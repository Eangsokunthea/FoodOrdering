<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $fillable = [
        'coupon_name',
        'coupon_code',
        'coupon_type',
        'coupon_value',
        'coupon_min_value',
        'expired_on',  
        'coupon_status',  
        'added_on',    
    ];

    protected $primaryKey = 'coupon_id';
    protected $table = 'coupons';
}
