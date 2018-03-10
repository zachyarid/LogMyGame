<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileController\EditProfileRequest as EditRequest;
use Faker\Provider\Image;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'My Profile'
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

        if ($request->profile_pic)
        {

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
                return redirect('/profile')->with('fail_message', 'Password verification failed.');
            }
        }
        $user->save();

        return redirect('/profile')->with('success_message', 'Profile updated!');
    }
}
