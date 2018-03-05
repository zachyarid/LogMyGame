<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Game;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentController\PaymentCreateRequest as CreateRequest;
use App\Http\Requests\PaymentController\PaymentEditRequest as EditRequest;
use Illuminate\Support\Facades\DB;

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
            'pageTitle' => 'View Payments',
            'payments' => Payment::where('user_id', '=', \Auth::id())->get(),
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
            'pageTitle' => 'Log Payments',
            'gameswithoutpay' => DB::table('games')->whereNotExists(function ($query) {
                                    $query->select(DB::raw(1))
                                          ->from('payments')
                                          ->whereRaw('payments.game_id = games.id and payments.user_id = ' . \Auth::id());
                                 })->where('user_id', \Auth::id())->get()
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
        foreach ($request->game_id as $id)
        {
            Payment::create([
                'user_id' => \Auth::id(),
                'game_id' => $id,
                'payer' => $request->payer,
                'check_number' => $request->check,
                'date_received' => $request->date_received,
                'comments' => $request->comments,
            ]);
        }

        return redirect('/payment')->with('success_message', 'Payment/s logged! Game marked as paid!');
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

        $data = [
            'pageTitle' => 'View Payment',
            'payment' => $payment,
        ];

        return view('pages.payment.show-payment', $data);
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

        $data = [
            'pageTitle' => 'Edit Payment',
            'payment' => $payment,
        ];

        return view('pages.payment.edit-payment', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Payment $payment)
    {
        $this->authorize('update', $payment);

        $newPayment = Payment::find($payment->id);

        $newPayment->payer = $request->payer;
        $newPayment->date_received = $request->date_received;
        $newPayment->check_number = $request->check_number;
        $newPayment->comments = $request->comments;
        //$newPayment->game_id = $request->game_id; lock this

        $newPayment->save();

        return redirect('/payment')->with('success_message', 'Payment updated!');
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
