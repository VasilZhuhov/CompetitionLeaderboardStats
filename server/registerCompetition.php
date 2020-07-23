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
        $conn = connectToDatabase();
        if(array_key_exists("useExisting", $_POST)){
            $useExisting = true;
            $query = 'SELECT * FROM parsers WHERE name="'.$_POST['selectedParser'].'";';

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

        $query = "SELECT min(id) FROM parsers WHERE name = '$name'";
        $q = $conn -> query($query);
        $id = $q -> fetch()[0];



        $query = "INSERT INTO competitions (name, url, parserId)
        VALUES ('$name', '$url', '$id')";
        $conn->exec($query);


        include '../server/getCompetitionStats.php';
    }

?>