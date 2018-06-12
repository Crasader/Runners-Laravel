<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Users\StorePicture;

/**
 * UserLicencePictureController
 *
 * @author Bastien Nicoud
 * @package App\Http\Controllers\User
 */
class UserLicencePictureController extends Controller
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
        $this->authorize('update', $user);

        if ($request->file('picture')->isValid()) {
            // Delete the old picture
            if ($user->licencePictures()->exists()) {
                Storage::delete($user->licencePictures->first()->path);
                $user->licencePictures()->delete();
            }
            // Store the picture on the storage
            $path = $request->picture->store('public/licences');
            // Create the new attachment
            $attachment = new Attachment(['type' => 'licence', 'path' => $path]);
            $attachment->owner()->associate(Auth::user());
            $attachment->save();
            // Associate this attachment to the edited user
            $user->attachments()->save($attachment);
            // Success message
            return redirect()
                ->back()
                ->with('success', "Le photo du permis a corréctement été modifiée.");
        } else {
            // In invalid request case
            return redirect()
                ->back()
                ->with('danger', "L'image n'a pas été correctement transférée.");
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
        $this->authorize('update', $user);

        // Delete the old picture
        if ($user->licencePictures()->exists()) {
            Storage::delete($user->licencePictures->first()->path);
            $user->licencePictures()->delete();
            $default = new Attachment(['type' => 'licence', 'path' => 'licences/default.jpg']);
            // Set the owner of this attachments
            $default->owner()->associate($user);
            $default->save();

            // add the attachment of this user
            $user->attachments()->save($default);

            // Success message
            return redirect()
                ->back()
                ->with('success', "L'image a été correctement suprimée.");
        } else {
            // In invalid request case
            return redirect()
                ->back()
                ->with('danger', "Image inéxistante.");
        }
    }
}
