<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GymInfo;
use App\Models\GymZone;
use App\Models\PriceCategory;
use App\Models\PriceCategoryProperty;
use App\Models\PriceItem;
use App\Models\Trainer;
use App\Models\VisitorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    protected function checkAuth()
    {
        
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect()->route('login')->with('error', 'Доступ запрещен. Требуются права администратора.');
        }
        
        return null;
    }

    public function dashboard()
    {
        $check = $this->checkAuth();
        if ($check) return $check;

        $pendingRequests = VisitorRequest::pending()->count();
        $trainersCount = Trainer::count();
        $pricesCount = PriceItem::count();
        $categoriesCount = PriceCategory::count();

        return view('admin.dashboard', compact(
            'pendingRequests', 'trainersCount', 'pricesCount', 'categoriesCount'
        ));
    }

    
    
    

    public function trainers()
    {
        $check = $this->checkAuth();
        if ($check) return $check;
        
        $trainers = Trainer::ordered()->get();
        return view('admin.trainers.index', compact('trainers'));
    }

    public function createTrainer()
    {
        $check = $this->checkAuth();
        if ($check) return $check;
        
        return view('admin.trainers.create');
    }

    public function storeTrainer(Request $request)
    {
        $this->checkAuth();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specializations' => 'nullable|array',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'sports' => 'nullable|array',
            'experience_years' => 'required|integer|min:0',
            'quote' => 'nullable|string|max:500',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $ext = $file->getClientOriginalExtension();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $name = Str::slug($originalName);
            $filename = $name . '_' . time() . '.' . $ext;
            
            
            $path = $file->storeAs('trainers', $filename, 'public');
            
            
            $this->ensureFileAccessibility($path);
            
            $validated['photo'] = $path;
            
            \Log::info('Фото тренера сохранено:', [
                'original' => $file->getClientOriginalName(),
                'saved_as' => $filename,
                'path' => $path,
                'url' => asset('storage/' . $path)
            ]);
        }

        
        if ($request->has('specializations')) {
            $specializations = [];
            $inputSpecializations = $request->input('specializations', []);
            
            if (is_string($inputSpecializations) && !empty($inputSpecializations)) {
                $decoded = json_decode($inputSpecializations, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $inputSpecializations = $decoded;
                } else {
                    $inputSpecializations = [$inputSpecializations];
                }
            }
            
            foreach ((array) $inputSpecializations as $specialization) {
                if (is_string($specialization)) {
                    $trimmed = trim($specialization);
                    if (!empty($trimmed)) {
                        $specializations[] = $trimmed;
                    }
                }
            }
            $validated['specializations'] = !empty($specializations) ? json_encode($specializations, JSON_UNESCAPED_UNICODE) : null;
        } else {
            $validated['specializations'] = null;
        }

        
        if ($request->has('sports')) {
            $sports = [];
            $inputSports = $request->input('sports', []);
            
            if (is_string($inputSports) && !empty($inputSports)) {
                $decoded = json_decode($inputSports, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $inputSports = $decoded;
                } else {
                    $inputSports = [$inputSports];
                }
            }
            
            foreach ((array) $inputSports as $sport) {
                if (is_string($sport)) {
                    $trimmed = trim($sport);
                    if (!empty($trimmed)) {
                        $sports[] = $trimmed;
                    }
                }
            }
            $validated['sports'] = !empty($sports) ? json_encode($sports, JSON_UNESCAPED_UNICODE) : null;
        } else {
            $validated['sports'] = null;
        }

        $validated['is_active'] = $request->has('is_active') ? true : false;

        $trainer = Trainer::create($validated);

        return redirect()->route('admin.trainers')->with('success', 'Тренер добавлен');
    }

    public function editTrainer($id)
    {
        $this->checkAuth();
        $trainer = Trainer::findOrFail($id);

        
        $specializationsArray = [];
        if (!empty($trainer->specializations)) {
            
            if (is_array($trainer->specializations)) {
                $specializationsArray = $trainer->specializations;
            } 
            
            elseif (is_string($trainer->specializations)) {
                $decoded = json_decode($trainer->specializations, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $specializationsArray = $decoded;
                } else {
                    $specializationsArray = [$trainer->specializations];
                }
            }
        }
        $trainer->specializations_array = $specializationsArray;

        
        $sportsArray = [];
        if (!empty($trainer->sports)) {
            if (is_array($trainer->sports)) {
                $sportsArray = $trainer->sports;
            } 
            elseif (is_string($trainer->sports)) {
                $decoded = json_decode($trainer->sports, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $sportsArray = $decoded;
                } else {
                    $sportsArray = [$trainer->sports];
                }
            }
        }
        $trainer->sports_array = $sportsArray;

        return view('admin.trainers.edit', compact('trainer'));
    }

    public function updateTrainer(Request $request, $id)
    {
        $this->checkAuth();

        $trainer = Trainer::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specializations' => 'nullable|array',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'sports' => 'nullable|array',
            'experience_years' => 'required|integer|min:0',
            'quote' => 'nullable|string|max:500',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($trainer->photo) {
                Storage::disk('public')->delete($trainer->photo);
            }
            
            $file = $request->file('photo');
            $ext = $file->getClientOriginalExtension();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $name = Str::slug($originalName);
            $filename = $name . '_' . time() . '.' . $ext;
            
            $path = $file->storeAs('trainers', $filename, 'public');
            
            $this->ensureFileAccessibility($path);
            
            $validated['photo'] = $path;
        }

        
        if ($request->has('specializations')) {
            $specializations = [];
            $inputSpecializations = $request->input('specializations', []);
            
            if (is_string($inputSpecializations) && !empty($inputSpecializations)) {
                $decoded = json_decode($inputSpecializations, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $inputSpecializations = $decoded;
                } else {
                    $inputSpecializations = [$inputSpecializations];
                }
            }
            
            foreach ((array) $inputSpecializations as $specialization) {
                if (is_string($specialization)) {
                    $trimmed = trim($specialization);
                    if (!empty($trimmed)) {
                        $specializations[] = $trimmed;
                    }
                }
            }
            $validated['specializations'] = !empty($specializations) ? json_encode($specializations, JSON_UNESCAPED_UNICODE) : null;
        } else {
            $validated['specializations'] = null;
        }

        
        if ($request->has('sports')) {
            $sports = [];
            $inputSports = $request->input('sports', []);
            
            if (is_string($inputSports) && !empty($inputSports)) {
                $decoded = json_decode($inputSports, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $inputSports = $decoded;
                } else {
                    $inputSports = [$inputSports];
                }
            }
            
            foreach ((array) $inputSports as $sport) {
                if (is_string($sport)) {
                    $trimmed = trim($sport);
                    if (!empty($trimmed)) {
                        $sports[] = $trimmed;
                    }
                }
            }
            $validated['sports'] = !empty($sports) ? json_encode($sports, JSON_UNESCAPED_UNICODE) : null;
        } else {
            $validated['sports'] = null;
        }

        $validated['is_active'] = $request->has('is_active') ? true : false;

        $trainer->update($validated);

        return redirect()->route('admin.trainers')->with('success', 'Тренер обновлён');
    }

    public function deleteTrainer($id)
    {
        $this->checkAuth();

        $trainer = Trainer::findOrFail($id);

        if ($trainer->photo) {
            Storage::disk('public')->delete($trainer->photo);
        }

        $trainer->delete();

        return redirect()->route('admin.trainers')->with('success', 'Тренер удалён');
    }

    
    private function ensureFileAccessibility($path)
    {
        $storagePath = storage_path('app/public/' . $path);
        $publicPath = public_path('storage/' . $path);
        
        
        $publicDir = dirname($publicPath);
        if (!file_exists($publicDir)) {
            mkdir($publicDir, 0755, true);
        }
        
        
        if (!is_link($publicPath) && file_exists($storagePath) && !file_exists($publicPath)) {
            copy($storagePath, $publicPath);
            chmod($publicPath, 0644);
        }
    }

    
    
    

    public function pricesManagement()
    {
        $this->checkAuth();

        $categories = PriceCategory::with(['properties', 'items'])
            ->ordered()
            ->get();

        return view('admin.prices.management', compact('categories'));
    }

    public function savePriceManagement(Request $request)
    {
        $this->checkAuth();

        $data = $request->all();

        $saveCategory = $request->input('save_category');

        try {
            if (isset($data['delete_categories'])) {
                foreach ((array) $data['delete_categories'] as $catId) {
                    $category = PriceCategory::find($catId);
                    if ($category) $category->delete();
                }
            }

            if (isset($data['categories'])) {
                foreach ($data['categories'] as $categoryId => $categoryData) {
                    if ($saveCategory && $saveCategory != $categoryId) continue;

                    $propertyMap = [];

                    $isNewCategory = strpos($categoryId, 'new_') === 0;
                    if ($isNewCategory) {
                        $category = PriceCategory::create([
                            'name' => $categoryData['name'] ?? 'Новая категория',
                            'order' => $categoryData['order'] ?? 0,
                            'is_active' => isset($categoryData['is_active'])
                        ]);
                        $categoryId = $category->id;
                    } else {
                        $category = PriceCategory::find($categoryId);
                        if ($category) {
                            $category->update([
                                'name' => $categoryData['name'] ?? $category->name,
                                'order' => $categoryData['order'] ?? $category->order,
                                'is_active' => isset($categoryData['is_active'])
                            ]);
                        } else {
                            continue;
                        }
                    }

                    if (isset($categoryData['properties'])) {
                        foreach ($categoryData['properties'] as $propertyId => $propertyData) {
                            $isNewProperty = strpos($propertyId, 'new_') === 0;
                            if ($isNewProperty) {
                                $property = PriceCategoryProperty::create([
                                    'category_id' => $categoryId,
                                    'name' => $propertyData['name'] ?? 'Новое свойство',
                                    'values' => $propertyData['values'] ?? null,
                                    'order' => $propertyData['order'] ?? 0
                                ]);
                                $propertyMap[$propertyId] = $property->id;
                            } else {
                                $property = PriceCategoryProperty::find($propertyId);
                                if ($property && $property->category_id == $categoryId) {
                                    $property->update([
                                        'name' => $propertyData['name'] ?? $property->name,
                                        'values' => $propertyData['values'] ?? $property->values,
                                        'order' => $propertyData['order'] ?? $property->order
                                    ]);
                                    $propertyMap[$propertyId] = $propertyId;
                                }
                            }
                        }
                    }

                    if (isset($categoryData['delete_properties'])) {
                        foreach ((array) $categoryData['delete_properties'] as $propId) {
                            $property = PriceCategoryProperty::find($propId);
                            if ($property && $property->category_id == $categoryId) {
                                $property->delete();
                            }
                        }
                    }

                    if (isset($categoryData['items'])) {
                        foreach ($categoryData['items'] as $itemId => $itemData) {
                            $propertyValues = [];

                            foreach ($itemData as $key => $value) {
                                if (strpos($key, 'property_') === 0) {
                                    $propId = substr($key, 9);
                                    $realPropId = $propertyMap[$propId] ?? $propId;
                                    $property = PriceCategoryProperty::find($realPropId);
                                    if ($property && $property->category_id == $categoryId) {
                                        $propertyValues[$property->name] = $value;
                                    }
                                }
                            }

                            $isNewItem = strpos($itemId, 'new_') === 0;
                            if ($isNewItem) {
                                PriceItem::create([
                                    'category_id' => $categoryId,
                                    'name' => $itemData['name'] ?? 'Новый объект',
                                    'price' => $itemData['price'] ?? 0,
                                    'property_values' => !empty($propertyValues) ? $propertyValues : null,
                                    'order' => $itemData['order'] ?? 0
                                ]);
                            } else {
                                $item = PriceItem::find($itemId);
                                if ($item && $item->category_id == $categoryId) {
                                    $item->update([
                                        'name' => $itemData['name'] ?? $item->name,
                                        'price' => $itemData['price'] ?? $item->price,
                                        'property_values' => !empty($propertyValues) ? $propertyValues : null,
                                        'order' => $itemData['order'] ?? $item->order
                                    ]);
                                }
                            }
                        }
                    }

                    if (isset($categoryData['delete_items'])) {
                        foreach ((array) $categoryData['delete_items'] as $itemId) {
                            $item = PriceItem::find($itemId);
                            if ($item && $item->category_id == $categoryId) {
                                $item->delete();
                            }
                        }
                    }
                }
            }

            return redirect()->route('admin.prices.management')
                ->with('success', 'Все изменения сохранены');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ошибка при сохранении: ' . $e->getMessage());
        }
    }

    public function deletePriceItem($id)
    {
        $this->checkAuth();

        $item = PriceItem::findOrFail($id);
        $item->delete();

        return response()->json(['success' => true]);
    }

    public function deletePriceProperty($id)
    {
        $this->checkAuth();

        $property = PriceCategoryProperty::findOrFail($id);
        $property->delete();

        return response()->json(['success' => true]);
    }

    public function deletePriceCategory($id)
    {
        $this->checkAuth();

        $category = PriceCategory::findOrFail($id);
        $category->delete();

        return response()->json(['success' => true]);
    }

    
    
    

    public function priceCategories()
    {
        $this->checkAuth();
        $categories = PriceCategory::withCount(['properties', 'items'])->ordered()->get();
        return view('admin.prices.categories.index', compact('categories'));
    }

    public function createPriceCategory()
    {
        $this->checkAuth();
        return view('admin.prices.categories.create');
    }

    public function storePriceCategory(Request $request)
    {
        $this->checkAuth();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        PriceCategory::create($validated);

        return redirect()->route('admin.prices.categories')->with('success', 'Категория добавлена');
    }

    public function editPriceCategory($id)
    {
        $this->checkAuth();
        $category = PriceCategory::findOrFail($id);
        return view('admin.prices.categories.edit', compact('category'));
    }

    public function updatePriceCategory(Request $request, $id)
    {
        $this->checkAuth();

        $category = PriceCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $category->update($validated);

        return redirect()->route('admin.prices.categories')->with('success', 'Категория обновлена');
    }

    
    
    

    public function categoryProperties($categoryId)
    {
        $this->checkAuth();
        $category = PriceCategory::findOrFail($categoryId);
        $properties = $category->properties()->ordered()->get();
        return view('admin.prices.properties.index', compact('category', 'properties'));
    }

    public function createCategoryProperty($categoryId)
    {
        $this->checkAuth();
        $category = PriceCategory::findOrFail($categoryId);
        return view('admin.prices.properties.create', compact('category'));
    }

    public function storeCategoryProperty(Request $request, $categoryId)
    {
        $this->checkAuth();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'values' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        if (!empty($validated['values'])) {
            $valuesArray = array_map('trim', explode(',', $validated['values']));
            $validated['values'] = implode(',', $valuesArray);
        }

        $validated['category_id'] = $categoryId;

        PriceCategoryProperty::create($validated);

        return redirect()->route('admin.prices.properties', $categoryId)->with('success', 'Свойство добавлено');
    }

    public function editCategoryProperty($id)
    {
        $this->checkAuth();
        $property = PriceCategoryProperty::with('category')->findOrFail($id);
        return view('admin.prices.properties.edit', compact('property'));
    }

    public function updateCategoryProperty(Request $request, $id)
    {
        $this->checkAuth();

        $property = PriceCategoryProperty::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'values' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        if (!empty($validated['values'])) {
            $valuesArray = array_map('trim', explode(',', $validated['values']));
            $validated['values'] = implode(',', $valuesArray);
        }

        $property->update($validated);

        return redirect()->route('admin.prices.properties', $property->category_id)->with('success', 'Свойство обновлено');
    }

    
    
    

    public function priceItems($categoryId = null)
    {
        $this->checkAuth();

        $query = PriceItem::with('category');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $items = $query->ordered()->get();
        $categories = PriceCategory::ordered()->get();
        $selectedCategory = $categoryId ? PriceCategory::with('properties')->find($categoryId) : null;

        return view('admin.prices.items.index', compact('items', 'categories', 'selectedCategory'));
    }

    public function createPriceItem($categoryId = null)
    {
        $this->checkAuth();

        $categories = PriceCategory::active()->ordered()->get();
        $selectedCategory = $categoryId ? PriceCategory::with('properties')->find($categoryId) : null;

        return view('admin.prices.items.create', compact('categories', 'selectedCategory'));
    }

    public function storePriceItem(Request $request)
    {
        $this->checkAuth();

        $validated = $request->validate([
            'category_id' => 'required|exists:price_categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'has_discount' => 'boolean',
            'is_popular' => 'boolean',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $category = PriceCategory::with('properties')->find($validated['category_id']);
        $propertyValues = [];

        if ($category->properties->count() > 0) {
            foreach ($category->properties as $property) {
                $value = $request->input('property_' . $property->id);
                if ($value !== null) {
                    $propertyValues[$property->name] = $value;
                }
            }
        }

        $validated['property_values'] = !empty($propertyValues) ? $propertyValues : null;

        PriceItem::create($validated);

        return redirect()->route('admin.prices.items.category', ['category' => $validated['category_id']])
            ->with('success', 'Объект добавлен');
    }

    public function editPriceItem($id)
    {
        $this->checkAuth();

        $item = PriceItem::with('category.properties')->findOrFail($id);
        $categories = PriceCategory::active()->ordered()->get();

        return view('admin.prices.items.edit', compact('item', 'categories'));
    }

    public function updatePriceItem(Request $request, $id)
    {
        $this->checkAuth();

        $item = PriceItem::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:price_categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'has_discount' => 'boolean',
            'is_popular' => 'boolean',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $category = PriceCategory::with('properties')->find($validated['category_id']);
        $propertyValues = [];

        if ($category->properties->count() > 0) {
            foreach ($category->properties as $property) {
                $value = $request->input('property_' . $property->id);
                if ($value !== null) {
                    $propertyValues[$property->name] = $value;
                }
            }
        }

        $validated['property_values'] = !empty($propertyValues) ? $propertyValues : null;

        $item->update($validated);

        return redirect()->route('admin.prices.items.category', ['category' => $validated['category_id']])
            ->with('success', 'Объект обновлён');
    }

    
    
    

    public function requests()
    {
        $this->checkAuth();

        $requests = VisitorRequest::latest()->paginate(20);
        return view('admin.requests.index', compact('requests'));
    }

    public function processRequest($id)
    {
        $this->checkAuth();

        $requestItem = VisitorRequest::findOrFail($id);
        $requestItem->markAsProcessed();

        return back()->with('success', 'Заявка отмечена как обработанная');
    }

    
    
    

    public function settings()
    {
        $this->checkAuth();

        $settings = GymInfo::all()->keyBy('key');
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $this->checkAuth();

        $settings = $request->input('settings', []);

        foreach ($settings as $key => $value) {
            GymInfo::setValue($key, $value);
        }

        return back()->with('success', 'Настройки обновлены');
    }

    
    
    

    public function gymLayout()
    {
        $this->checkAuth();

        $zones = GymZone::ordered()->get();

        return view('admin.layout.index', compact('zones'));
    }

    public function createZone()
    {
        $this->checkAuth();

        $existingZones = GymZone::ordered()->get();

        return view('admin.layout.create', compact('existingZones'));
    }

    public function storeZone(Request $request)
    {
        $this->checkAuth();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'color' => 'nullable|string|max:7',
            'width_m' => 'required|numeric|min:0.1|max:48',
            'height_m' => 'required|numeric|min:0.1|max:19.2',
            'grid_x' => 'required|integer|min:0|max:59',
            'grid_y' => 'required|integer|min:0|max:23',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['width'] = max(1, ceil($validated['width_m'] / 0.8));
        $validated['height'] = max(1, ceil($validated['height_m'] / 0.8));

        unset($validated['width_m']);
        unset($validated['height_m']);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $ext = $file->getClientOriginalExtension();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $name = Str::slug($originalName);
            $filename = $name . '_' . time() . '.' . $ext;
            
            $path = $file->storeAs('gym_zones', $filename, 'public');
            
            $this->ensureFileAccessibility($path);
            
            $validated['image'] = $path;
        }

        if (empty($validated['color'])) {
            $validated['color'] = '#FFD700';
        }

        GymZone::create($validated);

        return redirect()->route('admin.layout')->with('success', 'Зона добавлена');
    }

    public function editZone($id)
    {
        $this->checkAuth();

        $zone = GymZone::findOrFail($id);

        $existingZones = GymZone::ordered()->get();

        $zone->width_m = $zone->width * 0.8;
        $zone->height_m = $zone->height * 0.8;

        return view('admin.layout.edit', compact('zone', 'existingZones'));
    }

    public function updateZone(Request $request, $id)
    {
        $this->checkAuth();

        $zone = GymZone::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'color' => 'nullable|string|max:7',
            'width_m' => 'required|numeric|min:0.1|max:48',
            'height_m' => 'required|numeric|min:0.1|max:19.2',
            'grid_x' => 'required|integer|min:0|max:59',
            'grid_y' => 'required|integer|min:0|max:23',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['width'] = max(1, ceil($validated['width_m'] / 0.8));
        $validated['height'] = max(1, ceil($validated['height_m'] / 0.8));

        unset($validated['width_m']);
        unset($validated['height_m']);

        if ($request->hasFile('photo')) {
            if ($zone->image) {
                Storage::disk('public')->delete($zone->image);
            }
            
            $file = $request->file('photo');
            $ext = $file->getClientOriginalExtension();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $name = Str::slug($originalName);
            $filename = $name . '_' . time() . '.' . $ext;
            
            $path = $file->storeAs('gym_zones', $filename, 'public');
            
            $this->ensureFileAccessibility($path);
            
            $validated['image'] = $path;
        }

        if (empty($validated['color'])) {
            $validated['color'] = '#FFD700';
        }

        $zone->update($validated);

        return redirect()->route('admin.layout')->with('success', 'Зона обновлена');
    }

    public function deleteZone($id)
    {
        $this->checkAuth();

        $zone = GymZone::findOrFail($id);

        if ($zone->image) {
            Storage::disk('public')->delete($zone->image);
        }

        $zone->delete();

        return redirect()->route('admin.layout')->with('success', 'Зона удалена');
    }

    public function saveLayoutPositions(Request $request)
    {
        $this->checkAuth();

        $validated = $request->validate([
            'zones' => 'required|array',
            'zones.*.x' => 'required|integer|min:0',
            'zones.*.y' => 'required|integer|min:0',
            'zones.*.w' => 'required|integer|min:1',
            'zones.*.h' => 'required|integer|min:1',
        ]);

        foreach ($validated['zones'] as $id => $data) {
            GymZone::where('id', $id)->update([
                'grid_x' => $data['x'],
                'grid_y' => $data['y'],
                'width' => $data['w'],
                'height' => $data['h'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Позиции сохранены'
        ]);
    }
}