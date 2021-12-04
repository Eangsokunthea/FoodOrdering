<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'matp',
        'name_city',
        'type',
    ];

    protected $primaryKey = 'matp';
    protected $table = 'devvn_tinhthanhpho';        
}
