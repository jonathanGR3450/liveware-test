<?php

namespace App\Http\Livewire;

use App\Application\Employees\HistoryEmployeeUseCase;
use Livewire\Component;

class History extends Component
{
    public $historyId;
    public $searchInitDate;
    public $searchEndtDate;


    public function render(HistoryEmployeeUseCase $historyEmployeeUseCase)
    {
        $histories = $historyEmployeeUseCase->__invoke(
            $this->historyId,
            null,
            $this->searchInitDate,
            $this->searchEndtDate,
        );
        return view('livewire.history', compact('histories'));
    }
}
