@extends('layouts.template')

@section('content')
    <div class="card pd-20 pd-sm-40">

        <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
            <div class="card">
                <div class="card-header" role="tab" id="headingOne">
                    <h6 class="mg-b-0">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                           aria-controls="collapseOne" class="tx-gray-800 collapsed" aria-expanded="false">
                            Will there be an Android/iOS application for Log My Games! ?
                        </a>
                    </h6>
                </div><!-- card-header -->

                <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="card-block pd-20">
                        <p>Yes! Once the core of the website is finished, development will start for the mobile application versions of this website. You may still use the website on your phone, but some display issues may arise.</p>
                    </div>
                </div>
            </div><!-- card -->
        </div>
    </div>
@endsection