<?php

namespace App\Http\Livewire;

use App\Application\Employees\IndexEmployeeUseCase;
use App\Infrastructure\Employees\EmployeeRepository;
use Livewire\Component;

class Dashboard extends Component
{
    public $searchId;
    public $searchDepartment;
    public $searchInitDate;
    public $searchEndtDate;
    public $searchHasAccess;


    public function render()
    {
        $indexEmployeeUseCase = new IndexEmployeeUseCase(new EmployeeRepository());
        $offset = null;
        $first_name = null;
        $last_name = null;
        $department = $this->searchDepartment;
        $has_access = $this->searchHasAccess;
        $date_init = $this->searchInitDate;
        $date_end = $this->searchEndtDate;
        $id = $this->searchId;

        $employees = $indexEmployeeUseCase->__invoke(
            $offset,
            $first_name,
            $last_name,
            $department,
            $has_access,
            $date_init,
            $date_end,
            $id,
        );
        // dd($has_access);
        return view('livewire.dashboard', compact('employees'));
    }
}
