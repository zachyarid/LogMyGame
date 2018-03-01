<?php

namespace App\Http\Controllers;

use App\GameLocation;
use Illuminate\Http\Request;
use App\Http\Requests\GameLocationController\GameLocationCreateRequest as MyRequest;

class GameLocationsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function store(MyRequest $request)
    {
        GameLocation::create([
            'location' => $request->location
        ]);

        return redirect('/game/add');
    }
}
