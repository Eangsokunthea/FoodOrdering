<?php

namespace App\Imports;

use App\Models\Dish;
use Maatwebsite\Excel\Concerns\ToModel;
// use Carbon\Carbon;

class ExcelImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Dish([
            'category_id' => $row[0],
            'dish_name' => $row[1],
            'dish_detail' => $row[2],
            'dish_image' => $row[3],
            'dish_status' => $row[4],
            'added_on' => \Carbon\Carbon::parse($row[5])->toDateString(),
            'full_price' => $row[6], 
            'half_price' => $row[7],  
        ]);
    }
}
