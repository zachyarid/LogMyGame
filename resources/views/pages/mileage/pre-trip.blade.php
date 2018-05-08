@extends('layouts.template')

@section('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <form method="POST" action="{{ route('mileage.pre-store') }}">
        @csrf
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Enter Pre-Trip Details</h6>
            <p class="mg-b-20 mg-sm-b-30"></p>

            <div class="form-layout">
                <div class="row mg-b-5">
                    <div class="col-lg-2">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Origin:</label>
                            <input name="origin" id="origin" type="text"
                                   class="form-control{{ $errors->has('origin') ? ' is-invalid' : '' }}"
                                   value="{{ $errors->has('origin') ? old('origin') : Auth::user()->default_origin }}"/>

                            @if ($errors->has('origin'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('origin') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-4 -->
                </div>

                <div class="row mg-b-5">
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
                </div>

                <div class="form-layout-footer">
                    <button class="btn btn-default mg-r-5">Start Pre-Trip</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
        </div>
    </form>
@endsection