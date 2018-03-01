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
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label class="form-control-label">Email:</label>
                    <input type="email" name="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div><!-- form-group -->

                <button type="submit" class="btn btn-dark btn-block">Send Reset Link</button>
            </form>
        </div><!-- signbox-body -->
    </div><!-- signbox -->
</div><!-- signpanel-wrapper -->

@include('layouts.endbody')
</body>
</html>