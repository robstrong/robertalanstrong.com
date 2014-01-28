#!/bin/bash
set -e

if [[ $EUID -ne 0 ]]; then
    echo "This script must be run as root" 1>&2
    exit 1
fi

SCRIPT_PATH="`dirname \"$0\"`"
$SCRIPT_PATH/ssh.sh
$SCRIPT_PATH/github.sh
$SCRIPT_PATH/apache.sh
$SCRIPT_PATH/php.sh
$SCRIPT_PATH/supervisord.sh
$SCRIPT_PATH/git.sh
$SCRIPT_PATH/composer.sh

