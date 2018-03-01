<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
</head>

<body>
<div class="signpanel-wrapper">
    <div class="signbox signup">
        <div class="signbox-header">
            <h4>{{ env("APP_NAME") }}</h4>
            <p class="mg-b-0">Register</p>
        </div><!-- signbox-header -->
        <div class="signbox-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label class="form-control-label">Email:</label>
                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                    @endif
                </div><!-- form-group -->

                <div class="row row-xs">
                    <div class="col-sm">
                        <div class="form-group">
                            <label class="form-control-label">First Name:</label>
                            <input type="text" name="fname" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" value="{{ old('fname') }}">

                            @if ($errors->has('fname'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div><!-- form-group -->
                    </div><!-- col -->

                    <div class="col-sm">
                        <div class="form-group">
                            <label class="form-control-label">Last Name:</label>
                            <input type="text" name="lname" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" value="{{ old('lname') }}">

                            @if ($errors->has('lname'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('lname') }}</strong>
                                </span>
                            @endif
                        </div><!-- form-group -->
                    </div><!-- col -->
                </div><!-- row -->

                <div class="form-group">
                    <label class="form-control-label">USSF Grade:</label>
                    <input type="number" name="ussf_grade" class="form-control{{ $errors->has('ussf_grade') ? ' is-invalid' : '' }}" value="{{ old('ussf_grade') }}">

                    @if ($errors->has('ussf_grade'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('ussf_grade') }}</strong>
                        </span>
                    @endif
                </div><!-- form-group -->

                <div class="row row-xs">
                    <div class="col-sm">
                        <div class="form-group">
                            <label class="form-control-label">Password:</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div><!-- form-group -->
                    </div><!-- col -->
                </div><!-- row -->

                <div class="row row-xs">
                    <div class="col-sm">
                        <div class="form-group">
                            <label class="form-control-label">Confirm Password:</label>
                            <input type="password" name="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}">

                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div><!-- form-group -->
                    </div><!-- col -->
                </div><!-- row -->

                <button type="submit" class="btn btn-dark btn-block">Sign Up</button>
                <div class="tx-center bd pd-10 mg-t-40">Already a member? <a href="/login">Sign In</a></div>
            </form>
        </div><!-- signbox-body -->
    </div><!-- signbox -->
</div><!-- signpanel-wrapper -->

@include('layouts.endbody')
</body>
</html>