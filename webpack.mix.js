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

// jquery
mix.copy("node_modules/jquery/dist/jquery.min.js", "public/js/jquery.min.js");

//admin create
mix.scripts("resources/assets/js/admin_create.js", "public/js/admin_create.js")
	.styles("resources/assets/css/admin_create.css", "public/css/admin_create.css");

//admin login
mix.scripts("resources/assets/js/admin_login.js", "public/js/admin_login.js")
	.styles("resources/assets/css/admin_login.css", "public/css/admin_login.css");

//master
mix.scripts("resources/assets/js/master.js", "public/js/master.js");
mix.styles("resources/assets/css/master.css", "public/css/master.css");

//maintenance
mix.styles("resources/assets/css/maintenance.css", "public/css/maintenance.css");

//mainLayout
mix.styles("resources/assets/css/mainLayout.css", "public/css/mainLayout.css");
mix.scripts("resources/assets/js/mainLayout.js", "public/js/mainLayout.js");
mix.scripts("resources/assets/js/LayoutBuilder.js", "public/js/LayoutBuilder.js");

