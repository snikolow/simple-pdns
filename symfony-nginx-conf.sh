#!/usr/bin/env bash
set -e

if [[ -n "${DEBUG}" ]]; then
    set -x
fi

cp /var/www/html/nginx-vhost.conf /etc/nginx/conf.d/vhost.conf
