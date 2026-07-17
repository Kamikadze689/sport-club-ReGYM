<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\PriceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    
    public function showPlans()
    {
        return redirect()->route('prices');
    }
    
    
    public function createPayment(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:price_items,id',
            'price_type' => 'required|in:day,full,personal,group,student,youth,adult'
        ]);
        
        $item = PriceItem::findOrFail($request->item_id);
        $category = $item->category;
        
        
        $priceColumn = 'price_' . $request->price_type;
        $price = $item->$priceColumn ?? 0;
        
        if ($price == 0) {
            return back()->with('error', 'Цена для выбранного типа не найдена');
        }
        
        $priceTypeNames = [
            'day' => 'Дневной (7:00-16:00)',
            'full' => 'Полный день (7:00-23:00)',
            'personal' => 'Персональная',
            'group' => 'Групповая',
            'student' => 'Студенческий',
            'youth' => 'До 18 лет',
            'adult' => 'От 24 лет',
        ];
        
        $priceTypeName = $priceTypeNames[$request->price_type] ?? $request->price_type;
        $itemName = $item->name . ' (' . $priceTypeName . ')';
        
        $months = $this->getMonthsFromItemName($item->name);
        
        $subscription = Subscription::create([
            'user_id' => Auth::id(),
            'type' => $itemName,
            'category_name' => $category->name,
            'duration_months' => $months,
            'price' => $price,
            'status' => 'pending',
            'payment_status' => 'pending',
            'payment_id' => 'PAY_' . uniqid() . '_' . time(),
            'purchased_at' => now(),
            'expires_at' => $months > 0 ? now()->addMonths($months) : now()->addDays(30),
        ]);
        
        return redirect()->route('payment.process', $subscription->id);
    }
    
    
    public function processPayment($subscriptionId)
    {
        $subscription = Subscription::findOrFail($subscriptionId);
        
        if ($subscription->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('user.payment', compact('subscription'));
    }
    
    
    public function paymentSuccess(Request $request, $subscriptionId)
    {
        $subscription = Subscription::findOrFail($subscriptionId);
        
        if ($subscription->user_id !== Auth::id()) {
            abort(403);
        }
        
        $subscription->update([
            'status' => 'active',
            'payment_status' => 'paid',
        ]);
        
        
        $subscription->qr_code = $this->generateQrCode($subscription);
        $subscription->save();
        
        return redirect()->route('user.dashboard')
            ->with('success', 'Оплата успешно проведена! Ваш абонемент активирован.');
    }
    
    public function paymentCancel()
    {
        return redirect()->route('prices')->with('error', 'Оплата была отменена.');
    }
    
    
    private function generateQrCode($subscription)
    {
        $data = json_encode([
            'subscription_id' => $subscription->id,
            'user_name' => $subscription->user->name,
            'user_phone' => $subscription->user->phone,
            'type' => $subscription->type,
            'expires_at' => $subscription->expires_at->format('d.m.Y H:i'),
            'purchased_at' => $subscription->purchased_at->format('d.m.Y H:i'),
            'price' => $subscription->price,
        ]);
        
        return 'https://quickchart.io/qr?text=' . urlencode($data) . '&size=300&margin=2';
    }
    
    private function getMonthsFromItemName($name)
    {
        $name = mb_strtolower($name);
        if (str_contains($name, 'год') || str_contains($name, '12')) return 12;
        if (str_contains($name, '6 месяц') || str_contains($name, '6 months')) return 6;
        if (str_contains($name, '3 месяц') || str_contains($name, '3 months')) return 3;
        if (str_contains($name, '1 месяц') || str_contains($name, 'месяц') || str_contains($name, 'month')) return 1;
        if (str_contains($name, 'пробн')) return 0;
        if (str_contains($name, 'разов')) return 0;
        if (str_contains($name, 'тренировок')) return 1;
        return 1;
    }
    
    
    public function showQrCode($subscriptionId)
    {
        $subscription = Subscription::findOrFail($subscriptionId);
        
        if ($subscription->user_id !== Auth::id()) {
            abort(403);
        }
        
        $isActive = $subscription->status === 'active' && $subscription->expires_at > now();
        
        if (!$isActive) {
            return redirect()->route('user.dashboard')->with('error', 'Абонемент неактивен или истек.');
        }
        
        return view('user.qr_code', compact('subscription'));
    }
}