<?php

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ValidateSignature as Middleware;

// This PHP class serves as middleware in a Laravel application, extending Laravel's built-in ValidateSignature middleware. It allows specifying query string parameters that should be ignored during signature validation. By defining these exceptions, certain query string parameters can be excluded from affecting the signature validation process.

class ValidateSignature extends Middleware
{
    /**
     * The names of the query string parameters that should be ignored.
     *
     * @var array<int, string>
     */
    protected $except = [
        // 'fbclid',
        // 'utm_campaign',
        // 'utm_content',
        // 'utm_medium',
        // 'utm_source',
        // 'utm_term',
    ];
}
