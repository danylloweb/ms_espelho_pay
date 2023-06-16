#!/usr/bin/env sh

printf "\n\nStarting PHP $PHP_VERSION daemon...\n\n";
php-fpm --daemonize

printf "Starting Nginx...\n\n"
set -e

if [[ "$1" == -* ]]; then
    set -- nginx -g daemon off; "$@"
fi

if [ $# -eq 0 ]
  then
    echo "
# Artisan Scheduler
* * * * * cd /var/www && /usr/local/bin/php artisan schedule:run >> /tmp/cron.log
" >> /etc/crontab
    crontab /etc/crontab
    export COMPOSER_MEMORY_LIMIT=-1
fi
exec "$@"
