#!/bin/bash
set -e

yum -y --enablerepo=remi install php php-common php-cli php-pear php-pdo php-pgsql php-pecl-memcache php-pecl-memcached php-gd php-mbstring php-mcrypt php-xml php-devel
echo "date.timezone=America/New_York" >> /etc/php.ini
