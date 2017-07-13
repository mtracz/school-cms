<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

use App\Helpers\MaintenanceModeHelper;

class isMaintenanceModeChecked {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		$maintenanceModeHelper = new MaintenanceModeHelper();

		if($maintenanceModeHelper->isMaintenance() && ! $request->user()) {
			return redirect("maintenance");
		} else {

			return $next($request);
		}
		
	}
}
