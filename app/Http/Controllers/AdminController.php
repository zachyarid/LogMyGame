<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminController\AdminInviteRequest;
use App\Mail\InviteUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Administration Panel',
            'dashboardMessage' => DB::table('config')->where('key', 'dashboardMessage')->get()[0]->value,
        ];

        return view('pages.admin.index', $data);
    }

    public function invite(AdminInviteRequest $request)
    {
        $generated = substr(sha1(time()), 0, 12);

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => bcrypt($generated),
        ]);

        Mail::to($user->email)
            ->send(new InviteUser($user, $generated));

        return redirect('/admin')->with('success_message', 'User has been invited!');
    }

    public function dboardMsg(Request $request)
    {
        DB::table('config')
            ->where('key', 'dashboardMessage')
            ->update(['value' => $request->message]);

        return redirect('/admin')->with('success_message', 'Dashboard Message changed!');
    }
}
