@extends('layouts.template')

@section ('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <form method="POST" action="{{ route('gametype.update', ['gametype' => $gametype->id]) }}">
        @csrf
        @method('PUT')

        <div class="card pd-20 pd-sm-40">
            <div class="form-layout">
                <div class="row mg-b-5">
                    <div class="col-lg-4">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Name:<span class="tx-danger">*</span></label>
                            <input name="name" id="name" type="text"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   value="{{ $gametype->name }}" />

                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-6 -->
                </div>

                <div class="row mg-b-5">
                    <div class="col-lg-4">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Location:<span class="tx-danger">*</span></label>
                            <input name="location" id="location" type="text"
                                   class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}"
                                   value="{{ $gametype->location }}" />

                            @if ($errors->has('location'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-4 -->
                </div>

                <div class="row mg-b-5">
                    <div class="col-lg-4">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Assignor:<span class="tx-danger">*</span></label>
                            <input name="assignor" id="assignor" type="text"
                                   class="form-control{{ $errors->has('assignor') ? ' is-invalid' : '' }}"
                                   value="{{ $gametype->assignor }}" />

                            @if ($errors->has('assignor'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('assignor') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-4 -->
                </div>

                <div class="row mg-b-5">
                    <div class="col-lg-4">
                        <label class="ckbox">
                            <input type="checkbox" name="hotel" id="hotel"
                                    {{ $gametype->hotel == "true" ? 'checked' : '' }}>
                            <span>Hotel</span>

                            @if ($errors->has('hotel'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('hotel') }}</strong>
                                </span>
                            @endif
                        </label>
                    </div>
                </div>

                <div class="row mg-b-5">
                    <div class="col-lg-4">
                        <label class="ckbox">
                            <input type="checkbox" name="travel" id="travel"
                                    {{ $gametype->travel == "true" ? 'checked' : '' }}>
                            <span>Travel</span>

                            @if ($errors->has('travel'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('travel') }}</strong>
                                </span>
                            @endif
                        </label>
                    </div>
                </div>

                <div class="row mg-b-20">
                    <div class="col-lg-4">
                        <label class="ckbox">
                            <input type="checkbox" name="grade_premium" id="grade_premium"
                                    {{ $gametype->grade_premium == "true" ? 'checked' : '' }}>
                            <span>Grade Premium</span>

                            @if ($errors->has('grade_premium'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('grade_premium') }}</strong>
                                </span>
                            @endif
                        </label>
                    </div>
                </div>

                <div class="row mg-b-25">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label class="col-sm-4 form-control-label" for="comments">Comments: </label>
                            <textarea id="summernote-editor" name="comments">{{ $gametype->comments }}</textarea>

                            @if ($errors->has('comments'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('comments') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-10 -->
                </div>

                <div class="form-layout-footer">
                    <button class="btn btn-default mg-r-5">Update Game Type</button>
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
        });
    </script>
@endsection