<?php
 $servername="127.0.0.1";
 $username="root";
 $password="#XQ5LFf.k9$5pMt";

 try {
    // $conn = new PDO("mysql:host=$servername", $username, $password);
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // try{
    //   $sql = "CREATE DATABASE competitionTracker";
    //   $conn->exec($sql);
    //   echo "Database is created successfully!";
    // } catch(PDOException $e) {
    //   echo "Database is already created!";
    // }

    $conn = new PDO("mysql:host=$servername;dbname=competitionTracker", $username, $password);
    $tableSQL = "CREATE TABLE IF NOT EXISTS parsers(
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      ownerId INT(6),
      name VARCHAR(50),
      namePath VARCHAR(100),
      scorePath VARCHAR(100),
      rankPath VARCHAR(100)
      )";
    $conn->exec($tableSQL);
    echo "Table is created successfully!\n";

    $conn = new PDO("mysql:host=$servername;dbname=competitionTracker", $username, $password);
    $tableSQL = "CREATE TABLE IF NOT EXISTS competitions (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        url VARCHAR(100),
        parserId INT(6) UNSIGNED,
        FOREIGN KEY (parserId) REFERENCES parsers (id),
        startTime DATETIME
      )";
    $conn->exec($tableSQL);
    echo "Table is created successfully!\n";

    $conn = new PDO("mysql:host=$servername;dbname=competitionTracker", $username, $password);
    $tableSQL = "CREATE TABLE IF NOT EXISTS participants(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100)
      )";
    $conn->exec($tableSQL);
    echo "Table is created successfully!\n";

    $conn = new PDO("mysql:host=$servername;dbname=competitionTracker", $username, $password);
    $tableSQL = "CREATE TABLE IF NOT EXISTS competition_participants(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        competitionId INT(6) UNSIGNED,
        FOREIGN KEY (competitionId) REFERENCES competitions (id),
        participantId INT(6) UNSIGNED,
        FOREIGN KEY (participantId) REFERENCES participants (id)
      )";
    $conn->exec($tableSQL);
    echo "Table is created successfully!\n";

    $conn = new PDO("mysql:host=$servername;dbname=competitionTracker", $username, $password);
    $tableSQL = "CREATE TABLE IF NOT EXISTS tasks(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        maxScore INT(6) UNSIGNED,
        description VARCHAR(250)
      )";
    $conn->exec($tableSQL);
    echo "Table is created successfully!\n";

    $conn = new PDO("mysql:host=$servername;dbname=competitionTracker", $username, $password);
    $tableSQL = "CREATE TABLE IF NOT EXISTS competition_tasks(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        competitionParticipantId INT(6) UNSIGNED,
        FOREIGN KEY (competitionParticipantId) REFERENCES competition_participants (id),
        taskId INT(6) UNSIGNED,
        FOREIGN KEY (taskId) REFERENCES tasks (id),
        score INT(6) UNSIGNED,
        timeTaken TIME
      )";
    $conn->exec($tableSQL);
    echo "Table is created successfully!\n";

 } catch(PDOException $e) {
   print $e;
 }

?>