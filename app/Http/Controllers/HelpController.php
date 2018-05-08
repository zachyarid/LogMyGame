<?php

namespace App\Http\Controllers;

use App\Inquiry;
use Illuminate\Http\Request;
use App\Mail\InquiryReceived;
use Illuminate\Support\Facades\Mail;

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

    public function addglgt()
    {
        $data = [
            'pageTitle' => 'Adding a Game Type / Location'
        ];

        return view('pages.help.add-gt-gl', $data);
    }

    public function storeInquiry(Request $request)
    {
        $inquiry = Inquiry::create([
            'subject' => $request->subject,
            'details' => $request->details,
            'user_id' => \Auth::id()
        ]);

        Mail::to('help@logmygames.me')
            ->send(new InquiryReceived($inquiry));

        return redirect('/help')->with('success_message', 'Inquiry received. If we need more information from you, we will reach out via email! Thank you!');
    }

    public function viewInquiry(Inquiry $inquiry)
    {
        $data = [
            'pageTitle' => 'View Inquiry',
            'inquiry' => $inquiry,
        ];

        return view('pages.help.view-inquiry', $data);
    }

    public function gameTutorial()
    {
        $data = [
            'pageTitle' => 'Game Tutorial'
        ];

        return view('pages.help.game-tutorial', $data);
    }

    public function paymentTutorial()
    {
        $data = [
            'pageTitle' => 'Payment Tutorial'
        ];

        return view('pages.help.payment-tutorial', $data);
    }

    public function mileageTutorial()
    {
        $data = [
            'pageTitle' => 'Mileage Tutorial'
        ];

        return view('pages.help.mileage-tutorial', $data);
    }
}
