<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;

class OrderImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Order([
            'customer_id' => $row[0],
            'shipping_id' => $row[1],
            'order_total' => $row[2],
            'order_date' => \Carbon\Carbon::parse($row[3])->toDateString(),
            'order_status' => $row[4],
        ]);
    }
}
