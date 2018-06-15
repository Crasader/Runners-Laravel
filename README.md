<div align="center" style="margin-bottom:60px;">
  <img src ="public/img/logo.svg" width="40%"/><br><br>
</div>

Runners is a driver managment app, specially designed for the [paleo](http://yeah.paleo.ch/) festival.

## [v2.0.0-beta.4](https://github.com/CPNV-ES/Runners-Laravel/releases/tag/v2.0.0-beta.4)

!! ATTENTION !! :
This version includes database changes :
* Migrate the new database `php artisan migrate:fresh --seed`

If you want to preserve our database, you can just run the migration, and seed only the new contents :
* `php artisan migrate` will generate the new tables
* `php artisan db:seed --class=UserStatusSeedsAndAssociate` will generate status in the new table, and assign the free status to all users.
* !! You need to reassign the status you want to users

Break changes :
* Status for users are now moved to specific table

Changes :
* New default liscence picture

Improuvments :
* Little updates on the Kiela
* Updates in the user edition page
* 3 New seeders for dev purpose :
    * `php artisan db:seed --class=UserStatusSeedsAndAssociate` Generate and associate free status to all users.
    * `php artisan db:seed --class=RemoveAllRunsSeeder` Clear the runs and all run drivers.
    * `php artisan db:seed --class=ReGenerateRunsSeeder` Generate fres runs for the 3 previous and nex days.

Resolved Issues :
* [Add production seeder #79](https://github.com/CPNV-ES/Runners-Laravel/issues/79)
* [Runner status #72](https://github.com/CPNV-ES/Runners-Laravel/issues/72)
* [Add status table for the users #74](https://github.com/CPNV-ES/Runners-Laravel/issues/74)
* [Full trip in big screen #81](https://github.com/CPNV-ES/Runners-Laravel/issues/81)
* [Add docs for the folded boxes #76](https://github.com/CPNV-ES/Runners-Laravel/issues/76)
* [Complete the database diagram #75](https://github.com/CPNV-ES/Runners-Laravel/issues/75)
* [Picture for new runner #77](https://github.com/CPNV-ES/Runners-Laravel/issues/77)
* [Remove picture #78](https://github.com/CPNV-ES/Runners-Laravel/issues/78)

In progress :
* [See details in projects page !](https://github.com/CPNV-ES/Runners-Laravel/projects/2)

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
