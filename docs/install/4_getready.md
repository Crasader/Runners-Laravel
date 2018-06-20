# Get the app ready

## System locale

Don't forget to install the french locale on our system, example on ubuntu :

```sh
sudo locale-gen fr_FR.UTF-8
```

## Generating the transpilled assets

All the assets (js, css) needs to be transpilled into the public folder. We use webpack to automate transpiling,
and modules loading. Here 3 useful commands for working with assets.
```sh
# Run on the root folder of the project
npm run dev # OR yarn dev # Will compoile the assets (non minifed) and generate source map (useful for dev)
```
[**More info's about assets management**](../app/2_assets.md)

## Migrate the database

```sh
php artisan migrate:fresh --seed
```

This command will create a fresh database with the seeds specified in the `database/seeds` folder.
If you want more info's about the seeding and the migrations, read the [migration and seeding](../app/1_migrationAndSeeding.md) doc page.

## Storage

Laravel store dynamic files in the storage folder. In `storage/app/public` we store all files that must be accessible by the client.
To make this files reachable, we need to link the folder in the public repertory.
```sh
# In the root folder of the project
php artisan storage:link
```

## Runners is ready

Now you can access to you freshly installed Runners app.

## IDE helper

To provide best completion on laravel Facade we use the [barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)
package, it allows you to generate file that's help your ide to discover methods and attributes generated on the fly.

```sh
# Generate helper file for laravel facades
php artisan ide-helper:generate
```

## !!! Code quality and Linting !!!

To maintain a good code quality and beauty on the project we use **coding standards** :

### What standards we use

* For **php** code, we respect the [PSR-2](https://www.php-fig.org/psr/psr-2/) code standard. We also use the [laravel best practices](http://www.laravelbestpractices.com/).
* For **javascript**, we use the [standard](https://github.com/standard/standard) coding style.

### Linters

To helps you to respect the coding guidelines imposed by these standards, we have include in the project code linters.
You can easily configure your editor to use these linters and give you a visual return of the type errors directly on you files.

To lint **php** we use the [PHP_code sniffer](https://github.com/squizlabs/PHP_CodeSniffer) by [squizlabs](https://github.com/squizlabs).
And for javascript we use the popular [eslint](https://github.com/eslint/eslint).

### Editor configuration

**VS code :**
Install the [eslint](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint)
and [phpcs](https://marketplace.visualstudio.com/items?itemName=ikappas.phpcs) extensions.
Eslint will directly work, for phpcs just add these line in your vs code project settings :

```json
{
  "phpcs.standard": "PSR2",
  "phpcs.ignore": "vendor,database",
  "phpcs.enable": true
}
```

**Other :**
You can easily find extensions to use these linters with many editors.

<br>
<br>
<br>
<hr>

**Helpful links :**

* [Laravel mix (assets management)](https://laravel.com/docs/5.6/mix)
* [Laravel migrations](https://laravel.com/docs/5.6/migrations)
* [Laravel seeding](https://laravel.com/docs/5.6/seeding)

<hr>
<div align="center">

**[<- Prev](3_homestead.md) // [Summary](../README.md) // [Next ->](../README.md)**

</div>