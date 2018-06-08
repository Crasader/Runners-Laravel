<div align="center" style="margin-bottom:60px;">
  <img src ="public/img/logo.svg" width="40%"/><br><br>
</div>

Runners is a driver managment app, specially designed for the [paleo](http://yeah.paleo.ch/) festival.

## **v2.0.0-beta.3**

This version includes dependencies changes, dont forget to :
* Run `composer install`
* Migrate the new database `php artisan migrate:fresh --seed`
* Generates new assets `npm run dev`

Break changes :
* x

Changes :
* Home page links reorganization
* Cars and CarTypes show pages now display related runs

Improuvments :
* Complete log system, that mark all database actions in a special crud. It allows you to track changes on a resource.
* Notification system, it allows you to send notification to users via the database driver.
* Unhandled exceptions notification, the superuser now receive notification when the app throws an uncatched exceptions.
* Add create and edition in runs crud.
* Add runs actions (start, stop, publish)

Bux fixes :
* Carbon dates formating
* Locales mismatch
* Spelling

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
