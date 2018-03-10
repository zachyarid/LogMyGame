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
                <button class="btn btn-default" onclick="window.location = '{{ route('payment.create') }}'">Log Payment</button>
            </div>
            <table id="payment-log" class="table table-striped table-responsive">
                <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Log Date</th>
                    <th>Date Received</th>
                    <th>Payer</th>
                    <th>Check/Reference Number</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach (Auth::user()->payments as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $p->created_at)->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $p->date_received)->format('M d, Y') }}</td>
                            <td>{{ $p->payer }}</td>
                            <td>{{ $p->check_number }}</td>
                            <td>
                                <button class="btn btn-default" onclick="window.location = '{{ route('game.show', ['game' => $p->game_id]) }}'">View Game</button>
                                <button class="btn btn-success" onclick="window.location = '{{ route('payment.edit', ['payment' => $p->id]) }}'">Edit</button>
                                <button class="btn btn-info" onclick="window.location = '{{ route('payment.show', ['payment' => $p->id]) }}'">View Payment</button>
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
            $('#payment-log').DataTable({
                responsive: true,
                bLengthChange: false,
                aaSorting: [[ 0, "desc" ]],
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page'
                },
                columnDefs: [
                    { 'orderData': [0] },
                    {
                        'targets': [0],
                        'visible': false,
                        'searchable': false
                    },
                ]
            });
        });
    </script>
@endsection