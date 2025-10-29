<div class="card border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 text-primary">Foto 4 Posisi Kendaraan</h5>
    </div>
    <div class="card-body text-center position-relative" style="min-height: 500px;">
        <!-- Gambar Mobil -->
        <img src="{{ asset('images/car-silhouette.png') }}" 
             class="img-fluid" 
             style="max-height: 400px; pointer-events: none;">

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
                 class="rounded-circle shadow-sm" 
                 style="width: 80px; height: 80px; object-fit: cover;">
        `;

        // Simpan ke localStorage sebagai BLOB + metadata
        savePhoto(field, file, e.target.result);
    };
    reader.readAsDataURL(file);
}

function savePhoto(field, file, dataUrl) {
    let data = JSON.parse(localStorage.getItem('step3') || '{}');
    data[`${field}_photo_blob`] = dataUrl;           // Simpan gambar (base64)
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

    // Validasi berdasarkan nama file (bukan File object)
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
                // Rekonstruksi File dari Blob
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

                        // Tampilkan preview
                        const point = input.closest('.photo-point');
                        const preview = point.querySelector('.preview');
                        const placeholder = point.querySelector('.placeholder');
                        placeholder.style.display = 'none';
                        preview.innerHTML = `
                            <img src="${saved[blobKey]}" 
                                 class="rounded-circle shadow-sm" 
                                 style="width: 80px; height: 80px; object-fit: cover;">
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
    transition: all 0.2s ease;
}
.photo-point:hover {
    transform: scale(1.1) !important;
}
.photo-point .placeholder {
    transition: opacity 0.3s ease;
}
</style>