# Server requirements
- PHP >= 7.0.4
    - OpenSSL PHP Extension
    - PDO PHP Extension
    - Mbstring PHP Extension
    - Tokenizer PHP Extension
    - XML PHP Extension
- Webserver (nginx or apache)
- Mysql >= 13.04
- Composer
- Node >= 7.0.0

# Project set-up

First you will need a fresh copy of the project, and a terminal.
```
$ git clone https://github.com/CPNV-ES/Runners-Laravel runners
$ cd runners
$ sudo chmod -R 777 storage
$ sudo chmod -R 777 bootstrap
$ cp .env.example .env
```

Now you have 3 possibilities of installation
* Docker
* Vagrant - Homestead
* LAMP server

# Installation

## With docker

First get yourself a fresh copy of docker, with docker-compose **>= 1.8** (we need api v2).

Run the following:
1. `sudo docker-compose up -d`
2. `sudo docker-compose run --rm app php artisan key:generate`

Then run `artisan key:generate`
If nothing is written to your .env file (`$ cat .env`), you can re-run the command and copy the key and insert it manually in the file with `$ nano .env`


Since PHP Dotenv doesn't override by default already environment variables, please check `config/docker/app.env`, if you need to change anything.
All variables that aren't set in that file, can be set via your `.env` file.
For more examples look at `.env.example`.
Or you could specify them in your config files, instead of `.env`.

### Using Docker-Machine
If you are running docker on windows or mac, you will probably be running docker-machine. If that is the case, you need to put the prject folder in your personnal directory!
This means cloning the project in ~/

## With Vagrant - Homestead
With homestead all you need is to add your site to your Homestead.yaml.
For more information please check [the official documentation for homestead](https://laravel.com/docs/5.4/homestead#configuring-homestead)

After configuring, please add
`schedule: true`
To your sites config. [FYI](https://laravel.com/docs/5.4/homestead#configuring-cron-schedules)

## With a LAMP

Edit the .env file to suit your need. You need to provide at least a setted database.

And simply run. It may take a little few minutes to install.
1. `composer install`
2. `php artisan key:generate`  
3. `npm i -g gulp`  _if you have a persmission error, use `sudo chown -R $(whoami) $(npm config get prefix)/{lib/node_modules,bin,share` and re-run de command_
4. `npm i`  

# Post install operations
## Database set-up
Now that the app is installed you will need to execute the following commands:

**Create** then **seed** the **database** with the production data
```
$ php artisan db:reset --production
$ sudo chmod 777 -R vendor/mpdf/mpdf/tmp
$ sudo chmod 777 -R vendor/mpdf/mpdf/graph_cache
$ sudo chmod 777 -R vendor/mpdf/mpdf/ttfontdata
```

If you want to **reset** the database, use at any moment the following command.
`php artisan db:reset --production`.  
If you don't want to use the production data, remove the argument and use the command `php artisan db:reset` instead.

If you are using **docker**, run the commands above prefixed with `docker-compose run --rm app {command}`

## Install laravel echo
### Prerequisites

- Redis [for more info on how to install redis]((https://redis.io/download)), (or use [this link](https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-redis-on-ubuntu-16-04) if you use ubuntu)
- Node >= 7.0.0

### Laravel echo installation

```
$ npm i -g laravel-echo-server
```

Make sure redis is running, and that you have already changed the `.env` to suit your needs.

Now edit the `.env` and change
```
...
BROADCAST_DRIVER=redis
QUEUE_DRIVER=redis
....
```

Now you will need to start a few deamons:
1. Start a redis-server instance
    `$ sudo service redis-server start`
2. start laravel-echo-server as a deamon or just as bacjground process
   `$ cd config/broadcasting/ && laravel-echo-server start`

3. Start a queue worker
   `$ php artisan queue:work --verbose`

4. Start a scheduler
    `$ sudo crontab -e`
    Add this to your crontab
    `* * * * * php /PATH TO YOUR PROJECT/artisan schedule:run >> /dev/null 2>&1`

Now you should be good to go.
