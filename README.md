<div align="center" style="margin-bottom:60px;">
  <img src ="public/img/logo.svg" width="40%"/><br><br>
</div>

Runners is a driver management app, specially designed for the [paleo](http://yeah.paleo.ch/) festival.

## [v2.0.0-rc.1.2](https://github.com/CPNV-ES/Runners-Laravel/releases/tag/v2.0.0-rc.1.2)

Break changes :
* x

Changes :
* Change the runs status logic according to the statuses lifecycle diagram.

Improvements :
* Change time validation on schedules creation.
* Add time check to change the status of runs where the status is after current time.

Resolved Issues :
* [Minimal run info #96](https://github.com/CPNV-ES/Runners-Laravel/issues/96)
* [Can create new schedule, validation fails #98](https://github.com/CPNV-ES/Runners-Laravel/issues/98)
* [Run status, subscriptions must be complete to allows ready status. #94](https://github.com/CPNV-ES/Runners-Laravel/issues/94)
* [Update runs status managment according to the diagram in `docs/diagrams/runStats` #97](https://github.com/CPNV-ES/Runners-Laravel/issues/97)

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
