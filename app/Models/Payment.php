<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public static function authorization()
    {
        return Http::withHeaders([
            'Authorization' => env('PAGSEGURO_APP_TOKEN'),
            'x-api-version' => '4.0'
        ]);
    }

    public static function createDataCC($request, $order)
    {
        return [
            'reference_id' => $order->id,
            'description' => "O numéro do pedido é " . $order->id,
            'amount' => [
                'value' => removePointDecimal($order->total),
                'currency' => 'BRL'
            ],
            'payment_method' => [
                'type' => $request->payment_method,
                'installments' => $request->installments,
                'capture' => true,
                'soft_descriptor' => "wCastro ecommerce",
                'card' => [
                    'number' => removeAllSpaces($request->number),
                    'exp_month' => $request->exp_month,
                    'exp_year' =>  $request->exp_year,
                    'security_code' => $request->security_code,
                    'holder' => [
                        'name' => strtoupper($request->card_name)
                    ]
                ]
            ],
            'notification_urls' => [
                'https://yourserver.com/nas_ecommerce/277be731-3b7c-4dac-8c4e-4c3f4a1fdc46/'
            ],
            'metadata' => [
                'customer_id' => $order->customer_id,
                'created_at' => $order->created_at
            ]
        ];
    }

    public static function paymentCreditCard($data)
    {
        $pagSeguro = self::authorization();

        return $pagSeguro->post('https://sandbox.api.pagseguro.com/charges', $data)->json();
    }
    
    public static function paymentBankSlip()
    {
        //
    }
}
