<?php

namespace App\Http\Controllers;

use App\Mileage;
use Illuminate\Http\Request;
use App\Http\Requests\MileageController\MileageCreateRequest as MyRequest;

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
        $data = [
            'pageTitle' => 'Log Mileage',
        ];

        return view('pages.mileage.log-mileage', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MyRequest $request)
    {
        Mileage::create([
            'user_id' => \Auth::id(),
            'game_id' => $request->game_id,
            'odometer_out' => $request->odoout,
            'odometer_in' => $request->odoin,
            'distance' => $request->odoin - $request->odoout,
        ]);

        return redirect('/mileage')->with('message', 'Mileage logged!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MileageController  $mileageController
     * @return \Illuminate\Http\Response
     */
    public function show(Mileage $mileageController)
    {
        $data = [
            'pageTitle' => 'View Mileage Entry',
        ];


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MileageController  $mileageController
     * @return \Illuminate\Http\Response
     */
    public function edit(Mileage $mileageController)
    {
        $data = [
            'pageTitle' => 'Edit Mileage Entry',
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MileageController  $mileageController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mileage $mileageController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MileageController  $mileageController
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mileage $mileageController)
    {
        //
    }
}
