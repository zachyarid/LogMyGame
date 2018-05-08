@extends('layouts.template')

@section('content')
    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-md-10">
                <p>There are two ways you can log the mileage that you drive.</p>

                <h5 class="mg-t-20">Method #1</h5>
                <p>To log mileage, select the game/s for which you are trying to log the mileage. You may select multiple games for one mileage log.</p>
                <p>The Date Traveled field will default to today's date, but you may change it, if needed.</p>
                <p>You may enter the total distance travelled, or your odometer out/in readings (this method will be discussed in Method #2)</p>
                <p>Finally, click Log Mileage. You will be taken back to the View Mileage page where you can view/edit your mileage logs.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">
                <img width="1100px" src="{{ Storage::disk('public')->url('help/log_mileage.png') }}" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">
                <hr class="mg-t-50" />
                <h5 class="mg-t-20">Method #2</h5>
                <p>Before you leave, you might want to enter your Odometer Out reading. On the left side bar, if you click Mileage Log > Start Pre-Trip, you will be asked to enter the odometer out reading as well as your origin.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <img src="{{ Storage::disk('public')->url('help/pre_trip.png') }}" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">
                <p class="mg-t-20">Once you click Start Pre-Trip, you will be brought to the View Mileage Logs page where you will see the Pre-Trip that you just logged.</p>
                <p>Please note that you will not be able to start another Pre-Trip Log or log mileage (Method #1) until you either complete or cancel the existing mileage log.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <img src="{{ Storage::disk('public')->url('help/complete_pretrip.png') }}" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">
                <p class="mg-t-20">When you complete your trip, you will be presented with a page that looks similar to Method #1 but with a few greyed out options</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <img src="{{ Storage::disk('public')->url('help/complete_mileage.png') }}" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">
                <p class="mg-t-20">Here, you can select the games which you would like to add to this mileage log, and enter either the odometer in reading OR the total distance traveled.</p>
                <p>Click Complete Mileage Log. You will be taken back to the View Mileage page where you can view/edit your mileage logs.</p>
            </div>
        </div>
    </div>
@endsection