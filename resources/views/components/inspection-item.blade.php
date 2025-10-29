{{-- resources/views/components/inspection-item.blade.php --}}
<div class="inspection-item mb-4 p-3 border rounded bg-light" data-field="{{ $field }}">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="d-flex align-items-center gap-2">
            <div class="btn-group">
                @foreach(['G' => 'success', 'F' => 'warning', 'P' => 'danger'] as $c => $color)
                    <button type="button" 
                            class="btn condition-btn btn-sm btn-outline-{{ $color }}"
                            data-condition="{{ $c }}"
                            onclick="selectCondition('{{ $field }}', '{{ $c }}')">
                        {{ $c }}
                    </button>
                @endforeach
            </div>
            <span class="fw-semibold ms-2">{{ $title }}</span>
        </div>
    </div>

    <!-- Hidden Condition (kosong di awal) -->
    <input type="hidden" name="{{ $field }}_condition" value="">

    <!-- Form Detail (SELALU Tersembunyi di awal) -->
    <div class="detail-form mt-3" style="display: none;">
        <div class="mb-2">
            <label class="form-label small">Catatan</label>
            <textarea name="{{ $field }}_note" class="form-control form-control-sm" rows="2" 
                      oninput="saveInspectionItem('{{ $field }}')"></textarea>
        </div>
        <div class="mb-2">
            <label class="form-label small">Gambar</label>
            <input type="file" name="{{ $field }}_image" class="form-control form-control-sm" accept="image/*"
                   onchange="previewImage(this, '{{ $field }}')">
            <div class="image-preview mt-1"></div>
        </div>
    </div>
</div>