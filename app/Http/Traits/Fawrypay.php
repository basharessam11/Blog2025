<?php

namespace App\Http\Traits;


trait Fawrypay
{
    public function Fawrypay($userId, $amount)
    {
        $payment = new \DavidMaximous\Fawrypay\Classes\FawryPayment();

        return $payment->setUserId($userId)
            ->setUserName("Default User")
            ->setUserEmail("user@example.com")
            ->setUserPhone("01000000000")
            ->setMethod("PayAtFawry")
            ->setLanguage("en-gb")
            ->setItem("Default Item")
            ->setQuantity(1)
            ->setDescription("Payment")
            ->setAmount($amount)
            ->pay();

        dd($response);


    }
}
