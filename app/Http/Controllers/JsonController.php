<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class JsonController extends Controller
{
    public function showAllTeams()
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

        return $allteams;
    }

    public function showAllReferees()
    {
        $allrefs = [];

        // all centers
        $allcenters = DB::table('games')->select('center_name')->distinct()->get();

        // all ar1s

        // all ar2s

        // all 4ths

        // all users (fname . ' ' . lname)

        // combine
        foreach ($allcenters as $c)
        {
            $allrefs[] = $c->center_name;
        }

        return $allrefs;
    }
}
