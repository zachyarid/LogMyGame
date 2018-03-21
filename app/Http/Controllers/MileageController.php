<?php

namespace App\Http\Controllers;

use App\Game;
use App\Mileage;
use Illuminate\Http\Request;
use App\Http\Requests\MileageController\MileageCreateRequest as CreateRequest;
use App\Http\Requests\MileageController\MileageEditRequest as EditRequest;
use App\Http\Requests\MileageController\MileageCompleteRequest as CompleteRequest;
use App\Http\Requests\MileageController\MileagePreRequest as PreRequest;

class MileageController extends Controller
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
            'pageTitle' => 'Mileage Log',
        ];

        return view('pages.mileage.view-mileage', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mileage = \Auth::user()->mileage->where('status', 'pre')->last();
        if ($mileage)
        {
            return redirect('/mileage')->with('fail_message', 'An existing, in-progress log already exists. If you wish to log a new trip, please cancel the current mileage log.');
        }

        $data = [
            'pageTitle' => 'Log Mileage',
        ];

        return view('pages.mileage.log-mileage', $data);
    }

    public function preTrip()
    {
        $mileage = \Auth::user()->mileage->where('status', 'pre')->last();
        if ($mileage)
        {
            return redirect('/mileage')->with('fail_message', 'An existing, in-progress log already exists. If you wish to log a new trip, please cancel the current mileage log.');
        }

        $data = [
            'pageTitle' => 'Start Pre-Trip'
        ];

        return view('pages.mileage.pre-trip', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        // One
        $mileage = Mileage::create([
            'user_id' => \Auth::id(),
            'origin' => $request->origin,
            'date_travel' => $request->date_travel,
            'odometer_out' => $request->odometer_out,
            'odometer_in' => $request->odometer_in,
            'distance' => is_null($request->odometer_in) && is_null($request->odometer_out) ? (int) $request->distance : (int) $request->odometer_in - (int) $request->odometer_out,
            'comments' => $request->comments,
            'status' => 'comp',
        ]);

        foreach ($request->game_id as $id) {
            // Many
            $game = Game::find($id);
            $game->mileage_id = $mileage->id;
            $game->save();
        }

        return redirect('/mileage')->with('success_message', 'Mileage logged!');
    }

    public function storePreTrip(PreRequest $request)
    {
        $mileage = \Auth::user()->mileage->where('status', 'pre')->last();

        if (!$mileage) {
            Mileage::create([
                'user_id' => \Auth::id(),
                'origin' => $request->origin,
                'odometer_out' => $request->odometer_out,
                'date_travel' => date('Y-m-d', time()),
                'status' => 'pre'
            ]);
        } else {
            return redirect('/mileage')->with('fail_message', 'Another trip is in progress. Please cancel that one if you wish to start another.');
        }

        return redirect('/mileage')->with('success_message', 'Pre-Trip has been started. Complete below');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mileage  $mileage
     * @return \Illuminate\Http\Response
     */
    public function show(Mileage $mileage)
    {
        $this->authorize('view', $mileage);

        $data = [
            'pageTitle' => 'View Mileage Entry',
            'mileage' => $mileage
        ];

        if ($mileage->status == 'pre')
        {
            return redirect('/mileage')->with('fail_message', 'Unable to view mileage entry');
        }

        return view('pages.mileage.show-mileage', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mileage  $mileage
     * @return \Illuminate\Http\Response
     */
    public function edit(Mileage $mileage)
    {
        $this->authorize('view', $mileage);

        $data = [
            'pageTitle' => $mileage->status == 'pre' ? 'Complete Mileage Entry' : 'Edit Mileage Entry',
            'mileage' => $mileage
        ];

        return view('pages.mileage.edit-mileage', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mileage  $mileage
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Mileage $mileage)
    {
        $this->authorize('update', $mileage);

        $newMileage = Mileage::find($mileage->id);

        if ($newMileage->status !== 'comp')
        {
            return redirect('/mileage')->with('fail_message', 'Incorrect type of form submission.');
        }

        foreach ($request->game_id as $id)
        {
            $game = Game::findOrFail($id);
            $game->mileage_id = $mileage->id;
            $game->save();
        }

        $newMileage->date_travel = $request->date_travel;
        $newMileage->origin = $request->origin;
        $newMileage->odometer_in = $request->odometer_in;
        $newMileage->odometer_out = $request->odometer_out;
        $newMileage->distance = !is_null($request->odometer_in) && !is_null($request->odometer_out) ? (int) $request->odometer_in - (int) $request->odometer_out : (int) $request->distance;
        $newMileage->comments = $request->comments;

        $newMileage->save();

        return redirect('/mileage')->with('success_message', 'Mileage Log edited!');
    }

    public function completePre(CompleteRequest $request, Mileage $mileage)
    {
        $this->authorize('update', $mileage);

        $newMileage = Mileage::find($mileage->id);

        if ($newMileage->status !== 'pre')
        {
            return redirect('/mileage')->with('fail_message', 'Incorrect type of form submission.');
        }

        foreach ($request->game_id as $id)
        {
            $game = Game::findOrFail($id);
            $game->mileage_id = $mileage->id;
            $game->save();
        }

        $newMileage->odometer_in = is_null($request->odometer_in) && !is_null($request->distance) ? $newMileage->odometer_out + $request->distance : $request->odometer_in;
        $newMileage->distance = is_null($request->distance) && !is_null($request->odometer_in) ? $request->odometer_in - $newMileage->odometer_out : $request->distance;

        $newMileage->comments = $request->comments;
        $newMileage->status = 'comp';
        $newMileage->save();

        return redirect('/mileage')->with('success_message', 'Trip completed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mileage  $mileage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mileage $mileage)
    {
        $this->authorize('delete', $mileage);

        if ($mileage->status == 'pre')
        {
            $mileage->delete();
        }
    }
}
