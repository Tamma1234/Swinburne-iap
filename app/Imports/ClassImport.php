<?php

namespace App\Imports;

use App\Models\Fu\Groups;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ClassImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        dd($collection);
    }
}
