<div class="card card-modern">
    <div class="card-header">
        <h5 class="mb-0 fw-semibold"><i class="bi bi-file-text me-2"></i> Syarat & Ketentuan</h5>
    </div>
    <div class="card-body">
        <!-- Syarat & Ketentuan -->
        <div class="border p-3 mb-4 rounded-3" 
             style="height: 230px; overflow-y: auto; background: #f8f9fa; font-size: 0.9rem; line-height: 1.6;">
            <ol class="mb-0 ps-3">
                <li>Kondisi kendaraan dapat berubah setelah pembersihan. Tim akan menginformasikan jika ada perubahan.</li>
                <li>Status cat kendaraan (repaint/original) tidak dapat dipastikan, risiko ditanggung pemilik.</li>
                <li>Penambahan jarak tempuh (mileage) bisa terjadi, dan bukan tanggung jawab Wrap Station.</li>
                <li>Kerusakan/malfungsi mesin selama atau setelah pengerjaan bukan tanggung jawab kami.</li>
                <li>Kerusakan akibat pembongkaran aksesoris oleh pihak lain bukan tanggung jawab kami.</li>
                <li>Kehilangan barang pribadi bukan tanggung jawab Wrap Station. Harap kosongkan kendaraan.</li>
                <li>Wrap Station berhak melakukan tindakan teknis bila diperlukan dan disetujui sebelumnya.</li>
                <li>Kondisi/modifikasi khusus yang tidak diinformasikan menjadi tanggung jawab pemilik.</li>
                <li>Penurunan baterai EV adalah kondisi alami, bukan tanggung jawab kami.</li>
                <li>Estimasi pengerjaan dapat berubah, keterlambatan akan diinformasikan ke pelanggan.</li>
            </ol>
        </div>

        <!-- Checkbox Persetujuan -->
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="agree" required>
            <label class="form-check-label" for="agree">
                Saya telah membaca dan menyetujui syarat & ketentuan di atas
            </label>
        </div>

        <!-- Signature Area -->
        <div class="mb-4">
            <label class="form-label fw-bold">Tanda Tangan</label>
            <div class="d-flex flex-column align-items-start">
                <div class="signature-container border rounded-3 bg-white shadow-sm mb-2">
                    <canvas id="signatureCanvas" class="border rounded-3"></canvas>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearSignature()">
                    <i class="bi bi-trash3"></i> Hapus
                </button>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="button" class="btn btn-success px-5 py-2 rounded-pill shadow-sm"
                    onclick="handleFinalSubmit()">
                <i class="bi bi-send-check"></i> Submit
            </button>
        </div>
    </div>
</div>

<!-- Signature Pad + Responsif -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>

let signaturePad;
let canvas;

    function dataURLtoBlob(dataurl) {
        const arr = dataurl.split(',');
        const mime = arr[0].match(/:(.*?);/)[1];
        const bstr = atob(arr[1]);
        let n = bstr.length;
        const u8arr = new Uint8Array(n);
        while (n--) u8arr[n] = bstr.charCodeAt(n);
        return new Blob([u8arr], { type: mime });
    }

    window.addEventListener('DOMContentLoaded', () => {
        canvas = document.getElementById('signatureCanvas');
        const container = canvas.parentElement;

        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            const size = 270; // persegi 200px
            canvas.width = size * ratio;
            canvas.height = size * ratio;
            const ctx = canvas.getContext('2d');
            ctx.scale(ratio, ratio);
            canvas.style.width = size + 'px';
            canvas.style.height = size + 'px';
            signaturePad?.clear();
        }

        // Tambahkan delay agar ukuran layout sudah fix sebelum resizeCanvas dipanggil
        setTimeout(() => {
            resizeCanvas();
            signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)',
                penColor: 'rgb(0, 0, 0)'
            });
        }, 200);

        window.addEventListener('resize', () => {
            resizeCanvas();
        });
    });

    function clearSignature() {
        signaturePad.clear();
    }

</script>

<style>
    .signature-container {
        width: 270px;
        height: 270px;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }
    #signatureCanvas {
        width: 100%;
        height: 100%;
        cursor: crosshair;
        touch-action: none;
    }
    .btn i {
        vertical-align: middle;
    }
</style>