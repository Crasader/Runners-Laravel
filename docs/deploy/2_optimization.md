# Optimize the app

Laravel is really heavy, it is important to do some optimizations wen you pass our app in production.

## Cache the config

This genearte a pre parsed config file for the laravel app. (prevent for re parsing the config at each request)

```sh
php artisan config:cache
```

## Cache the router

About 50% of the requst life in the laravel app is the parsing of all the routes. So it is really important to cache all the router.

```sh
php artisan route:cache
```

## OPcache

To prevent PHP from reinterpreting all files at each request, it is important to enable opcache. This will cache the OPcode, and sinificativly improuve the app performances.

<br>
<br>
<br>
<hr>

**Helpful links :**

<hr>
<div align="center">

**[<- Prev](#) // [Summary](../README.md) // [Next ->](#)**

</div>