# Backend Database services

This API is part of the apartment platform project. It deploys a REST-CRUD API for the db access from the website.

## Start

To run the api local, start `make run`

To test the api local, start `make test`

## Config Locale

Replace in file `buildsrc/config.ini` your db credentials.

## Config Prod

Create copy the file `buildsrc/config.ini` with your credentials in folder `<root>/private/`
and push the `src/` under `<root>/rest/`.

## API-URL

### Locale Tiles

- Get by ID `11`: `http://localhost:1080/tile/11/`
- Get All `http://localhost:1080/alltile/`
- Get only IDs `http://localhost:1080/alltile/`

### Locale Images

- Get by ID `2`:`http://localhost/image/<name_of_image>/`
- Get All `http://localhost/image/`

## Update

Create new Composer Files run: `docker run --rm -it -v ".:/app" -w "/app" composer:lts composer require --dev phpunit/phpunit`
