<?php
 $servername="127.0.0.1";
 $username="root";
 $password="#XQ5LFf.k9$5pMt";

 try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
      $sql = "CREATE DATABASE competitionTracker";  
      $conn->exec($sql);
      echo "Database is created successfully!";
    } catch(PDOException $e) {
      echo "Database is already created!";
    }

    try {
      $conn = new PDO("mysql:host=$servername;dbname=competitionTracker", $username, $password);
      $tableSQL = "CREATE TABLE Parsers (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        ownerId INT(6),
        name VARCHAR(50),
        namePath VARCHAR(100),
        scorePath VARCHAR(100),
        rankPath VARCHAR(100)
        )";
      $conn->exec($tableSQL);
      echo "Table is created successfully!";
    } catch(PDOException $e)  {
      echo "Table is already created!";
    }
   
 } catch(PDOException $e) {
   print $e;
 }

?>