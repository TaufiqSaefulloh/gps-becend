<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * URIs yang tidak perlu dicek CSRF.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
