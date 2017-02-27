#!/bin/bash

cd /var/www

# composer install

curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

sudo sed -i "s/^user.*/user www-data;/" /etc/nginx/nginx.conf

sudo service nginx restart

# prepare data dir

mkdir -p /var/data
chown -R www-data.www-data /var/data
