<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "K2giMbO1fOZ4dGre9YYAbrnamNVLAz6TJb2POPdVu4b0KSSYK7CybTI25N2kz77V",
    ];
}
