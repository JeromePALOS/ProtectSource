Source Guard
========================

FIQUET Gabin
PALOS Jérôme
DESHAYES Alexandre


[Git Hub Source Guard Home][1]

Installation
--------------

php >= 7.1
activate intl extension and openssl

![ampps extension](https://raw.githubusercontent.com/jeromepalos/ProtectSource/doc/ampps.png)


git clone https://github.com/jeromepalos/protectsource

cd protectsource/
composer install
php bin/console ckeditor:install
php bin/console assets:install
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force


cd ../
git clone https://github.com/jeromepalos/protectsourcehome
cd protectsourcehome/
composer install
php bin/console assets:install




database in protectsource/protectsource.sql


Account :
 login : admin
 password : admin
 
 login : fiquet
 password : fiquet

 login : palos
 password : palos



[1]:  https://github.com/JeromePALOS/ProtectSourceHome/

