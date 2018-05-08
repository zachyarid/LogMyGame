@component('mail::message')
<?php
$w = 0;
$t = 0;
?>
# Mileage Summary

Hi, {{ $user->fname }}!

Below you will find a table of your recent mileage logs:

@if (count($mileage))
@component('mail::table')
| Travel Date | Destination | Distance Travelled | Potential Write Off* |
|:-----------:|:-----------:|:------------------:|:--------------------:|
@foreach ($mileage->sortBy('date_travel') as $m)
<?php $w += $m->distance * 0.545; $t += $m->distance; ?>
|{{ \Carbon\Carbon::parse($m->date_travel)->format('M d, Y') }}|{{ isset($m->games[0]) ? $m->games[0]->gameloc->location : 'No Linked Game' }}|{{ $m->distance }}|${{ number_format($m->distance * 0.545,2)}}|
@endforeach
@endcomponent
@else
@component('mail::panel')
No Recent Mileage Logs
@endcomponent
@endif

@component('mail::promotion')
**Total Miles Driven:** {{ $t }}<br>
**Total Potential Write Offs:** ${{ number_format($w,2) }}
@endcomponent

Missing a mileage log? Click the button below to log it!
@component('mail::button', ['url' =>  config('app.url') . '/mileage/add'])
Log Mileage!
@endcomponent

@component('mail::panel')
*Based on the 2018 Standard IRS Mileage Rate of $0.545 / mile.<br>
Log My Games! does not offer tax advice. Everyone's tax situation is different. We are merely offering an estimation.
@endcomponent

To change your email preferences, click <a target="_blank" href="{{ route('profile.email') }}">here</a>.
@endcomponent
