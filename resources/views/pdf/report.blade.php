<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Inspection Report - Wrap Station</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @page {
            margin: 20px;
            size: A4;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            color: #000;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }

        /* HEADER */
        .header {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }
        .header img {
            height: 45px;
        }
        .header h1 {
            font-size: 18pt;
            font-weight: bold;
            margin: 0;
            letter-spacing: 1px;
        }

        /* INFO TABLE */
        .info-table {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 4px 0;
            vertical-align: top;
        }
        .label {
            font-weight: bold;
            width: 130px;
            white-space: nowrap;
            font-size: 9.5pt;
        }

        /* ITEM | PLATE | MILEAGE – RAPI */
        .item-row {
            display: flex;
            justify-content: space-between;
            align-items: stretch;
            margin: 0 40px 18px;
            border-bottom: 1px solid #000;
            padding-bottom: 6px;
        }
        .item-col {
            flex: 1;
            text-align: center;
            padding: 0 12px;
        }
        .item-col .label {
            display: block;
            margin-bottom: 5px;
            font-size: 9pt;
        }
        .item-col strong {
            display: block;
            font-size: 11pt;
            font-weight: bold;
        }

        /* SECTION TITLE */
        .section-title {
            text-align: center;
            font-weight: bold;
            font-size: 11pt;
            border: 1px solid #000;
            background: #f0f0f0;
            padding: 6px;
            margin: 20px 0 10px;
        }

        /* INSPECTION TABLE */
        .inspection-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 9.5pt;
        }
        .inspection-table th,
        .inspection-table td {
            border: 1px solid #000;
            padding: 7px;
            text-align: center;
        }
        .inspection-table th {
            background: #e0e0e0;
            font-weight: bold;
        }

        .page-header {
            position: running(header);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 3px solid #000;
            margin-bottom: 15px;
        }
        .page-header .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .page-header .logo img {
            height: 50px;
        }
        .page-header .report-box {
            border: 2px solid #000;
            padding: 6px 18px;
            text-align: center;
            font-weight: bold;
            font-size: 11pt;
            line-height: 1.2;
            white-space: nowrap;
        }
        /* CHECKBOX – MUNCUL DI PRINT (PAKAI ::after) */
        .checkbox {
            width: 13px;
            height: 13px;
            border: 1.8px solid #000;
            display: inline-block;
            margin: 0 auto;
            position: relative;
            box-sizing: border-box;
        }
        .checkbox.checked::after {
            content: '';
            position: absolute;
            top: 1.5px;
            left: 1.5px;
            width: 8px;
            height: 8px;
            background: #000;
            display: block;
        }

        /* REMARKS */
        .remarks {
            margin: 20px 0;
            font-size: 8.5pt;
            line-height: 1.5;
        }
        .remarks strong {
            display: inline-block;
            width: 60px;
        }

        /* FOOTER NOTE */
        .footer-note {
            text-align: center;
            font-weight: bold;
            font-size: 9pt;
            margin-top: 25px;
            padding-top: 10px;
            border-top: 1px solid #000;
        }

        /* PAGE BREAK */
        .page-break {
            page-break-before: always;
        }

        /* PHOTO GRID */
        .photo-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 30px 40px;
        }
        .photo-item {
            text-align: center;
        }
        .photo-item img {
            width: 100%;
            max-height: 260px;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .photo-item p {
            margin: 8px 0 0;
            font-weight: bold;
            font-size: 10pt;
        }

        /* INSPECTION PHOTO */
        .inspection-photo {
            page-break-inside: avoid;
            margin: 25px 40px;
        }
        .inspection-photo h3 {
            border-bottom: 1px solid #000;
            padding-bottom: 4px;
            margin: 0 0 12px;
            font-size: 11pt;
            font-weight: bold;
        }
        .inspection-photo .image-container {
            text-align: center;
        }
        .inspection-photo img {
            width: 80%;
            max-height: 320px;
            object-fit: contain;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .no-image {
            width: 80%;
            height: 200px;
            margin: 0 auto;
            border: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            background: #f9f9f9;
            font-size: 12pt;
            border-radius: 4px;
        }

        /* SIGNATURE */
        .signature-block {
            margin-top: 60px;
            text-align: center;
            page-break-inside: avoid;
        }
        .signature-block p {
            margin: 0 0 5px;
            font-weight: bold;
            font-size: 11pt;
        }
        .signature-line {
            display: inline-block;
            width: 340px;
            border-bottom: 2px solid #000;
            padding: 15px 0;
        }
        .signature-line img {
            height: 70px;
            vertical-align: middle;
        }
        .customer-name {
            margin: 8px 0 0;
            font-weight: bold;
            font-size: 12pt;
            text-transform: uppercase;
        }

        /* TERMS LIST */
        .terms-list {
            margin: 0 50px;
            font-size: 10pt;
            line-height: 1.6;
        }
        .terms-list ol {
            padding-left: 22px;
            margin: 0;
        }
        .terms-list li {
            margin-bottom: 8px;
        }

        /* PRINT: PAKSA WARNA & UKURAN */
        @media print {
            @page { margin: 15px; }
            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .checkbox.checked::after {
                background: #000 !important;
            }
        }
    </style>
</head>
<body>
@php
    // Helper: Konversi gambar ke base64
    function imgToBase64($path) {
        if ($path && file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $base64;
        }
        return null;
    }

    $logoPath = public_path('images/logo.png');
    $logoBase64 = imgToBase64($logoPath);
@endphp

    <!-- HALAMAN 1 -->
    <div class="page-header">
        <table class="inspection-table" border=0>
            <tbody>
                <tr>
                   <td style="border: 0!important;">
                    <div class="logo">
                        <img src="{{ $logoBase64 }}" alt="Wrap Station">
                    </div>
                   </td>

                   <td style="border: 0!important;">
                    <div class="report-box">
                        INSPECTION<br>REPORT
                    </div>
                   </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="content">
        <table class="info-table">
            <tr>
                <td class="label">CUSTOMER</td>
                <td>: {{ $ws->customer_front_name }} {{ $ws->customer_last_name }}</td>
                <td class="label">INSPECTION #</td>
                <td>: WS{{ $ws->id }}{{ now()->format('Y') }}</td>
            </tr>
            <tr>
                <td class="label">INVOICE #</td>
                <td>: {{ $ws->invoice_number ?? 'WS251152541022' }}</td>
                <td class="label">DATE</td>
                <td>: {{ \Carbon\Carbon::parse($ws->inspection_date)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="label">INSPECTOR</td>
                <td>: {{ $ws->inspector_name ?? 'AGUS' }}</td>
                <td class="label">LOCATION</td>
                <td>: WRAP STATION MEDAN</td>
            </tr>
        </table>

        <table class="inspection-table">
            <thead>
                <tr>
                    <th>ITEM</th>
                    <th>LICENSE PLATE</th>
                    <th>MILEAGE (KM)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                   <td><strong>{{ $ws->car_brand }} {{ $ws->car_model }}</strong></td>

                   <td><strong>{{ $ws->car_brand }} {{ $ws->license_plate }}</strong></td>

                   <td><strong>{{ $ws->car_brand }} {{ $ws->mileage }}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="section-title">ITEM INSPECTIONS</div>

        <table class="inspection-table">
            <thead>
                <tr>
                    <th>ARTICLE</th>
                    <th colspan="3">CONDITIONS</th>
                    <th>NOTES</th>
                </tr>
                <tr>
                    <th></th>
                    <th width="40">G</th>
                    <th width="40">F</th>
                    <th width="40">P</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $order = [
                        'paint' => '1. Paint',
                        'glass_windshield' => '2. Windshield',
                        'glass_windows' => '3. Windows',
                        'glass_mirrors' => '4. Mirrors',
                        'glass_rear_window' => '5. Rear Window',
                        'tires_tires' => '6. Tires',
                        'tires_wheels' => '7. Wheels'
                    ];
                @endphp
                @foreach($order as $field => $label)
                    @php
                        $item = $ws->inspections->firstWhere('item_name', str_replace(['1. ', '2. ', '3. ', '4. ', '5. ', '6. ', '7. '], '', $label));
                    @endphp
                    <tr>
                        <td style="text-align:left; padding-left:12px;">{{ $label }}</td>
                        <td><span class="checkbox {{ $item && $item->condition === 'G' ? 'checked' : '' }}"></span></td>
                        <td><span class="checkbox {{ $item && $item->condition === 'F' ? 'checked' : '' }}"></span></td>
                        <td><span class="checkbox {{ $item && $item->condition === 'P' ? 'checked' : '' }}"></span></td>
                        <td style="text-align:left; padding-left:8px;">{{ $item->note ?? 'TEST' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="remarks">
            <strong>Remarks :</strong><br>
            <strong>G = GOOD</strong> – This item is in good condition...<br>
            <strong>F = FAIR</strong> – This item is in fair condition...<br>
            <strong>P = POOR</strong> – This item is in poor condition...
        </div>

        <div class="footer-note">
            DETAILED PHOTOGRAPH PRESENTED ON THE LATER PAGES
        </div>
    </div>

    <!-- HALAMAN 2 -->
    <div class="page-break">
        <div class="page-header">
            <table class="inspection-table" border=0>
                <tbody>
                    <tr>
                       <td style="border: 0!important;">
                        <div class="logo">
                            <img src="{{ $logoBase64 }}" alt="Wrap Station">
                        </div>
                       </td>

                       <td style="border: 0!important;">
                        <div class="report-box">
                            INSPECTION<br>REPORT
                        </div>
                       </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="content">
            <h2 style="text-align:center; margin:30px 0 20px; font-size:14pt; border-bottom:2px solid #000; padding-bottom:6px;">
                CAR
            </h2>

            <div class="photo-grid">
                @foreach(['front','rear','left','right'] as $pos)
                    @php 
                        $photo = $ws->photos->where('position', $pos)->first();
                        $photoPath = $photo ? public_path('storage/' . $photo->photo_path) : null;
                        $itemBase64 = imgToBase64($photoPath);
                    @endphp
                    <div class="photo-item">
                        <!-- <p>{{ strtoupper(str_replace('_', ' ', $pos)) }} VIEW</p> -->
                        @if($itemBase64)
                            <img src="{{ $itemBase64 }}" alt="{{ $pos }}">
                        @else
                            <div class="no-image">No Photo</div>
                        @endif
                    </div>
                @endforeach
            </div>

            @foreach($order as $field => $label)
                @php 
                    $item = $ws->inspections->firstWhere('item_name', str_replace(['1. ', '2. ', '3. ', '4. ', '5. ', '6. ', '7. '], '', $label));
                    $itemPath = $item && $item->image_path ? public_path('storage/' . $item->image_path) : null;
                    $itemBase64 = imgToBase64($itemPath);
                @endphp
                <div class="inspection-photo">
                    <h3>{{ $label }}</h3>
                    <div class="image-container">
                        @if($itemBase64)
                            <img src="{{ $itemBase64 }}" alt="{{ $label }}">
                        @else
                            <div class="no-image">No Image</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- HALAMAN 3 -->
    <div class="page-break">
        <div class="page-header">
            <table class="inspection-table" border=0>
                <tbody>
                    <tr>
                       <td style="border: 0!important;">
                        <div class="logo">
                            <img src="{{ $logoBase64 }}" alt="Wrap Station">
                        </div>
                       </td>

                       <td style="border: 0!important;">
                        <div class="report-box">
                            INSPECTION<br>REPORT
                        </div>
                       </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="content">
            <div class="terms-list">
                <ol>
                    <li>Penambahan jarak tempuh (mileage) bisa terjadi, dan bukan tanggung jawab Wrap Station.</li>
                    <li>Kerusakan/malfungsi mesin selama atau setelah pengerjaan bukan tanggung jawab kami.</li>
                    <li>Kerusakan akibat pembongkaran aksesori oleh pihak lain bukan tanggung jawab kami.</li>
                    <li>Kebersihan barang pribadi bukan tanggung jawab Wrap Station. Harap kosongkan kendaraan.</li>
                    <li>Wrap Station berhak melakukan tindakan teknis bila diperlukan dan disetujui sebelumnya.</li>
                    <li>Kondisi/modifikasi khusus yang tidak diinformasikan menjadi tanggung jawab pemilik.</li>
                    <li>Pemurnian baterai EV adalah kondisi alami, bukan tanggung jawab kami.</li>
                    <li>Estimasi pengerjaan dapat berubah. Keterlambatan akan diinformasikan ke pelanggan.</li>
                    <li>Dengan menandatangani, Anda menyatakan menyetujui semua syarat dan ketentuan ini.</li>
                </ol>
            </div>

            <div class="signature-block">
                @php 
                    $sigPath = $ws->signature_path ? public_path('storage/' . $ws->signature_path) : null;
                    $itemBase64 = imgToBase64($sigPath);
                @endphp
                <p>Customer Signature :</p>
                <div class="signature-line">
                    @if($itemBase64)
                        <img src="{{ $itemBase64 }}" alt="Signature">
                    @else
                        <span style="color:#999;">[No Signature]</span>
                    @endif
                </div>
                <p class="customer-name">
                    {{ strtoupper($ws->customer_front_name . ' ' . $ws->customer_last_name) }}
                </p>
            </div>
        </div>
    </div>

</body>
</html>