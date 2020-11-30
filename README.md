# Mingle



Setup with Docker:
___

1] Setup domain name in hosts file:

default location in ubuntu is '/etc/hosts'

add following ip with domain name:

127.0.0.1   mingle.local

- Make sure you have installed 'docker' and 'docker-compose', before you continue with docker.


2] Build Docker & Run

=> docker-compose build

=> docker-compose up

=> docker exec -it mingle_php_container /bin/bash

3] Install/Update project dependencies

    => composer update

4] create migrations from docker terminal

   => php artisan migrate --step 
