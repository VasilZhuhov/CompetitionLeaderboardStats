<?php
  $config=json_decode(file_get_contents("./config.json"));
  $databaseName=$config->databaseName;
  $servername=$config->servername;
  $username=$config->username;
  $password=$config->password;
  $conn = new PDO("mysql:host=$servername;dbname=$databaseName", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  include 'helpers/db.php';
  $options = selectAll($conn, 'parsers', 'name');
?>