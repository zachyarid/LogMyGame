@extends('layouts.template')

@section ('content')
    <div class="pd-20">
        <div class="row">
            <p class="text-danger font-italic pd-10">Please note, import functionality may have some unexpected behavior.
                We have done our best to catch errors but some may still slip by. To ensure accuracy,
                we ask that you verify all games after they are imported.
            </p>
            <p class="text-danger font-italic pd-10">
                If you require any assistance, do not hesitate to send us an email at <a href="mailto:support@logmygames.me">support@logmygames.me</a>
            </p>
        </div>

        <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
            <div class="card">
                <div class="card-header" role="tab" id="headingOne">
                    <h6 class="mg-b-0">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                           aria-controls="collapseOne" class="tx-gray-800 collapsed" aria-expanded="false">
                            Game Officials Import Instructions
                        </a>
                    </h6>
                </div><!-- card-header -->

                <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="card-block pd-20">
                        <div class="row mg-t-20">
                            <div class="col-md-2">
                                <img src="{{ Storage::disk('public')->url('instructions/go/go_1.PNG') }}" />
                            </div>
                            <div class="col-md-8 mg-t-75">
                                <p>First, click on REPORTS on the left hand pane.</p>
                                <img width="700px" src="{{ Storage::disk('public')->url('instructions/go/go_2.PNG') }}" />
                                <p class="mg-t-5">Next, click on Officials Schedule</p>
                            </div>
                        </div>

                        <div class="row mg-t-40">
                            <div class="col-md-12">
                                <p>Next, set the date range, check "Show One Line Per Game", set the Report Format to Microsoft Excel (.xls) , and, optionally, select "Include games from All Groups"</p>
                                <img src="{{ Storage::disk('public')->url('instructions/go/go_3.PNG') }}" />
                                <p class="font-italic">Please be sure to only import games from the past.</p>
                            </div>
                        </div>

                        <div class="row mg-t-40">
                            <div class="col-md-12">
                                <p>Now, in order to import, it is necessary to open the file in Excel and convert it to CSV.</p>
                                <p>After you open the file, you may see an error similar to the one pictured below. Click Yes.</p>
                                <img width="850px" src="{{ Storage::disk('public')->url('instructions/go/go_4.PNG') }}" />
                            </div>
                        </div>

                        <div class="row mg-t-30">
                            <div class="col-md-12">
                                <p>After you click yes, Click File -> Save As. The Save as type should be CSV UTF-8.</p>
                                <img src="{{ Storage::disk('public')->url('instructions/go/go_5.PNG') }}" />
                                <p class="mg-t-5">Save the file where you can retrieve it easily.</p>
                            </div>
                        </div>

                        <div class="row mg-t-30">
                            <div class="col-md-12">
                                <p>Now you may use the import functionality of the Log My Games! website. Remember to select the correct source before you import.</p>
                                <img src="{{ Storage::disk('public')->url('instructions/go/go_6.PNG') }}" />
                                <p>Click <a href="{{ route('import.index') }}">here</a> to go there</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- card -->

            <div class="card">
                <div class="card-header" role="tab" id="headingTwo">
                    <h6 class="mg-b-0">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                           aria-controls="collapseTwo" class="tx-gray-800 collapsed" aria-expanded="false">
                            Raw CSV Import Instructions
                        </a>
                    </h6>
                </div><!-- card-header -->

                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="card-block pd-20">
                        <ol>
                            <li>
                                <p>First, you'll need the CSV template file. You can download that <a href="{{ Storage::disk('public')->url('template/logmygames-template.csv') }}">here</a></p>
                            </li>
                            <li>
                                <p>After you have downloaded the template, open the file in a spreadsheet editor (Microsoft Excel, Google Sheets, etc) and begin entering your game data line by line.</p>
                            </li>
                            <li>
                                <p>Dates <span class="font-italic">must</span> be in the format of yyyy-mm-dd. For example, {{ date('Y-m-d', time()) }}</p>
                                <p>Times <span class="font-italic">must</span> be in the format of hh:mm. For example, {{ date('H:i', time()) }}</p>
                            </li>
                            <li>
                                <p>After you have put all of your data in the csv, you may import it into the system <a href="{{ route('import.index') }}">here</a> using the Raw CSV/XLS source.</p>
                            </li>
                        </ol>
                    </div>
                </div><!-- card -->
            </div><!-- accordion -->
        </div>
    </div>
@endsection