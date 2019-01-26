<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the homepage
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the home page for connected users
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Show the information page (versions, copiright...)
     *
     * @return \Illuminate\Http\Response
     */
    public function infos()
    {
        return view('infos');
    }

    /**
     * For dev & test purposes only: reseed the database !!!
     */
    public function reseed($token)
    {
        if (User::where('api_token','=',$token)->get()->count() == 1)
            exec("
            cd ..
            php artisan migrate:fresh --seed
            ");
        return redirect('/');
    }
}
