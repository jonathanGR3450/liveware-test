<?php

namespace App\Infrastructure\Laravel\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        $middleware = request()->route()->gatherMiddleware();
        $guard = config('auth.defaults.guard');
        foreach($middleware as $m) {
            if(preg_match("/auth:/", $m)) {
                list($mid, $guard) = explode(":", $m);
            }
        }

        if (!$request->expectsJson()) {
            switch ($guard) {
                case 'web':
                    return route('login');
                    break;
                case 'employee':
                    return route('employee.login.form');
                    break;
                default:
                return route('login');
                    break;
            }

        }
    }
}
