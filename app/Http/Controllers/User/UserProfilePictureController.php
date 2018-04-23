<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\StorePicture;

/**
 * UserProfilePictureController
 *
 * @author Bastien Nicoud
 * @package App\Http\Controllers\User
 */
class UserProfilePictureController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Users\StorePicture  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(StorePicture $request, User $user)
    {
        if ($request->file('picture')->isValid()) {
            // Delete the old picture
            if ($user->profilePictures()->exists()) {
                $user->profilePictures()->delete();
            }
            // Store the picture on the storage
            $path = $request->picture->store('public/licences');
            // Create the new attachment
            $attachment = new Attachment(['type' => 'profile', 'path' => $path]);
            $attachment->owner()->associate(Auth::user());
            $attachment->save();
            // Associate this attachment to the edited user
            $user->attachments()->save($attachment);
        } else {
            return redirect()
                ->back()
                ->with('warning', "L'image n'a pas été correctement transférée");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Attachment $attachment)
    {
        return 'tutu';
    }
}
