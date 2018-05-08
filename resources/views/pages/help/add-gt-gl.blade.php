@extends('layouts.template')

@section('content')
    <div class="card pd-20 pd-sm-40">
        <div class="form-layout">
            <div class="row">
                <h4>Game Types</h4>
            </div>

            <div class="row mg-t-20">
                <p>
                    Game Types are the various categories of games that you can referee. For example, D1 State League or a specific tournament would each be a game type.
                </p>
                <p>
                    There are two ways to add game types.
                </p>
                <p>
                    The first option is within the Log A Game page. Next to the select area for a game type, there is an Add button. This will open a modal where you can add a game type. After you add the game type, it will automatically be selected when the modal is dismissed.
                </p>
            </div>

            <div class="row mg-t-20">
                <div class="col-md-3">
                    <img src="{{ Storage::disk('public')->url('help/gt-add.png') }}" />
                </div>

                <div class="col-md-9">
                    <h6 class="pd-l-15">Form Breakdown</h6>
                    <ul>
                        <li><strong>Name</strong>: This is the name of the League or Tournament</li>
                        <li><strong>Location</strong>: This is where this game type occurs.</li>
                        <li><strong>Assignor</strong>: This is the name primary assignor of the game type</li>
                        <li><strong>Hotel / Travel / Grade Premium</strong>: This is whether or not the game type offers each attribute</li>
                    </ul>

                    <p class="pd-l-15">
                        <strong>Location</strong>: If a tournament occurs in multiple towns, put the location where HQ is. Similarly, if a league (D1 State League, NPSL, etc) occurs in many locations, we recommend putting Various here
                    </p>
                </div>
            </div>

            <div class="row mg-t-20">
                <p>
                    The second option is within the View > Game Types menu. Here, you will be presented with an option to include a comment. If you add a game type in the Log A Game page, you may come here and add a comment, if you wish.
                </p>
            </div>

            <div class="row">
                <h4>Game Locations</h4>
            </div>

            <div class="row mg-t-20">
                <p>
                    Game Locations are the locations of the games that you referee. For example, Richard Siegel Soccer Complex or Stewart's Creek High School
                </p>
                <p>
                    There are two ways to add game game locations.
                </p>
                <p>
                    The first option is within the Log A Game page. Next to the select area for a game location, there is an Add button. This will open a modal where you can add a game location. After you add the game location, it will automatically be selected when the modal is dismissed.
                </p>
            </div>

            <div class="row mg-t-20">
                <div class="col-md-3">
                    <img src="{{ Storage::disk('public')->url('help/gl-add.png') }}" />
                </div>

                <div class="col-md-9">
                    <h6 class="pd-l-30">Form Breakdown</h6>
                    <ul>
                        <li><strong>Location</strong>: This is where this game location occurs. This section is more specific than the game type. For example, if you put Various for a game type, you would usually put the field name here.</li>
                    </ul>
                </div>
            </div>

            <div class="row mg-t-20">
                <p>
                    The second option is within the View > Game Locations menu. Here, you will be presented with an option to include a comment. If you add a game location in the Log A Game page, you may come here and add a comment, if you wish.
                </p>
            </div>
        </div><!-- form-layout -->
    </div>
@endsection