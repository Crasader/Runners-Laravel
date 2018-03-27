<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Run;
use App\Http\Resources\waypoints\WaypointCollection;

/**
 * RunWaypointController
 * Api ressource controller
 *
 * @author Bastien Nicoud
 * @package App\Http\Controllers\api
 */
class RunWaypointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Run $run)
    {
        return new WaypointCollection($run->waypoints()->get());
    }
}
