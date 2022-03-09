<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoryImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Category([
            'category_name' => $row[0],
            'order_number' => $row[1],
            'category_status' => $row[2],
            'added_on' => \Carbon\Carbon::parse($row[3])->toDateString(),
        ]);
    }
}
