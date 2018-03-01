<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
</head>

<body>
<div class="signpanel-wrapper">
    <div class="signbox">
        <div class="signbox-header">
            <h4>{{ env("APP_NAME") }}</h4>
            <p class="mg-b-0">Login</p>
        </div><!-- signbox-header -->
        <div class="signbox-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-control-label">Email:</label>
                    <input type="email" name="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div><!-- form-group -->

                <div class="form-group">
                    <label class="form-control-label">Password:</label>
                    <input type="password" name="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div><!-- form-group -->

                <div class="form-group">
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                </div><!-- form-group -->

                <button class="btn btn-dark btn-block" type="submit">Sign In</button>

                <div class="tx-center bd pd-10 mg-t-40">Not yet a member? <a href="/register">Create an account</a>
                </div>
            </form>
        </div><!-- signbox-body -->
    </div><!-- signbox -->
</div><!-- signpanel-wrapper -->

@include('layouts.endbody')

</body>
</html>