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
                <button class="btn btn-default" onclick="window.location = '{{ route('mileage.create') }}'">Log Mileage</button>
            </div>
            <div class="table-responsive">
                <table id="payment-log" class="table table-striped">
                    <thead>
                    <tr>
                        <th>Trip Date</th>
                        <th>Destination</th>
                        <th>Odometer Out</th>
                        <th>Odometer In</th>
                        <th>Mileage</th>
                        <th>Potential Write Off *</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach (Auth::user()->mileage as $m)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($m->date_travel)->format('M d, Y') }}</td>
                            <td>{{ isset($m->games[0]) ? $m->games[0]->gameloc->location : 'No Linked Games' }}</td>
                            <td>{{ $m->odometer_out }}</td>
                            <td>{{ $m->odometer_in }}</td>
                            <td>{{ $m->distance }}</td>
                            <td>
                                ${{ number_format($m->distance * 0.545,2) }}
                            </td>
                            <td>
                                @if ($m->status == 'pre')
                                    <button class="btn btn-default" onclick="window.location = '{{ route('mileage.edit', ['mileage' => $m->id]) }}'">Complete Mileage Log</button>
                                    <button class="btn btn-danger" onclick="doCancel({{ $m->id }})">Cancel Mileage Log</button>
                                @elseif ($m->status == 'comp')
                                    <button class="btn btn-success" onclick="window.location = '{{ route('mileage.edit', ['mileage' => $m->id]) }}'">Edit Mileage Log</button>
                                    <button class="btn btn-info" onclick="window.location = '{{ route('mileage.show', ['mileage' => $m->id]) }}'">View Mileage Log</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <p>* Based on 2018 IRS Mileage Rate of 54.5 cents / mile</p>
    </div>
@endsection

@section('script-source')
    <script>
        $(document).ready(function () {
            $('#payment-log').DataTable({
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

        function doCancel(id)
        {
            var result = confirm('Are you sure you want to cancel this trip?');

            if (result) {
                $.ajax({
                    type: 'POST',
                    url: '{{ url('/mileage') }}/' + id,
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (data) {
                        console.log(data);
                        location.reload();
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
        }
    </script>
@endsection