<?php
    $url = $argv[1];
    $namePath = $argv[2];
    $scorePath = $argv[3];
    $rankPath = $argv[4];
    $name = $argv[5];
    echo "!!!!!!!!";
    echo $name;
    $current_res = fopen("../front-end/res.json", "w") or die("Unable to open file!");

    $command = 'node scriping.js -u "' . $url . '" -n "' . $namePath . '" -p "' . $scorePath . '" -r "' . $rankPath . '"';
    $output = shell_exec($command);
    $manage = json_decode($output, true);
    fwrite($current_res, $output);
    print("<pre>".print_r($manage, true)."</pre>");


    fclose($current_res);

?>