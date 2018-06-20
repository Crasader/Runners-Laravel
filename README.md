<div align="center" style="margin-bottom:60px;">
  <img src ="public/img/logo.svg" width="40%"/><br><br>
</div>

Runners is a driver management app, specially designed for the [paleo](http://yeah.paleo.ch/) festival.

## [v2.0.0-rc.1.4](https://github.com/CPNV-ES/Runners-Laravel/releases/tag/v2.0.0-rc.1.3)

**Break changes :**
* -

**Improvements :**
* `api/runners/{runner}/driver` and `api/runnners/{runner}/car` now returns a RunnerResource.
* Fix some spelling in docs

**Resolved Issues :**
* [Return Values on actions #101](https://github.com/CPNV-ES/Runners-Laravel/issues/101)

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
