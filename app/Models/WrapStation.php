<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrapStation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'inspection_date' => 'date',
        'terms_agreed' => 'boolean'
    ];

    public function inspections()
    {
        return $this->hasMany(InspectionItem::class);
    }

    public function photos()
    {
        return $this->hasMany(WrapStationPhoto::class);
    }
}
