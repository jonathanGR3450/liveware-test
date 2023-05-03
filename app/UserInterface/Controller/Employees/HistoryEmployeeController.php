<?php

namespace App\UserInterface\Controller\Employees;

use App\Application\Employees\HistoryEmployeeUseCase;
use App\Infrastructure\Laravel\Controller;
use Illuminate\Http\Request;

class HistoryEmployeeController extends Controller
{
    private HistoryEmployeeUseCase $historyEmployeeUseCase;

    public function __construct(HistoryEmployeeUseCase $historyEmployeeUseCase) {
        $this->historyEmployeeUseCase = $historyEmployeeUseCase;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, string $id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('histories.index', compact('id'));
    }
}
