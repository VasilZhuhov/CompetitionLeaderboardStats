<?php
    include '../helpers/db.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = $_POST['name'];
        $url = $_POST['url'];
        $namePath = $_POST['namePath'];
        $scorePath = $_POST['scorePath'];
        $rankPath = $_POST['rankPath'];
        $command = 'node scriping.js -u "' . $url . '" -n "' . $namePath . '" -p "' . $scorePath . '" -r "' . $rankPath . '"';
        // try{
        //     $output = shell_exec($command);
        // }catch(T_STRING $e){
        //     echo $e;
        // }
        $output = shell_exec($command);
        // echo $output;
        $manage = json_decode($output, true);
        $conn = connectToDatabase('competitionTracker');     
        $query = "INSERT INTO Parsers (name, namePath, scorePath, rankPath)
        VALUES ('$name', '$namePath', '$scorePath', '$rankPath')";
        $conn->exec($query);
        echo $output;
        print("<pre>".print_r($manage, true)."</pre>");
    }
?>