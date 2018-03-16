# Homestead

## Configuration

To run the app in a evironement close as the production env, we use Homestead, a preconfigured VM that includes all the required technologies use by laravel.

Runners includes the homestead automatic configurator, to generate homestead configuration on the fly.

**1. Requirements :**

* You need to install [vagrant](https://www.vagrantup.com/) on our machine. I use the 1.9.6, but the newer versions vork great, just check the compatibility with homestead.
* And [virtualbox](), Actually the suported version by vagrant is th 5.1, if you want to use a newer, verify it's compatibility with vagrant.

**2. Download the box**

When you have install requirements, you need to add the homestead box :
```sh
vagrant box add laravel/homestead
```
This will download the base homestead box on our machine.

**3. Initialize homestead in runners**

To generates a homestead configuration, specific to runners you need to run the foolowing commands on our project directory.
To run this command, you must have install the php dependencies, see [installation](install.md#Install-the-php-dependencies) for more infos.

Linux / Mac OS :
```sh
php vendor/bin/homestead make
```

Windows :
```sh
vendor\\bin\\homestead make
```

This will generate a Homestead.yaml file, with an auto generated config, specific to the project

**4. Configuring homestead machine**

The Homestead machine nearly ready, you just have to change the database name in the new `Homestead.yaml` generated on the base folder of our project.

```yaml
databases:
    - runners
```

To acces the app via our local navigator without typing ip, add this line to our `hosts` file :

```
192.168.10.10    runners-laravel
```

You want to use an other ip for the machine, just change it on the `Homestead.yaml` file and `hosts` file.

```yaml
# Homestead.yaml
ip: 192.168.10.10
```

**4. Up and run**

Now, you can run the homestad machine :
```sh
# launch the command a the same level of the Homestead.yaml file
vagrant up
```

And access our app typing the `runners-laravel` url in our navigator.

**6. Shutdown the machine**

To stop the homestead machine :
```sh
vagrant halt
```

**7. SSH**

To wort properly with the `php artisan` commands, we need to a ssh connection to our vm, then we can type commands directly in the vm, to be executed vith the same environment as your project.

To etablish a ssh conection with the homestead machine :

```sh
vagrant ssh
```

After, your have the control of the prompt in the vm, type `exit` to recover our local prompt.

We recommend to run all the laravel comands in the vm.

<hr>

**Helpful links :**
* [Homestead docs](https://laravel.com/docs/5.5/homestead)

<hr>
<div align="center">

**[<- Prev](2_install.md) // [Summary](../README.md) // [Next ->](4_getready.md)**

</div>