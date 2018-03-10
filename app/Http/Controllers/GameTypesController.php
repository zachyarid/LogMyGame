<?php

namespace App\Http\Controllers;

use App\GameType;
use App\Http\Requests\GameTypeController\GameTypeCreateRequest as CreateRequest;
use App\Http\Requests\GameTypeController\GameTypeCreateAjaxRequest as CreateAjaxRequest;

class GameTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'View Game Types',
            'gametypes' => GameType::own()->default()->get(),
        ];

        return view('pages.gametype.view-gt', $data);
    }

    public function create()
    {
        $data = [
            'pageTitle' => 'Create Game Type'
        ];

        return view('pages.gametype.create-gt', $data);
    }

    public function storeAjax(CreateAjaxRequest $request)
    {
        GameType::create([
            'name' => $request->name,
            'location' => $request->location,
            'assignor' => $request->assignor,
            'hotel' => $request->hotel,
            'travel' => $request->travel,
            'grade_premium' => $request->grade_premium,
            'user_id' => \Auth::id(),
        ]);

        return GameType::select('name', 'id')->get();
    }

    public function store(CreateRequest $request)
    {
        GameType::create([
            'name' => $request->name,
            'location' => $request->location,
            'assignor' => $request->assignor,
            'hotel' => $request->hotel == 'on' ? 'true' : 'false',
            'travel' => $request->travel == 'on' ? 'true' : 'false',
            'grade_premium' => $request->grade_premium == 'on' ? 'true' : 'false',
            'user_id' => \Auth::id(),
        ]);

        return redirect('/gametype')->with('success_message', 'Game Type added!');
    }

    public function viewGamesUsed($type)
    {
        $data = [
            'pageTitle' => 'Games Used By Type',
            'whereused' => \Auth::user()->games->where('type', $type),
        ];

        return view('pages.gametype.view-games-used', $data);
    }

    public function edit(GameType $gametype)
    {
        $this->authorize('view', $gametype);

        $data = [
            'pageTitle' => 'Edit Game Type',
            'gametype' => $gametype,
        ];

        return view('pages.gametype.edit-gt', $data);
    }

    public function update(CreateRequest $request, GameType $gametype)
    {
        $this->authorize('update', $gametype);

        $newType = GameType::find($gametype->id);

        $newType->name = $request->name;
        $newType->location = $request->location;
        $newType->assignor = $request->assignor;
        $newType->hotel = $request->hotel == 'on' ? 'true' : 'false';
        $newType->travel = $request->travel == 'on' ? 'true' : 'false';
        $newType->grade_premium = $request->grade_premium == 'on' ? 'true' : 'false';

        $newType->save();

        return redirect('/gametype')->with('success_message', 'Game type updated!');
    }

    public function destroy(GameType $gametype)
    {
        $this->authorize('delete', $gametype);

        $count = \Auth::user()->games->where('type', $gametype->id)->count();

        if ($count > 0)
        {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'There are games that exist with this Game Type. Change the existing game types before removing this one.'
            ]);
            throw $error;
        }
        else
        {
            $gametype->delete();
        }
    }
}