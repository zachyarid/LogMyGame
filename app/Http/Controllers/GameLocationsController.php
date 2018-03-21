<?php

namespace App\Http\Controllers;

use App\GameLocation;
use App\Http\Requests\GameLocationController\GameLocationCreateRequest as CreateRequest;

class GameLocationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'View Game Locations',
            'gamelocs' => GameLocation::own()->default()->get(),
        ];

        return view('pages.gamelocation.view-gl', $data);
    }

    public function create()
    {
        $data = [
            'pageTitle' => 'Create Game Location'
        ];

        return view('pages.gamelocation.create-gl', $data);
    }

    public function store(CreateRequest $request)
    {
        GameLocation::create([
            'location' => $request->location,
            'comments' => $request->comments,
            'user_id' => \Auth::id(),
        ]);

        return redirect('/gamelocation')->with('success_message', 'Game Location added!');
    }

    public function storeAjax(CreateRequest $request)
    {
        GameLocation::create([
            'location' => $request->location,
            'user_id' => \Auth::id(),
        ]);

        return GameLocation::select('location', 'id')->get();
    }

    public function viewGamesUsed($location)
    {
        $data = [
            'pageTitle' => 'Games Used By Location',
            'whereused' => \Auth::user()->games->where('location_id', $location),
        ];

        return view('pages.gamelocation.view-games-used', $data);
    }

    public function edit(GameLocation $gamelocation)
    {
        $this->authorize('view', $gamelocation);

        $data = [
            'pageTitle' => 'Edit Game Location',
            'gamelocation' => $gamelocation,
        ];

        return view('pages.gamelocation.edit-gl', $data);
    }

    public function update(CreateRequest $request, GameLocation $gamelocation)
    {
        $this->authorize('update', $gamelocation);

        $newLoc = GameLocation::find($gamelocation->id);

        $newLoc->location = $request->location;
        $newLoc->comments = $request->comments;
        $newLoc->save();

        return redirect('/gamelocation')->with('success_message', 'Game location updated!');
    }

    public function destroy(GameLocation $gamelocation)
    {
        $this->authorize('delete', $gamelocation);

        $count = \Auth::user()->games->where('location_id', $gamelocation->id)->count();

        if ($count > 0)
        {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'There are games that exist with this Game Location. Change the existing game locations before removing this one.'
            ]);
            throw $error;
        }
        else
        {
            $gamelocation->delete();
        }
    }
}
