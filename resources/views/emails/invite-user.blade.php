@component('mail::message')
# Log My Games! Account Creation

Hi, {{ $user->fname }}!

An administrator of the site has created an account for you!

Below are the details to login!
@component('mail::panel')
Email: {{ $user->email }}<br>
Password: {{ $pass }}
@endcomponent

@component('mail::button', ['url' => config('app.url') . '/password/reset'])
Reset Password
@endcomponent

Please be sure to change your password!

<br>

## Getting Started
For a tutorial on logging your first game, click <a href="{{ config('app.url') }}/help/tutorial">here</a>!

<br>

Setup your profile page and email preferences by clicking <a href="{{ config('app.url') }}/profile">here</a>!

If you have any questions, visit our Help page by clicking <a href="{{ config('app.url') }}/help">here</a>!

<br>

Thank you,<br>
{{ config('app.name') }}

To change your email preferences, click <a target="_blank" href="{{ route('profile.email') }}">here</a>.
@endcomponent