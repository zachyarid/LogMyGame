@extends('layouts.template')

@section('content')
    <form method="POST" action="{{ route('payment.store') }}">
        @csrf

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Enter Payment Details</h6>
            <p class="mg-b-20 mg-sm-b-30"></p>

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Game: <span class="tx-danger">*</span></label>
                            <select name="game_id" id="game_id"
                                    class="form-control select2{{ $errors->has('game_id') ? ' is-invalid' : '' }}">
                                @if (count($gameswithoutpay) > 0)
                                    <option selected disabled value="">Select a Game</option>
                                    @foreach ($gameswithoutpay as $g)
                                        <option value="{{ $g->id }}" {{ $g->id == old('game_id') ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $g->date . $g->time)->format('M d, Y H:i A') }},
                                            {{ $g->home_team }} vs {{ $g->away_team }}
                                        </option>
                                    @endforeach
                                @else
                                    <option selected disabled value="">All Games Paid!</option>
                                @endif
                            </select>

                            @if ($errors->has('game_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('game_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-6 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Check/Reference Number: <span class="tx-danger">*</span></label>
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
                        <div class="form-group mg-b-10">
                            <label class="form-control-label">Date Received: <span class="tx-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                <input name="date_received"
                                       class="form-control fc-datepicker{{ $errors->has('date_received') ? ' is-invalid' : '' }}"
                                       value="{{ old('date_received') }}">
                                <input type="hidden" name="date_received" id="date_receivedf" value="{{ old('date_received') }}" />
                                @if ($errors->has('date_received'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date_received') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div><!-- col-4 -->

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
                    <button class="btn btn-default mg-r-5">Submit Form</button>
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
                altField: '#game_datef'
            });

            $('#summernote-editor').summernote({
                height: 150
            });

            $(".select2").select2();
        });
    </script>
@endsection