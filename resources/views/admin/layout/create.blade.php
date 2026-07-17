@extends('admin.layout')

@section('title', 'Добавить зону')

@section('content')

<div class="card">
    <div class="header" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <h1>Добавить зону на карту зала</h1>
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
            <form action="{{ route('admin.layout.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="form-label required">Название зоны</label>
                    <input type="text" name="name" required value="{{ old('name') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Описание</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Цвет зоны (опционально)</label>
                    <input type="color" name="color" value="{{ old('color', '#FFD700') }}" class="form-control" style="height:40px; padding:4px;">
                </div>

                <div class="form-group">
                    <label class="form-label">Фото (опционально, макс. 2 МБ)</label>
                    <input type="file" name="photo" accept="image/*" class="form-control">
                </div>

                <div class="form-group" style="background:#f9f9f9; padding:20px; border-radius:8px;">
                    <h4 style="margin:0 0 16px;">Размер зоны (в метрах)</h4>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                        <div>
                            <label class="form-label">Ширина, м</label>
                            <input type="number" step="0.1" min="0.1" name="width_m" id="width-m"
                                   value="{{ old('width_m', 1.6) }}" required class="form-control">
                        </div>
                        <div>
                            <label class="form-label">Высота, м</label>
                            <input type="number" step="0.1" min="0.1" name="height_m" id="height-m"
                                   value="{{ old('height_m', 1.6) }}" required class="form-control">
                        </div>
                    </div>
                    <div style="margin-top:16px; text-align:center; font-size:1.1em; font-weight:bold;">
                        В клетках: <span id="cells-size" style="color:#e67e22;">2 × 2</span><br>
                        <small style="color:#555; font-size:0.9em;">1 клетка = 0.8 × 0.8 м</small>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Позиция (верхний левый угол)</label>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                        <div>
                            <input type="number" name="grid_x" id="grid-x" readonly
                                   value="{{ old('grid_x', 0) }}" required class="form-control">
                            <small>X (0–59)</small>
                        </div>
                        <div>
                            <input type="number" name="grid_y" id="grid-y" readonly
                                   value="{{ old('grid_y', 0) }}" required class="form-control">
                            <small>Y (0–23)</small>
                        </div>
                    </div>
                    <small id="overlap-warning" style="color:#ef4444; font-weight:600; display:none; margin-top:10px;">
                        Нельзя размещать здесь — зона пересекается с другой!
                    </small>
                    <small style="color:#e67e22; font-weight:600; display:block; margin-top:10px;" id="position-info">
                        Кликните по карте справа — позиция зафиксируется
                    </small>
                </div>

                <button type="submit" class="btn" style="width:100%; padding:16px; font-size:1.2rem; margin-top:30px; background:#f59e0b; color:#000;">
                    Сохранить зону
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

                
                @foreach($existingZones as $zone)
                    <div class="existing-zone"
                         data-grid-x="{{ $zone->grid_x }}"
                         data-grid-y="{{ $zone->grid_y }}"
                         data-width="{{ $zone->width }}"
                         data-height="{{ $zone->height }}"
                         style="
                             position: absolute;
                             left: {{ $zone->grid_x * (100/60) }}%;
                             top: {{ $zone->grid_y * (100/24) }}%;
                             width: {{ $zone->width * (100/60) }}%;
                             height: {{ $zone->height * (100/24) }}%;
                             background: {{ $zone->color ?? '#9ca3af' }}30;
                             border: 2px solid {{ $zone->color ?? '#64748b' }};
                             border-radius: 8px;
                             display: flex;
                             align-items: center;
                             justify-content: center;
                             color: #111;
                             font-weight: bold;
                             font-size: clamp(10px, 1.4vw, 14px);
                             text-align: center;
                             pointer-events: none;
                         ">
                        {{ $zone->name }}
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
                Наведите мышь — предпросмотр<br>Кликните — зафиксируете позицию (если не пересекает другие зоны)
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    console.log('Скрипт добавления зоны с защитой от наложения → запущен');

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

    let zoneWidthCells = 2;
    let zoneHeightCells = 2;
    let selectedCellX = 0;
    let selectedCellY = 0;

    
    const existingZones = [];
    document.querySelectorAll('.existing-zone').forEach(el => {
        existingZones.push({
            x: parseInt(el.dataset.gridX),
            y: parseInt(el.dataset.gridY),
            w: parseInt(el.dataset.width),
            h: parseInt(el.dataset.height)
        });
    });

    
    function isOverlapping(testX, testY, testW, testH) {
        for (const zone of existingZones) {
            if (!(testX + testW <= zone.x ||
                  testX >= zone.x + zone.w ||
                  testY + testH <= zone.y ||
                  testY >= zone.y + zone.h)) {
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
    updatePreview(0, 0);

    console.log('Инициализация завершена — карта готова (с защитой от наложения)');
});
</script>
@endsection



