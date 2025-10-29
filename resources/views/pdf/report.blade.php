<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .signature { margin-top: 50px; text-align: center; }
        img { max-width: 100%; height: auto; }
    </style>
</head>
<body>
    <div class="header">
        <h2>WRAP STATION - LAPORAN INSPEKSI</h2>
        <p><strong>ID:</strong> #{{ $ws->id }} | <strong>Tanggal:</strong> {{ $ws->inspection_date->format('d/m/Y') }}</p>
    </div>

    <h3>Data Pelanggan</h3>
    <p><strong>Nama:</strong> {{ $ws->customer_front_name }} {{ $ws->customer_last_name }}</p>
    <p><strong>No. HP:</strong> {{ $ws->customer_phone }}</p>
    <p><strong>Kendaraan:</strong> {{ $ws->car_brand }} {{ $ws->car_model }} ({{ $ws->year }}) - {{ $ws->color }}</p>
    <p><strong>No. Polisi:</strong> {{ $ws->license_plate }}</p>

    <h3>Inspeksi Kondisi</h3>
    @foreach($ws->inspections->groupBy('category') as $cat => $items)
        <h4>{{ $cat }}</h4>
        <table>
            <tr><th>Item</th><th>Kondisi</th><th>Catatan</th></tr>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->item_name }}</td>
                    <td><strong>{{ $item->condition }}</strong></td>
                    <td>{{ $item->note ?: '-' }}</td>
                </tr>
            @endforeach
        </table>
    @endforeach

    <h3>Foto Posisi</h3>
    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
        @foreach($ws->photos as $photo)
            <div style="flex: 1; min-width: 200px;">
                <p><strong>{{ ucfirst($photo->position) }}</strong></p>
                <img src="{{ public_path('storage/' . $photo->photo_path) }}" style="max-height: 200px;">
            </div>
        @endforeach
    </div>

    <div class="signature">
        <p><strong>Tanda Tangan Pelanggan</strong></p>
        <img src="{{ public_path('storage/' . $ws->signature_path) }}" style="max-height: 100px;">
    </div>
</body>
</html>