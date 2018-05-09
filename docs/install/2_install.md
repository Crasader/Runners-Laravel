# Install the project

## Get the sources

```sh
git clone git@github.com:CPNV-ES/Runners-Laravel.git Runners
# Your git local instance must have the credentials for this repo
```

## Configure the .env

Duplicate the `.env.example` in `.env` and configure the variables four our environment.

1. App infos, all the key `APP_*`. This section is preconfigured, just change the `APP_URL` to the base url you use in dev.
2. Databse, replace by your databse connection infos

## Install the php dependencies

Just run :
```bash
# At the root folder of the project
composer install
```

## Generate a fresh app key

Laravel needs a specific unique key, uset to generate authentication tokens, and encription. Use the `php artisan key:generate` to automatically generate and set the key for our project.

## Install the node.js dependencies

Just run :
```bash
# At the root folder of the project
npm i # Or yarn
```


<br>
<br>
<br>
<hr>

**Helpful links :**
* [Homestead docs](https://laravel.com/docs/5.5/homestead)
* [Composer](https://getcomposer.org/)

<hr>
<div align="center">

**[<- Prev](1_requirements.md) // [Summary](../README.md) // [Next ->](3_homestead.md)**

</div>