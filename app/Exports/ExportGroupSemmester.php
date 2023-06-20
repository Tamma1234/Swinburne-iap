<?php

namespace App\Exports;

use App\Models\Fu\Groups;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Config;

class ExportGroupSemmester implements FromView
{
    use RegistersEventListeners;

    public $groups;

    public function __construct(array $groups)
    {
        $this->groups = $groups;
    }

    public function view(): View
    {
       foreach ($this->groups as $items) {
           $group = $items;
              return view('admin.groups.export', [
                  'groups' => $group
              ]);
       }
    }
}
