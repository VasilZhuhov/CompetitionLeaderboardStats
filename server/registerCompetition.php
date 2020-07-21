<?php
    include '../helpers/db.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = $_POST['name'];
        $url = $_POST['url'];
        $namePath = $_POST['namePath'];
        $scorePath = $_POST['scorePath'];
        $rankPath = $_POST['rankPath'];
        $trackingTime = $_POST['trackingTime'];

        $useExisting = false;
        $parser;
        $conn = connectToDatabase('competitionTracker');

        if(array_key_exists("useExisting", $_POST)){
            $useExisting = true;
            $query = 'SELECT * FROM Parsers WHERE name="'.$_POST['selectedParser'].'";';

            $q = $conn->query($query);
            $results = $q->fetch();

            $namePath = $results['namePath'];
            $scorePath = $results['scorePath'];
            $rankPath = $results['rankPath'];
        }

        if(!array_key_exists("useExisting", $_POST)){
            $query = "INSERT INTO parsers (name, namePath, scorePath, rankPath)
            VALUES ('$name', '$namePath', '$scorePath', '$rankPath')";
            $conn->exec($query);
        }

        include '../server/getCompetitionStats.php';
    }

?>