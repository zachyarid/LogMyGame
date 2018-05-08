@extends('layouts.template')

@section('content')
    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <p>Let's say that you've just refereed a game with the details below:</p>
            <img src="{{ Storage::disk('public')->url('help/example_game.png') }}" />
            <p class="mg-t-10">We will be using all of this information to log your game. Let's start with the game details.</p>
        </div>

        <div class="row">
            <div class="col-md-7">
                <img width="600px" src="{{ Storage::disk('public')->url('help/game_details.png') }}" />
            </div>
            <div class="col-md-4">
                <ul class="mg-t-10">
                    <li class="mg-10">The game's date was April 21, 2018</li>
                    <li class="mg-10">The game's time was 10:00 am</li>
                    <li class="mg-10">The game's type was D1 State League *</li>
                    <li class="mg-10">The game's location was Richard Siegel Soccer Complex *</li>
                    <li class="mg-10">The game's age/level was U18</li>
                </ul>
                <hr />
                <p>* There might be some confusion on how the Game Type and Location works. Please read <a target="_blank" href="{{ route('help.add-gt-gl') }}">this</a> page to learn more.</p>
                <p>Next, let's look at the team details.</p>
            </div>
        </div>

        <div class="row mg-t-20">
            <div class="col-md-7">
                <img width="600px" src="{{ Storage::disk('public')->url('help/team_details.png') }}" />
            </div>
            <div class="col-md-4">
                <ul class="mg-t-10">
                    <li class="mg-10">The home team was Team 1</li>
                    <li class="mg-10">The away team was Team 2</li>
                    <li class="mg-10">The home team's score was 1</li>
                    <li class="mg-10">The away team's score was 1</li>
                </ul>
                <hr />
                <p class="mg-t-10">Notice how there is a drop down beneath the Home Team text box. This is because Team 1 has already been entered into the system.</p>
                <p>You may click this drop down option to autocomplete this text box.</p>
                <p>Next, we will look at the referee details.</p>
            </div>
        </div>

        <div class="row mg-t-20">
            <div class="col-md-7">
                <img width="600px" src="{{ Storage::disk('public')->url('help/referee_details.png') }}" />
            </div>
            <div class="col-md-4">
                <ul class="mg-t-10">
                    <li class="mg-10">The center was Zach Yarid</li>
                    <li class="mg-10">AR1 was Another Referee</li>
                    <li class="mg-10">AR2 was Another Referee</li>
                    <li class="mg-10">There was no fourth official assigned to this game</li>
                    <li class="mg-10">The game fee was $70</li>
                </ul>
                <hr />
                <p class="mg-t-10">Since you can referee games with only one center, the center field is the only one that is required.</p>
                <p>For games that were dualled (High School or Middle School), the second referee would go in the Assistant Referee 1 text box.</p>
                <p>Next, we will look at miscellaneous details.</p>
            </div>
        </div>

        <div class="row mg-t-20">
            <div class="col-md-7">
                <img width="600px" src="{{ Storage::disk('public')->url('help/misc_details.png') }}" />
            </div>
            <div class="col-md-4">
                <ul class="mg-t-10">
                    <li class="mg-10">There were 5.4 miles run in the game.</li>
                    <li class="mg-10">These were the comments for the game.</li>
                </ul>
                <hr />
                <p class="mg-t-10">If you use a smart/fitness watch to log how many miles you run in the game, you can record that in this area.</p>
                <p>You may enter any comments that you may have about the game here, too!</p>
            </div>
        </div>

        <div class="row mg-t-20">
            <p>Finally, if the game was paid on the field, you may check the Payment Received checkbox to auto-log the payment.</p>
            <p>Alternatively, if payment will be mailed or sent via another method, you may leave this unchecked, and manually record the payment when received.</p>
            <img src="{{ Storage::disk('public')->url('help/final_game.png') }}" />
        </div>

        <div class="row mg-t-20">
            <p class="mg-t-10">When you have finished entering game details, click Log Game. You will be brought to the View Games page where you can view or edit any of the games that you have logged.</p>
            <p>Click <a href="{{ route('help.paymentTutorial') }}">here</a> for the tutorial on how to log a payment.</p>
        </div>
    </div>
@endsection