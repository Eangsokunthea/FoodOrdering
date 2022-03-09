<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'delivery_name',
        'delivery_phone_number',
        'delivery_password',
        'delivery_status',
        'added_on',  
    ];
    protected $primaryKey = 'delivery_id';
    protected $table = 'delivery';
}
