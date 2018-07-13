<?php

namespace App\Http\Controllers\Group;

use App\User;
use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Groups\StoreGroup;
use App\Http\Requests\Groups\UpdateGroup;
use App\Http\Requests\Groups\UpdateGroupUserAssociations;
use Illuminate\Support\Facades\Auth;

/**
 * GroupController
 *
 * @author Bastien Nicoud
 * @package App\Http\Controllers\Group
 */
class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Group::class);
        $groups = Group::paginate(20);
        return view('groups.index')->with(compact('groups'));
    }

    /**
     * Display the group manage (drag n drop system)
     *
     * @return \Illuminate\Http\Response
     */
    public function manager()
    {
        $groups = Group::with('users')->get();
        $usersWithoutGroup = User::doesntHave('groups')->get();
        if (Auth::user()->can('manage', Group::class)) {
            $this->authorize('manage', Group::class);
            return view('groups.manager')->with(compact('groups', 'usersWithoutGroup'));
        } else {
            return view('groups.managerNoEdit')->with(compact('groups', 'usersWithoutGroup'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Group::class);
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Groups\StoreGroup  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroup $request)
    {
        $this->authorize('create', Group::class);
        Group::create($request->all());
        return redirect()->route('groups.index')->with('success', 'Le groupe a bien été créé !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        $this->authorize('view', Group::class);
        return view('groups.show')->with(compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $this->authorize('update', $group);
        return view('groups.edit')->with(compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Groups\UpdateGroup  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroup $request, Group $group)
    {
        $this->authorize('update', $group);
        $group->fill($request->all());
        $group->save();
        return redirect()
            ->route('groups.show', ['group' => $group->id])
            ->with('success', 'Le groupe a bien été modifié !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Groups\UpdateGroupUserAssociations  $request
     * @return \Illuminate\Http\Response
     */
    public function managerUpdate(UpdateGroupUserAssociations $request)
    {
        $this->authorize('manage', Group::class);
        // The request contains association between users and groups
        // Get all the users have a group change
        $userGroupChanges = collect($request->user);
        // Get all the coresponding user
        $users = User::find($userGroupChanges->keys());
        // Iteraites each users
        $users->each(function ($user) use ($userGroupChanges) {
            if ($userGroupChanges->get($user->id) === 'no-group') {
                $user->groups()->sync([]);
            } else {
                // Sync the association
                $user->groups()->sync([$userGroupChanges->get($user->id)]);
            }
        });
        return redirect()
            ->back()
            ->with('success', "Les modifications ont correctement étés enregistrées.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);
        if ($group->users()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', "Le groupe {$group->name} n'est pas vide !");
        }
        $group->delete();
        return redirect()
            ->route('groups.index')
            ->with('success', "Le groupe {$group->name} a bien été supprimé !");
    }
}
