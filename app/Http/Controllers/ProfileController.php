<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'My Profile'
        ];

        return view('pages.profile.profile', $data);
    }

    public function update(Request $request, User $user)
    {
        return redirect('/profile')->with('success_message', 'Profile updated!');
    }
}
