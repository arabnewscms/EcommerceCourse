<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next = null, $guard = null) {
		if (Auth::guard($guard)->check()) {
			return $next($request);
			// return redirect('admin');
		} else {
			return redirect('admin/login');
		}

	}
}
