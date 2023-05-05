<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
// use Illuminate\Routing\Route; //元から
use Illuminate\Support\Facades\Route; //追加

class Authenticate extends Middleware
{
    protected $user_route = 'user.login';
    protected $admin_route = 'admin.login';

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */

    // protected function redirectTo(Request $request): ?string
    // {
    //     return $request->expectsJson() ? null : route('login');
    // }

    protected function redirectTo($request)
    {
        if(! $request->expectsJson()) {
            if(Route::is('admin.*')) {
                return route($this->admin_route);
            } else {
                return route($this->user_route);
            }
        }
    }
}

