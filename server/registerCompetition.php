<?php
    include '../helpers/db.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = $_POST['name'];
        $url = $_POST['url'];
        $namePath = $_POST['namePath'];
        $scorePath = $_POST['scorePath'];
        $rankPath = $_POST['rankPath'];
        $command = 'node scriping.js -u "' . $url . '" -n "' . $namePath . '" -p "' . $scorePath . '" -r "' . $rankPath . '"';
        
        $output = shell_exec($command);
        $manage = json_decode($output, true);
        $conn = connectToDatabase('competitionTracker');     
        $query = "INSERT INTO Parsers (name, namePath, scorePath, rankPath)
        VALUES ('$name', '$namePath', '$scorePath', '$rankPath')";
        $conn->exec($query);
        print("<pre>".print_r($manage, true)."</pre>");
    }
?>