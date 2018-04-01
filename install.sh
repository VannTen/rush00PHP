#!/bin/bash

docker-machine create --driver 'virtualbox' dev-php
docker-machine start dev-php
eval $(docker-machine env dev-php)
sed -i '' -e "s/SERVER_NAME/`docker-machine ip dev-php`/" conf/rush.conf
docker run -d -p 80:80 \
	-v $PWD/conf/rush.conf:/etc/apache2/sites-available/000-default.conf \
	-v $PWD:/var/www/html --name rush00 akeneo/apache-php
docker start rush00
curl http://`docker-machine ip dev-php`/install.php
