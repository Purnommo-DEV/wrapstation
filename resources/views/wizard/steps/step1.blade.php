<div class="card border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 text-primary">Data Pelanggan & Kendaraan</h5>
    </div>
    <div class="card-body">
        <form id="formStep1">
            <div class="row g-3">
                <div class="col-md-6"><input type="text" name="customer_front_name" class="form-control" placeholder="First Name" required></div>
                <div class="col-md-6"><input type="text" name="customer_last_name" class="form-control" placeholder="Last Name" required></div>
                <div class="col-md-6"><input type="text" name="customer_phone" class="form-control" placeholder="Phone" required></div>
                <div class="col-md-6"><input type="text" name="car_brand" class="form-control" placeholder="Brand" required></div>
                <div class="col-md-6"><input type="text" name="car_model" class="form-control" placeholder="Model" required></div>
                <div class="col-md-6"><input type="text" name="color" class="form-control" placeholder="Color" required></div>
                <div class="col-md-6"><input type="number" name="year" class="form-control" placeholder="Year" required></div>
                <div class="col-md-6"><input type="text" name="license_plate" class="form-control" placeholder="License Plate" required></div>
                <div class="col-md-6"><input type="date" name="inspection_date" class="form-control" value="{{ date('Y-m-d') }}" required></div>
            </div>
        </form>
    </div>
</div>

<script>
function saveStep1() {
    const form = document.getElementById('formStep1');
    const data = {};
    let valid = true;
    const required = ['customer_front_name', 'customer_last_name', 'customer_phone', 'car_brand', 'car_model', 'color', 'year', 'license_plate', 'inspection_date'];

    required.forEach(field => {
        const val = form[field].value.trim();
        if (!val) {
            valid = false;
            form[field].classList.add('is-invalid');
        } else {
            form[field].classList.remove('is-invalid');
            data[field] = val;
        }
    });

    if (valid) localStorage.setItem('step1', JSON.stringify(data));
    return valid;
}

function validateStep1() {
    const saved = localStorage.getItem('step1');
    if (!saved) {
        showError('Harap isi semua data pelanggan.');
        return false;
    }
    const data = JSON.parse(saved);
    const required = ['customer_front_name', 'customer_last_name', 'customer_phone', 'car_brand', 'car_model', 'color', 'year', 'license_plate', 'inspection_date'];
    for (let f of required) {
        if (!data[f]) {
            showError(`"${f.replace(/_/g, ' ')}" wajib diisi.`);
            return false;
        }
    }
    return true;
}

function loadStep1() {
    const saved = localStorage.getItem('step1');
    if (saved) {
        const data = JSON.parse(saved);
        Object.keys(data).forEach(k => {
            const el = document.querySelector(`[name="${k}"]`);
            if (el) el.value = data[k];
        });
    }
}

// Auto-save
document.querySelectorAll('#formStep1 input').forEach(input => {
    input.addEventListener('input', () => {
        const data = JSON.parse(localStorage.getItem('step1') || '{}');
        data[input.name] = input.value;
        localStorage.setItem('step1', JSON.stringify(data));
        input.classList.remove('is-invalid');
    });
});
</script>