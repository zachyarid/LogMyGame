@extends('layouts.template')

@section ('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <form id="pageForm">
        <!-- big row -->
        <div class="row row-sm mg-t-20">
            <div class="col-xl-6">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <h6 class="card-body-title">Game Details</h6>
                    <p class="mg-b-20 mg-sm-b-30"></p>

                    <div class="row">
                        <label class="col-sm-4 form-control-label">Date: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                <input name="game_date"
                                       class="form-control fc-datepicker"
                                       value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $game->date)->format('m/d/Y') }}">
                                <input type="hidden" name="game_date" id="game_datef" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="game_time">Time: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="game_time" id="game_time" type="time"
                                   class="form-control"
                                   value="{{ $game->time }}"/>
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="game_type">Game Type/Tournament: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <select name="game_type" id="game_type"
                                    class="form-control select2">
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
                        </div>
                    </div><!-- row -->

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="location">Game Location: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <select name="location" id="location"
                                    class="form-control select2">
                                <option selected disabled value="">Select a Location</option>
                                @if (count($gamelocs) > 0)
                                    @foreach ($gamelocs as $loc)
                                        @if ($loc->id == $game->location_id)
                                            <option selected value="{{ $loc->id }}">{{ $loc->location }}</option>
                                        @else
                                            <option value="{{ $loc->id }}">{{ $loc->location }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="age">Age: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <select name="age" id="age"
                                    class="form-control select2">
                                <option selected disabled value="">Select an Age</option>
                                @if (count($ages) > 0)
                                    @foreach ($ages as $a)
                                        @if ($a->id == $game->age_id)
                                            <option selected value="{{ $a->id }}">{{ $a->string }}</option>
                                        @else
                                            <option value="{{ $a->id }}">{{ $a->string }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 mg-t-25 mg-xl-t-0">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <h6 class="card-body-title">Team Details</h6>
                    <p class="mg-b-20 mg-sm-b-30"></p>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="home_team">Home Team: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="home_team" id="home_team" type="text"
                                   class="form-control"
                                   value="{{ $game->home_team }}"/>
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="home_score">Home Team Score: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="home_score" id="home_score" type="number"
                                   class="form-control"
                                   value="{{ $game->home_team_score }}"/>
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="away_team">Away Team: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="away_team" id="away_team" type="text"
                                   class="form-control"
                                   value="{{ $game->away_team }}"/>
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="away_score">Away Team Score: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="away_score" id="away_score" type="number"
                                   class="form-control"
                                   value="{{ $game->away_team_score }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- another row -->
        <div class="row row-sm mg-t-20">
            <div class="col-xl-6">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <h6 class="card-body-title">Referee Details</h6>
                    <p class="mg-b-20 mg-sm-b-30"></p>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="center_name">Center: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="center_name" id="center_name" type="text"
                                   class="form-control"
                                   value="{{ $game->center_name }}"/>
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="ar1_name">Assistant Referee 1: </label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="ar1_name" id="ar1_name" type="text"
                                   class="form-control"
                                   value="{{ $game->ar1_name }}"/>
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="ar2_name">Assistant Referee 2: </label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="ar2_name" id="ar2_name" type="text"
                                   class="form-control"
                                   value="{{ $game->ar2_name }}"/>
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="th_name">Fourth Official: </label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="th_name" id="th_name" type="text"
                                   class="form-control"
                                   value="{{ $game->th_name }}"/>
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="game_fee">Game Fee: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="game_fee" id="game_fee" type="number"
                                   class="form-control"
                                   value="{{ $game->game_fee }}"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 mg-t-25 mg-xl-t-0">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <h6 class="card-body-title">Miscellaneous Details</h6>
                    <p class="mg-b-20 mg-sm-b-30"></p>
                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="miles_run">Distance Run: </label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="miles_run" id="miles_run" type="number"
                                   class="form-control"
                                   value="{{ $game->miles_run }}"/>
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="comments">Comments: </label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <textarea id="summernote-editor" name="comments">{{ $game->comments }}</textarea>
                        </div>
                    </div>
                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="comments">Payment Status: </label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="paid_status" id="paid_status" class="form-control {{ $game->hasPayments() ? 'alert-success' : 'alert-danger'}}"
                                   value="{{ $game->hasPayments() ? 'PAID' : 'NOT PAID' }}"/>
                        </div>
                    </div>
                </div><!-- card -->
            </div>
        </div>
    </form>
@endsection

@section('script-source')
    <script>
        $(document).ready(function () {
            $('#summernote-editor').summernote({
                height: 150
            }).summernote('disable');

            $(".select2").select2({
                disabled: true
            });

            $('#pageForm input').attr('readonly', 'readonly');
        });
    </script>
@endsection