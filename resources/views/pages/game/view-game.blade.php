@extends('layouts.template')

@section('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <div class="card pd-20 pd-sm-40">
        <div class="table-responsive">
            <div class="col-md-1">
                <button class="btn btn-default" onclick="window.location = '{{ route('game.create') }}'">Log Game</button>
            </div>
            <table id="game-log" class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Home Team (Score)</th>
                        <th>Away Team (Score)</th>
                        <th>Center</th>
                        <th>AR1</th>
                        <th>AR2</th>
                        <th>4th</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Auth::user()->games as $g)
                        <tr>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $g->date. ' '  . $g->time)->format('M d, Y H:i A') }}</td>
                            <td>{{ $g->home_team }} ({{ $g->home_team_score }})</td>
                            <td>{{ $g->away_team }} ({{ $g->away_team_score }})</td>
                            <td>{{ $g->center_name }}</td>
                            <td>{{ $g->ar1_name }}</td>
                            <td>{{ $g->ar2_name }}</td>
                            <td>{{ $g->th_name }}</td>
                            <td>
                                <button class="btn btn-success" onclick="window.location = '{{ route('game.edit', ['game' => $g->id]) }}'">Edit</button>
                                <button class="btn btn-default" onclick="window.location = '{{ route('game.show', ['game' => $g->id]) }}'">View</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script-source')
    <script>
        $(document).ready(function () {
            $('#game-log').DataTable({
                responsive: true,
                bLengthChange: false,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page'
                }
            });
        });
    </script>
@endsection