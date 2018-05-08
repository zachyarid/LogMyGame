@component('mail::message')
# Greetings!

Welcome to Log My Games, {{ $user->fname }}!

<br>

## Getting Started
For a tutorial on logging your first game, click <a href="{{ config('app.url') }}/help/tutorial">here</a>!

<br>

Setup your profile page and email preferences by clicking <a href="{{ config('app.url') }}/profile">here</a>!

If you have any questions, visit our Help page by clicking <a href="{{ config('app.url') }}/help">here</a>!

<br>

Click below to Log your First Game!
@component('mail::button', ['url' => config('app.url') . '/game/add'])
Log My Game!
@endcomponent

Thank you for joining us!<br>
{{ config('app.name') }}

To change your email preferences, click <a target="_blank" href="{{ route('profile.email') }}">here</a>.
@endcomponent