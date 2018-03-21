@extends('layouts.template')

@section('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <form action="{{ route('export.games') }}" method="post">
        @csrf

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Export Games</h6>
            <p class="mg-b-20 mg-sm-b-30"></p>

            <div class="row">
                <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                    <label>Export Type:</label>
                    <select name="type" class="form-control select2">
                        <option disabled selected>Select a type</option>
                        <option value="xlsx">Excel</option>
                        <option value="csv">CSV</option>
                        <option value="pdf" disabled>PDF</option>
                        <option value="html">HTML</option>
                    </select>
                </div>
            </div>

            <div class="row mg-t-20">
                <button class="btn btn-primary">Export Games</button>
            </div>
        </div>
    </form>

    <form action="{{ route('export.payments') }}" method="post">
        @csrf

        <div class="card pd-20 pd-sm-40 mg-t-20">
            <h6 class="card-body-title">Export Payments</h6>
            <p class="mg-b-20 mg-sm-b-30"></p>

            <div class="row">
                <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                    <label>Export Type:</label>
                    <select name="type" class="form-control select2">
                        <option disabled selected>Select a type</option>
                        <option value="xlsx">Excel</option>
                        <option value="csv">CSV</option>
                        <option value="pdf" disabled>PDF</option>
                        <option value="html">HTML</option>
                    </select>
                </div>
            </div>

            <div class="row mg-t-20">
                <button class="btn btn-primary">Export Payments</button>
            </div>
        </div>
    </form>

    <form action="{{ route('export.mileage') }}" method="post">
        @csrf

        <div class="card pd-20 pd-sm-40 mg-t-20">
            <h6 class="card-body-title">Export Mileage</h6>
            <p class="mg-b-20 mg-sm-b-30"></p>

            <div class="row">
                <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                    <label>Export Type:</label>
                    <select name="type" class="form-control select2">
                        <option disabled selected>Select a type</option>
                        <option value="xlsx">Excel</option>
                        <option value="csv">CSV</option>
                        <option value="pdf" disabled>PDF</option>
                        <option value="html">HTML</option>
                    </select>
                </div>
            </div>

            <div class="row mg-t-20">
                <button class="btn btn-primary">Export Mileage</button>
            </div>
        </div>
    </form>
@endsection

@section('script-source')
    <script>
        $(document).ready(function () {
            $(".select2").select2();
        });
    </script>
@endsection