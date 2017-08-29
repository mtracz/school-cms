<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use View;

use App\Models\Settings;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //set local timezone
        date_default_timezone_set("Europe/Warsaw");
        //utf8mb4
        Schema::defaultStringLength(191);

        
        if(Schema::hasTable("settings")) {
            if( Settings::where("name","cookie_text")->first() !== null) {
               $cookie_text = Settings::where("name","cookie_text")->get()->toArray()[0]["value"];

               View::share("cookie_text", $cookie_text);
           }
       } else {
            View::share("cookie_text", "Tu są ciastka!");
       }
   }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
