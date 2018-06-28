Source Guard
========================

* FIQUET Gabin
* PALOS Jérôme
* DESHAYES Alexandre

[Github Source Guard Home](https://github.com/JeromePALOS/ProtectSourceHome)


Installation
--------------

php >= 7.1
activate intl extension and openssl

```
git clone https://github.com/jeromepalos/protectsource

cd protectsource/
composer install
php bin/console ckeditor:install
php bin/console assets:install
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
```

```
cd ../
git clone https://github.com/jeromepalos/protectsourcehome
cd protectsourcehome/
composer install
php bin/console assets:install
```


```
database in protectsource/protectsource.sql
```



Account 
-------


```
 login : admin
 password : admin
 
 login : fiquet
 password : fiquet

 login : palos
 password : palos
```


