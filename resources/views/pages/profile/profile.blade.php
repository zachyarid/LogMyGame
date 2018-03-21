@extends('layouts.template')

@section('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-4 col-lg-3">
                <label class="content-left-label">Your Profile Photo</label>
                <figure class="edit-profile-photo">
                    <img src="{{ $profile_path }}" class="img-fluid" alt="">
                </figure>
                <label class="custom-file">
                    <input type="file" id="profile_pic" name="profile_pic" class="custom-file-input">
                    <span class="custom-file-control"></span>
                </label>
            </div><!-- col-3 -->
            <div class="col-md-8 col-lg-9 mg-t-30 mg-md-t-0">
                <label class="content-left-label">Login Information</label>
                <div class="card bg-gray-200 bd-0">
                    <div class="edit-profile-form">
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Email:</label>
                            <div class="col-sm-8 col-xl-6 mg-t-10 mg-sm-t-0">
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email" type="email" value="{{ Auth::user()->email }}">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr class="invisible">

                        <div class="form-group row mg-b-10">
                            <label class="col-sm-3 form-control-label">Current Password:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}"
                                       name="current_password" type="password" />

                                @if ($errors->has('current_password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mg-b-10">
                            <label class="col-sm-3 form-control-label">Password:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" type="password" />

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mg-b-10">
                            <label class="col-sm-3 form-control-label">Confirm Password:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                       name="password_confirmation" type="password" />

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div><!-- wd-60p -->
                </div><!-- card -->

                <hr class="invisible">

                <label class="content-left-label">Personal Information</label>
                <div class="card bg-gray-200 bd-0">
                    <div class="edit-profile-form">
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Firstname:</label>
                            <div class="col-sm-8 col-xl-6 mg-t-10 mg-sm-t-0">
                                <input class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}"
                                       type="text" name="fname" value="{{ Auth::user()->fname }}">

                                @if ($errors->has('fname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Lastname:</label>
                            <div class="col-sm-8 col-xl-6 mg-t-10 mg-sm-t-0">
                                <input class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}"
                                       type="text" name="lname" value="{{ Auth::user()->lname }}">

                                @if ($errors->has('lname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">USSF Grade:</label>
                            <div class="col-sm-8 col-xl-6 mg-t-10 mg-sm-t-0">
                                <input class="form-control{{ $errors->has('ussf_grade') ? ' is-invalid' : '' }}"
                                       type="number" name="ussf_grade" value="{{ Auth::user()->ussf_grade }}">

                                @if ($errors->has('ussf_grade'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ussf_grade') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Default Origin:</label>
                            <div class="col-sm-8 col-xl-6 mg-t-10 mg-sm-t-0">
                                <input class="form-control{{ $errors->has('default_origin') ? ' is-invalid' : '' }}"
                                       type="text" name="default_origin" value="{{ Auth::user()->default_origin }}">

                                @if ($errors->has('default_origin'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('default_origin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><!-- form-group -->
                    </div><!-- wd-60p -->
                </div><!-- card -->
            </div><!-- col-9 -->
        </div><!-- row -->

        <div class="card pd-20 mg-t-20">
            <div class="form-layout-footer">
                <button class="btn btn-default mg-r-5">Edit Profile</button>
            </div><!-- form-layout-footer -->
        </div>
    </form>
@endsection