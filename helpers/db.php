<?php
function connectToDatabase($databaseName){
    $servername="127.0.0.1";
    $username="root";
    $password="#XQ5LFf.k9$5pMt";
    $conn = new PDO("mysql:host=$servername;dbname=$databaseName", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
?>