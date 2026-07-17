@extends('admin.layout')

@section('title', 'Управление ценами')

@section('content')
<style>
    .management-container {
        padding: 30px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .management-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .management-header h1 {
        color: #000;
        font-size: 28px;
        font-weight: 600;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }

    .btn-success {
        background: #FFD700;
        color: #000;
    }

    .btn-success:hover {
        background: #ffed4a;
    }

    .btn-danger {
        background: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background: #c82333;
    }

    .btn-primary {
        background: #000;
        color: #fff;
    }

    .btn-primary:hover {
        background: #222;
    }

    .category-card {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 8px;
        margin-bottom: 20px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    }

    .category-header {
        background: #000;
        color: #fff;
        padding: 16px 20px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 500;
        transition: background 0.2s;
    }

    .category-header:hover {
        background: #222;
    }

    .category-header .left {
        display: flex;
        align-items: center;
        gap: 15px;
        flex: 1;
    }

    .category-name-input {
        background: rgba(255,255,255,0.15);
        border: none;
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 17px;
        width: 60%;
        min-width: 200px;
    }

    .category-name-input:focus {
        outline: none;
        background: rgba(255,255,255,0.25);
    }

    .category-toggle {
        font-size: 22px;
        transition: transform 0.3s;
    }

    .category-header.collapsed .category-toggle {
        transform: rotate(-90deg);
    }

    .category-content {
        padding: 20px;
        display: none;
    }

    .category-content.open {
        display: block;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 25px 0 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #000;
    }

    .add-btn {
        background: #000;
        color: #fff;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
    }

    .add-btn:hover {
        background: #222;
    }

    .properties-grid, .objects-grid {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .property-row {
        display: flex;
        gap: 15px;
        padding: 12px;
        background: #f9f9f9;
        border-radius: 6px;
        align-items: center;
        cursor: move;
    }

    .property-name-input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 15px;
    }

    .delete-btn {
        background: #dc3545;
        color: white;
        width: 36px;
        height: 36px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .object-row {
        display: flex;
        gap: 15px;
        padding: 16px;
        background: #f9f9f9;
        border-radius: 6px;
        align-items: flex-start;
        cursor: move;
    }

    .object-main {
        flex: 0 0 300px;
    }

    .object-name-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 500;
    }

    .object-properties {
        flex: 1;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 16px;
    }

    .property-field {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .object-main p {
        font-size: 13px;
        color: #555;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .property-field label {
        font-size: 13px;
        color: #555;
        font-weight: 500;
    }

    .property-field input {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
    }

    .object-actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
        min-width: 140px;
    }

    .empty-state {
        padding: 40px;
        text-align: center;
        color: #777;
        background: #f9f9f9;
        border-radius: 8px;
        border: 1px dashed #ddd;
    }

    .sortable-ghost {
        opacity: 0.4;
        background: #f0f0f0;
    }

    .sortable-chosen {
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
</style>

<div class="management-container">
    <div class="management-header">
        <h1>Управление ценами</h1>
        <div>
            <button type="button" class="btn btn-success" id="add-new-category">+ Создать категорию</button>
            <button type="submit" form="price-form" class="btn btn-primary">Сохранить все изменения</button>
        </div>
    </div>

    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding:15px; border-radius:6px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background:#f8d7da; color:#721c24; padding:15px; border-radius:6px; margin-bottom:20px;">
            {{ session('error') }}
        </div>
    @endif

    <form id="price-form" method="POST" action="{{ route('admin.prices.management.save') }}">
        @csrf

        <div id="categories-container">
            @forelse($categories as $category)
                <div class="category-card" data-category-id="{{ $category->id }}">
                    <div class="category-header collapsed" onclick="toggleCategory(event, this)">
                        <div class="left">
                            <input type="text" 
                                   name="categories[{{ $category->id }}][name]" 
                                   value="{{ old('categories.' . $category->id . '.name', $category->name) }}" 
                                   class="category-name-input" 
                                   placeholder="Название категории" required>
                        </div>

                        <div style="display: flex; align-items: center; gap: 15px;">
                            <button type="button" class="btn btn-danger delete-category-btn">Удалить категорию</button>
                            <div class="category-toggle">›</div>
                        </div>
                    </div>

                    <div class="category-content">
                        <input type="hidden" name="categories[{{ $category->id }}][is_active]" value="1">
                        <input type="hidden" name="categories[{{ $category->id }}][order]" class="sort-order" value="{{ $category->order }}">

                        
                        <div class="section">
                            <div class="section-header">
                                <h3 class="section-title">Свойства</h3>
                                <button type="button" class="add-btn add-property-btn" data-category-id="{{ $category->id }}">+ Добавить свойство</button>
                            </div>

                            <div class="properties-grid sortable-properties" data-category-id="{{ $category->id }}">
                                @forelse($category->properties as $property)
                                    <div class="property-row" data-property-id="{{ $property->id }}">
                                        <input type="text" 
                                               name="categories[{{ $category->id }}][properties][{{ $property->id }}][name]" 
                                               value="{{ old('categories.' . $category->id . '.properties.' . $property->id . '.name', $property->name) }}" 
                                               class="property-name-input" 
                                               placeholder="Название свойства" required>

                                        <input type="hidden" 
                                               name="categories[{{ $category->id }}][properties][{{ $property->id }}][order]" 
                                               class="sort-order" 
                                               value="{{ $property->order }}">

                                        <button type="button" class="delete-btn delete-property-btn">×</button>
                                    </div>
                                @empty
                                    <div class="empty-state">Свойства не добавлены</div>
                                @endforelse
                            </div>
                        </div>

                        
                        <div class="section">
                            <div class="section-header">
                                <h3 class="section-title">Объекты</h3>
                                <button type="button" class="add-btn add-object-btn" data-category-id="{{ $category->id }}">+ Добавить объект</button>
                            </div>

                            <div class="objects-grid sortable-objects" data-category-id="{{ $category->id }}">
                                @forelse($category->items as $item)
                                    <div class="object-row" data-item-id="{{ $item->id }}">
                                        <div class="object-main">
                                            <p>Объект</p>
                                            <input type="text" 
                                                   name="categories[{{ $category->id }}][items][{{ $item->id }}][name]" 
                                                   value="{{ old('categories.' . $category->id . '.items.' . $item->id . '.name', $item->name) }}" 
                                                   class="object-name-input" 
                                                   placeholder="Название объекта" required>
                                        </div>

                                        <div class="object-properties">
                                            @foreach($category->properties as $prop)
                                                @php
                                                    $val = old("categories.{$category->id}.items.{$item->id}.property_{$prop->id}", $item->getPropertyValue($prop->name));
                                                @endphp
                                                <div class="property-field">
                                                    <label>{{ $prop->name }}</label>
                                                    <input type="text" 
                                                           name="categories[{{ $category->id }}][items][{{ $item->id }}][property_{{ $prop->id }}]" 
                                                           value="{{ $val }}">
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="object-actions">
                                            <input type="hidden" 
                                                   name="categories[{{ $category->id }}][items][{{ $item->id }}][order]" 
                                                   class="sort-order" 
                                                   value="{{ $item->order }}">

                                            <button type="button" class="delete-btn delete-object-btn">×</button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty-state">Объекты не добавлены</div>
                                @endforelse
                            </div>
                        </div>

                        <div style="margin-top: 20px; text-align: right;">
                            <button type="submit" name="save_category" value="{{ $category->id }}" class="btn btn-primary">
                                Сохранить категорию
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="padding: 60px; font-size: 18px;">
                    Категорий пока нет. Создайте первую.
                </div>
            @endforelse
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

<script>

function toggleCategory(e, header) {
    if (e.target.tagName === 'INPUT' || e.target.classList.contains('delete-category-btn')) {
        return;
    }
    const content = header.nextElementSibling;
    const isCollapsed = header.classList.toggle('collapsed');
    content.classList.toggle('open', !isCollapsed);
}


function updateAllOrders(container) {
    if (!container) return;
    const items = container.children;
    Array.from(items).forEach((item, index) => {
        const orderInput = item.querySelector('.sort-order');
        if (orderInput) {
            orderInput.value = index;
        }
    });
}


function initSortable(el, handle = null) {
    if (!el) return;
    new Sortable(el, {
        animation: 150,
        handle: handle,
        ghostClass: 'sortable-ghost',
        chosenClass: 'sortable-chosen',
        onEnd: (evt) => {
            updateAllOrders(evt.to);
            
            let parent = evt.to.parentElement.closest('.sortable-properties, .sortable-objects, #categories-container');
            while (parent) {
                updateAllOrders(parent);
                parent = parent.parentElement.closest('.sortable-properties, .sortable-objects, #categories-container');
            }
        },
        onSort: (evt) => {
            updateAllOrders(evt.to);
        }
    });
}


document.getElementById('price-form')?.addEventListener('submit', () => {
    updateAllOrders(document.getElementById('categories-container'));
    document.querySelectorAll('.sortable-properties, .sortable-objects').forEach(el => {
        updateAllOrders(el);
    });
});


document.getElementById('add-new-category')?.addEventListener('click', () => {
    const tempId = 'new_' + Date.now();

    
    let maxOrder = 0;
    document.querySelectorAll('#categories-container .category-card .sort-order').forEach(input => {
        const val = parseInt(input.value) || 0;
        if (val > maxOrder) maxOrder = val;
    });
    const newOrder = maxOrder + 1;

    const html = `
        <div class="category-card" data-category-id="${tempId}">
            <div class="category-header collapsed" onclick="toggleCategory(event, this)">
                <div class="left">
                    <input type="text" 
                           name="categories[${tempId}][name]" 
                           class="category-name-input" 
                           placeholder="Название категории" required value="Новая категория">
                </div>

                <div style="display: flex; align-items: center; gap: 15px;">
                    <button type="button" class="btn btn-danger delete-category-btn">Удалить категорию</button>
                    <div class="category-toggle">›</div>
                </div>
            </div>

            <div class="category-content">
                <input type="hidden" name="categories[${tempId}][is_active]" value="1">
                <input type="hidden" name="categories[${tempId}][order]" class="sort-order" value="${newOrder}">

                <div class="section">
                    <div class="section-header">
                        <h3 class="section-title">Свойства</h3>
                        <button type="button" class="add-btn add-property-btn" data-category-id="${tempId}">+ Добавить свойство</button>
                    </div>
                    <div class="properties-grid sortable-properties" data-category-id="${tempId}"></div>
                </div>

                <div class="section">
                    <div class="section-header">
                        <h3 class="section-title">Объекты / Тарифы</h3>
                        <button type="button" class="add-btn add-object-btn" data-category-id="${tempId}">+ Добавить объект</button>
                    </div>
                    <div class="objects-grid sortable-objects" data-category-id="${tempId}"></div>
                </div>

                <div style="margin-top: 20px; text-align: right;">
                    <button type="submit" name="save_category" value="${tempId}" class="btn btn-primary">
                        Сохранить категорию
                    </button>
                </div>
            </div>
        </div>
    `;

    document.getElementById('categories-container').insertAdjacentHTML('beforeend', html);

    const newCard = document.querySelector(`[data-category-id="${tempId}"]`);
    initSortable(newCard.querySelector('.properties-grid'));
    initSortable(newCard.querySelector('.objects-grid'));

    toggleCategory({target: newCard.querySelector('.category-header')}, newCard.querySelector('.category-header'));
});


document.addEventListener('click', e => {
    if (e.target.classList.contains('delete-category-btn')) {
        if (!confirm('Удалить категорию и всё её содержимое?')) return;

        const card = e.target.closest('.category-card');
        const catId = card.dataset.categoryId;

        if (!catId.startsWith('new_')) {
            document.getElementById('price-form').insertAdjacentHTML('beforeend', `
                <input type="hidden" name="delete_categories[]" value="${catId}">
            `);
        }

        card.remove();
        updateAllOrders(document.getElementById('categories-container'));
    }
});


document.addEventListener('click', e => {
    if (e.target.classList.contains('add-property-btn')) {
        const catId = e.target.dataset.categoryId;
        const grid = e.target.closest('.section').querySelector('.properties-grid');
        const tempId = 'new_prop_' + Date.now();

        const html = `
            <div class="property-row" data-property-id="${tempId}">
                <input type="text" 
                       name="categories[${catId}][properties][${tempId}][name]" 
                       class="property-name-input" 
                       placeholder="Название свойства" required>
                <input type="hidden" name="categories[${catId}][properties][${tempId}][order]" class="sort-order" value="999">
                <button type="button" class="delete-btn delete-property-btn">×</button>
            </div>
        `;

        grid.insertAdjacentHTML('beforeend', html);

        document.querySelectorAll(`[data-category-id="${catId}"] .object-row`).forEach(obj => {
            const itemId = obj.dataset.itemId;
            obj.querySelector('.object-properties').insertAdjacentHTML('beforeend', `
                <div class="property-field">
                    <label>Новое свойство</label>
                    <input type="text" name="categories[${catId}][items][${itemId}][property_${tempId}]">
                </div>
            `);
        });

        initSortable(grid);
        updateAllOrders(grid);
    }
});


document.addEventListener('click', e => {
    if (e.target.classList.contains('delete-property-btn')) {
        if (!confirm('Удалить свойство?')) return;

        const row = e.target.closest('.property-row');
        const propId = row.dataset.propertyId;
        const catId = row.closest('.category-card').dataset.categoryId;

        document.querySelectorAll(`[name*="property_${propId}"]`).forEach(el => el.closest('.property-field')?.remove());

        if (!propId.startsWith('new_')) {
            document.getElementById('price-form').insertAdjacentHTML('beforeend', `
                <input type="hidden" name="categories[${catId}][delete_properties][]" value="${propId}">
            `);
        }

        row.remove();
        updateAllOrders(row.parentElement);
    }
});


document.addEventListener('click', e => {
    if (e.target.classList.contains('add-object-btn')) {
        const catId = e.target.dataset.categoryId;
        const grid = e.target.closest('.section').querySelector('.objects-grid');
        const tempId = 'new_item_' + Date.now();

        let propsHtml = '';
        document.querySelectorAll(`[data-category-id="${catId}"] .property-row`).forEach(row => {
            const propId = row.dataset.propertyId;
            const name = row.querySelector('.property-name-input')?.value || 'Свойство';
            propsHtml += `
                <div class="property-field">
                    <label>${name}</label>
                    <input type="text" name="categories[${catId}][items][${tempId}][property_${propId}]">
                </div>
            `;
        });

        const html = `
            <div class="object-row" data-item-id="${tempId}">
                <div class="object-main">
                    <p>Объект</p> 
                    <input type="text" 
                           name="categories[${catId}][items][${tempId}][name]" 
                           class="object-name-input" 
                           placeholder="Название объекта" required>
                </div>
                <div class="object-properties">${propsHtml || '<div class="empty-state">Нет свойств</div>'}</div>
                <div class="object-actions">
                    <input type="hidden" name="categories[${catId}][items][${tempId}][order]" class="sort-order" value="999">
                    <button type="button" class="delete-btn delete-object-btn">×</button>
                </div>
            </div>
        `;

        grid.insertAdjacentHTML('beforeend', html);
        initSortable(grid);
        updateAllOrders(grid);
    }
});


document.addEventListener('click', e => {
    if (e.target.classList.contains('delete-object-btn')) {
        if (!confirm('Удалить объект?')) return;

        const row = e.target.closest('.object-row');
        const itemId = row.dataset.itemId;
        const catId = row.closest('.category-card').dataset.categoryId;

        if (!itemId.startsWith('new_')) {
            document.getElementById('price-form').insertAdjacentHTML('beforeend', `
                <input type="hidden" name="categories[${catId}][delete_items][]" value="${itemId}">
            `);
        }

        row.remove();
        updateAllOrders(row.parentElement);
    }
});


document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.sortable-properties, .sortable-objects').forEach(el => {
        initSortable(el);
    });

    initSortable(document.getElementById('categories-container'), '.category-header');

    
    document.getElementById('price-form')?.addEventListener('submit', () => {
        updateAllOrders(document.getElementById('categories-container'));
        document.querySelectorAll('.sortable-properties, .sortable-objects').forEach(el => {
            updateAllOrders(el);
        });
    });
});
</script>
@endsection