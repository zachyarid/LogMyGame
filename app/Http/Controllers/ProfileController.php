<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileController\EditProfileRequest as EditRequest;
use Faker\Provider\Image;
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
}
