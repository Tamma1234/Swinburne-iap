<?php

namespace App\Imports;

use App\Models\Fu\Groups;
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
        $group = [];
        foreach ($input as $key => $value) {
            $group[] = $value['group_name'];
            }
        $group_name = Groups::select('group_name')->groupBy('group_name')->pluck('group_name')->toArray();
        $array_that = array_diff($group, $group_name);
        dd($array_that);
        dd($group);
        dd($input);
    }
}
