<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

// This PHP class, acting as middleware in a Laravel application, extends Laravel's built-in middleware for trimming request input strings and specifies the attributes that should not be trimmed, such as passwords.

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array<int, string>
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}
