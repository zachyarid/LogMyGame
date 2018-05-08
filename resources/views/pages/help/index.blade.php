@extends('layouts.template')

@section('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <div class="card pd-20 pd-sm-40">
        <p>If you encounter an error, please take the time to send a screenshot to <a href="mailto:help@logmygames.me">help@logmygames.me</a>. Include as much detail as you can!</p>
        <p class="mg-t-15">For a tutorial on adding a game, click <a href="{{ route('help.gameTutorial') }}">here</a>.</p>
        <p>For a tutorial on adding a payment, click <a href="{{ route('help.paymentTutorial') }}">here</a>.</p>
        <p>For a tutorial on adding a mileage, click <a href="{{ route('help.mileageTutorial') }}">here</a>.</p>
        <p class="mg-t-15">For answers to Frequently Asked Questions, click <a href="{{ route('help.faq') }}">here</a>.</p>
        <p>For help on adding Game Types / Locations, click <a href="{{ route('help.add-gt-gl') }}">here</a></p>
        <p>For import instructions, click <a href="{{ route('import.instructions') }}">here</a></p>
    </div>

    <div class="card pd-20 pd-sm-40 mg-t-20">
        <h5>For all other inquiries, please submit the form below.</h5>

        <div class="form-layout">
            <form method="POST" action="{{ route('help.inquiry') }}">
                @csrf

                <div class="row mg-b-25">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-sm-4 form-control-label mg-t-15" for="subject">Subject:<span class="tx-danger">*</span></label>
                            <input name="subject" id="subject" required
                                   class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}"
                                   value="{{ old('subject') }}"/>

                        </div>
                    </div>
                </div>
                <div class="row mg-b-25">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label class="col-sm-4 form-control-label" for="details">Details:<span class="tx-danger">*</span></label>
                            <textarea id="summernote-editor" name="details">{{ old('details') }}</textarea>

                            @if ($errors->has('details'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('details') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div><!-- col-10 -->
                </div>

                <div class="form-layout-footer">
                    <button class="btn btn-default mg-r-5">Submit</button>
                </div><!-- form-layout-footer -->
            </form>
        </div>
    </div>
@endsection

@section('script-source')
    <script>
        $(document).ready(function () {
            $('#summernote-editor').summernote({
                height: 150
            });
        });
    </script>
@endsection