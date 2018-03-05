<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Game;
use App\GameLocation;
use App\GameType;
use App\Http\Requests\GameController\GameCreateRequest as CreateRequest;
use App\Http\Requests\GameController\GameEditRequest as EditRequest;

class GameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'View Games',
            'games' => Game::where(['user_id' => \Auth::id()])->get(),
        ];

        return view('pages.game.view-game', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allteams = [];
        $allhometeams = DB::table('games')->select('home_team')->distinct()->get();
        $allawayteams = DB::table('games')->select('away_team')->distinct()->get();

        foreach ($allhometeams as $team)
        {
            $allteams[] = $team->home_team;
        }

        foreach ($allawayteams as $team)
        {
            $allteams[] = $team->away_team;
        }

        $data = [
            'pageTitle' => 'Log Game',
            'gametypes' => GameType::all(),
            'gamelocs' => GameLocation::all(),
            'ages' => DB::table('ages')->get(),
            'allteams' => $allteams,
        ];

        return view('pages.game.log-game', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        Game::create([
            'user_id' => \Auth::id(),
            'date' => $request->game_date,
            'time' => $request->game_time,
            'location_id' => $request->location,
            'age_id' => $request->age,
            'home_team' => $request->home_team,
            'home_team_score' => $request->home_score,
            'away_team' => $request->away_team,
            'away_team_score' => $request->away_score,
            'center_name' => $request->center_name,
            'ar1_name' => $request->ar1_name,
            'ar2_name' => $request->ar2_name,
            'th_name' => $request->th_name,
            'comments' => $request->comments,
            'game_fee' => $request->game_fee,
            'miles_run' => $request->miles_run,
            'type' => $request->game_type,
            'platform' => $request->platform,
            'ussf_grade' => \Auth::user()->ussf_grade,
        ]);

        return redirect('/game')->with('success_message', 'Game added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        $this->authorize('view', $game);

        $data = [
            'pageTitle' => 'View Game',
            'game' => $game,
            'gametypes' => GameType::all(),
            'gamelocs' => GameLocation::all(),
            'ages' => DB::table('ages')->get(),
        ];

        return view('pages.game.show-game', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        $this->authorize('view', $game);

        $data = [
            'pageTitle' => 'Edit Game',
            'game' => $game,
            'gametypes' => GameType::all(),
            'gamelocs' => GameLocation::all(),
            'ages' => DB::table('ages')->get(),
        ];

        return view('pages.game.edit-game', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Game $game)
    {
        $this->authorize('update', $game);

        $newGame = Game::find($game->id);

        $newGame->date = $request->game_date;
        $newGame->time = $request->game_time;
        $newGame->location_id = $request->location;
        $newGame->age_id = $request->age;
        $newGame->home_team = $request->home_team;
        $newGame->home_team_score = $request->home_score;
        $newGame->away_team = $request->away_team;
        $newGame->away_team_score = $request->away_score;
        $newGame->center_name = $request->center_name;
        $newGame->ar1_name = $request->ar1_name;
        $newGame->ar2_name = $request->ar2_name;
        $newGame->th_name = $request->th_name;
        $newGame->comments = $request->comments;
        $newGame->game_fee = $request->game_fee;
        $newGame->miles_run = $request->miles_run;
        $newGame->type = $request->game_type;

        $newGame->save();

        return redirect('/game')->with('success_message', 'Game updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        $this->authorize('delete', $game);

        // Not sure if I want to allow a game deletion
    }
}
