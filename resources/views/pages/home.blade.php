@extends('layouts.template')

@section('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <form method="POST">
        <label>Look a soon to be dashboard!</label>

        <!-- TODO: games not paid, how long, etc
             TODO: most recent games
         -->
    </form>
@endsection