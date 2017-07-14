<?php

namespace App\Http\Middleware;

use Closure;

use App\Helpers\VisitHelper;

class VisitMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)	{

		$visitHelperObject = new VisitHelper();

		if(! $visitHelperObject->checkUniqueVisitCookie()) {   
			$visitHelperObject->createUniqueVisitCookie();
			$visitHelperObject->updateUniqueVisits();
		}

		return $next($request);
	}
}