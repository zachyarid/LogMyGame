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
            <table id="payment-log" class="table table-striped table-responsive">
                <thead>
                <tr>
                    <th>Log ID</th>
                    <th>Log Date</th>
                    <th>Origin</th>
                    <th>Odometer Out</th>
                    <th>Odometer In</th>
                    <th>Mileage</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach (Auth::user()->mileage as $m)
                    <tr>
                        <td>{{ $m->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($m->created_at)->format('M d, Y h:i A') }}</td>
                        <td>{{ $m->origin }}</td>
                        <td>{{ $m->odometer_out }}</td>
                        <td>{{ $m->odometer_in }}</td>
                        <td>{{ $m->distance }}</td>
                        <td>
                            @if ($m->status == 'pre')
                                Pre-Mileage Log
                            @elseif ($m->status == 'comp')
                                Complete
                            @endif
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
                ],
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