<?php

namespace App\Http\Controllers;

use App\Game;
use App\GameType;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ImportController\GameImportRequest as ImportRequest;

class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'Import Menu',
        ];

        return view('pages.import.index', $data);
    }

    public function instructions()
    {
        $data = [
            'pageTitle' => 'Import Instructions',
        ];

        return view('pages.import.instructions', $data);
    }

    public function importGames(ImportRequest $request)
    {
        $path = $request->file('import')->getRealPath();
        try {
            $data = \Excel::load($path, function ($reader) {
            })->get();
        } catch (Exception $e) {
            return back()->with('fail_message', $e->getMessage());
        }

        //dd($data);

        if(!empty($data) && $data->count())
        {
            foreach ($data->toArray() as $row)
            {
                if(!empty($row))
                {
                    $add_comm = '';

                    switch ($request->source) {
                        case 'go':

                            try {
                                $datetime = Carbon::parse($row['date_time']);
                            } catch (Exception $e)
                            {
                                return back()->with('fail_message', $e->getMessage());
                            }

                            if ($datetime->diffInDays(Carbon::now()) > 0)
                            {
                                $message = 'Game import failed. Future games not allowed. No games have been imported.';
                                return back()->with('fail_message', $message);
                            }
                            $date = $datetime->format('Y-m-d');
                            $time = $datetime->format('H:i');

                            $c = str_replace('REF: ', '', $row['official_1']);
                            $a1 = str_replace('AR1: ', '', $row['official_2']);
                            $a2 = str_replace('AR2: ', '', $row['official_3']);
                            $th = str_replace('4TH: ', '', $row['official_4']);

                            $game = $row['game']; # game number from GO

                            $home = $row['home'];
                            $home_score = -1; #filler
                            $away = $row['away'];
                            $away_score = -1; #filler
                            $game_fee = 0; #filler
                            $miles_run = 0; #filler

                            $league = $row['league'];
                            $result = DB::table('game_types')
                                ->where([
                                    ['user_id', '=', \Auth::id()],
                                    ['name', 'like', "%$league%"]
                                ])->get();
                            if ($result->count() == 1)
                            {
                                // found
                                $game_type = $result[0]->id;
                            } else if ($result->count() > 1 || $result->count() == 0)
                            {
                                // more than one match or no matcches.
                                // create one
                                $gametype = GameType::create([
                                    'user_id' => \Auth::id(),
                                    'name' => $league,
                                    'location' => 'Various',
                                    'assignor' => 'Various',
                                    'hotel' => false,
                                    'travel' => false,
                                    'grade_premium' => false,
                                    'comments' => "<p>[System Generated] Game Type created automatically. It might be necessary to alter some automatically generated details.</p>"
                                ]);
                                $game_type = $gametype->id;
                            } else {
                                $game_type = 0;
                                $add_comm = "<p style='color:red;'>Unable to process Game Type.</p>";
                            }

                            $comments = "<p>[System Generated] Game imported from external source. Game: $game</p><p>System Fillers used for location, age/level, scores, and game fee.</p>$add_comm";

                            break;

                        case 'csv':
                            try {
                                $datetime = Carbon::createFromFormat('Y-m-d H:i', $row['date'] . ' ' . $row['time']);
                            } catch (Exception $e) {
                                return back()->with('fail_message', $e->getMessage());
                            }
                            $diff = $datetime->diffInDays(Carbon::now());

                            if ($diff > 0)
                            {
                                $message = 'Game import failed! Future games not allowed. No games have been imported.';
                                return back()->with('fail_message', $message);
                            }

                            $date = $datetime->format('Y-m-d');
                            $time = $datetime->format('H:i:s');

                            $game_type = 0; # force 0

                            $home = $row['home_team'];
                            $home_score = $row['home_team_score'];
                            $away = $row['away_team'];
                            $away_score = $row['away_team_score'];

                            $c = $row['center_name'];
                            $a1 = $row['ar1_name'];
                            $a2 = $row['ar2_name'];
                            $th = $row['th_name'];
                            $game_fee = $row['game_fee'];
                            $comments = '<p>' . $row['comments'] . '</p><p>Age: ' . $row['age'] . '</p>';
                            $miles_run = $row['miles_run'];

                            $comments .= "<p>[System Generated] Game imported from external source.</p><p>System Fillers used for Location, Age/Level, Game Type.</p>";

                            break;

                        default:
                            return back()->with('fail_message', 'Invalid request.');

                            break;
                    }

                    // Final data array for insert
                    $gameArray[] =
                        [
                            'date' => $date,
                            'time' => $time,
                            'location_id' => 0, # system fillers
                            'age_id' => 0, # system fillers
                            'type' => $game_type, # possible system filler depending on flow
                            'home_team' => $home,
                            'home_team_score' => $home_score,
                            'away_team_score' => $away_score,
                            'away_team' => $away,
                            'center_name' => !empty($c) ? $c : null,
                            'ar1_name' => !empty($a1) ? $a1 : null,
                            'ar2_name' => !empty($a2) ? $a2 : null,
                            'th_name' => !empty($th) ? $th : null,
                            'game_fee' => $game_fee,
                            'miles_run' => $miles_run,
                            'platform' => 'import-' . $request->source,
                            'comments' => $comments,
                            'ussf_grade' => \Auth::user()->ussf_grade,
                            'user_id' => \Auth::id(),
                        ];
                }
            }

            if(!empty($gameArray))
            {
                try {
                    DB::transaction(function () use ($gameArray) {
                        Game::insert($gameArray);
                    });
                } catch (Exception $e) {
                    switch ($e->getCode())
                    {
                        case 23000:
                            $errorMessage = "There is already a game with the same date and time in the system. Check the game details and try again";
                            break;
                        default:
                            $errorMessage = "An unknown error has occurred";
                            break;
                    }

                    return back()->with('fail_message', $errorMessage);
                }

                return back()->with('success_message', 'Games imported! Please check for accuracy');
            }
        }
    }
}
