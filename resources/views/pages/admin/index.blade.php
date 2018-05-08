@extends('layouts.template')

@section('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <div class="row row-sm mg-t-20">
        <div class="col-xl-6">
            <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                <form method="POST" action="{{ route('admin.invite') }}">
                    @csrf
                    <h6 class="card-body-title">Invite User</h6>
                    <p class="mg-b-20 mg-sm-b-30"></p>

                    <div class="row">
                        <label class="col-sm-4 form-control-label" for="fname">First Name: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="fname" id="fname" type="text" autocomplete="off"
                                   class="form-control easy-ac-teams{{ $errors->has('fname') ? ' is-invalid' : '' }}"
                                   value="{{ old('fname') }}"/>

                            @if ($errors->has('fname'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="lname">Last Name: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="lname" id="lname" type="text" autocomplete="off"
                                   class="form-control easy-ac-teams{{ $errors->has('lname') ? ' is-invalid' : '' }}"
                                   value="{{ old('lname') }}"/>

                            @if ($errors->has('lname'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('lname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label" for="email">Email: <span
                                    class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input name="email" id="email" type="text" autocomplete="off"
                                   class="form-control easy-ac-teams{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   value="{{ old('email') }}"/>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <div class="col-lg-2">
                            <button class="btn btn-default">Invite User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                <form method="POST" action="{{ route('admin.dboardmsg') }}">
                    @csrf
                    <h6 class="card-body-title">Dashboard Message</h6>
                    <p class="mg-b-20 mg-sm-b-30"></p>

                    <textarea id="summernote-editor" name="message">{{ $dashboardMessage }}</textarea>

                    <div class="row mg-t-20">
                        <div class="col-lg-2">
                            <button class="btn btn-default">Save Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row row-sm mg-t-20">
        <div class="col-xl-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">View Users</h6>
                <p class="mg-b-20 mg-sm-b-30"></p>

                    <div class="table-responsive">
                        <table id="users" class="table table-striped">
                            <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>USSF Grade</th>
                                <th>Email</th>
                                <th>Receive Emails?</th>
                                <th>Total Games Logged</th>
                                <th>Join Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach (App\User::all() as $u)
                                <tr>
                                    <td>{{ $u->id }}</td>
                                    <td>{{ $u->fname . ' ' . $u->lname }}</td>
                                    <td>{{ $u->ussf_grade }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ $u->email_toggle == 1 ? 'Yes' : 'No' }}</td>
                                    <td>{{ $u->games->count() }}</td>
                                    <td>{{ \Carbon\Carbon::parse($u->created_at)->format('M d, Y H:i A') }}</td>

                                    <td>
                                        <button class="btn btn-success" onclick="alert('View')">Some Action</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script-source')
    <script>
        $(document).ready(function () {
            $('#users').DataTable({
                responsive: true,
                bLengthChange: true,
                aaSorting: [],
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page'
                }
            });
        });

        $('#summernote-editor').summernote({
            height: 150
        });
    </script>
@endsection