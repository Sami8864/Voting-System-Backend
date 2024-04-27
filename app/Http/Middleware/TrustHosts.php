<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

// This PHP class is a middleware in a Laravel application, extending Laravel's built-in TrustHosts middleware. It defines the host patterns that should be trusted. In this case, it returns an array containing all subdomains of the application URL. This helps to ensure that requests with trusted hosts are allowed through the middleware.

class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array<int, string|null>
     */
    public function hosts(): array
    {
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}
