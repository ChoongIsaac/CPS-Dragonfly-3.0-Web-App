<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mission;

class FlightDetail extends Model
{
    use HasFactory;
    //protected $primaryKey = 'detail_id';
    protected $fillable = ['mission_id', 'detected_qr_code', 'detected_time'];
    //protected $dates = ['start_time', 'end_time'];
    public $timestamps = false;

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    // public static function boot()
    // {
    //     parent::boot();

    //     // static::creating(function ($model) {
    //     //     $model->code = 'FLG' . str_pad(self::max('id') + 1, 3, '0', STR_PAD_LEFT);
    //     // });
    // }
}
