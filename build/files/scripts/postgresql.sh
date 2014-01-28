#!/bin/bash
set -e

yum -y --enablerepo=remi install postgresql postgresql-server postgresql-contrib

DATADIR="/var/lib/postgresql/9.1/main"
CONF="/etc/postgresql/9.1/main/postgresql.conf"
POSTGRES="/usr/local/pgsql/bin/postgres"
INITDB="/usr/local/pgsql/bin/initdb"

# test if DATADIR is existent
if [ ! -d $DATADIR ]; then
  echo "Creating Postgres data at $DATADIR"
  mkdir -p $DATADIR
fi

# test if DATADIR has content
if [ ! "$(ls -A $DATADIR)" ]; then
  echo "Initializing Postgres Database at $DATADIR"
  chown -R postgres $DATADIR
  su postgres sh -c "$INITDB $DATADIR"
fi
