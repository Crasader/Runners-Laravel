<?php

namespace App\Http\Controllers\User;

use App\Attachment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * UserQrCodeController
 *
 * @author Bastien Nicoud
 * @package App\Http\Controllers\User
 */
class UserQrCodeController extends Controller
{
    /**
     * Create a fresh QR code for the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(User $user)
    {
        $this->authorize('create', User::class);

        $user->generateQrCode();

        return redirect()
            ->back()
            ->with('success', "Un QR code pour {$user->fullname} a bien été généré.");
    }

    /**
     * Delete the qr code for the user
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('create', User::class);

        $user->deleteQrCode();

        return redirect()
            ->back()
            ->with('warning', "Le QR code de {$user->fullname} a bien supprimmé,
                il ne peut plus se connecter a l'app mobile.");
    }
}
