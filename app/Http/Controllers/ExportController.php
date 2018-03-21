<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'Export Menu',
        ];

        return view('pages.export.index', $data);
    }

    public function exportGames(Request $request)
    {
        $games = DB::table('games')
            ->join('game_locations', 'games.location_id', '=', 'game_locations.id')
            ->join('game_types', 'games.type', '=', 'game_types.id')
            ->join('ages', 'games.age_id', '=', 'ages.id')
            ->select('games.id as Game Number', 'date as Game Date', 'time as Game Time', 'game_locations.location as Location', 'ages.string as Level',
                'home_team as Home', 'home_team_score as Home Score', 'away_team_score as Away Score', 'away_team as Away',
                'center_name as Center', 'ar1_name as AR1', 'ar2_name as AR2', 'th_name as 4th', 'game_fee as Game Fee', 'miles_run as Miles Run')
            ->where('games.user_id', '=', \Auth::id())
            ->get();

        $this->exportData($games, $request->type, 'games');
    }

    public function exportMileage(Request $request)
    {
        $mileage = DB::table('mileage')
            ->select('mileage.id as Mileage Number', 'date_travel as Date of Travel', 'odometer_out as Odometer Out', 'odometer_in as Odometer In',
                'distance as Mileage')
            ->where('mileage.user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->get();

        $this->exportData($mileage, $request->type, 'mileage');
    }

    public function exportPayments(Request $request)
    {
        $payments = DB::table('payments')
            ->join('games', 'payments.game_id', '=', 'games.id')
            ->select('payments.id as Payment Number', 'games.id as Game Number', 'games.date as Game Date', 'games.time as Game Time',
                'games.home_team as Home Team', 'games.away_team as Away Team', 'games.game_fee as Amount', 'payer as Payer',
                'check_number as Reference Number', 'date_received as Date Received')
            ->where('payments.user_id', '=', \Auth::id())
            ->get();

        $this->exportData($payments, $request->type, 'payments');
    }

    private function exportData($data, $type, $object)
    {
        $data = json_decode( json_encode($data), true );

        Excel::create("logmygames-$object-export", function($excel) use($data) {
            $excel->sheet('ExportFile', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export($type);
    }

}
