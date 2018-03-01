<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Game;
use Illuminate\Http\Request;
use App\Http\Requests\GameController\GameCreateRequest as MyRequest;

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

        return view('pages.game.view-game');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'gametypes' => DB::table('game_types')->get(),
            'gamelocs' => DB::table('game_locations')->get(),
            'ages' => DB::table('ages')->get(),
        ];


        return view('pages.game.log-game', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MyRequest $request)
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

        return redirect('/game')->with('message', 'Game added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}
