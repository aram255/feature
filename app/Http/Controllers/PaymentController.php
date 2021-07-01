<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Credential;
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

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $customer_isset = false;

        $credential = Credential::where('user_id', Auth::id())->first();

        if(Auth::user()){

            if($credential){
                $customer = $stripe->customers->retrieve(
                    $credential->customer_id
                );
                if($customer){
                    $customer_isset = true;
                }
            }

            if(!$customer_isset){
                $customer = $stripe->customers->create([
                    'name' => Auth::user()->first_name .' '. Auth::user()->last_name,
                    'email' => Auth::user()->email,
                ]);
                $credential = Credential::create([
                    'user_id' => Auth::id(),
                    'customer_id' => $customer->id
                ]);
            }


            $cards = $stripe->customers->allSources(
                $customer->id,
                ['object' => 'card']
            );

            $check_card = false;

            foreach ($cards as $card){

                if(Card::where('fingerprint', $card->fingerprint)->first()){
                    $check_card = true;
                }
            }

            if(!$check_card){
                $card = $stripe->customers->createSource(
                    $credential->customer_id,
                    ['source' => $request->stripeToken]
                );
                Card::create([
                    'user_id' => Auth::id(),
                    'fingerprint' => $card->fingerprint,
                    'card_id' => $card->id,
                    'number' => $card->last4,
                ]);
                Session::flash('success', 'Card is created');
            }else{
                Session::flash('success', 'Card is already exist');
            }

        }


        return back();
    }

    public function removeCard(Request $request, $id)
    {
        try{
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $card = Card::find($id);
            $credential = Credential::where('user_id', Auth::id())->first();

            $stripe->customers->deleteSource(
                $credential->customer_id,
                $card->card_id
            );

            $card->delete();

        }catch(\Exception $exception){

        }

        return back();
    }


}
