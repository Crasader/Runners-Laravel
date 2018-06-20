# Installation requirements

## Technologies

* PHP
    * PHP > 7.1.3
    * OpenSSL PHP Extension
    * PDO PHP Extension
    * Mbstring PHP Extension
    * Tokenizer PHP Extension
    * XML PHP Extension
    * Ctype PHP Extension
    * JSON PHP Extension
    * **composer** ^1.6
* JS
    * node.js > 8
    * npm ^3 OR yarn ^1.5
* Database
    * MySQL (^14.14)

## Dev env

If you use a **Windows** environment, we recommend to use the [Homestead](https://laravel.com/docs/5.6/homestead)
preconfigured virtual machine.
We explain all the install and configuration procedure for homestead in the next sections of this doc.

If you use an **Unix like** OS (Linux, macOS), we can also use Homestead,
but its already possible to install the app in local, for best perfs,
in this case make sure to have all the requirements installed properly and working on our machine.

### Mac OS example

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

### Debian based distro example

On Linux (debian based), you can user aptitude.
```sh
apt-get install php
apt-get install mysql
apt-get install node
```
!! Warning, the packages on apt are not necessary the latest version.

<br>
<br>
<br>
<hr>

**Helpful links :**

<hr>
<div align="center">

**[<- Prev](../README.md) // [Summary](../README.md) // [Next ->](2_install.md)**

</div>
