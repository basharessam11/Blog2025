<?php

namespace App\Http\Traits;


trait StripeTrait
{
    public function Stripe($total,$success,$cancel){
        $stripe = \Stripe\Stripe::setApiKey(config('stripe.stripe_sk'));

        $response =  \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Mobile Phone'
                        ],
                        'unit_amount' => $total* 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            "success_url" => route($success),
            "cancel_url" => route($cancel)

        ]);

        // dd($response);
        return redirect()->away($response->url);


    }
}
