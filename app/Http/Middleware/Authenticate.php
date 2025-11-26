<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        // Kalau belum login dan akses route yang butuh login, arahkan ke login page
        return $request->expectsJson() ? null : route('login');
    }
}
