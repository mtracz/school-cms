let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

//semantic
mix.copy("node_modules/semantic-ui/dist/semantic.min.js", "public/js")
	.copy("node_modules/semantic-ui/dist/semantic.min.css", "public/css");

//semantic calendar
mix.copy("node_modules/semantic-ui-calendar/dist/calendar.min.js", "public/js")
	.copy("node_modules/semantic-ui-calendar/dist/calendar.min.css", "public/css");

// jquery
mix.copy("node_modules/jquery/dist/jquery.min.js", "public/js/jquery.min.js");

//admin create
mix.scripts("resources/assets/js/adminCreate.js", "public/js/adminCreate.js")
	.styles("resources/assets/css/adminCreate.css", "public/css/adminCreate.css");

//admin login
mix.scripts("resources/assets/js/adminLogin.js", "public/js/adminLogin.js")
	.styles("resources/assets/css/adminLogin.css", "public/css/adminLogin.css");

//master
mix.scripts("resources/assets/js/master.js", "public/js/master.js");
mix.styles("resources/assets/css/master.css", "public/css/master.css");

//maintenance
mix.styles("resources/assets/css/maintenance.css", "public/css/maintenance.css");

//mainLayout
mix.styles("resources/assets/css/mainLayout.css", "public/css/mainLayout.css");
mix.scripts("resources/assets/js/mainLayout.js", "public/js/mainLayout.js");
mix.scripts("resources/assets/js/LayoutBuilder.js", "public/js/LayoutBuilder.js");

//news add
mix.scripts("resources/assets/js/addNews.js", "public/js/addNews.js");
mix.styles("resources/assets/css/addNews.css", "public/css/addNews.css");

//ContentTools
mix.copy("node_modules/ContentTools/build/content-tools.min.js", "public/js")
	.copy("node_modules/ContentTools/build/content-tools.min.css", "public/css");

//ContentTools init & settings
mix.scripts("resources/assets/js/contentToolsInit.js", "public/js/contentToolsInit.js");