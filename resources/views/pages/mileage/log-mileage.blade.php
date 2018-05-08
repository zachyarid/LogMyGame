@extends('layouts.template')

@section('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <form method="POST" action="{{ route('mileage.store') }}">
        @csrf

        <div class="card pd-20 pd-sm-40">
            <div class="form-layout">
                <div class="row mg-b-5">
                    <div class="col-lg-6">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Game: <span class="tx-danger">*</span></label>
                            <select name="game_id[]" id="game_id" {{ count(Auth::user()->games) == 0 ? '' : 'multiple' }}
                            class="form-control select2{{ $errors->has('game_id') ? ' is-invalid' : '' }}">
                                @foreach (App\Game::own()->orderBy('date', 'desc')->get() as $g)
                                    <option value="{{ $g->id }}" {{ $g->id == old('game_id') ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $g->date . $g->time)->format('M d, Y h:i A') }},
                                        {{ $g->home_team }} vs {{ $g->away_team }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('game_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('game_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-6 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Date Traveled: <span class="tx-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                <input name="date_travel"
                                       class="form-control fc-datepicker{{ $errors->has('date_travel') ? ' is-invalid' : '' }}"
                                       value="{{ old('date_travel') ? \Carbon\Carbon::createFromFormat('Y-m-d', old('date_travel'))->format('m/d/Y') : \Carbon\Carbon::now()->format('m/d/Y') }}" />
                                <input type="hidden" name="date_travel" id="date_travelf" value="{{ old('date_travel') ? old('date_travel') : \Carbon\Carbon::now()->format('Y-m-d') }}" />

                                @if ($errors->has('date_travel'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date_travel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div><!-- col-4 -->
                </div>

                <div class="row mg-b-5">
                    <div class="col-lg-2">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Origin:<span class="tx-danger">*</span></label>
                            <input name="origin" id="origin" type="text"
                                   class="form-control{{ $errors->has('origin') ? ' is-invalid' : '' }}"
                                   value="{{ old('origin') ? old('origin') : Auth::user()->default_origin }}" />

                            @if ($errors->has('origin'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('origin') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-1">
                        <label>&nbsp;&nbsp;</label>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Odometer Out:</label>
                            <input name="odometer_out" id="odometer_out" type="number"
                                   class="form-control{{ $errors->has('odometer_out') ? ' is-invalid' : '' }}"
                                   value="{{ old('odometer_out') }}"/>

                            @if ($errors->has('odometer_out'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('odometer_out') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-2">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Odometer In:</label>
                            <input name="odometer_in" id="odometer_in" type="number"
                                   class="form-control{{ $errors->has('odometer_in') ? ' is-invalid' : '' }}"
                                   value="{{ old('odometer_in') }}"/>

                            @if ($errors->has('odometer_in'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('odometer_in') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-1" style="text-align:center;">
                        <label>&nbsp;</label><br>
                        <h5 class="mg-t-7">OR</h5>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Distance Traveled:</label>
                            <input name="distance" id="distance"
                                   class="form-control{{ $errors->has('distance') ? ' is-invalid' : '' }}"
                                   value="{{ old('distance') }}"/>

                            @if ($errors->has('distance'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('distance') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-4 -->
                </div>

                <div class="row mg-b-25">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label class="col-sm-4 form-control-label" for="comments">Mileage Comments: </label>
                            <textarea id="summernote-editor" name="comments">{{ old('comments') }}</textarea>

                            @if ($errors->has('comments'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('comments') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-10 -->
                </div>

                <div class="form-layout-footer">
                    <button class="btn btn-default mg-r-5">Log Mileage</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
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
                altField: '#date_travelf'
            });

            $('#summernote-editor').summernote({
                height: 150
            });

            $(".select2").select2();
        });
    </script>
@endsection