@extends('layouts.template')

@section ('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <form method="POST" action="{{ route('game.update', ['game' => $game->id]) }}">
        @method('PUT')
        @csrf
        <input type="hidden" name="platform" value="{{ Browser::browserFamily() }}"/>

        <!-- big row -->
        <div class="row row-sm mg-t-20">
            <div class="col-xl-6">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <h6 class="card-body-title">Enter Game Details</h6>
                    <p class="mg-b-20 mg-sm-b-30"></p>

                    <div class="row">
                        <label class="col-sm-4 form-control-label">Date: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                <input name="game_date"
                                       class="form-control fc-datepicker{{ $errors->has('game_date') ? ' is-invalid' : '' }}"
                                       value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $game->date)->format('m/d/Y') }}">
                                <input type="hidden" name="game_date" id="game_datef" value="{{ $game->date }}" />
                                @if ($errors->has('game_date'))
                                    <span class="invalid-feedback">
                                <strong>{{ $errors->first('game_date') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="game_time">Time: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="game_time" id="game_time" type="time"
                                   class="form-control{{ $errors->has('game_time') ? ' is-invalid' : '' }}"
                                   value="{{ $errors->has('game_time') ? ' is-invalid' : $game->time }}"/>

                            @if ($errors->has('game_time'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('game_time') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="game_type">Game Type/Tournament: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                            <select name="game_type" id="game_type"
                                    class="form-control select2{{ $errors->has('game_type') ? ' is-invalid' : '' }}">
                                <option selected disabled value="">Select a Game Type</option>
                                @if (count($gametypes) > 0)
                                    @foreach ($gametypes as $type)
                                        @if ($type->id == $game->type)
                                            <option selected value="{{ $type->id }}">{{ $type->name }}</option>
                                        @else
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>

                            @if ($errors->has('game_type'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('game_type') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="col-sm-2 mg-t-10 mg-sm-t-0 ">
                            <a href="" class="btn btn-primary pd-x-20" data-toggle="modal" data-target="#gametypemodal">Add</a>
                        </div>
                    </div><!-- row -->

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="location">Game Location: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                            <select name="location" id="location"
                                    class="form-control select2{{ $errors->has('location') ? ' is-invalid' : '' }}">
                                <option selected disabled value="">Select a Location</option>
                                @if (count($gamelocs) > 0)
                                    @foreach ($gamelocs as $loc)
                                        @if ($loc->id == $game->location_id)
                                            <option selected value="{{ $loc->id }}" {{ $loc->disabled ? 'disabled readonly' : '' }}>{{ $loc->location }}</option>
                                        @else
                                            <option value="{{ $loc->id }}" {{ $loc->disabled ? 'disabled readonly' : '' }}>{{ $loc->location }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>

                            @if ($errors->has('location'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-2 mg-t-10 mg-sm-t-0 ">
                            <a href="" class="btn btn-primary pd-x-20" data-toggle="modal" data-target="#gamelocmodal">Add</a>
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="age">Level/Age: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <select name="age" id="age"
                                    class="form-control select2{{ $errors->has('age') ? ' is-invalid' : '' }}">
                                <option selected disabled value="">Select an Age</option>
                                @if (count($ages) > 0)
                                    @foreach ($ages as $a)
                                        @if ($a->id == $game->age_id)
                                            <option selected value="{{ $a->id }}" {{ $a->disabled ? 'disabled readonly' : '' }}>{{ $a->string }}</option>
                                        @else
                                            <option value="{{ $a->id }}" {{ $a->disabled ? 'disabled readonly' : '' }}>{{ $a->string }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>

                            @if ($errors->has('age'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('age') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 mg-t-25 mg-xl-t-0">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <h6 class="card-body-title">Enter Team Details</h6>
                    <p class="mg-b-20 mg-sm-b-30"></p>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="home_team">Home Team: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="home_team" id="home_team" type="text" autocomplete="off"
                                   class="form-control easy-ac-teams{{ $errors->has('home_team') ? ' is-invalid' : '' }}"
                                   value="{{ $game->home_team }}"/>

                            @if ($errors->has('home_team'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('home_team') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="home_score">Home Team Score: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="home_score" id="home_score" type="number"
                                   class="form-control{{ $errors->has('home_score') ? ' is-invalid' : '' }}"
                                   value="{{ $game->home_team_score }}"/>

                            @if ($errors->has('home_score'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('home_score') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="away_team">Away Team: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="away_team" id="away_team" type="text" autocomplete="off"
                                   class="form-control easy-ac-teams{{ $errors->has('away_team') ? ' is-invalid' : '' }}"
                                   value="{{ $game->away_team }}"/>

                            @if ($errors->has('away_team'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('away_team') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="away_score">Away Team Score: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="away_score" id="away_score" type="number"
                                   class="form-control{{ $errors->has('away_score') ? ' is-invalid' : '' }}"
                                   value="{{ $game->away_team_score }}"/>

                            @if ($errors->has('away_score'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('away_score') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- another row -->
        <div class="row row-sm mg-t-20">
            <div class="col-xl-6">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <h6 class="card-body-title">Enter Referee Details</h6>
                    <p class="mg-b-20 mg-sm-b-30"></p>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="center_name">Center: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="center_name" id="center_name" type="text" autocomplete="off"
                                   class="form-control easy-ac-referees{{ $errors->has('center_name') ? ' is-invalid' : '' }}"
                                   value="{{ $game->center_name }}"/>

                            @if ($errors->has('center_name'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('center_name') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="ar1_name">Assistant Referee 1: </label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="ar1_name" id="ar1_name" type="text" autocomplete="off"
                                   class="form-control easy-ac-referees{{ $errors->has('ar1_name') ? ' is-invalid' : '' }}"
                                   value="{{ $game->ar1_name }}"/>

                            @if ($errors->has('ar1_name'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('ar1_name') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="ar2_name">Assistant Referee 2: </label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="ar2_name" id="ar2_name" type="text" autocomplete="off"
                                   class="form-control easy-ac-referees{{ $errors->has('ar2_name') ? ' is-invalid' : '' }}"
                                   value="{{ $game->ar2_name }}"/>

                            @if ($errors->has('ar2_name'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('ar2_name') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="th_name">Fourth Official: </label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="th_name" id="th_name" type="text" autocomplete="off"
                                   class="form-control easy-ac-referees{{ $errors->has('th_name') ? ' is-invalid' : '' }}"
                                   value="{{ $game->th_name }}"/>

                            @if ($errors->has('th_name'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('th_name') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="game_fee">Game Fee: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="game_fee" id="game_fee"
                                   class="form-control{{ $errors->has('game_fee') ? ' is-invalid' : '' }}"
                                   value="{{ $game->game_fee }}"/>

                            @if ($errors->has('game_fee'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('game_fee') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 mg-t-25 mg-xl-t-0">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <h6 class="card-body-title">Enter Miscellaneous Details</h6>
                    <p class="mg-b-20 mg-sm-b-30"></p>
                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="miles_run">Distance Run: </label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="miles_run" id="miles_run"
                                   class="form-control{{ $errors->has('miles_run') ? ' is-invalid' : '' }}"
                                   value="{{ $game->miles_run }}"/>

                            @if ($errors->has('miles_run'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('miles_run') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="comments">Comments: </label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <textarea id="summernote-editor" name="comments">{{ $game->comments }}</textarea>


                            @if ($errors->has('comments'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('comments') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>
                </div><!-- card -->
            </div>
        </div>

        <!-- another row -->
        <div class="card pd-20 pd-sm-40 mg-t-20">
            <div class="form-layout-footer">
                <button class="btn btn-default mg-r-5">Update Game Details</button>
            </div><!-- form-layout-footer -->
        </div>
    </form>
@endsection

@section('script-source')
    <script>
        $(document).ready(function () {
            $('.fc-datepicker').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                numberOfMonths: 1,
                altFormat: 'yy-mm-dd',
                altField: '#game_datef'
            });

            $('#summernote-editor').summernote({
                height: 150
            });

            $(".select2").select2();

            var optionsTeams = {
                url: '{{ route('json-teams') }}',
                list: {
                    match: {
                        enabled: true
                    }
                }
            };

            var optionsReferees = {
                url: '{{ route('json-referees') }}',
                list: {
                    match: {
                        enabled: true
                    }
                }
            };

            $(".easy-ac-teams").easyAutocomplete(optionsTeams);
            $(".easy-ac-referees").easyAutocomplete(optionsReferees);
        });

        function submitLocPost()
        {
            var gameloc = $('#location_add').val();

            $.ajax({
                type: "POST",
                url: '{{ route('add-gameloc') }}',
                data: {
                    location: gameloc,
                    _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    console.log(data);

                    $("#gamelocmodal").modal("hide");

                    $("#location option").remove();

                    for (var i = 0; i < data.length; i++)
                    {
                        $("#location").append($("<option></option>").attr("value", data[i].id).text(data[i].location));
                    }
                    $("#location option:last").attr("selected", "selected");
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function submitTypePost()
        {
            var gameloc = $('#location_addd').val();
            var name = $('#name_add').val();
            var assignor = $('#assignor_add').val();
            var hotel = $('#hotel').val();
            var travel = $('#travel').val();
            var grade_prem = $('#grade_prem').val();

            $.ajax({
                type: "POST",
                url: '{{ route('add-gametype') }}',
                data: {
                    name: name,
                    location: gameloc,
                    assignor: assignor,
                    hotel: hotel,
                    travel: travel,
                    grade_premium: grade_prem,
                    _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    console.log(data);

                    $("#gametypemodal").modal("hide");

                    $("#game_type option").remove();

                    for (var i = 0; i < data.length; i++)
                    {
                        $("#game_type").append($("<option></option>").attr("value", data[i].id).text(data[i].name));
                    }
                    $("#game_type option:last").attr("selected", "selected");
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    </script>
@endsection

@section('modals')
    <div id="gametypemodal" class="modal fade show" style="display: none;">
        <div class="modal-dialog modal-dialog-vertical-center" role="document">
            <div class="modal-content bd-0 tx-14">
                <div class="modal-header pd-y-20 pd-x-25">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add a Game Type</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body pd-25">
                    <div class="form-group">
                        <label for="name_add">Name:</label>
                        <input name="name_add" id="name_add" class="form-control wd-100p" />
                    </div>
                    <div class="form-group">
                        <label for="location_addd">Location:</label>
                        <input name="location_addd" id="location_addd" class="form-control wd-100p" placeholder="City, State" />
                    </div>
                    <div class="form-group">
                        <label for="assignor_add">Assignor:</label>
                        <input name="assignor_add" id="assignor_add" class="form-control wd-100p" />
                    </div>

                    <label class="ckbox">
                        <input type="checkbox" name="hotel" id="hotel">
                        <span>Hotel</span>
                    </label>

                    <label class="ckbox">
                        <input type="checkbox" name="travel" id="travel">
                        <span>Travel</span>
                    </label>

                    <label class="ckbox">
                        <input type="checkbox" name="grade_prem" id="grade_prem">
                        <span>Grade Premium</span>
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pd-x-20" onclick="submitTypePost()">Add Game Type</button>
                    <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div>

    <div id="gamelocmodal" class="modal fade show" style="display: none;">
        <div class="modal-dialog modal-dialog-vertical-center" role="document">
            <div class="modal-content bd-0 tx-14">
                <div class="modal-header pd-y-20 pd-x-25">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add a Game Location</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body pd-25">
                    <div class="form-group">
                        <label for="location_add">Location:</label>
                        <input name="location_add" id="location_add" class="form-control wd-100p" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pd-x-20" onclick="submitLocPost()">Add Game Location</button>
                    <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div>
@endsection