<?php

namespace App\UserInterface\Controller\Employees;

use App\Infrastructure\Laravel\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutEmployeeController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employee.login.form')->with('status', 'Employee logout successfull!');
    }
}
