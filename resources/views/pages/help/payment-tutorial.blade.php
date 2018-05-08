@extends('layouts.template')

@section('content')
    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-md-10">
                <p>So you've just logged a game and a few days later, you have received payment for that game.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">
                <img width="1100px" src="{{ Storage::disk('public')->url('help/log_payment.png') }}" />
            </div>
        </div>

        <div class="row">
            <p class="mg-t-20">To log a payment, select the game/s for which you are trying to log the payment. You may select multiple games for one payment.</p>
            <p>Enter a check or reference number. Note, this is <strong>not</strong> a required field, so for cash payments, this field may be omitted.</p>
            <p>Enter who is paying. For club soccer, this is usually the home team, or the teams might split the game fee (like in this example). </p>
            <p>The Date Received field will default to today's date, but you may change it, if needed.</p>
            <p>Finally, click Log Payment. You will be taken back to the View Payments page where you can view/edit your payments.</p>
        </div>
    </div>
@endsection