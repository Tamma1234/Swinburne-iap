<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

abstract class BaseImport implements
    WithChunkReading,
    WithStartRow
{
    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 1;
    }

    /**
     * Import data.
     *
     * @param Collection $collection
     * @return mixed
     */
    public abstract function import(Collection $collection);
}
