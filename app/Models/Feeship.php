<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'fee_delivery',
        'fee_matp',
        'fee_maqh',
        'fee_xaid',
        'fee_feeship',
    ];

    protected $primaryKey = 'fee_id';
    protected $table = 'feeship';

    public function delivery(){
        return $this->belongsTo('App\Models\Delivery', 'fee_delivery');
    }
    public function city(){
        return $this->belongsTo('App\Models\City', 'fee_matp');
    }
    public function province(){
        return $this->belongsTo('App\Models\Province', 'fee_maqh');
    }
    public function wards(){
        return $this->belongsTo('App\Models\Wards', 'fee_xaid');
    }
}
