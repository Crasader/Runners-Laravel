<?php
/**
 * User: Eric.BOUSBAA
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Lib\Models\Group;
use Lib\Models\User;

class GroupController extends Controller
{
  public function __construct()
  {
    $this->middleware("auth");
  }
    /**
     * Display all the groups with the users included
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::with("users")->get();
        // get the users wihout groups. Theses users are in the "no group" container
        $usersWithoutGroup = User::whereNull("group_id")->get();

        return view('group.index', ["groups" => $groups, "no_group" => $usersWithoutGroup]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
