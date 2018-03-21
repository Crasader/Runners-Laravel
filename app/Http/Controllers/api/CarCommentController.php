<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Car;
use App\Comment;
use App\Http\Requests\StoreComment;
use App\Http\Resources\Comments\CommentCollection;
use App\Http\Resources\Comments\CommentResource;

/**
 * CarCommentController
 * Api ressource controller
 *
 * @author Bastien Nicoud
 * @package App\Http\Controllers\api
 */
class CarCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function index(Car $car)
    {
        return new CommentCollection($car->comments()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Car  $car
     * @param  \App\Http\Requests\StoreComment  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Car $car, StoreComment $request)
    {
        $comment = new Comment($request->all());
        $comment->author()->associate($request->user());
        $car->comments()->save($comment);
        return new CommentResource($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car, Comment $comment)
    {
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Car  $car
     * @param  \App\Comment  $comment
     * @param  \App\Http\Requests\StoreComment  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Car $car, StoreComment $request, Comment $comment)
    {
        $comment->fill($request->all());
        $comment->save();
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car, Comment $comment)
    {
        $comment->delete();
        return response()->json(null, 204);
    }
}
