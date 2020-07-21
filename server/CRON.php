<?php
    $url = $argv[1];
    $namePath = $argv[2];
    $scorePath = $argv[3];
    $rankPath = $argv[4];
    $name = $argv[5];

    $current_res = fopen("./res.json", "w") or die("Unable to open file!");
    $command = 'node ../server/scriping.js -u "' . $url . '" -n "' . $namePath . '" -p "' . $scorePath . '" -r "' . $rankPath . '"';
    $output = shell_exec($command);
    $manage = json_decode($output, true);
    fwrite($current_res, $output);
    print("<pre>".print_r($manage, true)."</pre>");

    fclose($current_res);

    include '../helpers/db.php';
    $conn = connectToDatabase('competitionTracker');

    $query = "SELECT min(id) FROM parsers WHERE name = '$name'";
    $q = $conn -> query($query);
    $id = $q -> fetch()[0];



    $query = "INSERT INTO competitions (name, url, parserId)
    VALUES ('$name', '$url', '$id')";
    $conn->exec($query);


    // slow af
    foreach($manage as $current){
        $participantName = $current['name'];
        $score = $current['points'];
        $query = "INSERT INTO participants (name, score)
        VALUES ('$participantName', '$score')";
        $conn->exec($query);
    }

    foreach($manage as $current){
        $participantName = $current['name'];
        $query = "SELECT max(id) FROM participants WHERE name = '$participantName'";
        $q = $conn -> query($query);
        $participantId = $q -> fetch()[0];

        $query = "INSERT INTO competition_participants (competitionId, participantId)
        VALUES ('$id', '$participantId')";
        $conn -> exec($query);
    }

?>
