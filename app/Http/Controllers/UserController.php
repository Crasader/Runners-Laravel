<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $user = User::all();
    // load the view and pass the user list
    return view('user.index')->with('users', $user);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(User $user)
  {
      return view("user.show",compact("user"));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $user = User::find($id);
    return view("user.edit")->with('user', $user);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    /*//TODO : Validation
    $this->validate($request, [
      'license_plates'   => 'required',
      'brand'            => 'required',
      'model'            => 'required'
    ]);*/
    $user = User::findOrFail($id);
    $input = $request->all();
    $user->fill($input)->save();
    return redirect('user');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    // delete
    $user = User::find($id);
    $user->delete();

    return redirect('user');
  }

}
