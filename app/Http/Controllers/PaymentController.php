<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Stripe;
use Session;

class PaymentController extends Controller
{
    public function index()
    {
        return view('customer.payment');
    }

    public function makePayment(Request $request)
    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => 120 * 100,
            "currency" => "aed",
            "source" => $request->stripeToken,
         /*   'source'   => [
                'object'    => 'card',
                'number'    => '...',
                'exp_month' => '...',
                'exp_year'  => '...',
                'cvc'       => '...',
                ],*/
            "description" => "Make payment and chill."
        ]);

        Session::flash('success', 'Payment successfully made.');

        return back();
    }

    public function addCard(Request $request)
    {

        Card::create([
                'user_id' => Auth::id(),
                'sender_name' => $request->sender_name,
                'card_number' => Crypt::encryptString(trim($request->num)),
                'month' => $request->month,
                'year' => $request->year,
                'cvc' => Crypt::encryptString($request->cvc),
        ]);

        Session::flash('success', 'Card is created');

        return back();
    }
}
