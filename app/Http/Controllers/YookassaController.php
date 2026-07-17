<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use YooKassa\Client;

class YookassaController extends Controller
{
    private function getClient()
    {
        $client = new Client();
        $client->setAuth(config('services.yookassa.shop_id', env('YOOKASSA_SHOP_ID')), config('services.yookassa.secret_key', env('YOOKASSA_SECRET_KEY')));
        return $client;
    }

    
    public function createPayment(Request $request)
    {
        $subscription = Subscription::findOrFail($request->subscription_id);
        
        if ($subscription->user_id !== Auth::id()) {
            abort(403);
        }

        $client = $this->getClient();

        try {
            $payment = $client->createPayment(
                array(
                    'amount' => array(
                        'value' => number_format($subscription->price, 2, '.', ''),
                        'currency' => 'RUB',
                    ),
                    'receipt' => array(
                        'customer' => array(
                            'email' => Auth::user()->email ?? 'test@example.com',
                        ),
                        'items' => array(
                            array(
                                'description' => mb_substr('Абонемент: ' . $subscription->type, 0, 128),
                                'quantity' => '1.00',
                                'amount' => array(
                                    'value' => number_format($subscription->price, 2, '.', ''),
                                    'currency' => 'RUB'
                                ),
                                'vat_code' => 1, 
                                'payment_mode' => 'full_prepayment',
                                'payment_subject' => 'service'
                            )
                        )
                    ),
                    'confirmation' => array(
                        'type' => 'redirect',
                        'return_url' => route('yookassa.callback', ['subscription_id' => $subscription->id]),
                    ),
                    'capture' => true,
                    'description' => 'Оплата абонемента: ' . $subscription->type,
                    'metadata' => array(
                        'subscription_id' => $subscription->id,
                    )
                ),
                uniqid('', true)
            );

            
            $subscription->update([
                'payment_id' => $payment->getId(),
            ]);

            return redirect($payment->getConfirmation()->getConfirmationUrl());

        } catch (\Exception $e) {
            \Log::error('Yookassa Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            
            dd("Ошибка ЮKassa: " . $e->getMessage() . " | Проверьте доступы в .env");
        }
    }

    
    public function callback(Request $request)
    {
        $subscriptionId = $request->query('subscription_id');
        
        if (!$subscriptionId) {
            return redirect()->route('user.dashboard')->with('error', 'Абонемент не найден.');
        }

        $subscription = Subscription::findOrFail($subscriptionId);

        if ($subscription->user_id !== Auth::id()) {
            abort(403);
        }

        
        if ($subscription->status === 'active' && $subscription->payment_status === 'paid') {
            return redirect()->route('user.dashboard')->with('success', 'Абонемент успешно активирован.');
        }

        $client = $this->getClient();

        try {
            
            $payment = $client->getPaymentInfo($subscription->payment_id);

            if ($payment->getStatus() === 'succeeded') {
                
                $subscription->update([
                    'status' => 'active',
                    'payment_status' => 'paid',
                ]);
                
                
                $subscription->qr_code = $this->generateQrCode($subscription);
                $subscription->save();
                
                return redirect()->route('user.dashboard')
                    ->with('success', 'Оплата прошла успешно! Ваш абонемент активирован.');
            } else {
                return redirect()->route('user.dashboard')
                    ->with('error', 'Платеж еще не прошел или был отменен (статус: ' . $payment->getStatus() . ').');
            }

        } catch (\Exception $e) {
            return redirect()->route('user.dashboard')->with('error', 'Ошибка проверки платежа: ' . $e->getMessage());
        }
    }

    private function generateQrCode($subscription)
    {
        $data = json_encode([
            'subscription_id' => $subscription->id,
            'user_name' => $subscription->user->name,
            'user_phone' => $subscription->user->phone,
            'type' => $subscription->type,
            'expires_at' => $subscription->expires_at->format('d.m.Y H:i'),
            'price' => $subscription->price,
        ]);
        
        return 'https://quickchart.io/qr?text=' . urlencode($data) . '&size=300&margin=2';
    }
}