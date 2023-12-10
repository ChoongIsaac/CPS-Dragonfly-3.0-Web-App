<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FlightDetail;


class Mission extends Model
{
    use HasFactory;
    protected $primaryKey = 'mission_id';
    protected $fillable = ['start_time', 'end_time','flight_path'];

    public function flightDetail()
    {
        return $this->hasMany(FlightDetail::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->code = 'MSN' . str_pad(self::max('id') + 1, 3, '0', STR_PAD_LEFT);
        });
    }
}
