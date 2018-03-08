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
        $pd = [];
        $payments = \Auth::user()->payments;
        foreach ($payments as $p)
        {
            $pd[] = $p->game_id;
        }

        $data = [
            'pageTitle' => 'Dashboard',
            'games' => \Auth::user()->games, // TODO: This is not limiting like I'd like
            'outstanding' => \Auth::user()->games->whereNotIn('id', $pd),
        ];

        return view('pages.home', $data);
    }
}
