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

 mix.styles("resources/assets/css/templates.css", "public/css/templates.css");

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

mix.babel("resources/assets/js/LayoutBuilder.js", "public/js/LayoutBuilder.js");

//form news page
mix.scripts("resources/assets/js/formNewsPage.js", "public/js/formNewsPage.js");
mix.styles("resources/assets/css/formNewsPage.css", "public/css/formNewsPage.css");

//news add edit
mix.scripts("resources/assets/js/addEditNews.js", "public/js/addEditNews.js");
mix.styles("resources/assets/css/addEditNews.css", "public/css/addEditNews.css");

//page add edit
mix.scripts("resources/assets/js/addEditPage.js", "public/js/addEditPage.js");
mix.styles("resources/assets/css/addEditPage.css", "public/css/addEditPage.css");

//ContentTools
mix.copy("node_modules/ContentTools/build/content-tools.min.js", "public/js")
.copy("node_modules/ContentTools/build/content-tools.min.css", "public/css");

//ContentTools init & settings
mix.scripts("resources/assets/js/contentToolsInit.js", "public/js/contentToolsInit.js");
mix.scripts("resources/assets/js/contentToolsSetToolbox.js", "public/js/contentToolsSetToolbox.js");
mix.scripts("resources/assets/js/contentToolsSetLanguage.js", "public/js/contentToolsSetLanguage.js");
mix.scripts("resources/assets/js/contentToolsCustomTags.js", "public/js/contentToolsCustomTags.js");

//toastr
mix.copy("node_modules/toastr/build/toastr.min.js", "public/js")
.copy("node_modules/toastr/build/toastr.min.css", "public/css");

//toastr opions
mix.scripts("resources/assets/js/toastrOptions.js", "public/js/toastrOptions.js");

//settings
mix.styles("resources/assets/css/settings.css", "public/css/settings.css");
mix.babel("resources/assets/js/settings.js", "public/js/settings.js");

//file
mix.scripts("resources/assets/js/addFile.js", "public/js/addFile.js");
mix.styles("resources/assets/css/addFile.css", "public/css/addFile.css");

//news manage
mix.styles("resources/assets/css/newsManage.css", "public/css/newsManage.css");
mix.babel("resources/assets/js/newsManage.js", "public/js/newsManage.js");

//pages manage
mix.styles("resources/assets/css/pagesManage.css", "public/css/pagesManage.css");
mix.babel("resources/assets/js/pagesManage.js", "public/js/pagesManage.js");

//files manage
mix.styles("resources/assets/css/filesManage.css", "public/css/filesManage.css");
mix.babel("resources/assets/js/filesManage.js", "public/js/filesManage.js");

//elements manage
mix.styles("resources/assets/css/elementsManage.css", "public/css/elementsManage.css");
mix.babel("resources/assets/js/elementsManage.js", "public/js/elementsManage.js");

mix.babel("resources/assets/js/DatabaseElementsUpdater.js", "public/js/DatabaseElementsUpdater.js");

//menu admin
mix.styles("resources/assets/css/menuAdmin.css", "public/css/menuAdmin.css");
mix.scripts("resources/assets/js/menuAdmin.js", "public/js/menuAdmin.js");

//elements menu
mix.styles("resources/assets/css/menuAddEdit.css", "public/css/menuAddEdit.css");
mix.scripts("resources/assets/js/menuAddEdit.js", "public/js/menuAddEdit.js");

// Bottom sector- footer
mix.styles("resources/assets/css/bottomSector.css", "public/css/bottomSector.css")


// CONTRAST 
mix.styles("resources/assets/css/templates/contrast.css", "public/css/contrast.css");

// SiteMap
mix.styles("resources/assets/css/templates/sitemap.css", "public/css/sitemap.css");

// TEMPLATES ELEMENTS
// custom panel
mix.styles("resources/assets/css/templates/custom.css", "public/css/custom.css");

// editTab
mix.scripts("resources/assets/js/templates/editTab.js", "public/js/editTab.js");

// accessibilities panel
mix.styles("resources/assets/css/templates/accessibilities.css", "public/css/accessibilities.css");
mix.scripts("resources/assets/js/templates/accessibilities.js", "public/js/accessibilities.js");

mix.babel("resources/assets/js/templates/ColorSchemes.js", "public/js/ColorSchemes.js");
mix.babel("resources/assets/js/templates/ChangeFont.js", "public/js/ChangeFont.js");

// info panel
mix.styles("resources/assets/css/templates/info.css", "public/css/info.css");

// list panel
mix.styles("resources/assets/css/templates/list.css", "public/css/list.css");

// banner panel
mix.styles("resources/assets/css/templates/banner.css", "public/css/banner.css");

// info panel
mix.styles("resources/assets/css/templates/info.css", "public/css/info.css");

// jquery-simplecolorpicker
mix.copy("node_modules/jquery-simplecolorpicker/jquery.simplecolorpicker.js", "public/js");
mix.copy("node_modules/jquery-simplecolorpicker/jquery.simplecolorpicker.css", "public/css");

// fontManager
mix.babel("resources/assets/js/templates/fontManager.js", "public/js/fontManager.js");

//createLink
mix.scripts("resources/assets/js/createLink.js", "public/js/createLink.js");

//panel add edit
mix.babel("resources/assets/js/addEditPanel.js", "public/js/addEditPanel.js");
mix.styles("resources/assets/css/addEditPanel.css", "public/css/addEditPanel.css");

//magnifict popup
mix.copy("node_modules/magnific-popup/dist/jquery.magnific-popup.min.js", "public/js")
.copy("node_modules/magnific-popup/dist/magnific-popup.css", "public/css");

//form admin
mix.scripts("resources/assets/js/formAdmin.js", "public/js/formAdmin.js");
mix.styles("resources/assets/css/formAdmin.css", "public/css/formAdmin.css");

//admins manage
//mix.styles("resources/assets/css/pagesManage.css", "public/css/pagesManage.css");
mix.babel("resources/assets/js/adminsManage.js", "public/js/adminsManage.js");

//archive news
mix.scripts("resources/assets/js/archiveNews.js", "public/js/archiveNews.js");

//archive news for year
mix.scripts("resources/assets/js/archiveNewsForYear.js", "public/js/archiveNewsForYear.js");
mix.styles("resources/assets/css/archiveNewsForYear.css", "public/css/archiveNewsForYear.css");