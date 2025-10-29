<div class="card card-modern">
    <div class="card-header">
        <h5 class="mb-0 fw-semibold">🚗 Inspeksi Kendaraan</h5>
    </div>

    <div class="card-body p-4">
        <small class="text-muted fw-bold d-block mb-4 text-center">
            <span class="badge bg-success me-2">G = Good</span>
            <span class="badge bg-warning text-dark me-2">F = Fair</span>
            <span class="badge bg-danger">P = Poor</span>
        </small>

        <!-- === PAINT === -->
        <div class="section mb-4">
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-brush-fill text-primary me-2 fs-5"></i>
                <h6 class="fw-bold mb-0">Paint</h6>
            </div>
            <div class="ms-3">
                <x-inspection-item title="Paint" field="paint" />
            </div>
        </div>

        <!-- === GLASS === -->
        <div class="section mb-4">
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-square text-info me-2 fs-5"></i>
                <h6 class="fw-bold mb-0">Glass</h6>
            </div>
            <div class="ms-3">
                <x-inspection-item title="Windshield" field="glass_windshield" />
                <x-inspection-item title="Windows" field="glass_windows" />
                <x-inspection-item title="Mirrors" field="glass_mirrors" />
                <x-inspection-item title="Rear Window" field="glass_rear_window" />
            </div>
        </div>

        <!-- === TIRES & WHEELS === -->
        <div class="section">
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-circle-half text-secondary me-2 fs-5"></i>
                <h6 class="fw-bold mb-0">Tires and Wheels</h6>
            </div>
            <div class="ms-3">
                <x-inspection-item title="Tires" field="tires_tires" />
                <x-inspection-item title="Wheels" field="tires_wheels" />
            </div>
        </div>
    </div>
</div>

<style>
    .card-modern {
        border-radius: 1rem;
    }

    .card-body {
        background-color: #fafafa;
    }

    .section h6 {
        color: #333;
        font-weight: 600;
    }

    .x-inspection-item {
        margin-bottom: 10px;
    }

    /* Responsif */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
        .section h6 {
            font-size: 1rem;
        }
        small.text-muted {
            font-size: 0.85rem;
        }
    }

    .inspection-item .btn {
        width: 40px;
        height: 40px;
        font-weight: bold;
        font-size: 14px;
    }

    .inspection-item .btn.active {
        color: white !important;
    }
</style>


<script>
    function selectCondition(field, condition) {
        const item = document.querySelector(`[data-field="${field}"]`);
        const buttons = item.querySelectorAll('.condition-btn');

        buttons.forEach(btn => {
            btn.classList.remove('active', 'btn-success', 'btn-warning', 'btn-danger');
            const color = btn.dataset.condition === 'G' ? 'success' : btn.dataset.condition === 'F' ? 'warning' : 'danger';
            btn.classList.add('btn-outline-' + color);
        });

        const selected = item.querySelector(`[data-condition="${condition}"]`);
        selected.classList.add('active', `btn-${condition === 'G' ? 'success' : condition === 'F' ? 'warning' : 'danger'}`);

        item.querySelector(`input[name="${field}_condition"]`).value = condition;
        const detail = item.querySelector('.detail-form');
        detail.style.display = 'block';

        saveInspectionItem(field);
    }

    function previewImage(input, field) {
        const file = input.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = e => {
            const preview = input.closest('.detail-form').querySelector('.image-preview');
            preview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded" style="max-height:120px;">`;
            // Simpan sebagai BLOB
            saveInspectionItem(field, file, e.target.result);
        };
        reader.readAsDataURL(file);
    }

    function saveInspectionItem(field, file = null, dataUrl = null) {
        const item = document.querySelector(`[data-field="${field}"]`);
        const condition = item.querySelector(`input[name="${field}_condition"]`).value;
        const note = item.querySelector(`textarea[name="${field}_note"]`)?.value || '';

        let data = JSON.parse(localStorage.getItem('step2') || '{}');
        data[`${field}_condition`] = condition;
        data[`${field}_note`] = note;

        if (file && dataUrl) {
            data[`${field}_image_blob`] = dataUrl;
            data[`${field}_image_name`] = file.name;
            data[`${field}_image_type`] = file.type;
            data[`${field}_image_size`] = file.size;
            data[`${field}_image_lastModified`] = file.lastModified;
        }

        localStorage.setItem('step2', JSON.stringify(data));
    }

    function validateStep2() {
        const saved = localStorage.getItem('step2');
        if (!saved) {
            showError('Harap pilih kondisi (G/F/P) untuk semua item.');
            return false;
        }
        const data = JSON.parse(saved);
        const required = [
            'paint_condition',
            'glass_windshield_condition', 'glass_windows_condition',
            'glass_mirrors_condition', 'glass_rear_window_condition',
            'tires_tires_condition', 'tires_wheels_condition'
        ];
        const missing = required.filter(f => !data[f]);
        if (missing.length > 0) {
            showError('Wajib pilih kondisi untuk: ' + missing.map(m => m.replace(/_condition/g, '').replace(/_/g, ' ')).join(', '));
            return false;
        }
        return true;
    }

    function loadStep2() {
        const saved = JSON.parse(localStorage.getItem('step2') || '{}');
        Object.keys(saved).forEach(key => {
            if (key.endsWith('_condition') && saved[key]) {
                const field = key.replace('_condition', '');
                selectCondition(field, saved[key]);
            }
            if (key.endsWith('_note')) {
                const field = key.replace('_note', '');
                const el = document.querySelector(`[data-field="${field}"] textarea[name="${key}"]`);
                if (el) el.value = saved[key];
            }
            if (key.endsWith('_image_blob') && saved[key]) {
                const field = key.replace('_image_blob', '');
                const input = document.querySelector(`[data-field="${field}"] input[name="${field}_image"]`);
                if (input) {
                    fetch(saved[key])
                        .then(res => res.blob())
                        .then(blob => {
                            const file = new File([blob], saved[`${field}_image_name`], {
                                type: saved[`${field}_image_type`]
                            });
                            const dt = new DataTransfer();
                            dt.items.add(file);
                            input.files = dt.files;

                            input.closest('.detail-form').querySelector('.image-preview')
                                .innerHTML = `<img src="${saved[key]}" class="img-fluid rounded" style="max-height:120px;">`;
                        });
                }
            }
        });
    }
</script>