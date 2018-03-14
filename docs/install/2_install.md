# Install the project

## Get the sources

```sh
git clone git@github.com:CPNV-ES/Runners-Laravel.git Runners
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

## Install the node.js dependencies

Just run :
```bash
# At the root folder of the project
npm i
```


<br>
<br>
<br>
<hr>

**Helpful links :**
* [Homestead docs](https://laravel.com/docs/5.5/homestead)

<hr>
<div align="center">

**[<- Prev](1_requirements.md) // [Summary](../README.md) // [Next ->](3_homestead.md)**

</div>