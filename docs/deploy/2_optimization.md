# Optimize the app

Laravel is really heavy, it is important to do some optimizations wen you pass our app in production.

## Cache the config

This generate a pre parsed config file for the laravel app. (prevent for re parsing the config at each request)

```sh
php artisan config:cache
```

## Cache the router

About 50% of the request life in the laravel app is the parsing of all the routes. So it is really important to cache all the router.

```sh
php artisan route:cache
```

## OPcache

To prevent PHP from reinterpreting all files at each request, it is important to enable opcache. This will cache the OPcode, and significantly improve the app performances.

## Magnified assets

To generate magnified and versioned javascript/css files, use the production command :
```sh
# In the root folder of the project
npm run prod # OR yarn prod
```

<br>
<br>
<br>
<hr>

**Helpful links :**

* [PHP opcache](http://php.net/manual/fr/book.opcache.php)

<hr>
<div align="center">

**[<- Prev](./1_requirements.md) // [Summary](../README.md) // [Next ->](../README.md)**

</div>