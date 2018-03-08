@extends('layouts.template')

@section('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <form method="POST" action="{{ $mileage->status == 'pre' ? route('mileage.pre-complete', ['mileage' => $mileage->id]) : route('mileage.update', ['mileage' => $mileage->id]) }}">
        @method('PUT')
        @csrf

        <div class="card pd-20 pd-sm-40">
            <div class="form-layout">
                <div class="row mg-b-5">
                    <div class="col-lg-6">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Game: <span class="tx-danger">*</span></label>
                            <select name="game_id[]" id="game_id" multiple
                            class="form-control select2{{ $errors->has('game_id') ? ' is-invalid' : '' }}">
                                @foreach (Auth::user()->games as $g)
                                    <option value="{{ $g->id }}" {{ $g->mileage_id == $mileage->id ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $g->date . ' ' . $g->time)->format('M d, Y h:i A') }},
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
                            <label class="form-control-label">Date Traveled:<span class="tx-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                <input name="date_travel" {{ $mileage->status == 'pre' ? ' disabled readonly' : '' }}
                                       class="form-control fc-datepicker{{ $errors->has('date_travel') ? ' is-invalid' : '' }}"
                                       value="{{ old('date_travel') ? \Carbon\Carbon::parse(old('date_travel'))->format('m/d/Y') : \Carbon\Carbon::parse($mileage->date_travel)->format('m/d/Y') }}" />
                                <input type="hidden" name="date_travel" id="date_travelf" value="{{ $mileage->date_travel }}" />

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
                            <input name="origin" id="origin" type="text" {{ $mileage->status == 'pre' ? ' disabled readonly' : '' }}
                                   class="form-control{{ $errors->has('origin') ? ' is-invalid' : '' }}"
                                   value="{{ $mileage->origin }}" />

                            @if ($errors->has('origin'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('origin') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-2">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Odometer Out:</label>
                            <input name="odometer_out" id="odometer_out" type="number" {{ $mileage->status == 'pre' ? ' disabled readonly' : '' }}
                                   class="form-control{{ $errors->has('odometer_out') ? ' is-invalid' : '' }}"
                                   value="{{ $mileage->odometer_out }}"/>

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
                                   value="{{ $mileage->odometer_in }}"/>

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
                            <input name="distance" id="distance" type="number"
                                   class="form-control{{ $errors->has('distance') ? ' is-invalid' : '' }}"
                                   value="{{ $mileage->distance }}"/>

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
                            <textarea id="summernote-editor" name="comments">{{ $mileage->comments }}</textarea>

                            @if ($errors->has('comments'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('comments') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-10 -->
                </div>

                <div class="form-layout-footer">
                    <button class="btn btn-default mg-r-5">{{ $mileage->status == 'pre' ? 'Complete' : 'Edit' }} Mileage Log</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
        </div>
    </form>
@endsection

@section('script-source')
    <script>
        $(document).ready(function () {
            $('#summernote-editor').summernote({
                height: 150
            });

            $(".select2").select2();
        });
    </script>
@endsection