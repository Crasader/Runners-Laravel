# Install the project

## Environment

If you vant to run the app on your local machine, make sure to have installed all required dependencies.

On macOS you can use [brew](https://brew.sh/index_fr) to easily install all dependencies.
```sh
# Install latest php
brew install php
# Install mySQL
brew install mysql
# Install composer
brew install composer
# Install node
brew install node
```

On Linux (debian based), you can user aptitude.
```sh
apt-get install php
apt-get install mysql
apt-get install node
```
!! Warning, the packages on apt are not necessary the latest version.

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