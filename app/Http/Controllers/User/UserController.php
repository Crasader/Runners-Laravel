<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\StoreUser;
use App\Http\Requests\Users\UpdateUser;
use App\Http\Resources\Users\UserResource;
use App\Http\Resources\users\UserSearchResource;
use App\Status;

/**
 * UserController
 *
 * @author Bastien Nicoud
 * @package App\Http\Controllers\User
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::filter($request, 'lastname', 'asc')->paginate(20);
        return view('users/index')->with(compact('users'));
    }

    /**
     * Display the personal page of the connected user
     *
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        // Redirect to the user page with the id of the authenticated user
        return redirect()->route('users.show', ['user' => Auth::user()->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $roles = Role::assignablesRoles()->get();
        $statuses = Status::userStatuses()->get();
        return view('users.create')->with(compact('roles', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Users\StoreUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $this->authorize('create', User::class);
        $user = new User($request->all());
        $user->generateName();
        $user->save();
        $user->generateDefaultPictures();
        $user->addRole($request->role);
        $user->setStatus($request->status);

        return redirect()
            ->route('users.show', ['user' => $user->id])
            ->with('success', "L'utilisateur {$user->fullname} a bien été crée");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show')->with(compact('user'));
    }

    /**
     * Search in the model, return json
     * This method is designed to be used with the search fields (see the search field component)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if ($request->needle) {
            // Case insensitive search
            $results = User::whereRaw('LOWER(`firstname`) LIKE ? ', [trim(strtolower($request->needle)).'%'])->get();
            return UserSearchResource::collection($results);
        } else {
            return response()->json([], 200);
        }
        return response()->json([], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $roles = Role::assignablesRoles()->get();
        $statuses = Status::userStatuses()->get();
        return view('users.edit')->with(compact('user', 'roles', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Users\UpdateUser  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        $this->authorize('update', $user);
        $user->fill($request->all());
        $user->generateName();
        $user->save();
        $user->addRole($request->role);
        $user->setStatus($request->status);

        return redirect()
            ->route('users.show', ['user' => $user->id])
            ->with('success', "L'utilisateur {$user->fullname} a bien été modifié");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', "{$user->fullname} a bien été supprimé !");
    }

    /**
     * Send a credentials request to the user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateCredentials(Request $request)
    {
        return redirect()
            ->back()
            ->with('warning', "La génération des credentials n'est pas encore implémentée !");
    }

    /**
     * Import a list of users direct from a csv file
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        return redirect()
            ->back()
            ->with('warning', "L'importation des credentials par csv n'est pas encore implémentée !");
    }
}
