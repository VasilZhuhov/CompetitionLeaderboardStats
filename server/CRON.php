<?php
    $config =  json_decode(file_get_contents("front-end\\comp_config.json"));
    $current_res = fopen("front-end\\res.json", "w") or die("Unable to open file!");
    
    $url = $config -> url;
    $namePath = $config -> namePath;
    $scorePath = $config -> scorePath;
    $rankPath = $config -> rankPath;
    
    $command = 'node server\\scriping.js -u "' . $url . '" -n "' . $namePath . '" -p "' . $scorePath . '" -r "' . $rankPath . '"';
    $output = shell_exec($command);
    $manage = json_decode($output, true);
    fwrite($current_res, $output);
    print("<pre>".print_r($manage, true)."</pre>");
    
    
    fclose($current_res);

?>