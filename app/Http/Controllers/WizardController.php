<?php

namespace App\Http\Controllers;

use App\Models\WrapStation;
use App\Models\InspectionItem;
use App\Models\WrapStationPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WizardController extends Controller
{
    public function index()
    {
        return view('wizard.wizard');
    }

    public function store(Request $request)
    {
        // DEBUG: LIHAT SEMUA DATA MASUK
        // dd($request->all(), $request->files->all());

        $ws = WrapStation::create($request->only([
            'customer_front_name', 'customer_last_name', 'customer_phone',
            'car_brand', 'car_model', 'color', 'year', 'license_plate', 'inspection_date'
        ]));
        $ws->terms_agreed = true;

        // Signature
        $img = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->signature));
        $path = 'signatures/' . $ws->id . '.png';
        Storage::disk('public')->put($path, $img);
        $ws->signature_path = $path;

        // Simpan inspeksi
        // $items = [];
        foreach ($request->all() as $key => $value) {
            if (str_ends_with($key, '_condition') && $value) {
                $field = str_replace('_condition', '', $key);
                $imageKey = $field . '_image';

                $imagePath = null;
                if ($request->hasFile($imageKey)) {
                    $imagePath = $request->file($imageKey)->store('inspections', 'public');
                }

                $parts = explode('_', $field);
                $category = ucfirst($parts[0]);
                $item_name = count($parts) > 1
                    ? ucwords(str_replace('_', ' ', implode(' ', array_slice($parts, 1))))
                    : ucfirst($parts[0]);

                
                // $items[] = $item_name;
                InspectionItem::create([
                    'wrap_station_id' => $ws->id,
                    'category' => $category,
                    'item_name' => $item_name,
                    'condition' => $value,
                    'note' => $request->input($field . '_note', ''),
                    'image_path' => $imagePath
                ]);
            }
        }
        // dd($items);

        // Simpan foto
        foreach (['front', 'rear', 'left', 'right'] as $pos) {
            $key = $pos . '_photo';
            if ($request->hasFile($key)) {
                $path = $request->file($key)->store('photos', 'public');
                WrapStationPhoto::create([
                    'wrap_station_id' => $ws->id,
                    'position' => $pos,
                    'photo_path' => $path
                ]);
            }
        }

        $ws->save();
        return response()->json(['id' => $ws->id]);
    }
}