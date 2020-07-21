<?php
    include "helpers/db.php";
    $conn = connectToDatabase('competitionTracker');
    $options = selectAll($conn, 'parsers', 'name');
?>