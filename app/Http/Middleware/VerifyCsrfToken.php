<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

// This PHP class acts as middleware in a Laravel application, extending Laravel's built-in VerifyCsrfToken middleware. It allows specifying the URIs that should be excluded from CSRF (Cross-Site Request Forgery) token verification. By defining these exceptions, certain routes or endpoints can be exempted from CSRF protection, typically for endpoints used by APIs or for specific functionalities where CSRF protection is unnecessary or handled differently.

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
