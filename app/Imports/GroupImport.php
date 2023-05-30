<?php

namespace App\Imports;

use App\Models\Fu\Groups;
use App\Service\Service;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GroupImport extends BaseImport
{
    /**
     * Import data.
     *
     * @param Collection $collection
     * @return mixed
     */
    public function import(Collection $collection)
    {
        $input = [];
        $quantity = 0;
        foreach ($collection as $childCollection) {
            $keys = $childCollection[0]->toArray();
            $childCollection->forget(0);
            foreach ($childCollection as $value) {
                foreach ($keys as $index => $field) {

                    $input[$quantity][$field] = $value[$index];
                }
                ++$quantity;
            }
        }
        $import = Service::getGroup()->checkGroupName($input);

        return $import;
    }
}
