<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        if ($request->file('picture')->isValid()) {
            return 'toto';
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
