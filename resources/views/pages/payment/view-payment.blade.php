@extends('layouts.template')

@section('content')
    <div class="card pd-20 pd-sm-40">
        <div class="table-responsive">
            <div class="col-md-1">
                <button class="btn btn-default" onclick="window.location = '{{ route('payment.create') }}'">Log Payment</button>
            </div>
            <table id="payment-log" class="table table-striped table-responsive">
                <thead>
                <tr>
                    <th>Log Date</th>
                    <th>Payer</th>
                    <th>Check Number (if applicable)</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (count($payments) > 0)
                    @foreach ($payments as $p)
                        <tr>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $p->date_received)->format('M d, Y') }}</td>
                            <td>{{ $p->payer }}</td>
                            <td>{{ $p->check_number }}</td>
                            <td>
                                <button class="btn btn-default" onclick="window.location = '{{ route('game.show', ['game' => $p->game_id]) }}'">View Game</button>
                                <button class="btn btn-info" onclick="window.location = '{{ route('payment.edit', ['payment' => $p->id]) }}'">Edit</button>
                                <button class="btn btn-success" onclick="window.location = '{{ route('payment.show', ['payment' => $p->id]) }}'">View Payment</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
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
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page'
                }
            });
        });
    </script>
@endsection