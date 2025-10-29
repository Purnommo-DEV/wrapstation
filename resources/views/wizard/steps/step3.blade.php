<div class="card card-modern">
    <div class="card-header">
        <h5 class="mb-0 fw-semibold">📸 Foto 4 Posisi Kendaraan</h5>
    </div>

    <div class="card-body text-center position-relative bg-light" style="min-height: 500px;">
        <!-- Gambar Mobil -->
        <img src="{{ asset('images/car-silhouette.png') }}" 
             class="img-fluid opacity-75">

        <!-- 4 Posisi -->
        <x-photo-point top="18%" left="50%" transform="translateX(-50%)" label="Depan" field="front" />
        <x-photo-point top="82%" left="50%" transform="translateX(-50%)" label="Belakang" field="rear" />
        <x-photo-point top="50%" left="8%" transform="translateY(-50%)" label="Kiri" field="left" />
        <x-photo-point top="50%" right="8%" transform="translateY(-50%)" label="Kanan" field="right" />
    </div>
</div>

<script>
function handlePhotoUpload(input, field) {
    const file = input.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        const point = input.closest('.photo-point');
        const preview = point.querySelector('.preview');
        const placeholder = point.querySelector('.placeholder');

        // Ganti placeholder
        placeholder.style.display = 'none';
        preview.innerHTML = `
            <img src="${e.target.result}" 
                 class="rounded-circle shadow-lg border border-2 border-white" 
                 style="width: 90px; height: 90px; object-fit: cover;">
        `;

        savePhoto(field, file, e.target.result);
    };
    reader.readAsDataURL(file);
}

function savePhoto(field, file, dataUrl) {
    let data = JSON.parse(localStorage.getItem('step3') || '{}');
    data[`${field}_photo_blob`] = dataUrl;
    data[`${field}_photo_name`] = file.name;
    data[`${field}_photo_type`] = file.type;
    data[`${field}_photo_size`] = file.size;
    data[`${field}_photo_lastModified`] = file.lastModified;
    localStorage.setItem('step3', JSON.stringify(data));
}

function validateStep3() {
    const saved = localStorage.getItem('step3');
    if (!saved) {
        showError('Harap upload foto 4 posisi kendaraan.');
        return false;
    }
    const data = JSON.parse(saved);
    const required = ['front_photo_name', 'rear_photo_name', 'left_photo_name', 'right_photo_name'];
    const missing = required.filter(f => !data[f]);
    if (missing.length > 0) {
        showError('Belum upload foto: ' + missing.map(m => m.replace('_photo_name', '')).join(', '));
        return false;
    }
    return true;
}

function loadStep3() {
    const saved = JSON.parse(localStorage.getItem('step3') || '{}');
    ['front', 'rear', 'left', 'right'].forEach(field => {
        const blobKey = `${field}_photo_blob`;
        const nameKey = `${field}_photo_name`;
        if (saved[blobKey] && saved[nameKey]) {
            const input = document.getElementById(`input-${field}`);
            if (input) {
                fetch(saved[blobKey])
                    .then(res => res.blob())
                    .then(blob => {
                        const file = new File([blob], saved[nameKey], {
                            type: saved[`${field}_photo_type`],
                            lastModified: saved[`${field}_photo_lastModified`]
                        });
                        const dt = new DataTransfer();
                        dt.items.add(file);
                        input.files = dt.files;

                        const point = input.closest('.photo-point');
                        const preview = point.querySelector('.preview');
                        const placeholder = point.querySelector('.placeholder');
                        placeholder.style.display = 'none';
                        preview.innerHTML = `
                            <img src="${saved[blobKey]}" 
                                 class="rounded-circle shadow-lg border border-2 border-white"
                                 style="width: 90px; height: 90px; object-fit: cover;">
                        `;
                    })
                    .catch(err => console.error('Gagal load foto:', err));
            }
        }
    });
}
</script>

<style>
    .photo-point {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        transform-origin: center center;
        cursor: pointer;
    }

    .photo-point:hover {
        transform: scale(1.08);
        box-shadow: 0 0 12px rgba(0, 123, 255, 0.3);
        z-index: 10;
    }

    /* Transisi halus untuk placeholder */
    .photo-point .placeholder {
        transition: opacity 0.3s ease;
    }

    /* Input file tetap klik-able tapi disembunyikan */
    .photo-point input[type="file"] {
        opacity: 0;
        position: absolute;
        inset: 0;
        cursor: pointer;
    }

    /* Efek saat foto sudah diupload */
    .photo-point img {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .photo-point img:hover {
        transform: scale(1.05);
    }

    .card-header h5 {
        letter-spacing: 0.5px;
    }
</style>

