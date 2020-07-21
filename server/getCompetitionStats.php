<?php
    function schedule($url, $namePath, $scorePath, $rankPath, $name, $minutes){
        try {
            $c = 'bash ../server/CRON.sh "' . $url . '" "' . $namePath . '" "' . $scorePath . '" "' . $rankPath . '" "' . $name . '" "' . $minutes . '" > /dev/null 2>&1 &';
            $res = shell_exec($c);
            echo $res;
        }
        catch(T_STRING $e) {
            echo $e;
        }
    }
    schedule($url, $namePath, $scorePath, $rankPath, $name, $trackingTime);
?>