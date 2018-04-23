<?php

namespace App\Http\Controllers\User;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\Users\StoreUserComment;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

/**
 * UserCommentController
 *
 * @author Bastien Nicoud
 * @package App\Http\Controllers\User
 */
class UserCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\Users\StoreUserComment  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserComment $request, User $user)
    {
        // Create the comment
        $comment = new Comment($request->all());
        $comment->author()->associate(Auth::user());
        $comment->save();
        // Associate the comment to the commented user
        $user->comments()->save($comment);
        // Redirect to the consulted user page
        return redirect()->route('users.show', ['user' => $user->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Comment $comment)
    {
        $comment->delete();
        return redirect()->route('users.show', ['user' => $user->id]);
    }
}
