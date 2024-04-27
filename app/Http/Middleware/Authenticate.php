<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

// This PHP class, serving as middleware in a Laravel application, extends Laravel's built-in authentication middleware and defines a method to redirect unauthenticated users either to the login route or to a JSON response based on the request expectation.

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
