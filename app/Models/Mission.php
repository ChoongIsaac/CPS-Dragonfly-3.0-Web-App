<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FlightDetail;


class Mission extends Model
{
    use HasFactory;
    protected $primaryKey = 'mission_id';
    protected $fillable = ['mission_id','start_time', 'end_time','flight_path'];
    protected $casts = [
        'flight_path' => 'array',
        'mission_id' => 'string', // Ensure mission_id is casted as string
        

    ];
    public $timestamps = false;

    public function flightDetail()
    {
        return $this->hasMany(FlightDetail::class, 'mission_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // $model->mission_id = 'MSN' . str_pad((int)self::max('mission_id') + 1, 3, '0', STR_PAD_LEFT);
            $model->mission_id = 'MSN' . str_pad((int) self::max('mission_id') + 1, 3, '0', STR_PAD_LEFT);

        });
    }
}
