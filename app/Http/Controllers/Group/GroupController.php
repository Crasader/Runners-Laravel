<?php

namespace App\Http\Controllers\Group;

use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Groups\StoreGroup;
use App\Http\Requests\Groups\UpdateGroup;

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
        $this->authorize('view', Group::class);
        $groups = Group::with('users')->get();
        return view('groups.manager')->with(compact('groups'));
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
        return redirect()->route('groups.index')->with('success', 'Le groupe a bien été crée !');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function managerUpdate(Request $request)
    {
        dd($request->all());
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
        $group->delete();
        return redirect()
            ->route('groups.index')
            ->with('success', "Le groupe {$group->name} a bien été supprimé !");
    }
}
