<?php

namespace App\Exports;

use App\Models\Slot;
use Maatwebsite\Excel\Concerns\FromCollection;

class SlotsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Slot::all();
    }
}
