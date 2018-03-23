<?php

namespace App\Http\Middleware;

use Closure;

class Lang {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		app()->setLocale(lang());
		return $next($request);
	}
}
