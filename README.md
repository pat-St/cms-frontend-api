# Backend Database services
This API ist part of the apartment platform project. It deploys a REST-CRUD API for the db access from the website.
## Start
To run the api local, start `./run.sh`
## Config Locale
Replace in file `config.ini` your db credentials.
## Config Prod
Create copy the file `config.ini` with your credentials in folder `<root>/private/` 
and push the `src/` under `<root>/rest/`.
## API-URL 
### Locale Tiles
- Get by ID `11`: `http://localhost:80/tile/11/`
- Get All `http://localhost:80/alltile/`
- Get only IDs `http://localhost:80/alltile/`
### Locale Images
- Get by ID `2`:`http://localhost/image/<name_of_image>/`
- Get All `http://localhost/image/`