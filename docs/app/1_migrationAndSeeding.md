# Migrations and seeding

You can easily start development with fake data's using migration and seeding.

## Migrations

The migrations will generate all the database incrementally. The migrations allows you to track the changes performed on the database over time.

If you need to make change on the database structure, create a new migration. **Never edit older migrations !**

You find all the migration possibilities on the [official doc](https://laravel.com/docs/5.5/migrations).

### Related commands :
```sh
# Generate the database from scrach
php artisan migrate

# Reset the migrations (drop all the tables and rebuild the database)
php artisan migrate:fresh

# Rollback all the migrations
php artisan migrate:reset
```

## Seeding

Laravel provides a seeding system to easily populate the database. You find all the seeders in the `database/seeds` folder.
These scripts populates each tables with fake data's automatically.
If you want to add new seeders see the [doc](https://laravel.com/docs/5.5/seeding).

### Related commands
```sh
# Seed the database
php artisan db:seed

# You can migrate and seed the database in one time
php artisan migrate:fresh --seed
# This will repuild the database from scratch and seed it

# Seed and assign the free status to all users
php artisan db:seed --class=UserStatusSeedsAndAssociate

# Re seed only the generated runs (will empty all the runs, and relaunch the generation...)
php artisan db:seed --class=ReGenerateRunsSeeder

# Delete all the runs
php artisan db:seed --class=RemoveAllRunsSeeder
```

<br>
<br>
<br>
<hr>

**Helpful links :**

* [Laravel migrations](https://laravel.com/docs/5.5/migrations)
* [Laravel seeders](https://laravel.com/docs/5.5/seeding)

<hr>
<div align="center">

**[<- Prev](../README.md) // [Summary](../README.md) // [Next ->](./2_assets.md)**

</div>