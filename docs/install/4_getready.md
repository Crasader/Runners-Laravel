# Get the app ready

## System locale

Dont forget to install the french locale on our system, example on ubuntu :

```sh
sudo locale-gen fr_FR.UTF-8
```

## Generating the transpilled assets

All the assets (js, css) needs to be transpiled into the public folder. We use webpack to automate transpiling, and modules loading. Here 3 useful commands for working with assets.
```sh
# Run on the root folder of the project
npm run dev # OR yarn dev # Will compoile the assets (non minifed) and generate source map (useful for dev)

npm run watch # OR yarn watch # Will run the dev command on each file change

npm run prod # yarn prod # will generate minified and versionned files for production deployment
```

## Migrate the database

```sh
php artisan migrate:fresh --seed
```

This command will create a fresh database with the seeds specified in the `database/seeds` folder.
If you want more infos about the seeding and the migrations, read the [migration and seeding](../app/migrationAndSeeding.md) doc page.

## Runners is ready

Now you can access to you freshly installed Runners app.

## !!! Code quality and Linting !!!

To maintain a good code quality and beauty on the project we use **coding standards** :

### What standards we use

* For **php** code, we respect the [PSR-2](https://www.php-fig.org/psr/psr-2/) code standard. We also use the [laravel best practicies](http://www.laravelbestpractices.com/).
* For **javascript**, we use the [standard](https://github.com/standard/standard) coding style.

### Linters

To helps you to respect the coding guidelines imposed by these standards, we have include in the project code linters. You can easyly configure your editor to use these linters and give you a visual return of the type errors directly on you files.

To lint **php** we use the [PHP_codesniffer](https://github.com/squizlabs/PHP_CodeSniffer) by [squizlabs](https://github.com/squizlabs). And for javascript we use the popular [eslint](https://github.com/eslint/eslint).

### Editor configuration

**VS code :**
Instal the [eslint](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint) and [phpcs](https://marketplace.visualstudio.com/items?itemName=ikappas.phpcs) extensions.
Eslint will direcly work, for phpcs just add these line in your vs code project settings :

```json
{
  "phpcs.standard": "PSR2",
  "phpcs.ignore": "vendor,database",
  "phpcs.enable": true
}
```

**Other :**
You can easealy find extensions to use these linters with many editors.

<br>
<br>
<br>
<hr>

**Helpful links :**

<hr>
<div align="center">

**[<- Prev](3_homestead.md) // [Summary](../README.md) // [Next ->](../README.md)**

</div>