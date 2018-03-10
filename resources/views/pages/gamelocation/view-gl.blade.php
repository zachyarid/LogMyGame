@extends('layouts.template')

@section ('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <div class="card pd-20 pd-sm-40">
        <div class="table-responsive">
            <div class="col-md-1">
                <button class="btn btn-default" onclick="window.location = '{{ route('gamelocation.create') }}'">Add A New Game Location</button>
            </div>
            <table id="game-locs" class="table table-striped table-responsive">
                <thead>
                <tr>
                    <th>Location ID</th>
                    <th>Location</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($gamelocs as $g)
                    <tr>
                        <td>{{ $g->id }}</td>
                        <td>{{ $g->location }}</td>
                        <td>
                            <button class="btn btn-default" onclick="window.location = '{{ route('gamelocation.games-used', ['type' => $g->id]) }}'">View Games Used</button>

                            @if ($g->is_default == 0)
                                <button class="btn btn-success" onclick="window.location = '{{ route('gamelocation.edit', ['gametype' => $g->id]) }}'">Edit</button>
                                <button class="btn btn-danger" onclick="doCancel({{ $g->id }})">Remove</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section ('script-source')
    <script>
        $(document).ready(function () {
            $('#game-locs').DataTable({
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

        function doCancel(id)
        {
            var result = confirm('Are you sure you want to delete this game type?');

            if (result) {
                $.ajax({
                    type: 'POST',
                    url: '{{ url('/gamelocation') }}/' + id,
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
                        alert(data.responseJSON.errors[0]);
                    }
                });
            }
        }
    </script>
@endsection