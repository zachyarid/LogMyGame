<?php

namespace App\Http\Controllers;

use App\GameType;
use Illuminate\Http\Request;
use App\Http\Requests\GameTypeController\GameTypeCreateRequest as MyRequest;

class GameTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(MyRequest $request)
    {
        GameType::create([
            'name' => $request->name,
            'location' => $request->location,
            'assignor' => $request->assignor,
            'hotel' => $request->hotel,
            'travel' => $request->travel,
            'grade_premium' => $request->grade_premium,
        ]);

        return redirect('/game/add');
    }
}