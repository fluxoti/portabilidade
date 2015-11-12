#! /usr/bin/env bash

. includes/colors

source includes/check_requisites.sh

#Repostories
apt-add-repository -y ppa:chris-lea/node.js
apt-add-repository -y ppa:ondrej/php5-5.6

apt-get -y update --fix-missing
# Force Locale

#change locale, timezone and hostname
echo "LC_ALL=pt_BR.UTF-8" >> /etc/default/locale
locale-gen pt_BR.UTF-8
ln -nfs /usr/share/zoneinfo/Brazil/East /etc/localtime

# Common packages
apt-get install -y --force-yes build-essential dos2unix gcc git libmcrypt4 libpcre3-dev \
make python2.7-dev python-pip re2c supervisor unattended-upgrades whois vim rubygems-integration \
software-properties-common python-software-properties

#Php
apt-get install -y --force-yes php5-fpm php5-cli php-pear \
php5-mysqlnd \
php5-apcu php5-json php5-curl php5-gd \
php5-gmp php5-imap php5-mcrypt \
php5-memcached

# Make MCrypt Available
ln -s /etc/php5/conf.d/mcrypt.ini /etc/php5/mods-available
sudo php5enmod mcrypt

# Set Some PHP CLI Settings
sudo sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/cli/php.ini
sudo sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/cli/php.ini
sudo sed -i "s/memory_limit = .*/memory_limit = 512M/" /etc/php5/cli/php.ini
sudo sed -i "s/;date.timezone.*/date.timezone = America/Sao_Paulo/" /etc/php5/cli/php.ini

# Set Some PHP FPM Settings
sudo sed -i "s/error_reporting = .*/error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT/" /etc/php5/fpm/php.ini
sudo sed -i "s/display_errors = .*/display_errors = Off/" /etc/php5/fpm/php.ini
sudo sed -i "s/memory_limit = .*/memory_limit = 512M/" /etc/php5/fpm/php.ini
sudo sed -i "s/;date.timezone.*/date.timezone = America/Sao_Paulo/" /etc/php5/fpm/php.ini
sudo sed -i "s/;upload_max_filesize = .*/upload_max_filesize = 100M/" /etc/php5/fpm/php.ini
sudo sed -i "s/;cgi.fix_pathinfo=.*/cgi.fix_pathinfo=0/" /etc/php5/fpm/php.ini

# Set Some PHP Pool configuration
sudo sed -i "s/pm = .*/pm = dynamic/" /etc/php5/fpm/pool.d/www.conf
sudo sed -i "s/pm.max_children = .*/pm.max_children = 1000/" /etc/php5/fpm/pool.d/www.conf
sudo sed -i "s/pm.start_servers = .*/pm.start_servers = 120/" /etc/php5/fpm/pool.d/www.conf
sudo sed -i "s/pm.min_spare_servers = .*/pm.min_spare_servers = 60/" /etc/php5/fpm/pool.d/www.conf
sudo sed -i "s/pm.max_spare_servers = .*/pm.max_spare_servers = 180/" /etc/php5/fpm/pool.d/www.conf

#Mysql
echo "mysql-server mysql-server/root_password password $DBPASSWD" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password $DBPASSWD" | debconf-set-selections

apt-get -y --force-yes install mysql-server-5.5

mysql -uroot -p$DBPASSWD -e "CREATE DATABASE $DBNAME CHARACTER SET utf8 COLLATE utf8_general_ci"
mysql -uroot -p$DBPASSWD -e "grant all privileges on $DBNAME.* to '$DBUSER'@'localhost' identified by '$DBPASSWD'"

# Install composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
printf "\nPATH=\"~/.composer/vendor/bin:\$PATH\"\n" | tee -a /home/vagrant/.profile

#Nginx e nodejs
apt-get -y --force-yes install nginx nodejs
/usr/bin/npm install -g gulp
/usr/bin/npm install -g bower


echo "server {

    root /var/www/portabilidade/current/public;
    index index.php index.html index.htm;

    server_name $SERVER_NAME;

    client_max_body_size 100M;

    error_log /var/log/nginx/portabilidade.log error;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

     location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        fastcgi_intercept_errors off;
        fastcgi_buffer_size 16k;
        fastcgi_buffers 4 16k;
        fastcgi_connect_timeout 300;
        fastcgi_send_timeout 300;
        fastcgi_read_timeout 300;
    }

    location ~ /\.ht {
        deny all;
    }

}" > /etc/nginx/sites-available/portabilidade
ln -s /etc/nginx/sites-available/portabilidade /etc/nginx/sites-enabled/portabilidade

#create document root
mkdir -p /var/www
chown -R www-data:www-data /var/www
chmod -R 775 /var/www

/etc/init.d/nginx restart
service php5-fpm restart