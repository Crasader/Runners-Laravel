<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MobileAppController extends Controller
{
    public function download()
    {
        return Storage::disk('public')->download("app/palerunner.apk");
    }
}
