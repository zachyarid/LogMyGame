@component('mail::message')
<?php
$t = 0;
?>
# Outstanding Payments

Hi, {{ $user->fname }}!

Below you will find a table of the outstanding payments:

@if (count($games))
@component('mail::table')
| Game Date        | Days Since   |     Teams      | Game Fee |  Game Type   | |
|:----------------:|:------------------:|:--------------:|:--------:|:------------:|:----:|
@foreach ($games->sortBy('date') as $g)
<?php $t += $g->game_fee; ?>
|{{ \Carbon\Carbon::parse($g->date . ' ' . $g->time)->format('M d, Y h:ia') }}|{{\Carbon\Carbon::parse($g->date)->diffInDays(\Carbon\Carbon::now())}}|{{ $g->home_team }} vs {{ $g->away_team }}|${{ $g->game_fee }}|{{ $g->gametype->name }}|<a href="{{ config('app.url') . '/payment/add/' . $g->id }}">Log Payment</a>|
@endforeach
@endcomponent
@else
@component('mail::panel')
No Outstanding Payments!
@endcomponent
@endif

@component('mail::promotion')
**Total Outstanding:** ${{ number_format($t, 2) }}
@endcomponent

@if (count($games))
Have you tried touching base with the home team?
@endif

Did you receive a payment? Click the button below to log it!
@component('mail::button', ['url' => config('app.url') . '/payment/add'])
Log A Payment!
@endcomponent

{{ config('app.name') }}

To change your email preferences, click <a target="_blank" href="{{ route('profile.email') }}">here</a>.
@endcomponent
