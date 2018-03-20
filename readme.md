# School CMS

## About
This is a small CMS system, with CRUD, which allow manage news, static pages, files, links, moderators.
 Dynamically layout change. \
 Dynamically created menus. \
 Simple and user friendly content editor.
 Popup images in news / pages content.

## Requirements
* PHP 7.0 / 7.1 / 7.2
* MySQL 5.7.19
* Composer

## Installation
1. clone repo
2. `composer install`
3. `php artisan key:generate`
4. create `.env` file based on `.env.example`
5. create MySQL database and set up in `.env`
6. `php artisan migrate --seed`

## Used plugins:
##### Semantic UI
https://semantic-ui.com/

##### Content Tools:
http://getcontenttools.com/getting-started

##### semantic calendar:
https://github.com/mdehoog/Semantic-UI-Calendar

##### toastr:
https://github.com/CodeSeven/toastr

##### jquery-simplecolorpicker:
https://github.com/tkrotoff/jquery-simplecolorpicker

##### Magnific-Popup
https://github.com/dimsemenov/Magnific-Popup