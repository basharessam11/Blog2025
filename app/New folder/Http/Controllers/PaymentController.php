<?php

namespace App\Http\Controllers;

use App\Services\FawryService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $fawryService;

    public function __construct(FawryService $fawryService)
    {
        $this->fawryService = $fawryService;
    }

    public function createPayment(Request $request)
    {
        $customerData = [
            'customerProfileId' => '12345',
            'customerMobile' => '01000000000',
            'customerEmail' => 'customer@example.com',
        ];

        $orderData = [
            'merchantRefNumber' => 'order123',
            'amount' => 100.00,
            'currencyCode' => 'EGP',
            'description' => 'Order Description',
        ];

        try {
            $response = $this->fawryService->createPayment($customerData, $orderData);
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
