<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\WrapStation;

class WrapStationPhoto extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function wrapStation()
    {
        return $this->belongsTo(WrapStation::class);
    }
}
