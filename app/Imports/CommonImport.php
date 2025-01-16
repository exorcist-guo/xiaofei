<?php

namespace App\Imports;

use App\Models\Common;
use Maatwebsite\Excel\Concerns\ToModel;

class CommonImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Common([
            //
        ]);
    }
}
