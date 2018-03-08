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
        foreach ($allcenters as $c)
        {
            if (!in_array($c->center_name, $allrefs)) {
                $allrefs[] = $c->center_name;
            }
        }

        // all ar1s
        $allar1 = DB::table('games')->select('ar1_name')->distinct()->get();
        foreach ($allar1 as $c)
        {
            if (!in_array($c->ar1_name, $allrefs)) {
                $allrefs[] = $c->ar1_name;
            }
        }

        // all ar2s
        $allar2 = DB::table('games')->select('ar2_name')->distinct()->get();
        foreach ($allar2 as $c)
        {
            if (!in_array($c->ar2_name, $allrefs)) {
                $allrefs[] = $c->ar2_name;
            }
        }

        // all 4ths
        $allth = DB::table('games')->select('th_name')->distinct()->get();
        foreach ($allth as $c)
        {
            if (!in_array($c->th_name, $allrefs)) {
                $allrefs[] = $c->th_name;
            }
        }

        // all users (fname . ' ' . lname)
        $alluser = DB::table('users')->select(DB::raw('concat(fname, \' \', lname) as name'))->get();
        foreach ($alluser as $c)
        {
            if (!in_array($c->name, $allrefs)) {
                $allrefs[] = $c->name;
            }
        }

        return $allrefs;
    }
}
