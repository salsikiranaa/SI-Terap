<?php

namespace App\Http\Middleware;

use App\Models\pServiceAccess;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ServiceAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $guard): Response
    {
        $user_services = pServiceAccess::where('user_id', Auth::user()->id)->get();
        // $user_services = User::find(Auth::user()->id)->service;
        // dd($user_services);
        if (count($user_services) == 0) return redirect()->route('auth.no_service');
        foreach ($user_services as $service) {
            if ($service->service_id == $guard && !$service->is_locked) return $next($request);
        }
        return redirect()->route('home');
    }
}
