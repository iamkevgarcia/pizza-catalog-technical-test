Pizza Catalog
=============

### Requirements

* Symfony 3.2
* Composer

1.- Install the dependencies using composer.
2.- Create the schema and fixtures
```sh
php bin/console doctrine:schema:create
php bin/console doctrine:fixture:load
```
3.- run server
```sh
php bin/console server:run
```
