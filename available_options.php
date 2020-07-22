<?php
    include "helpers/db.php";
    $conn = connectToDatabase();
    $options = selectAll($conn, 'parsers', 'name');
?>