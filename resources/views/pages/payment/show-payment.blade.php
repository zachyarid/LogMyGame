@extends('layouts.template')

@section('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <form id="pageForm">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Payment Details</h6>
            <p class="mg-b-20 mg-sm-b-30"></p>

            <div class="form-layout">
                <div class="row mg-b-5">
                    <div class="col-lg-6">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Game: <span class="tx-danger">*</span></label>
                            <select name="game_id" id="game_id"
                            class="form-control select2">
                                <option value="{{ $payment->game->id }}">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $payment->game->date . $payment->game->time)->format('M d, Y h:i A') }},
                                    {{ $payment->game->home_team }} vs {{ $payment->game->away_team }}
                                </option>
                            </select>
                        </div>
                    </div><!-- col-6 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Check/Reference Number:</label>
                            <input name="check_number" id="check_number" type="number"
                                   class="form-control"
                                   value="{{ $payment->check_number }}"/>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Payer: <span class="tx-danger">*</span></label>
                            <input name="payer" id="payer" type="text"
                                   class="form-control"
                                   value="{{ $payment->payer }}"/>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-20">
                            <label class="form-control-label">Date Received: <span class="tx-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                <input name="date_received"
                                       class="form-control fc-datepicker"
                                       value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $payment->date_received)->format('m/d/Y') }}" />
                            </div>
                        </div>
                    </div><!-- col-4 -->
                </div>

                <div class="row mg-b-25">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label class="col-sm-4 form-control-label" for="comments">Payment Comments: </label>
                            <textarea id="summernote-editor" name="comments">{{ $payment->comments }}</textarea>
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

            $(".select2").select2({
                disabled: true
            });

            $('#pageForm input').attr('readonly', 'readonly');
        });
    </script>
@endsection