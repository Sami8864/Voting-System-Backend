<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

// This PHP class, functioning as middleware in a Laravel application, extends Laravel's built-in middleware for encrypting cookies and allows specifying the names of cookies that should not be encrypted.

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
