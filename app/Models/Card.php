<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $table = 'cards';

    protected $guarded = [];

    // Old
    /*
    public function add($order){
        $card = \Session::get('card');

        $card['username'] = $order->username;
        $card['email'] = $order->email;

        if(isset($card['items'][$order->game])){
            // TODO Currency question
            if($card['items'][$order->game]['order_currency_code'] == $order->order_currency_code){
                $card['items'][$order->game]['amount'] += $order->gold_amount;
                $card['items'][$order->game]['order_current_price'] += $order->order_current_price;
                $card['items'][$order->game]['total_price_usd'] += $order->total_price_usd;
            }
        } else {
            $card['items'][$order->game] = array();
            $card['items'][$order->game]['game'] = $order->game;
            $card['items'][$order->game]['amount'] = $order->gold_amount;
            $card['items'][$order->game]['order_currency_code'] = $order->order_currency_code;
            $card['items'][$order->game]['order_current_price'] = $order->order_current_price;
            $card['items'][$order->game]['total_price_usd'] = $order->total_price_usd;
        }

        if(isset($card['total'])){
            if($card['total_currency'] == $order->order_currency_code){
                $card['total'] += $order->order_current_price;
            }
        }else{
            $card['total'] = $order->order_current_price;
            $card['total_currency'] = $order->order_currency_code;
        }

        \Session::put('card', $card);

        $card = \Session::get('card');

        return true;
    }*/

    // public function add($order){
    //     $card = \Session::get('card');

    //     $card['username'] = $order->username;
    //     $card['email'] = $order->email;

    //     if(isset($card['order']) && ($card['order']['order_currency_code']) == $order->order_currency_code){
    //         $card['order']['amount'] += $order->gold_amount;
    //         $card['order']['order_current_price'] += $order->order_current_price;
    //         $card['order']['total_price_usd'] += $order->total_price_usd;
    //     } else {
    //         $card['order'] = array();
    //         $card['order']['game'] = $order->game;
    //         $card['order']['amount'] = $order->gold_amount;
    //         $card['order']['order_currency_code'] = $order->order_currency_code;
    //         $card['order']['order_current_price'] = $order->order_current_price;
    //         $card['order']['total_price_usd'] = $order->total_price_usd;
    //     }

    //     \Session::put('card', $card);

    //     return true;
    // }
}
