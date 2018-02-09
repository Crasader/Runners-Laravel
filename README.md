# Runners

Runners is a driver managing app, specially designed for the [paleo](http://yeah.paleo.ch/) festival of Nyon.

## Version changelog **v2.0.0-alpha.0**

Empty release to clean the master for future v2.

Break changes :
* API migration to [laravel passport](https://laravel.com/docs/5.5/passport) package

Changes :
* Updated laravel version to **5.5 LTS**
* Big repository clean

Improuvments :
* x

Bux fixes :
* x

## Start developping

You can find a complete install procedure [here](docs/install/requirements.md).

## Docs

You find docs [here](docs/readme.md)

## Logins

If you seeded the database, you will hae a couple users, but a few are important.


| username | email          | password | access token |
|----------|----------------|----------|--------------|
| root     | root.toor@paleo.ch     | root   | root   |
| runner   | runner.runner@paleo.ch | runner | runner |


## Api


To access the api, please visit the url `/api`. This page will display information necessary for you to use the api.

Please refer to the documentation [docs/api.md](docs/api.md)
And `/api` to get a listing of all available endpoints.
