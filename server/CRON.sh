#!/usr/bin/bash
for i in {0..3}
do
    php CRON.php "$1" "$2" "$3" "$4" "$5"
    sleep 20
done