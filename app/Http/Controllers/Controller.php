<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// This PHP class extends Laravel's base controller, providing authorization and validation functionalities through traits.

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
