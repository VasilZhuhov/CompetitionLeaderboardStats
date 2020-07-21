#!/usr/bin/bash
#for i in `eval echo {0..$6}` #One tick here is 20 seconds, so put period for which you want to use it
#do
php ../server/CRON.php "$1" "$2" "$3" "$4" "$5"
    #sleep 20
#done