# School CMS

## About
This is a small CMS system, with CRUD, which allow manage news, static pages, files, links, moderators.
 Dynamically layout change. \
 Dynamically created menus. \
 Simple and user friendly content editor.
 Popup images in news / pages content.

## Requirements
- Docker
- Docker Compose
  
Optionally:
- Make (to run make commands)

## Installation
```
make install
```
or
```
cp .env.example .env
docker-compose up -d
docker-compose exec php-fpm composer install
docker-compose exec php-fpm php artisan key:generate
docker-compose exec php-fpm php artisan migrate --seed
```

## Run
```
docker-compose  up -d
```
or
```
make run
```

App will be accessible on:
```
localhost:555
```

### Log in to the dashboard

```localhost:555/login```
- user: admin
- pass: admin

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

# Make commands
- make shell
- make run
- make build
- make stop
- make install
