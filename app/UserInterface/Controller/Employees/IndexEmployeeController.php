<?php

namespace App\UserInterface\Controller\Employees;

use App\Application\Employees\IndexEmployeeUseCase;
use App\Infrastructure\Laravel\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;

class IndexEmployeeController extends Controller
{
    private IndexEmployeeUseCase $indexEmployeeUseCase;

    public function __construct(IndexEmployeeUseCase $indexEmployeeUseCase) {
        $this->indexEmployeeUseCase = $indexEmployeeUseCase;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('dashboard');
    }
}
