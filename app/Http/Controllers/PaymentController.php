<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentController\PaymentCreateRequest as CreateRequest;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'payments' => DB::table('payments')->where(['user_id' => \Auth::id()])->get(),
        ];

        return view('pages.payment.view-payment', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'gameswithoutpay' => DB::table('games')->where('user_id', \Auth::id())->whereNull('payment_id')->get(),
        ];

        return view('pages.payment.log-payment', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        Payment::create([
            'user_id' => \Auth::id(),
            'game_id' => $request->game_id,
            'payer' => $request->payer,
            'check_number' => $request->check,
            'date_received' => $request->daterec,
        ]);

        return redirect('/payment')->with('message', 'Payment logged! Game marked as paid!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        $this->authorize('view', $payment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $this->authorize('view', $payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $this->authorize('update', $payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $this->authorize('delete', $payment);
    }
}
