<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class Item extends Model
{
    use HasFactory;

    use Sortable;

    public $timestamps=false;

    protected $fillable = [

        'item_name',
        'rfid_id',
        'quantity',
        'customer',
        'location',
        'checkInDate',
        'checkOutDate',
        'release',
        'status',
    ];
    
    public $sortable = [

        'item_name',
        'quantity',
        'customer',
        'location',
        'status',
    ];
}
