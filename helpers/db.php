<?php
function connectToDatabase(){
    $config=json_decode(file_get_contents("../config.json"));
    $databaseName=$config->databaseName;
    $servername=$config->servername;
    $username=$config->username;
    $password=$config->password;
    $conn = new PDO("mysql:host=$servername;dbname=$databaseName", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function selectAll($connection, $tableName, $attribute){
    $query = "SELECT $attribute FROM `$tableName`;";
    $q = $connection->query($query);
    $results = $q->fetchAll();
    return $results;
}

?>