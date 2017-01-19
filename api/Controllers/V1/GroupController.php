<?php
/**
 * Created by PhpStorm.
 * User: Thomas.RICCI
 * Date: 12.01.2017
 * Time: 13:44
 */

namespace Api\Controllers\V1;


use App\Group;
use App\User;
use Api\Controllers\BaseController;
use Illuminate\Http\Request;

class GroupController extends BaseController
{
    public function index()
    {
        return Group::all();
    }
    public function show(Group $group)
    {
        return $group;
    }
    public function update(Request $request, Group $group)
    {
        $group->update($request->all());

        //$userID = $request->input()["data"];

        $user = User::findOrFail($request->get("user"));
        $user->group_id = $group->id;

        $user->save();

        return $this->response()->accepted(route("groups.update",$group->id));
    }
    public function store(Request $request)
    {
        $group = new Group;
        $group->fill($request->all());
        $group->save();
        return $this->response()->created(route("groups.show",$group->id));
    }
    public function delete(Group $user)
    {
        return $user->delete();
    }
}
