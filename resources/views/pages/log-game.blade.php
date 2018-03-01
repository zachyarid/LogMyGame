@extends('layouts.template')

@section('content')
    <form method="POST" action="{{ route('log-game.store') }}">
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
                                       value="{{ old('game_date') }}">
                                <input type="hidden" name="game_date" id="game_datef" value="{{ old('game_date') }}" />
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
                                   value="{{ old('game_time') }}"/>

                            @if ($errors->has('game_time'))
                                <span class="invalid-feedback">
                            <strong>{{ $errors->first('game_time') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="game_type">Game Type: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <select name="game_type" id="game_type"
                                    class="form-control{{ $errors->has('game_type') ? ' is-invalid' : '' }}">
                                <option selected disabled value="">Select a Game Type</option>
                                @if (count($gametypes) > 0)
                                    @foreach ($gametypes as $type)
                                        @if ($type->id == old('game_type'))
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
                    </div><!-- row -->

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="location">Game Location: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <select name="location" id="location"
                                    class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}">
                                <option selected disabled value="">Select a Location</option>
                                <option value="1">Richard Siegel Soccer Complex</option>
                                <option value="2">Mike Rose Soccer Park</option>
                                <option value="3">Metro Park</option>
                            </select>

                            @if ($errors->has('location'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="age">Age: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <select name="age" id="age"
                                    class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}">
                                <option selected disabled value="">Select an Age</option>
                                <option value="17">U17B</option>
                                <option value="17">U17G</option>
                                <option value="18">U18B</option>
                                <option value="18">U18G</option>
                                <option value="20">Adult</option>
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
                            <input name="home_team" id="home_team" type="text"
                                   class="form-control{{ $errors->has('home_team') ? ' is-invalid' : '' }}"
                                   value="{{ old('home_team') }}"/>

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
                                   value="{{ old('home_score') }}"/>

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
                            <input name="away_team" id="away_team" type="text"
                                   class="form-control{{ $errors->has('away_team') ? ' is-invalid' : '' }}"
                                   value="{{ old('away_team') }}"/>

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
                                   value="{{ old('away_score') }}"/>

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
                            <input name="center_name" id="center_name" type="text"
                                   class="form-control{{ $errors->has('center_name') ? ' is-invalid' : '' }}"
                                   value="{{ old('center_name') }}"/>

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
                            <input name="ar1_name" id="ar1_name" type="text"
                                   class="form-control{{ $errors->has('ar1_name') ? ' is-invalid' : '' }}"
                                   value="{{ old('ar1_name') }}"/>

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
                            <input name="ar2_name" id="ar2_name" type="text"
                                   class="form-control{{ $errors->has('ar2_name') ? ' is-invalid' : '' }}"
                                   value="{{ old('ar2_name') }}"/>

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
                            <input name="th_name" id="th_name" type="text"
                                   class="form-control{{ $errors->has('th_name') ? ' is-invalid' : '' }}"
                                   value="{{ old('th_name') }}"/>

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
                            <input name="game_fee" id="game_fee" type="number"
                                   class="form-control{{ $errors->has('game_fee') ? ' is-invalid' : '' }}"
                                   value="{{ old('game_fee') }}"/>

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
                            <input name="miles_run" id="miles_run" type="number"
                                   class="form-control{{ $errors->has('miles_run') ? ' is-invalid' : '' }}"
                                   value="{{ old('miles_run') }}"/>

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
                            <textarea id="summernote-editor" name="comments"></textarea>


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
                <button class="btn btn-default">Log Game</button>
                <button type="reset" class="btn btn-default" >Reset Form</button>
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
            })
        });
    </script>
@endsection