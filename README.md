<div align="center" style="margin-bottom:60px;">
  <img src ="public/img/logo.svg" width="40%"/><br><br>
</div>

Runners is a driver managment app, specially designed for the [paleo](http://yeah.paleo.ch/) festival.

## **v2.0.0-beta.3.1**

This version includes dependencies changes, dont forget to :
* Run `composer install`
* Migrate the new database `php artisan migrate:fresh --seed`
* Generates new assets `npm run dev`

Break changes :
* x

Changes :
* Search field now use user full name

Improuvments :
* Add box that display users without group in the groups manager
* Update of the search field with autocomplete to support key modifiers

Bux fixes :
* Runs creation without subscription
* Request validation fails on run creation
* Data loss on new run when you add subscription or waypoint

In progress :
* Notifications linked to runs actions
* Schedules crud

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
