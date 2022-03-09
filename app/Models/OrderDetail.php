<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $fillable = [
        'order_id',
        'dish_id',
        'dish_name',
        'dish_price',
        'dish_qty',
    ];
    protected $primaryKey = 'id';
    protected $table = 'order_details';
}
