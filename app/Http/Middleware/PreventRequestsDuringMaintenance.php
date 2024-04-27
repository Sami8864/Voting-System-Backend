<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;


// This PHP class, acting as middleware in a Laravel application, extends Laravel's built-in middleware for preventing requests during maintenance mode and allows specifying the URIs that should remain reachable while maintenance mode is enabled.

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
