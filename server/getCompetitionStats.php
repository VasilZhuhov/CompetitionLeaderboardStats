<?php
    // $command = 'node scriping.js -u "' . $url . '" -n "' . $namePath . '" -p "' . $scorePath . '" -r "' . $rankPath . '"';

    // $output = shell_exec($command);
    // $manage = json_decode($output, true);
    // print("<pre>".print_r($manage, true)."</pre>");

    // https://www.hackerrank.com/contests/practice-7-sda/leaderboard/1
    // .leaderboard > .table-wrap > #leaders > .leaderboard-list-view > .leaderboard-row > .span-flex-4 > p
    // .leaderboard > .table-wrap > #leaders > .leaderboard-list-view > .leaderboard-row > .span-flex-3 > p
    // .leaderboard > .table-wrap > #leaders > .leaderboard-list-view > .leaderboard-row > .text-center > p
    // $command = 'node scriping.js -u "' . $url . '" -n "' . $namePath . '" -p "' . $scorePath . '" -r "' . $rankPath . '"';


    // $command = 'node scriping.js -u "' . $url . '" -n "' . $namePath . '" -p "' . $scorePath . '" -r "' . $rankPath . '"';
    // $output = shell_exec($command);
    // $manage = json_decode($output, true);
    // print("<pre>".print_r($manage, true)."</pre>");

    //global $url, $namePath, $scorePath, $rankPath, $command, $output, $manage;



    //echo shell_exec("pwd");
    $command = 'node scriping.js -u "' . $url . '" -n "' . $namePath . '" -p "' . $scorePath . '" -r "' . $rankPath . '"';


    function getData(){
        global $command;
        $file = fopen("..\\front-end\\res.json", "w") or die("Unable to open file!");
        $output = shell_exec($command);
        $manage = json_decode($output, true);
        fwrite($file, $output);
        fclose($file);
        print("<pre>".print_r($manage, true)."</pre>");
    }

    function schedule($url, $namePath, $scorePath, $rankPath, $name){
        try {
            $c = 'bash CRON.sh "' . $url . '" "' . $namePath . '" "' . $scorePath . '" "' . $rankPath . '" "' . $name . '"> /dev/null 2>&1 &';
            $res = shell_exec($c);
            echo $res;
        }
        catch(T_STRING $e) {
            echo $e;
        }
    }

    schedule($url, $namePath, $scorePath, $rankPath, $name);



    //exec("schtasks /create /sc MINUTE /mo 1 /tn \"Cron\" /tr \"C:\\xampp\htdocs\MoveMe\CRON.bat\"");

?>