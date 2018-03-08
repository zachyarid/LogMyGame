@extends('layouts.template')

@section('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <form id="pageForm">
        <div class="card pd-20 pd-sm-40">
            <div class="form-layout">
                <div class="row mg-b-5">
                    <div class="col-lg-6">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Game: <span class="tx-danger">*</span></label>
                            <select name="game_id[]" id="game_id" multiple
                            class="form-control select2">
                                @foreach (App\Mileage::find($mileage->id)->games as $g)
                                    <option value="{{ $g->id }}" selected>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $g->date . $g->time)->format('M d, Y h:i A') }},
                                        {{ $g->home_team }} vs {{ $g->away_team }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- col-6 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Date Traveled: <span class="tx-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                <input name="date_travel"
                                       class="form-control fc-datepicker{{ $errors->has('date_travel') ? ' is-invalid' : '' }}"
                                       value="{{ \Carbon\Carbon::parse($mileage->date_travel)->format('m/d/Y') }}" />
                            </div>
                        </div>
                    </div><!-- col-4 -->
                </div>

                <div class="row mg-b-5">
                    <div class="col-lg-2">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Origin:</label>
                            <input name="origin" id="origin" type="text"
                                   class="form-control{{ $errors->has('origin') ? ' is-invalid' : '' }}"
                                   value="{{ $mileage->origin }}" />
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-2">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Odometer Out:</label>
                            <input name="odometer_out" id="odometer_out" type="number"
                                   class="form-control{{ $errors->has('odometer_out') ? ' is-invalid' : '' }}"
                                   value="{{ $mileage->odometer_out }}"/>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-2">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Odometer In:</label>
                            <input name="odometer_in" id="odometer_in" type="number"
                                   class="form-control{{ $errors->has('odometer_in') ? ' is-invalid' : '' }}"
                                   value="{{ $mileage->odometer_in }}"/>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-2">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Distance Traveled:</label>
                            <input name="distance" id="distance" type="number"
                                   class="form-control{{ $errors->has('distance') ? ' is-invalid' : '' }}"
                                   value="{{ $mileage->distance }}"/>
                        </div>
                    </div><!-- col-4 -->
                </div>

                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label class="col-sm-4 form-control-label" for="comments">Mileage Comments: </label>
                            <textarea id="summernote-editor" name="comments">{{ $mileage->comments }}</textarea>
                        </div>
                    </div><!-- col-10 -->
                </div>
            </div><!-- form-layout -->
        </div>
    </form>
@endsection

@section('script-source')
    <script>
        $(document).ready(function () {
            $('#summernote-editor').summernote({
                height: 150
            }).summernote('disable');

            $(".select2").select2();

            $('#pageForm input').attr('readonly', 'readonly');
        });
    </script>
@endsection