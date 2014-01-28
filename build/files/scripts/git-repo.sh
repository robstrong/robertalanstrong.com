#!/bin/bash
set -e

SSH_DIR=/root/.ssh
if [ ! -d "$SSH_DIR" ]; then
    mkdir -p $SSH_DIR
fi

echo -e "Host github.com\n\tStrictHostKeyChecking no\n" >> /root/.ssh/config
rm -Rf /var/www/* 
git clone $1 /var/www
chown -R www-data:www-data /var/www
