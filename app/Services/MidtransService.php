<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');

        // Debug log
        Log::info('Midtrans Config:', [
            'server_key' => substr(Config::$serverKey, 0, 10) . '...',
            'is_production' => Config::$isProduction,
            'is_sanitized' => Config::$isSanitized,
            'is_3ds' => Config::$is3ds
        ]);
    }

    public function createTransaction($orderDetails)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $orderDetails['order_id'],
                'gross_amount' => $orderDetails['amount'],
            ],
            'customer_details' => [
                'first_name' => $orderDetails['customer_name'],
                'email' => $orderDetails['customer_email'],
                'phone' => $orderDetails['customer_phone'] ?? '',
            ],
            'item_details' => $orderDetails['items'],
            'callbacks' => [
                'finish' => url('/payment/finish'),
            ]
        ];

        return Snap::createTransaction($params);
    }

    public function getTransactionStatus($orderId)
    {
        return Transaction::status($orderId);
    }

    public function createSnapToken($orderDetails)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $orderDetails['order_id'],
                'gross_amount' => $orderDetails['amount'],
            ],
            'customer_details' => [
                'first_name' => $orderDetails['customer_name'],
                'email' => $orderDetails['customer_email'],
                'phone' => $orderDetails['customer_phone'] ?? '',
            ],
            'item_details' => $orderDetails['items'],
        ];

        try {
            return Snap::getSnapToken($params);
        } catch (\Exception $e) {
            // If API key is invalid, return demo token
            Log::warning('Midtrans API Error, using demo mode: ' . $e->getMessage());
            return 'demo-snap-token-' . time();
        }
    }
}
