<?php

namespace App\Http\Controllers\Run;

use App\Run;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Comments\StoreComment;

/**
 * RunCommentController
 *
 * @author Bastien Nicoud
 * @package App\Http\Controllers\Run
 */
class RunCommentController extends Controller
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
     * @param  \App\Http\Requests\Comments\StoreComment  $request
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComment $request, Run $run)
    {
        // Create the comment
        $comment = new Comment($request->all());
        $comment->author()->associate(Auth::user());
        // Associate the comment to the commented user
        $comment->commentable()->associate($run);
        $comment->save();
        // Redirect to the consulted user page
        return redirect()->route('runs.show', ['run' => $run->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function show(Run $run)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function edit(Run $run)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Run $run)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Run  $run
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Run $run, Comment $comment)
    {
        $comment->delete();
        return redirect()->route('runs.show', ['run' => $run->id]);
    }
}
