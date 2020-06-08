# DO NOT USE THIS REPOSITORY. IT IS JUST A CODING CHALLENGE.

# MagicFramework


MagicFramework is based on [PSR-7 HTTP message](https://www.php-fig.org/psr/psr-7/),
and I chose to work with the [guzzlehttp/psr7](https://github.com/guzzle/psr7) implemention.  

The structure of the `Router` is inspired by [symfony/routing](https://github.com/symfony/routing/)  

* Tests are made with [PHPUnit](https://github.com/sebastianbergmann/phpunit)
* I chose [php-text-template](https://github.com/sebastianbergmann/php-text-template) as a very simple template engine
* The webserver configuration is made with `docker` and `docker-compose` [here](server)
* Routes are defined in the [config/routing.yaml](./config/routing.yaml)
* Services and Controllers are defined in the [Kernel::__construct](./src/Kernel.php)

## Requirements
This requires either `php >= 7.3` and `composer` or `docker`


## Install

Clone the repository:
```bash
git clone git@github.com:AlexDpy/MagicFramework.git && cd MagicFramework
```

If you have Docker:
```bash
make install
```
If you have php/composer:
```bash
composer install --dev
```

## Run the tests
If you have Docker:
```bash
make test
```

If you have php:
```bash
php vendor/bin/phpunit
```


## Launch the web server
Following command will use the port `8080`. Please make sure it is not already used on your machine.  

If you have Docker:
```bash
make serve
```

If you have php:
```bash
php -S 0.0.0.0:8080 -t public/
```

Then open your browser on [http://localhost:8080/](http://localhost:8080/)
