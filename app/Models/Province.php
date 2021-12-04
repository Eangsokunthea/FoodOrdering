<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $fillable = [
        'maqh',
        'name_quanhuyen',
        'type',
        'matp',
    ];

    protected $primaryKey = 'maqh';
    protected $table = 'devvn_quanhuyen';
}