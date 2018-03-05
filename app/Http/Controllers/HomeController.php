<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'Dashboard',
            'games' => Game::where('user_id', \Auth::id())->limit(10)->get(),
            'outstanding' => Game::whereNotExists(function ($query) {
                                                    $query->select(DB::raw(1))
                                                    ->from('payments')
                                                    ->whereRaw('payments.game_id = games.id and payments.user_id = ' . \Auth::id());
            })->where('user_id', \Auth::id())->get()
        ];

        return view('pages.home', $data);
    }
}
