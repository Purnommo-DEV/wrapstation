{{-- resources/views/components/photo-point.blade.php --}}
<div class="photo-point position-absolute text-center"
     style="top:{{ $top }}; left:{{ $left ?? 'auto' }}; right:{{ $right ?? 'auto' }}; transform:{{ $transform ?? '' }}; cursor: pointer;"
     onclick="document.getElementById('input-{{ $field }}').click()">
     
    <!-- Input File (hidden) -->
    <input type="file" 
           id="input-{{ $field }}" 
           name="{{ $field }}_photo" 
           class="d-none" 
           accept="image/*"
           onchange="handlePhotoUpload(this, '{{ $field }}')">

    <!-- Placeholder -->
    <div class="placeholder border rounded-circle d-flex align-items-center justify-content-center bg-white shadow-sm"
         style="width: 80px; height: 80px;">
        <i class="ti ti-camera fs-2 text-muted"></i>
    </div>

    <!-- Label -->
    <div class="mt-1 fw-bold text-dark">{{ $label }}</div>

    <!-- Preview (akan diganti saat upload) -->
    <div class="preview mt-1"></div>
</div>