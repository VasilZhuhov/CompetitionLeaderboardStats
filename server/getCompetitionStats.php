<?php
    function execInBackground($cmd){
        if (substr(php_uname(), 0, 7) == "Windows"){ 
            $p = popen("start /MIN ". $cmd, "r");
            pclose($p);
        }else{ 
            exec($cmd . " > /dev/null &");   
        } 
    } 
    function schedule($url, $namePath, $scorePath, $rankPath, $name, $minutes){
        try {
            $defaultConfig = file_get_contents("../competition_data/default_config.json");
            $defaultConfigDecoded = json_decode($defaultConfig);
            $refreshRate = $defaultConfigDecoded->refreshRateInSeconds;
            $c = 'php ../server/r.php "' . $url . '" "' . $namePath . '" "' . $scorePath . '" "' . $rankPath . '" "' . $name . '" "' . $minutes . '" "'. $refreshRate .'"';
            execInBackground($c);
        }
        catch(T_STRING $e) {
            echo $e;
        }
    }
    schedule($url, $namePath, $scorePath, $rankPath, $name, $trackingTime);
?>