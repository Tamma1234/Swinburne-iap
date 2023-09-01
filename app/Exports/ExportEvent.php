<?php

namespace App\Exports;

use App\Models\StudentEvent;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class ExportEvent implements FromView
{
    use RegistersEventListeners;

    public $events;

    public function __construct(array $events)
    {
        $this->events = $events;
    }

    public function view(): View
    {
        foreach ($this->events as $items) {
            $event = $items;
            return view('admin.events.export-event', [
                'events' => $event
            ]);
        }
    }
}
