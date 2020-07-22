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
    // print("<pre>".print_r($manage, true)."</pre>");

    fclose($current_res);

    include '../helpers/db.php';
    $conn = connectToDatabase();

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

    // ---------------------------------------
    // feed data into $name.json
    $file = fopen("../competition_data/$name.json", "a") or die("Unable to open file!");

    $data = file_get_contents("../competition_data/$name.json");

    $defaultConfig = file_get_contents("../competition_data/default_config.json");
    $defaultConfigDecoded = json_decode($defaultConfig);

    $defaultJSON = "{\"data\":[], \"config\": $defaultConfig}";
    // $defaultJSONDecoded = json_decode($defaultJSON);


    if(strlen($data) == 0){
        $data = $defaultJSON;
    }

    $dataDecoded = json_decode($data);
    $dataDecoded -> config -> title = $name . " progress results";
    // print_r($dataDecoded);

    $topK = "show-top-k";
    //echo gettype($defaultConfigDecoded -> $topK) . "\n\n\n\n";

    $counter = 0;
    $cap = $defaultConfigDecoded -> $topK;
    $mapping = ["first", "second", "third", "fourth", "fifth", "sixth", "seventh", "eighth", "ninth", "tenth"];
    $TEN = 10;
    $time = date("H:i:sa");

    $currentStandings = new stdClass();
    $currentStandings -> time = $time;

    foreach($manage as $current){
        if($counter > $cap){
            break;
        }

        $participantName = $current['name'];
        $score = $current['points'];

        $currentName = "name_" . (($counter >= $TEN) ? (string)($counter + 1) . "th" : $mapping[$counter]);
        $currentValue = "value_" . (($counter >= $TEN) ? (string)($counter + 1) . "th" : $mapping[$counter]);

        $currentStandings -> $currentName = $participantName;
        $currentStandings -> $currentValue = $score;


        $counter += 1;
    }
    array_push($dataDecoded -> data, $currentStandings);

    //print_r($dataDecoded);
    fclose($file);

    $file = fopen("../competition_data/$name.json", "w") or die("Unable to open file!");
    fwrite($file, json_encode($dataDecoded));
    fclose($file);

    echo "done";

?>
