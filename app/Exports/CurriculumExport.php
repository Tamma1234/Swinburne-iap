<?php

namespace App\Exports;

use App\Models\Curriculum;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class CurriculumExport implements FromView
{
    public $curriculums;

    public function __construct(array $curriculums)
    {
        $this->curriculums = $curriculums;
    }

    public function view(): View
    {
        foreach ($this->curriculums as $items) {
            $curriculums = $items;
            return view('admin.curriculums.export-student', [
                'curriculums' => $curriculums
            ]);
        }
    }
}
