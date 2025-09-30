<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class FawryService
{
    protected $client;
    protected $merchantCode;
    protected $secretKey;
    protected $sandboxMode;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('fawry.sandbox_mode') ? 'https://atfawry.fawrystaging.com' : 'https://www.atfawry.com',
        ]);
        $this->merchantCode = config('fawry.merchant_code');
        $this->secretKey = config('fawry.secret_key');
        $this->sandboxMode = config('fawry.sandbox_mode');
    }

    public function createPayment($customerData, $orderData)
    {
        $payload = array_merge($customerData, $orderData, [
            'merchantCode' => $this->merchantCode,
            'signature' => $this->generateSignature($orderData),
        ]);

        try {
            $response = $this->client->post('/ECommerceWeb/Fawry/payments/charge', [
                'json' => $payload,
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            Log::error('Fawry API Error: ' . $e->getMessage());
            throw new \Exception('Failed to create payment: ' . $e->getMessage());
        }
    }

    private function generateSignature($data)
    {
        $stringToSign = $this->merchantCode . $data['merchantRefNumber'] . $data['customerProfileId'] . $data['amount'] . $this->secretKey;
        return hash('sha256', $stringToSign);
    }
}
