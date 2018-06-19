<div align="center" style="margin-bottom:60px;">
  <img src ="public/img/logo.svg" width="40%"/><br><br>
</div>

Runners is a driver management app, specially designed for the [paleo](http://yeah.paleo.ch/) festival.

## [v2.0.0-rc.1.1](https://github.com/CPNV-ES/Runners-Laravel/releases/tag/v2.0.0-rc.1.1)

!! ATTENTION !! :
This version includes assets changes :
* Generate new assets for dev `npm run dev`
* Generate new assets for production `npm run prod`

Break changes :
* x

Changes :
* Change the check of the needs filling runs status

Improvements :
* Add specific seeder to clean the schedules table
* Fix spelling on docs

Resolved Issues :
* [Run status, subscriptions must be complete to allows ready status. #94](https://github.com/CPNV-ES/Runners-Laravel/issues/94)
* [Add seeder to remove all schedules #92](https://github.com/CPNV-ES/Runners-Laravel/issues/92)

## Start developing

You can find a complete install procedure [here](docs/install/1_requirements.md).

## Docs

You find docs [here](docs/README.md)

## Login

If you seeded the database, you will have a couple users, but a few are important.

| username | email               | password |
|----------|---------------------|----------|
| root     | root.toor@paleo.ch  | secret   |
| runner   | runner@paleo.ch     | runner   |
