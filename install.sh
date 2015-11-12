#!/bin/bash

. includes/colors
source includes/check_requisites.sh

# variables
ROOT_DIR=/var/www/portabilidade
RELEASE_ROOT=/var/www/portabilidade/releases/
RELEASE=$(date +"%d%m%Y%H%M%S")
RELEASE_DIR=$RELEASE_ROOT$RELEASE

# cloning in a temp directory and move project to the relase dir
git clone $REPO /tmp/$RELEASE
mv /tmp/$RELEASE/Project $RELEASE_DIR
rm -rf /tmp/$RELEASE

cd $RELEASE_DIR
composer install --prefer-dist --no-scripts
php artisan clear-compiled --env=production;
php artisan optimize --env=production;

sudo sed -i "s/'database'  => .*/'database'  => '$DBNAME',/" $RELEASE_DIR/app/config/database.php
sudo sed -i "s/'host'      => .*/'host'      => '$DBHOST',/" $RELEASE_DIR/app/config/database.php
sudo sed -i "s/'username'  => .*/'username'  => '$DBUSER',/" $RELEASE_DIR/app/config/database.php
sudo sed -i "s/'password'  => .*/'password'  => '$DBPASSWD',/" $RELEASE_DIR/app/config/database.php

sudo sed -i "s/'token' => .*/'token' => '$TOKEN',/" $RELEASE_DIR/app/config/services.php

php artisan migrate --force --env=production;

ln -nfs $RELEASE_DIR /var/www/portabilidade/current
chown -R www-data:www-data $RELEASE_DIR
chown -R www-data:www-data /var/www/portabilidade/current

service php5-fpm reload
