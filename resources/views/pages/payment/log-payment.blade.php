@extends('layouts.template')

@section('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <form method="POST" action="{{ route('payment.store') }}">
        @csrf

        <div class="card pd-20 pd-sm-40">
            <div class="form-layout">
                <div class="row mg-b-5">
                    <div class="col-lg-6">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Game: <span class="tx-danger">*</span></label>
                            <select name="game_id[]" id="game_id" {{ count($gameswithoutpay) == 0 ? '' : 'multiple' }}
                                    class="form-control select2{{ $errors->has('game_id') ? ' is-invalid' : '' }}">
                                @foreach ($gameswithoutpay as $g)
                                    <option value="{{ $g->id }}" {{ $g->id == old('game_id') ? 'selected' : isset($game->id) ? $game->id == $g->id ? 'selected' : '' : '' }}>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $g->date . $g->time)->format('M d, Y h:i A') }},
                                        {{ $g->home_team }} vs {{ $g->away_team }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('game_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('game_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-6 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Check/Reference Number:</label>
                            <input name="check_number" id="check_number" type="number"
                                   class="form-control{{ $errors->has('check_number') ? ' is-invalid' : '' }}"
                                   value="{{ old('check_number') }}"/>

                            @if ($errors->has('check_number'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('check_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Payer: <span class="tx-danger">*</span></label>
                            <input name="payer" id="payer" type="text"
                                   class="form-control{{ $errors->has('payer') ? ' is-invalid' : '' }}"
                                   value="{{ old('payer') }}"/>

                            @if ($errors->has('payer'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('payer') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Date Received: <span class="tx-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                <input name="date_received"
                                       class="form-control fc-datepicker{{ $errors->has('date_received') ? ' is-invalid' : '' }}"
                                       value="{{ old('date_received') ? \Carbon\Carbon::createFromFormat('Y-m-d', old('date_received'))->format('m/d/Y') : \Carbon\Carbon::now()->format('m/d/Y') }}" />
                                <input type="hidden" name="date_received" id="date_receivedf" value="{{ old('date_received') ? old('date_received') : \Carbon\Carbon::now()->format('Y-m-d') }}" />
                                @if ($errors->has('date_received'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date_received') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div><!-- col-4 -->
                </div>

                <div class="row mg-b-25">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label class="col-sm-4 form-control-label" for="comments">Payment Comments: </label>
                            <textarea id="summernote-editor" name="comments">{{ old('comments') }}</textarea>

                            @if ($errors->has('comments'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('comments') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-10 -->
                </div>

                <div class="form-layout-footer">
                    <button class="btn btn-default mg-r-5">Log Payment</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
        </div>
    </form>
@endsection

@section('script-source')
    <script>
        $(document).ready(function () {
            $('.fc-datepicker').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                numberOfMonths: 1,
                altFormat: 'yy-mm-dd',
                altField: '#date_receivedf'
            });

            $('#summernote-editor').summernote({
                height: 150
            });

            $(".select2").select2();
        });
    </script>
@endsection