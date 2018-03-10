@extends('layouts.template')

@section ('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <form method="POST" action="{{ route('gamelocation.store') }}">
        @csrf

        <div class="card pd-20 pd-sm-40">
            <div class="form-layout">
                <div class="row mg-b-5">
                    <div class="col-lg-4">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Location:<span class="tx-danger">*</span></label>
                            <input name="location" id="location" type="text"
                                   class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}"
                                   value="{{ old('location') }}" />

                            @if ($errors->has('location'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-4 -->
                </div>

                <div class="form-layout-footer">
                    <button class="btn btn-default mg-r-5">Create Game Location</button>
                </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
        </div>
    </form>
@endsection