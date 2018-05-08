@extends('layouts.template')

@section('content')
<div class="card pd-20 pd-sm-40 mg-t-20">
    <div class="form-layout">
        <div class="row mg-b-20">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="col-sm-4 form-control-label mg-t-15" for="subject">From:<span class="tx-danger">*</span></label>
                    <input name="subject" id="subject" disabled readonly
                           class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}"
                           value="{{ $inquiry->user->fname . ' ' . $inquiry->user->lname }} ({{ $inquiry->user->email }})"/>
                </div>
            </div>
        </div>

        <div class="row mg-b-25">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="col-sm-4 form-control-label mg-t-15" for="subject">Subject:<span class="tx-danger">*</span></label>
                    <input name="subject" id="subject" disabled readonly
                           class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}"
                           value="{{ $inquiry->subject }}"/>
                </div>
            </div>
        </div>
        <div class="row mg-b-25">
            <div class="col-lg-10">
                <div class="form-group">
                    <label class="col-sm-4 form-control-label" for="details">Details:<span class="tx-danger">*</span></label>
                    <textarea id="summernote-editor" name="details">{{ $inquiry->details }}</textarea>
                </div>
            </div><!-- col-10 -->
        </div>
    </div>
</div>
@endsection

@section('script-source')
    <script>
        $(document).ready(function () {
            $('#summernote-editor').summernote({
                height: 150
            }).summernote('disable');
        });
    </script>
@endsection