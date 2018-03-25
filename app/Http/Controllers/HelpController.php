<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Help'
        ];

        return view('pages.help.index', $data);
    }

    public function faq()
    {
        $data = [
            'pageTitle' => 'Frequently Asked Questions'
        ];

        return view('pages.help.faq', $data);
    }
}
