<div class="card border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 text-primary">Syarat & Ketentuan</h5>
    </div>
    <div class="card-body">
        <!-- Syarat & Ketentuan -->
        <div class="border p-3 mb-3 rounded" style="height:180px; overflow:auto; background:#f8f9fa; font-size:0.9rem;">
            <ol class="mb-0">
                <li>Kondisi kendaraan dapat berubah setelah pembersihan dan proses wrapping.</li>
                <li>Wrap Station tidak bertanggung jawab atas kerusakan yang terjadi akibat kondisi awal kendaraan.</li>
                <li>Pelanggan wajib menandatangani form ini sebagai persetujuan.</li>
                <!-- ... tambahkan 7 poin lagi jika perlu -->
            </ol>
        </div>

        <!-- Checkbox Persetujuan -->
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="agree" required>
            <label class="form-check-label" for="agree">Saya telah membaca dan menyetujui syarat & ketentuan di atas</label>
        </div>

        <!-- Signature Area -->
        <div class="mb-3">
            <label class="form-label fw-bold">Tanda Tangan</label>
            <div class="signature-container border rounded bg-white p-2 shadow-sm">
                <canvas id="signatureCanvas" class="border rounded"></canvas>
            </div>
            <div class="mt-2 text-end">
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearSignature()">Hapus</button>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center mt-4">
            <button type="button" class="btn btn-success btn-lg px-5" onclick="handleFinalSubmit()">
                Submit Formulir
            </button>
        </div>
    </div>
</div>

<!-- Signature Pad + Responsif -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>

function dataURLtoBlob(dataurl) {
    const arr = dataurl.split(',');
    const mime = arr[0].match(/:(.*?);/)[1];
    const bstr = atob(arr[1]);
    let n = bstr.length;
    const u8arr = new Uint8Array(n);
    while (n--) u8arr[n] = bstr.charCodeAt(n);
    return new Blob([u8arr], { type: mime });
}

let signaturePad;
let canvas;

// Inisialisasi saat halaman dimuat
window.addEventListener('load', function() {
    canvas = document.getElementById('signatureCanvas');
    const container = canvas.parentElement;

    // Atur ukuran canvas sesuai container
    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = container.offsetWidth * ratio;
        canvas.height = 150 * ratio; // Tinggi tetap 150px
        canvas.getContext('2d').scale(ratio, ratio);
        signaturePad?.clear();
    }

    // Buat SignaturePad
    signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)',
        penColor: 'rgb(0, 0, 0)'
    });

    // Resize saat load & resize window
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);
});

// Hapus tanda tangan
function clearSignature() {
    signaturePad.clear();
}

// Submit Final
async function finalSubmit() {
    if (!document.getElementById('agree').checked) {
        showError('Harap centang persetujuan');
        return;
    }
    if (signaturePad.isEmpty()) {
        showError('Silakan tanda tangan');
        return;
    }

    const formData = new FormData();

    // === STEP 1 ===
    const step1 = JSON.parse(localStorage.getItem('step1') || '{}');
    Object.keys(step1).forEach(k => formData.append(k, step1[k]));

    // === STEP 2: Teks + Gambar ===
    const step2 = JSON.parse(localStorage.getItem('step2') || '{}');
    const fields = [
        'paint', 'glass_windshield', 'glass_windows', 'glass_mirrors',
        'glass_rear_window', 'tires_tires', 'tires_wheels'
    ];

    const imagePromises = [];

    fields.forEach(field => {
        // Teks
        if (step2[`${field}_condition`]) formData.append(`${field}_condition`, step2[`${field}_condition`]);
        if (step2[`${field}_note`]) formData.append(`${field}_note`, step2[`${field}_note`]);

        // Gambar
        const blobKey = `${field}_image_blob`;
        const nameKey = `${field}_image_name`;
        const typeKey = `${field}_image_type`;

        if (step2[blobKey] && step2[nameKey]) {
            const promise = fetch(step2[blobKey])
                .then(res => res.blob())
                .then(blob => {
                    const file = new File([blob], step2[nameKey], { type: step2[typeKey] });
                    formData.append(`${field}_image`, file);
                })
                .catch(err => console.error(`Gagal load ${field}:`, err));
            imagePromises.push(promise);
        }
    });

    // === STEP 3: Foto 4 Posisi ===
    const step3 = JSON.parse(localStorage.getItem('step3') || '{}');
    const positions = ['front', 'rear', 'left', 'right'];
    positions.forEach(pos => {
        const blobKey = `${pos}_photo_blob`;
        const nameKey = `${pos}_photo_name`;
        const typeKey = `${pos}_photo_type`;

        if (step3[blobKey] && step3[nameKey]) {
            const promise = fetch(step3[blobKey])
                .then(res => res.blob())
                .then(blob => {
                    const file = new File([blob], step3[nameKey], { type: step3[typeKey] });
                    formData.append(`${pos}_photo`, file);
                });
            imagePromises.push(promise);
        }
    });

    // === TUNGGU SEMUA FILE SELESAI ===
    try {
        await Promise.all(imagePromises);
        formData.append('signature', signaturePad.toDataURL());

        // === SUBMIT ===
        const response = await fetch('{{ route("wizard.store") }}', {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });

        if (!response.ok) throw new Error('Server error: ' + response.status);

        const res = await response.json();
        localStorage.clear();
        window.location.href = '/report/' + res.id;

    } catch (err) {
        console.error('Submit error:', err);
        showError('Gagal submit. Cek console untuk detail.');
    }
}

// === PANGGIL DENGAN HANDLER ===
function handleFinalSubmit() {
    finalSubmit(); // async akan ditunggu
}

</script>

<style>
.signature-container {
    width: 100%;
    max-width: 100%;
    overflow: hidden;
}
#signatureCanvas {
    width: 100%;
    height: 150px;
    touch-action: none; /* Penting untuk mobile */
}
.form-check-input:checked {
    background-color: #198754;
    border-color: #198754;
}
</style>