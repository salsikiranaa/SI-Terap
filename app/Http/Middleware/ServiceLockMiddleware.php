<?php

namespace App\Http\Middleware;

use App\Models\mService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;

class ServiceLockMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $guard): Response
    {
        if (!$guard) return back()->withErrors('internal server error');
        $check = mService::find($guard);
        if ($check->is_locked) return redirect()->route('service.locked', Crypt::encryptString($guard));
        return $next($request);
    }
}
