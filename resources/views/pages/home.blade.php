@extends('layouts.template')

@section('content')
    @if ($dashboardMessage && !empty($dashboardMessage))
        <div class="alert alert-success rounded-5" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="d-flex align-items-center justify-content-start">
                <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                <span>{{ $dashboardMessage }}</span>
            </div><!-- d-flex -->
        </div><!-- alert -->
    @endif

    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Most Recent Games</h6>
        <p class="mg-b-20 mg-sm-b-30"></p>

        <div class="form-layout">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="recent-games" class="table table-striped">
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
                                @foreach ($games as $game)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $game->date . ' ' . $game->time)->format('M d, Y h:i A') }}</td>
                                        <td>{{ $game->home_team }} ({{ $game->home_team_score }})</td>
                                        <td>{{ $game->away_team }} ({{ $game->away_team_score }})</td>
                                        <td>{{ $game->center_name }}</td>
                                        <td>{{ $game->ar1_name }}</td>
                                        <td>{{ $game->ar2_name }}</td>
                                        <td>{{ $game->th_name }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card pd-20 pd-sm-40 mg-t-20">
        <h6 class="card-body-title">Outstanding Payments</h6>
        <p class="mg-b-20 mg-sm-b-30"></p>

        <div class="form-layout">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="outstanding-payments" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Game Date</th>
                                    <th>Time Outstanding</th>
                                    <th>Home Team</th>
                                    <th>Away Team</th>
                                    <th>Game Fee</th>
                                    <th>Game Type</th>
                                    <th>Location</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($outstanding as $game)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $game->date . ' ' . $game->time)->format('M d, Y h:i A') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($game->date)->diffInDays(\Carbon\Carbon::now()) }}</td>
                                        <td>{{ $game->home_team }}</td>
                                        <td>{{ $game->away_team }}</td>
                                        <td>$ {{ $game->game_fee }}</td>
                                        <td>{{ $game->gametype->name }}</td>
                                        <td>{{ $game->gameloc->location }}</td>
                                        <td>
                                            <button class="btn btn-success" onclick="window.location = '{{ route('payment.add-game', ['game' => $game->id]) }}'">Log Payment</button>
                                            <button class="btn btn-default" onclick="window.location = '{{ route('game.show', ['game' => $game->id]) }}'">View Game</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-source')
    <script>
        $(document).ready(function () {
            $('#recent-games').DataTable({
                responsive: true,
                bLengthChange: false,
                aaSorting: [],
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page'
                }
            });

            $('#outstanding-payments').DataTable({
                responsive: true,
                bLengthChange: false,
                aaSorting: [],
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page'
                }
            });
        });
    </script>
@endsection