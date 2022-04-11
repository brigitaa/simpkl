<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$role)
    {
        foreach ($role as $key => $value) {
            if (session('role') == $value) {    
                // dd($role->name);
                return $next($request);
            }
        }
        return redirect()->back()->with('error',"Anda tidak dapat mengakses halaman ini");
    }
}
