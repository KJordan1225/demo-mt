<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\URL;

class SetTenantUrlDefaults
{
    public function handle($request, Closure $next)
    {
        // Works for stancl/tenancy once tenancy() is initialized
        if (function_exists('tenant') && tenant()) {
            URL::defaults(['tenant' => tenant('id')]);
        } elseif ($request->route('tenant')) {
            URL::defaults(['tenant' => $request->route('tenant')]);
        }

        return $next($request);
    }
}
