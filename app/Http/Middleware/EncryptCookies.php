<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * Nama cookies yang tidak dienkripsi.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
