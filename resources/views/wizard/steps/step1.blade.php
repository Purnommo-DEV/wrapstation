<style>
    .card-modern {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .card-modern .card-header {
        background: linear-gradient(135deg, #3f51b5, #2196f3);
        color: #fff;
        padding: 1.25rem 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.4rem;
    }

    .form-control,
    .form-select,
    .select2-container--bootstrap-5 .select2-selection {
        border-radius: 0.6rem;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus,
    .select2-container--bootstrap-5 .select2-selection:focus {
        border-color: #2196f3;
        box-shadow: 0 0 0 0.25rem rgba(33, 150, 243, 0.25);
    }

    .select2-container--bootstrap-5 .select2-selection {
        padding: 0.4rem 0.6rem;
        min-height: 38px;
    }

    .select2-selection__rendered {
        line-height: 32px !important;
    }

    .select2-selection__arrow {
        top: 4px !important;
    }

    .card-modern .card-body {
        background-color: #fafbfc;
        padding: 2rem;
    }

    .btn-modern {
        background: linear-gradient(135deg, #2196f3, #3f51b5);
        color: #fff;
        border: none;
        border-radius: 0.5rem;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-modern:hover {
        background: linear-gradient(135deg, #1e88e5, #3949ab);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3);
    }
</style>

<div class="card card-modern">
    <div class="card-header">
        <h5 class="mb-0 fw-semibold">Data Pelanggan & Kendaraan</h5>
    </div>
    <div class="card-body">
        <form id="formStep1">
            <div class="row g-4">
                <!-- Location -->
                <div class="col-md-6">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" id="location" name="location" class="form-control" placeholder="Location" required>
                </div>

                <!-- Customer First Name -->
                <div class="col-md-6">
                    <label for="customer_front_name" class="form-label">Customer First Name</label>
                    <input type="text" id="customer_front_name" name="customer_front_name" class="form-control" placeholder="Customer First Name" required>
                </div>

                <!-- Customer Last Name -->
                <div class="col-md-6">
                    <label for="customer_last_name" class="form-label">Customer Last Name</label>
                    <input type="text" id="customer_last_name" name="customer_last_name" class="form-control" placeholder="Customer Last Name" required>
                </div>

                <!-- Customer Phone Number -->
                <div class="col-md-6">
                    <label for="customer_phone" class="form-label">Customer Phone Number</label>
                    <input type="text" id="customer_phone" name="customer_phone" class="form-control" placeholder="Customer Phone Number" required>
                </div>

                <!-- Car Brand -->
                <div class="col-md-6">
                    <label for="car_brand" class="form-label">Car Brand</label>
                    <input type="text" id="car_brand" name="car_brand" class="form-control" placeholder="Car Brand" required>
                </div>

                <!-- Car Model -->
                <div class="col-md-6">
                    <label for="car_model" class="form-label">Car Model</label>
                    <input type="text" id="car_model" name="car_model" class="form-control" placeholder="Car Model" required>
                </div>

                <!-- Color (with Select2) -->
                <div class="col-md-6">
                    <label for="color" class="form-label">Color</label>
                    <select id="color" name="color" class="form-select js-color-select" required>
                        <option value="" disabled selected>Choose a color...</option>
                        <option value="Black">Black</option>
                        <option value="White">White</option>
                        <option value="Silver">Silver</option>
                        <option value="Gray">Gray</option>
                        <option value="Red">Red</option>
                        <option value="Blue">Blue</option>
                        <option value="Green">Green</option>
                        <option value="Yellow">Yellow</option>
                        <option value="Brown">Brown</option>
                        <option value="Beige">Beige</option>
                        <option value="Gold">Gold</option>
                        <option value="Orange">Orange</option>
                        <option value="Purple">Purple</option>
                        <option value="Pink">Pink</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <!-- Year -->
                <div class="col-md-6">
                    <label for="year" class="form-label">Year</label>
                    <input type="number" id="year" name="year" class="form-control" placeholder="Year" required>
                </div>

                <!-- License Plate -->
                <div class="col-md-6">
                    <label for="license_plate" class="form-label">License Plate (No Spacing)</label>
                    <input type="text" id="license_plate" name="license_plate" class="form-control" placeholder="License Plate (No Spacing)" required>
                </div>

                <!-- Inspection Date -->
                <div class="col-md-6">
                    <label for="inspection_date" class="form-label">Inspection Date</label>
                    <input type="date" id="inspection_date" name="inspection_date" class="form-control" required>
                </div>

                <!-- Mileage -->
                <div class="col-md-6">
                    <label for="mileage" class="form-label">Mileage (Kilometer)</label>
                    <input type="number" id="mileage" name="mileage" class="form-control" placeholder="Mileage (Kilometer)" required>
                </div>
            </div>
        </form>
    </div>
</div>



<script>

    $(document).ready(function() {
        $('.js-color-select').select2({
            theme: 'bootstrap-5',
            placeholder: 'Choose a color...',
            allowClear: true
        });
    });

    const savedData = localStorage.getItem('step1');
    if (!savedData) {
        $('#inspection_date').val('');
    }

    function saveStep1() {
        const form = document.getElementById('formStep1');
        const data = {};
        let valid = true;
        const required = ['location', 'customer_front_name', 'customer_last_name', 'customer_phone', 'car_brand', 'car_model', 'color', 'year', 'license_plate', 'inspection_date', 'mileage'];

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
        const required = ['location', 'customer_front_name', 'customer_last_name', 'customer_phone', 'car_brand', 'car_model', 'color', 'year', 'license_plate', 'inspection_date', 'mileage'];
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

    document.querySelectorAll('#formStep1 input').forEach(input => {
        input.addEventListener('input', () => {
            const data = JSON.parse(localStorage.getItem('step1') || '{}');
            data[input.name] = input.value;
            localStorage.setItem('step1', JSON.stringify(data));
            input.classList.remove('is-invalid');
        });
    });

</script>