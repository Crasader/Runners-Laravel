<?php

namespace App\Http\Controllers\Role;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\StoreRole;
use App\Http\Requests\Roles\UpdateRole;

/**
 * RoleController
 *
 * @author Bastien Nicoud
 * @package App\Http\Controllers\Role
 */
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Role::class);
        $roles = Role::assignablesRoles()->get();
        return view('roles.index')->with(compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Role::class);
        $role = Role::first();
        $permissions = $role->permissions;
        return view('roles.create')->with(compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Roles\StoreRole  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRole $request)
    {
        $this->authorize('create', Role::class);
        Role::create($request->all());
        return redirect()->route('roles.index')->with('success', 'Le rôle à bien été crée');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $this->authorize('view', Role::class);
        return view('roles.show')->with(compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update', Role::class);
        return view('roles.edit')->with(compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Roles\UpdateRole  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRole $request, Role $role)
    {
        $this->authorize('update', Role::class);
        $role->fill($request->all());
        $role->save();
        return redirect()->route('roles.show', ['role' => $role->id])->with('success', 'Le rôle à bien été modifié !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);
        if (!$role->users()->exists()) {
            $role->delete();
            return redirect()
                ->route('roles.index')
                ->with('success', "{$role->name} a bien été supprimé !");
        }
        return redirect()->back()->with('danger', 'Ce rôle est utilisé, vous ne pouvez pas le supprimer.');
    }
}
