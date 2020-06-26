<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentsController extends Controller
{
    //
    public function index()
    {
        return view('payment/payment');
    }

    public function payWithCard(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment"
        ]);

        Session::flash('success', 'Payment successful!');

        return back();
    }
}
