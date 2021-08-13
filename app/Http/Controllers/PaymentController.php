<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Card;
use App\Models\Credential;
use App\Models\PractitionersModel;
use Illuminate\Http\Request;
use LVR\CreditCard\CardNumber;

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


        $amount = $request->amount;
        $credential = Credential::where('user_id', Auth::id())->first();
        $card = Card::where('user_id',Auth::id())->where('id', $request->card)->first();


        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $customer = $stripe->customers->retrieve(
            $credential->customer_id
        );

        $card = $stripe->customers->retrieveSource(
            $customer->id,
            $card->card_id
        );

         $charge = $stripe->charges->create ([
            "amount" => $amount * 100,
            "currency" => "AED",
            "description" => "Make payment and chill.",
            "customer" => $customer->id,
            "source" => $card->id
        ]);

         if($charge->status == "succeeded"){
             $balance = Balance::where('user_id', Auth::id())->first();
             if(!$balance){
                 $balance = Balance::create([
                     'user_id' => Auth::id(),
                     'balance' => 0
                 ]);
             }
             $balance->balance += $amount;
             $balance->save();

             Session::flash('success', 'Payment successfully made.');

         }else{

             Session::flash('error', 'Something wrong');

         }

        return back();
    }
    public function addCardPractitioner(Request $request){

        $request->validate([
            'card_number' => ['required', new CardNumber],
        ]);

        $user_id = session()->get('UserID');
        PractitionersModel::find($user_id)->update([
            'card_number' => $request->card_number
        ]);

        Session::flash('success', 'Card is added');

        return redirect()->back();
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

            $card_created = $stripe->customers->createSource(
                $credential->customer_id,
                ['source' => $request->stripeToken]
            );

            foreach ($cards as $card){
                if($card->fingerprint == $card_created->fingerprint){
                    $check_card = true;
                }
            }

            if(!$check_card){

                Card::create([
                    'user_id' => Auth::id(),
                    'fingerprint' => $card_created->fingerprint,
                    'card_id' => $card_created->id,
                    'number' => $card_created->last4,
                ]);

                Session::flash('success', 'Card is created');

            }else{

                $stripe->customers->deleteSource(
                    $credential->customer_id,
                    $card_created->id
                );

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
