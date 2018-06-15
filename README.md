<div align="center" style="margin-bottom:60px;">
  <img src ="public/img/logo.svg" width="40%"/><br><br>
</div>

Runners is a driver managment app, specially designed for the [paleo](http://yeah.paleo.ch/) festival.

## [v2.0.0-rc.1](https://github.com/CPNV-ES/Runners-Laravel/releases/tag/v2.0.0-rc.1)

!! ATTENTION !! :
This version includes assets changes :
* Generate new assets for dev `npm run dev`
* Generate new assets for production `npm run prod`

Break changes :
* x

Changes :
* Remove breadcrum on top of page

Improuvments :
* Add schedules crud
    * Schedules creation
    * Schedules edition
    * Schedules deletion
* Change kiela layout

Resolved Issues :
* [Adding driver in kiela fails #89](https://github.com/CPNV-ES/Runners-Laravel/issues/89)
* [Add seeder to set name field to conform new search fields #90](https://github.com/CPNV-ES/Runners-Laravel/issues/90)
* [Kiéla #80](https://github.com/CPNV-ES/Runners-Laravel/issues/80)
* [Interface cleanup #64](https://github.com/CPNV-ES/Runners-Laravel/issues/64)
* [Sex doesn't matter #85](https://github.com/CPNV-ES/Runners-Laravel/issues/85)
* [Duplicate runner status #86](https://github.com/CPNV-ES/Runners-Laravel/issues/86)
* [Status in english (low priority) #87](https://github.com/CPNV-ES/Runners-Laravel/issues/87)

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
