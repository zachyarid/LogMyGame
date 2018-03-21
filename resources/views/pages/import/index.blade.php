@extends('layouts.template')

@section('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <form action="{{ route('import.games') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card pd-20 pd-sm-40">
            <div class="col-md-6">
                <div class="row">
                    <h6 class="card-body-title">Import Games</h6>
                </div>

                <div class="row mg-t-20">
                    <p>Click <a href="{{ route('import.instructions') }}" target="_blank">here</a> for import instructions.</p>
                </div>

                <div class="row mg-t-40">
                    <select name="source" class="form-control select2 col-md-6{{ $errors->has('source') ? ' is-invalid' : '' }}">
                        <option disabled selected>Select a source</option>
                        <option value="go">Game Officials</option>
                        <option value="csv">Raw CSV/XLS</option>
                        <option disabled value="a">Coming soon! - Arbiter</option>
                    </select>

                    @if ($errors->has('source'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('source') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row mg-t-40">
                    <label class="custom-file{{ $errors->has('import') ? ' is-invalid' : '' }}">
                        <input type="file" id="import" name="import" class="custom-file-input">
                        <span class="custom-file-control"></span>
                    </label>
                </div>

                @if ($errors->has('import'))
                    <div class="row mg-t-10">
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('import') }}</strong>
                        </span>
                    </div>
                @endif

                <div class="row mg-t-40">
                    <button class="btn btn-primary" type="submit">Import</button>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row mg-t-20">
                    <p>Template file for raw CSV import available <a href="{{ Storage::disk('public')->url('template/logmygames-template.csv') }}">here</a></p>
                </div>
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