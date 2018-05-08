<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileController\EditProfileRequest as EditRequest;
use App\Http\Requests\ProfileController\EmailPreferencesRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'My Profile',
            'profile_path' => Storage::disk('public')->url('avatars/' .\Auth::id() . '.jpeg'),
        ];

        return view('pages.profile.profile', $data);
    }

    public function update(EditRequest $request)
    {
        $user = \Auth::user();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->ussf_grade = $request->ussf_grade;
        $user->default_origin = $request->default_origin;
        $user->email_toggle = $request->email_toggle == 'on' ? 1 : 0;

        if ($request->profile_pic)
        {
            $request->file('profile_pic')->storeAs('public/avatars', \Auth::id() . '.jpeg');
        }

        if ($request->current_password && $request->password_confirmation && $request->password)
        {
            if (password_verify($request->current_password, $user->password))
            {
                DB::table('users')
                    ->where('id', \Auth::id())
                    ->update(['password' => bcrypt($request->password)]);
            }
            else
            {
                return back()->with('fail_message', 'Password verification failed.');
            }
        }
        $user->save();

        return back()->with('success_message', 'Profile updated!');
    }

    public function emailPreferences()
    {
        $email_info = [
            'last_game' => \Auth::user()->game_summary_last_run,
            'last_mileage' => \Auth::user()->mileage_last_run,
            'last_pay' => \Auth::user()->outstanding_last_run,
        ];

        $data = [
            'pageTitle' => 'Set Email Preferences',
            'user' => \Auth::user(),
            'email_info' => $email_info
        ];

        return view('pages.profile.email-prefs', $data);
    }

    public function storeEmailPreferences(EmailPreferencesRequest $request)
    {
        // Prep the values
        $opf = $request->outstanding_freq;
        $sf = $request->game_summary_freq;
        $mf = $request->mileage_summary_freq;

        $op = $request->outstanding_payments == 'on' ? 1 : 0;
        $s = $request->game_summary == 'on' ? 1 : 0;
        $m = $request->mileage_summary == 'on' ? 1 : 0;

        $user = \Auth::user();
        $user->email_toggle = $request->email_toggle == 'on' ? 1 : 0;
        $user->outstanding_payments = $op;
        $user->outstanding_freq = $opf;
        $user->game_summary = $s;
        $user->game_summary_freq = $sf;
        $user->mileage_summary = $m;
        $user->mileage_summary_freq = $mf;
        $user->save();

        return redirect('/profile/email')->with('success_message', 'Email preferences have been saved!');
    }
}
