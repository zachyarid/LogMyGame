@extends('layouts.template')

@section('content')
    @if ($message = session('message'))
        @include('layouts.alert')
    @endif

    <form method="POST">
        <label>Look a home page!</label>
    </form>
@endsection