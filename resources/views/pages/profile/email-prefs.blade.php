@extends('layouts.template')

@section('content')
    @if ($message = session('success_message'))
        @include('layouts.alert-success')
    @elseif ($message = session('fail_message'))
        @include('layouts.alert-danger')
    @endif

    <div class="card pd-20 pd-sm-40">
        <form method="POST" action="{{ route('profile.email-store') }}">
            @csrf

            <div class="row">
                <div class="col-md-3">
                    <label for="email_toggle" class="mg-t-10 mg-r-10">Email Status:</label>
                </div>

                <div class="col-md-1">
                    <input id="email_toggle" name="email_toggle" type="checkbox" {{ Auth::user()->email_toggle == 1 ? 'checked' : '' }} data-toggle="toggle" data-onstyle="primary" />
                </div>
            </div>

            <hr>

            <div class="row mg-t-20">
                <div class="col-md-3">
                    <label for="game_summary" class="mg-t-10 mg-r-10">Game Summary: </label>
                </div>

                <div class="col-md-1">
                    <input id="game_summary" name="game_summary" type="checkbox"
                           data-toggle="toggle" data-onstyle="primary"
                            {{ $user->game_summary ? 'checked' : '' }} />
                </div>

                <div class="col-md-3">
                    <select name="game_summary_freq" class="form-control select2">
                        <option value="1" {{ $user->game_summary_freq == 1 ? 'selected' : '' }}>Daily</option>
                        <option value="7" {{ $user->game_summary_freq == 7 ? 'selected' : '' }}>Weekly</option>
                        <option value="30" {{ $user->game_summary_freq == 30 ? 'selected' : '' }}>Monthly</option>
                        <option value="90" {{ $user->game_summary_freq == 90 ? 'selected' : '' }}>Quarterly</option>
                        <option value="365" {{ $user->game_summary_freq == 365 ? 'selected' : '' }}>Yearly</option>
                    </select>
                </div>

                @if ($errors->has('game_summary'))
                    <div class="col-md-4">
                        <span class="text-danger">
                            <strong>{{ $errors->first('game_summary') }}</strong>
                        </span>
                    </div>
                @elseif ($errors->has('game_summary_freq'))
                    <div class="col-md-4">
                        <span class="text-danger">
                            <strong>{{ $errors->first('game_summary_freq') }}</strong>
                        </span>
                    </div>
                @else
                    <div class="col-md-4">
                        <p class="mg-t-5 font-italic">Last email sent: {{ \Carbon\Carbon::parse($email_info['last_game'])->format('M d, Y h:ia') }}</p>
                    </div>
                @endif
            </div>

            <div class="row mg-t-20">
                <div class="col-md-3">
                    <label for="outstanding_payments" class="mg-t-10 mg-r-10">Outstanding Payments: </label>
                </div>

                <div class="col-md-1">
                    <input id="outstanding_payments" name="outstanding_payments" type="checkbox"
                        data-toggle="toggle" data-onstyle="primary"
                            {{ $user->outstanding_payments ? 'checked' : '' }} />
                </div>

                <div class="col-md-3">
                    <select name="outstanding_freq" class="form-control select2">
                        <option value="1" {{ $user->outstanding_freq == 1 ? 'selected' : '' }}>Daily</option>
                        <option value="3" {{ $user->outstanding_freq == 3 ? 'selected' : '' }}>Once Every 3 Days</option>
                        <option value="7" {{ $user->outstanding_freq == 7 ? 'selected' : '' }}>Weekly</option>
                        <option value="30" {{ $user->outstanding_freq == 30 ? 'selected' : '' }}>Monthly</option>
                        <option value="90" {{ $user->outstanding_freq == 90 ? 'selected' : '' }}>Quarterly</option>
                        <option value="365" {{ $user->outstanding_freq == 365 ? 'selected' : '' }}>Yearly</option>
                    </select>
                </div>

                @if ($errors->has('outstanding_payments'))
                    <div class="col-md-4">
                        <span class="text-danger">
                            <strong>{{ $errors->first('outstanding_payments') }}</strong>
                        </span>
                    </div>
                @elseif ($errors->has('outstanding_freq'))
                    <div class="col-md-4">
                        <span class="text-danger">
                            <strong>{{ $errors->first('outstanding_freq') }}</strong>
                        </span>
                    </div>
                @else
                    <div class="col-md-4">
                        <p class="mg-t-5 font-italic">Last email sent: {{ \Carbon\Carbon::parse($email_info['last_pay'])->format('M d, Y h:ia') }}</p>
                    </div>
                @endif
            </div>

            <div class="row mg-t-20">
                <div class="col-md-3">
                    <label for="mileage_summary" class="mg-t-10 mg-r-10">Mileage Summary: </label>
                </div>

                <div class="col-md-1">
                    <input id="mileage_summary" name="mileage_summary" type="checkbox"
                           data-toggle="toggle" data-onstyle="primary"
                            {{ $user->mileage_summary ? 'checked' : '' }}/>
                </div>

                <div class="col-md-3">
                    <select name="mileage_summary_freq" class="form-control select2">
                        <option value="1" {{ $user->mileage_summary_freq == 1 ? 'selected' : '' }}>Daily</option>
                        <option value="7" {{ $user->mileage_summary_freq == 7 ? 'selected' : '' }}>Weekly</option>
                        <option value="30" {{ $user->mileage_summary_freq == 30 ? 'selected' : '' }}>Monthly</option>
                        <option value="90" {{ $user->mileage_summary_freq == 90 ? 'selected' : '' }}>Quarterly</option>
                        <option value="365" {{ $user->mileage_summary_freq == 365 ? 'selected' : '' }}>Yearly</option>
                    </select>
                </div>


                @if ($errors->has('mileage_summary'))
                    <div class="col-md-4">
                        <span class="text-danger">
                            <strong>{{ $errors->first('mileage_summary') }}</strong>
                        </span>
                    </div>
                @elseif ($errors->has('mileage_summary_freq'))
                    <div class="col-md-4">
                        <span class="text-danger">
                            <strong>{{ $errors->first('mileage_summary_freq') }}</strong>
                        </span>
                    </div>
                @else
                    <div class="col-md-4">
                        <p class="mg-t-5 font-italic">Last email sent: {{ \Carbon\Carbon::parse($email_info['last_mileage'])->format('M d, Y h:ia') }}</p>
                    </div>
                @endif
            </div>

            <hr>

            <div class="row mg-t-25">
                <div class="col-md-2">
                    <div class="form-layout-footer">
                        <button class="btn btn-default">Save Email Preferences</button>
                    </div><!-- form-layout-footer -->
                </div>
            </div>

            <div class="row mg-t-25">
                <div class="col-md-10">
                    Have an idea for another type of email? Recommend your suggestion <a target="_blank" href="{{ route('help.index') }}">here</a>!
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script-source')
    <script>
        $(document).ready(function () {
            $(".select2").select2();
        });
    </script>
@endsection