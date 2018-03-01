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
            <p class="mg-b-0">Reset Password</p>
        </div><!-- signbox-header -->
        <div class="signbox-body">
            <form method="POST" action="{{ route('password.request') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label class="form-control-label">Email:</label>
                    <input type="email" name="email" value="{{ $email or old('email') }}"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div><!-- form-group -->

                <div class="form-group">
                    <label class="form-control-label">Password:</label>
                    <input type="password" name="password" value="{{ $email or old('password') }}"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required autofocus>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div><!-- form-group -->

                <div class="form-group">
                    <label class="form-control-label">Confirm Password:</label>
                    <input type="password" name="password_confirmation" value="{{ $email or old('password_confirmation') }}"
                           class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" required autofocus>

                    @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div><!-- form-group -->

                <button type="submit" class="btn btn-dark btn-block">Reset Password</button>
            </form>
        </div><!-- signbox-body -->
    </div><!-- signbox -->
</div><!-- signpanel-wrapper -->

@include('layouts.endbody')

</body>
</html>