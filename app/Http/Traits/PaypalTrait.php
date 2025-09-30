<?php

namespace App\Http\Traits;


use Srmklive\PayPal\Services\PayPal as PayPalClient;
trait PaypalTrait
{
    public function Paypal($total,$success,$cancel){

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

         $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route($success),
                "cancel_url" => route($cancel)
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $total
                    ],

                ]
                    ],

        ]);

        // التحقق من الرد من PayPal
        if (isset($response['id']) && $response['id'] !== null) {
            foreach ($response['links'] as $key => $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('paypal_cancel');
        }



    }


}
