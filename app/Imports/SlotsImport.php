<?php

namespace App\Imports;

use App\Models\Slot;
use Maatwebsite\Excel\Concerns\ToModel;

class SlotsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Slot([
            'start_time' => $row[1],
            'end_time' => $row[2],
        ]);
    }
}
