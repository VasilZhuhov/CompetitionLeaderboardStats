#!/usr/bin/bash
for i in `eval echo {0..$6}`
do
    php ../server/CRON.php "$1" "$2" "$3" "$4" "$5"
    sleep $6;
done