<?php
    function schedule($url, $namePath, $scorePath, $rankPath, $name, $minutes){
        try {
            $defaultConfig = file_get_contents("../competition_data/default_config.json");
            $defaultConfigDecoded = json_decode($defaultConfig);
            $refreshRate = $defaultConfigDecoded->refreshRateInSeconds;
            $c = 'bash ../server/CRON.sh "' . $url . '" "' . $namePath . '" "' . $scorePath . '" "' . $rankPath . '" "' . $name . '" "' . $minutes . '" "'. $refreshRate .'" > /dev/null 2>&1 &';
            $res = shell_exec($c);
            echo $res;
        }
        catch(T_STRING $e) {
            echo $e;
        }
    }
    schedule($url, $namePath, $scorePath, $rankPath, $name, $trackingTime);
?>