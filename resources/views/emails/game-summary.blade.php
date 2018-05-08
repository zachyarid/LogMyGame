@component('mail::message')
<?php
$t = 0;
?>
# Game Summary

Hi, {{ $user->fname }}!
<?php $full = $user->fname . ' ' . $user->lname; ?>

Below you will find a table of your recent games:

@if (count($games))
@component('mail::table')
| Game Date |  Teams  |  Game Fee   | Game Location | Game Type |
|:---------:|:-------:|:-----------:|:-------------:|:---------:|
@foreach ($games->sortBy('date') as $g)
<?php $t += $g->game_fee; ?>
|{{ \Carbon\Carbon::parse($g->date . ' ' . $g->time)->format('M d, Y h:ia') }}|{{ $g->home_team }} vs {{ $g->away_team }}|${{ $g->game_fee }}|{{ $g->gameloc->location }}|{{ $g->gametype->name }}|
@endforeach
@endcomponent
@else
@component('mail::panel')
No Recent Games!
@endcomponent
@endif

@component('mail::promotion')
**Total Game Fees:** ${{ number_format($t, 2) }}
@endcomponent

Just finished a game? Click the button below to log it!
@component('mail::button', ['url' =>  config('app.url') . '/game/add'])
Log My Game!
@endcomponent

{{ config('app.name') }}

To change your email preferences, click <a target="_blank" href="{{ route('profile.email') }}">here</a>.
@endcomponent
