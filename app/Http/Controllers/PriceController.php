<?php

namespace App\Http\Controllers;

use App\Models\PriceCategory;
use App\Models\PriceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PriceController extends Controller
{
    
    public function index()
    {
        $categories = PriceCategory::with(['items' => function($query) {
            $query->where('is_active', true)
                  ->orderBy('order')
                  ->orderBy('price');
        }])->where('is_active', true)
           ->orderBy('order')
           ->get();

        return view('pages.prices', compact('categories'));
    }

    
    public function management()
    {
        $categories = PriceCategory::with(['properties', 'items'])
            ->orderBy('order')
            ->get();

        return view('admin.prices.management', compact('categories'));
    }

    
    public function save(Request $request)
    {
        DB::beginTransaction();
        
        try {
            
            if ($request->has('categories')) {
                foreach ($request->categories as $categoryId => $categoryData) {
                    
                    if (str_starts_with($categoryId, 'new_')) {
                        $category = PriceCategory::create([
                            'name' => $categoryData['name'] ?? 'Новая категория',
                            'order' => $categoryData['order'] ?? 999,
                            'is_active' => $categoryData['is_active'] ?? true
                        ]);
                        
                        
                        $realCategoryId = $category->id;
                    } else {
                        
                        $category = PriceCategory::findOrFail($categoryId);
                        $category->update([
                            'name' => $categoryData['name'] ?? $category->name,
                            'order' => $categoryData['order'] ?? $category->order,
                            'is_active' => $categoryData['is_active'] ?? $category->is_active
                        ]);
                        $realCategoryId = $categoryId;
                    }

                    
                    if (isset($categoryData['properties'])) {
                        foreach ($categoryData['properties'] as $propertyId => $propertyData) {
                            if (str_starts_with($propertyId, 'new_prop_')) {
                                
                                $category->properties()->create([
                                    'name' => $propertyData['name'] ?? 'Новое свойство',
                                    'order' => $propertyData['order'] ?? 999
                                ]);
                            } else {
                                
                                $property = $category->properties()->find($propertyId);
                                if ($property) {
                                    $property->update([
                                        'name' => $propertyData['name'] ?? $property->name,
                                        'order' => $propertyData['order'] ?? $property->order
                                    ]);
                                }
                            }
                        }
                    }

                    
                    if (isset($categoryData['items'])) {
                        foreach ($categoryData['items'] as $itemId => $itemData) {
                            
                            $propertyValues = [];
                            foreach ($itemData as $key => $value) {
                                if (str_starts_with($key, 'property_')) {
                                    $propId = str_replace('property_', '', $key);
                                    $property = $category->properties()->find($propId);
                                    if ($property) {
                                        $propertyValues[$property->name] = $value;
                                    }
                                }
                            }

                            
                            $price = isset($itemData['price']) ? floatval($itemData['price']) : 0;

                            if (str_starts_with($itemId, 'new_item_')) {
                                
                                $category->items()->create([
                                    'name' => $itemData['name'] ?? 'Новый объект',
                                    'price' => $price,
                                    'property_values' => $propertyValues,
                                    'has_discount' => $itemData['has_discount'] ?? false,
                                    'is_popular' => $itemData['is_popular'] ?? false,
                                    'is_active' => $itemData['is_active'] ?? true,
                                    'order' => $itemData['order'] ?? 999
                                ]);
                            } else {
                                
                                $item = $category->items()->find($itemId);
                                if ($item) {
                                    $item->update([
                                        'name' => $itemData['name'] ?? $item->name,
                                        'price' => $price,
                                        'property_values' => $propertyValues,
                                        'has_discount' => $itemData['has_discount'] ?? $item->has_discount,
                                        'is_popular' => $itemData['is_popular'] ?? $item->is_popular,
                                        'is_active' => $itemData['is_active'] ?? $item->is_active,
                                        'order' => $itemData['order'] ?? $item->order
                                    ]);
                                }
                            }
                        }
                    }

                    
                    if (isset($categoryData['delete_properties'])) {
                        $category->properties()->whereIn('id', $categoryData['delete_properties'])->delete();
                    }

                    
                    if (isset($categoryData['delete_items'])) {
                        $category->items()->whereIn('id', $categoryData['delete_items'])->delete();
                    }
                }
            }

            
            if ($request->has('delete_categories')) {
                PriceCategory::whereIn('id', $request->delete_categories)->delete();
            }

            DB::commit();
            
            return redirect()->route('admin.prices.management')
                ->with('success', 'Изменения успешно сохранены');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Ошибка сохранения цен: ' . $e->getMessage());
            
            return redirect()->route('admin.prices.management')
                ->with('error', 'Произошла ошибка при сохранении: ' . $e->getMessage());
        }
    }
}