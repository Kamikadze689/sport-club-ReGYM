@extends('admin.layout')

@section('title', 'Редактировать зону')

@section('content')

<div class="card">
    <div class="header" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <h1>Редактировать зону «{{ $zone->name }}»</h1>
        <a href="{{ route('admin.layout') }}" class="btn">← Назад</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger" style="margin-bottom:24px;">
            <ul style="margin:0; padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="display:flex; gap:40px; flex-wrap:wrap;">

        
        <div style="flex:1; min-width:380px; max-width:450px;">
            <form action="{{ route('admin.layout.update', $zone->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label required">Название зоны</label>
                    <input type="text" name="name" required value="{{ old('name', $zone->name) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Описание</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $zone->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Цвет зоны</label>
                    <input type="color" name="color" value="{{ old('color', $zone->color ?? '#FFD700') }}" class="form-control" style="height:40px; padding:4px;">
                </div>

                <div class="form-group">
                    <label class="form-label">Фото зоны (новое заменит старое)</label>
                    <input type="file" name="photo" accept="image/*" class="form-control">
                    @if($zone->photo)
                        <div style="margin-top:8px;">
                            <small>Текущее фото:</small><br>
                            <img src="{{ asset('storage/' . $zone->photo) }}" alt="Текущее фото" style="max-width:200px; border-radius:6px; margin-top:8px;">
                        </div>
                    @endif
                </div>

                <div class="form-group" style="background:#f9f9f9; padding:20px; border-radius:8px;">
                    <h4 style="margin:0 0 16px;">Размер зоны (в метрах)</h4>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                        <div>
                            <label class="form-label">Ширина, м</label>
                            <input type="number" step="0.1" min="0.1" name="width_m" id="width-m"
                                   value="{{ old('width_m', $zone->width_m ?? $zone->width * 0.8) }}" required class="form-control">
                        </div>
                        <div>
                            <label class="form-label">Высота, м</label>
                            <input type="number" step="0.1" min="0.1" name="height_m" id="height-m"
                                   value="{{ old('height_m', $zone->height_m ?? $zone->height * 0.8) }}" required class="form-control">
                        </div>
                    </div>
                    <div style="margin-top:16px; text-align:center; font-size:1.1em; font-weight:bold;">
                        В клетках: <span id="cells-size" style="color:#e67e22;">{{ $zone->width }} × {{ $zone->height }}</span><br>
                        <small style="color:#555; font-size:0.9em;">1 клетка = 0.8 × 0.8 м</small>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Позиция (верхний левый угол)</label>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                        <div>
                            <input type="number" name="grid_x" id="grid-x" readonly
                                   value="{{ old('grid_x', $zone->grid_x) }}" required class="form-control">
                            <small>X (0–59)</small>
                        </div>
                        <div>
                            <input type="number" name="grid_y" id="grid-y" readonly
                                   value="{{ old('grid_y', $zone->grid_y) }}" required class="form-control">
                            <small>Y (0–23)</small>
                        </div>
                    </div>
                    <small id="overlap-warning" style="color:#ef4444; font-weight:600; display:none; margin-top:10px;">
                        Нельзя размещать здесь — зона пересекается с другой!
                    </small>
                    <small id="position-info" style="color:#e67e22; font-weight:600; display:block; margin-top:10px;">
                        Кликните по карте справа — позиция обновится (если не пересекает другие зоны)
                    </small>
                </div>

                <button type="submit" class="btn" style="width:100%; padding:16px; font-size:1.2rem; margin-top:30px; background:#f59e0b; color:#000;">
                    Сохранить изменения
                </button>
            </form>
        </div>

        
        <div style="flex:2; min-width:600px;">
            <h3 style="margin-bottom:16px;">Карта зала 48 × 19.2 м (60 × 24 клетки)</h3>

            <div id="hall-map" style="
                width: 100%;
                aspect-ratio: 60 / 24;
                max-height: 620px;
                background: #f8fafc;
                border: 4px solid #1e293b;
                border-radius: 12px;
                position: relative;
                overflow: hidden;
                box-shadow: 0 10px 30px rgba(0,0,0,0.15);
                cursor: crosshair;
            ">
                
                <div style="
                    position: absolute;
                    inset: 0;
                    background-image:
                        linear-gradient(to right, #cbd5e1 1px, transparent 1px),
                        linear-gradient(to bottom, #cbd5e1 1px, transparent 1px);
                    background-size: calc(100% / 60) calc(100% / 24);
                    pointer-events: none;
                "></div>

                
                @foreach($existingZones as $z)
                    <div class="existing-zone"
                         data-grid-x="{{ $z->grid_x }}"
                         data-grid-y="{{ $z->grid_y }}"
                         data-width="{{ $z->width }}"
                         data-height="{{ $z->height }}"
                         style="
                             position: absolute;
                             left: {{ $z->grid_x * (100/60) }}%;
                             top: {{ $z->grid_y * (100/24) }}%;
                             width: {{ $z->width * (100/60) }}%;
                             height: {{ $z->height * (100/24) }}%;
                             background: {{ $z->color ?? '#9ca3af' }}30;
                             border: 2px solid {{ $z->color ?? '#64748b' }};
                             border-radius: 8px;
                             display: flex;
                             align-items: center;
                             justify-content: center;
                             color: #111;
                             font-weight: bold;
                             font-size: clamp(10px, 1.4vw, 14px);
                             text-align: center;
                             pointer-events: none;
                             opacity: {{ $z->id == $zone->id ? 0.4 : 1 }};
                         ">
                        {{ $z->name }}
                    </div>
                @endforeach

                
                <div id="preview-zone" style="
                    position: absolute;
                    display: none;
                    border: 4px dashed #f59e0b;
                    background: rgba(245, 158, 11, 0.20);
                    pointer-events: none;
                    box-shadow: 0 0 25px rgba(245,158,11,0.6);
                    z-index: 10;
                    transition: all 0.15s ease;
                "></div>
            </div>

            <div style="margin-top:12px; color:#64748b; font-size:0.95em; text-align:center;">
                Наведите мышь — предпросмотр<br>Кликните — зафиксируете (если не пересекает другие зоны)
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    console.log('Скрипт редактирования зоны с защитой от наложения → запущен');

    const map = document.getElementById('hall-map');
    const preview = document.getElementById('preview-zone');
    const xInput = document.getElementById('grid-x');
    const yInput = document.getElementById('grid-y');
    const widthMInput = document.getElementById('width-m');
    const heightMInput = document.getElementById('height-m');
    const cellsDisplay = document.getElementById('cells-size');
    const overlapWarning = document.getElementById('overlap-warning');
    const positionInfo = document.getElementById('position-info');

    if (!map || !preview || !xInput || !yInput || !widthMInput || !heightMInput || !cellsDisplay) {
        console.error('Один или несколько элементов не найдены');
        return;
    }

    let zoneWidthCells = parseInt('{{ $zone->width }}') || 2;
    let zoneHeightCells = parseInt('{{ $zone->height }}') || 2;
    let selectedCellX = parseInt('{{ $zone->grid_x }}') || 0;
    let selectedCellY = parseInt('{{ $zone->grid_y }}') || 0;

    
    const existingZones = [];
    document.querySelectorAll('.existing-zone').forEach(el => {
        const x = parseFloat(el.style.left) / (100 / 60); 
        const y = parseFloat(el.style.top) / (100 / 24);
        const w = parseFloat(el.style.width) / (100 / 60);
        const h = parseFloat(el.style.height) / (100 / 24);

        
        if (Math.abs(x - selectedCellX) > 0.1 || Math.abs(y - selectedCellY) > 0.1) {
            existingZones.push({
                x: Math.round(x),
                y: Math.round(y),
                w: Math.round(w),
                h: Math.round(h)
            });
        }
    });

    console.log('Найдено других зон для проверки:', existingZones.length);

    
    function isOverlapping(testX, testY, testW, testH) {
        for (const zone of existingZones) {
            if (!(testX + testW <= zone.x ||
                  testX >= zone.x + zone.w ||
                  testY + testH <= zone.y ||
                  testY >= zone.y + zone.h)) {
                console.log('Пересечение обнаружено с зоной:', zone);
                return true;
            }
        }
        return false;
    }

    function recalculateSize() {
        const wMeters = parseFloat(widthMInput.value) || 1.6;
        const hMeters = parseFloat(heightMInput.value) || 1.6;

        zoneWidthCells = Math.max(1, Math.ceil(wMeters / 0.8));
        zoneHeightCells = Math.max(1, Math.ceil(hMeters / 0.8));

        cellsDisplay.textContent = `${zoneWidthCells} × ${zoneHeightCells}`;

        updatePreview(selectedCellX, selectedCellY);
    }

    function updatePreview(cellX, cellY) {
        const mapRect = map.getBoundingClientRect();

        const cellWidth = mapRect.width / 60;
        const cellHeight = mapRect.height / 24;

        const pxLeft   = cellX * cellWidth;
        const pxTop    = cellY * cellHeight;
        const pxWidth  = zoneWidthCells * cellWidth;
        const pxHeight = zoneHeightCells * cellHeight;

        const overlapping = isOverlapping(cellX, cellY, zoneWidthCells, zoneHeightCells);

        preview.style.left   = `${pxLeft}px`;
        preview.style.top    = `${pxTop}px`;
        preview.style.width  = `${pxWidth}px`;
        preview.style.height = `${pxHeight}px`;

        if (overlapping) {
            preview.style.borderColor = '#ef4444';
            preview.style.background = 'rgba(239, 68, 68, 0.25)';
            overlapWarning.style.display = 'block';
            positionInfo.style.display = 'none';
        } else {
            preview.style.borderColor = '#f59e0b';
            preview.style.background = 'rgba(245, 158, 11, 0.20)';
            overlapWarning.style.display = 'none';
            positionInfo.style.display = 'block';
        }

        preview.style.display = 'block';
    }

    function setPosition(cellX, cellY) {
        if (isOverlapping(cellX, cellY, zoneWidthCells, zoneHeightCells)) {
            console.log('Попытка установить позицию с пересечением — отклонено');
            return; 
        }

        selectedCellX = Math.max(0, Math.min(cellX, 60 - zoneWidthCells));
        selectedCellY = Math.max(0, Math.min(cellY, 24 - zoneHeightCells));

        xInput.value = selectedCellX;
        yInput.value = selectedCellY;

        updatePreview(selectedCellX, selectedCellY);
    }

    map.addEventListener('click', e => {
        const rect = map.getBoundingClientRect();
        const clickX = e.clientX - rect.left;
        const clickY = e.clientY - rect.top;

        const cellX = Math.floor(clickX / (rect.width / 60));
        const cellY = Math.floor(clickY / (rect.height / 24));

        setPosition(cellX, cellY);
    });

    map.addEventListener('mousemove', e => {
        const rect = map.getBoundingClientRect();
        const mx = e.clientX - rect.left;
        const my = e.clientY - rect.top;

        const cellX = Math.floor(mx / (rect.width / 60));
        const cellY = Math.floor(my / (rect.height / 24));

        const safeX = Math.max(0, Math.min(cellX, 60 - zoneWidthCells));
        const safeY = Math.max(0, Math.min(cellY, 24 - zoneHeightCells));

        updatePreview(safeX, safeY);
    });

    map.addEventListener('mouseleave', () => {
        updatePreview(selectedCellX, selectedCellY);
    });

    widthMInput.addEventListener('input', recalculateSize);
    heightMInput.addEventListener('input', recalculateSize);

    recalculateSize();
    updatePreview(selectedCellX, selectedCellY);

    console.log('Инициализация редактирования завершена (с защитой от наложения)');
});
</script>
@endsection

