<?php

namespace App\Http\Controllers\api;

use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Groups\GroupResource;
use App\Http\Resources\Groups\GroupCollection;
use App\Http\Requests\StoreGroup;

/**
 * GroupController
 * Api ressource controller
 *
 * @author Nicolas Henry
 * @package App\Http\Controllers\api
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
        return new GroupCollection(Group::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroup $request)
    {
        $group = new Group($request->all());
        $group->save();
        return (new GroupResource($group))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return new GroupResource($group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGroup $request, Group $group)
    {
        $group->fill($request->all());
        $group->save();
        return new GroupResource($group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return response()->json(null, 204);
    }
}
