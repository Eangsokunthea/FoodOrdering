<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    protected $fillable = [
        'dish_name',
        'dish_detail',
        'dish_image',
        'dish_status',
        'category_id',
        'added_on', 
        'full', 
        'full_price', 
        'half',
        'half_price',  

    ];
    protected $primaryKey = 'dish_id';
    // protected $table = 'dishes';

}
