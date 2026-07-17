<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\PriceCategory;
use App\Models\PriceItem;
use App\Models\GymInfo;
use App\Models\GymZone;
use App\Models\VisitorRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $trainers = Trainer::active()->ordered()->limit(8)->get();
        $popularItems = PriceItem::popular()->active()->ordered()->limit(4)->get();
        $zones = GymZone::active()->ordered()->get();
        $categories = PriceCategory::with(['properties', 'items' => function($query) {
            $query->active()->ordered();
        }])->active()->ordered()->limit(3)->get();

        $gymStats = [
            'days_per_week' => GymInfo::getValue('days_per_week', '7'),
            'area' => GymInfo::getValue('area_m2', '1000+'),
            'equipment_count' => GymInfo::getValue('equipment_count', '100+'),
            'sports_nutrition_bar' => GymInfo::getValue('has_sports_nutrition', 'Да'),
            'gift_certificates' => GymInfo::getValue('has_gift_certificates', 'Да'),
        ];

        return view('home', compact('trainers', 'popularItems', 'zones', 'categories', 'gymStats'));
    }

    public function prices()
    {
        $categories = PriceCategory::with(['properties', 'items' => function($query) {
            $query->active()->ordered();
        }])->active()->ordered()->get();

        $discountInfo = GymInfo::getValue('discount_info', 'Скидка 10%: Школьникам, студентам, пенсионерам, мастерам спорта');
        
        return view('prices', compact('categories', 'discountInfo'));
    }

    public function trainers()
    {
        $trainers = Trainer::active()->ordered()->get();
        return view('trainers', compact('trainers'));
    }

    public function trainer($id)
    {
        $trainer = Trainer::active()->findOrFail($id);
        return view('trainer', compact('trainer'));
    }

    public function gymLayout()
    {
        $zones = GymZone::active()->ordered()->get();
        $zoneTypes = GymZone::getZoneTypes();
        
        return view('gym-layout', compact('zones', 'zoneTypes'));
    }

    public function storeRequest(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'request_type' => 'required|string',
            'message' => 'nullable|string',
            'trainer_id' => 'nullable|exists:trainers,id',
            'price_item_id' => 'nullable|exists:price_items,id',
            'goal' => 'nullable|string',
            'training_type' => 'nullable|string'
        ]);

        
        $messageParts = [];
        
        
        if (!empty($validated['trainer_id'])) {
            $trainer = Trainer::find($validated['trainer_id']);
            if ($trainer) {
                $messageParts[] = "Тренер: " . $trainer->name;
            }
        }
        
        
        if (!empty($validated['price_item_id'])) {
            $item = PriceItem::with('category')->find($validated['price_item_id']);
            if ($item) {
                $messageParts[] = "Тариф: " . $item->category->name . " - " . $item->name;
                $messageParts[] = "Цена: " . number_format($item->price, 0, ',', ' ') . " ₽";
            }
        }
        
        
        if (!empty($validated['goal'])) {
            $messageParts[] = "Цель: " . $validated['goal'];
        }
        
        
        if (!empty($validated['training_type'])) {
            $messageParts[] = "Тип тренировки: " . $validated['training_type'];
        }
        
        
        if (!empty($validated['message'])) {
            $messageParts[] = "\n" . $validated['message'];
        }
        
        
        $validated['message'] = implode("\n", $messageParts);

        
        VisitorRequest::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.'
        ]);
    }
}