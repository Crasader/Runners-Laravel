<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\Users\StoreUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\UpdateUser;

/**
 * UserController
 *
 * @author Bastien Nicoud
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('firstname', 'asc')->paginate(20);
        return view('users/index')->with(compact('users'));
    }

    /**
     * Display the personal page of the connected user
     *
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        return redirect()->route('users.show', ['user' => Auth::user()->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Users\StoreUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $this->authorize('create', User::class);
        $user = new User($request->all());
        $user->generateName();
        $user->save();
        $user->generateDefaultPictures();
        return redirect()
            ->route('users.show', ['user' => $user->id])
            ->with('success', "L'utilisateur {$user->fullname} a bien été crée");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show')->with(compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit')->with(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Users\UpdateUser  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        $this->authorize('update', $user);

        return redirect()
            ->route('users.edit', ['user' => $user->id])
            ->with('success', "L'utilisateur {$user->fullname} a bien été modifié");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        return 'true';
    }

    /**
     * Create a fresh QR code for the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function generateQrCode(User $user)
    {
        $user->generateQrCode();
        return redirect()
            ->back()
            ->with('success', "Un QR code pour {$user->fullname} a bien été généré.");
    }

    /**
     * Create a fresh QR code for the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function deleteQrCode(User $user)
    {
        $user->deleteQrCode();
        return redirect()
            ->back()
            ->with('warning', "Le QR code de {$user->fullname} a bien supprimmer,
                il ne peut plus se connecter a l'app mobile.");
    }
}
