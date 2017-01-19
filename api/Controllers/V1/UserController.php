<?php
/**
 * Created by PhpStorm.
 * User: Thomas.RICCI
 * Date: 12.01.2017
 * Time: 13:44
 */

namespace Api\Controllers\V1;


use Api\Controllers\BaseController;
use App\User;
use Illuminate\Http\Request;


class UserController extends BaseController
{
    public function index(Request $request)
    {
        $queryBuilder = new QueryBuilder(new User, $request);
        if($request->has("paginated"))
          return $queryBuilder->build()->paginate();
        return $queryBuilder->build()->get();

    }
    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return $this->response()->accepted(route("api.users.show",$user->id));
    }
    public function store(Request $request)
    {
        $user = new User;
        $user->fill($request->all());
        $user->save();
        return $this->response()->created(route("api.users.show",$user->id));
    }
    public function delete(User $user)
    {
        return $user->delete();
    }
    public function me()
    {
        return $this->user();
    }

}
