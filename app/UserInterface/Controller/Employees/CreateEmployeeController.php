<?php

namespace App\UserInterface\Controller\Employees;

use App\Application\Employees\CreateEmployeeUseCase;
use App\Infrastructure\Laravel\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;

class CreateEmployeeController extends Controller
{
    private CreateEmployeeUseCase $createEmployeeUsercase;

    public function __construct(CreateEmployeeUseCase $createEmployeeUsercase)
    {
        $this->createEmployeeUsercase = $createEmployeeUsercase;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // dd($request->img_file);
        $employee = $this->createEmployeeUsercase->__invoke(
            $request->input('first_name'),
            $request->input('last_name'),
            $request->input('department'),
            $request->input('has_access'),
            $request->input('email'),
            $request->input('password'),
            $request->img_file,
        );

        return redirect()->route('employees.index')->with('status', "Employee {$employee->id()->value()} was created success!");
    }
}
