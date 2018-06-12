<div align="center" style="margin-bottom:60px;">
  <img src ="public/img/logo.svg" width="40%"/><br><br>
</div>

Runners is a driver managment app, specially designed for the [paleo](http://yeah.paleo.ch/) festival.

## **v2.0.0-beta.3.2**

This version includes dependencies changes, dont forget to :
* Run `composer install`
* Migrate the new database `php artisan migrate:fresh --seed`
* Generates new assets `npm run dev`

Break changes :
* x

Changes :
* x

Improuvments :
* x

Bux fixes :
* Policies errors with roles runners and coordinator
* Pictures errors on update and delete
* Add permisions in the kielas crud
* Fix manager edition for runners crud

In progress :
* x

## Start developping

You can find a complete install procedure [here](docs/install/1_requirements.md).

## Docs

You find docs [here](docs/README.md)

## Logins

If you seeded the database, you will have a couple users, but a few are important.

| username | email               | password |
|----------|---------------------|----------|
| root     | root.toor@paleo.ch  | secret   |
| runner   | runner@paleo.ch     | runner   |
