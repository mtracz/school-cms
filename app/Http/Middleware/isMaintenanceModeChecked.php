<?php

namespace App\Http\Middleware;

use Closure;

use App\Helpers\MaintenanceModeHelper;

class isMaintenanceModeChecked {

	//allowed routes if maintenance is ON mode
	protected $allowed_routes = [
		"/maintenance",
		"/login",
		"/login_create",
		"/logout",
		//"/settings",	//ten route do poprawny
	];

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)	{
	
		$response = $next($request);
		$maintenanceModeHelper = new MaintenanceModeHelper();
			//dd($request->user());
		if($maintenanceModeHelper->isMaintenance() && ($request->user() == null)) {
			//dd("1");
			if(! in_array($_SERVER['REQUEST_URI'], $this->allowed_routes)) {
				return redirect()->route("maintenance");
			}			
		}

		// wracamy na index.get jeśli Maintenance == 0 i weszliśmy na route /maintenance
		if(! $maintenanceModeHelper->isMaintenance() && $_SERVER['REQUEST_URI'] == "/maintenance") {
			return redirect()->route("index.get");
		}
		return $response;			
	}
}
