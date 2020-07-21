<?php
    $arr = json_decode(file_get_contents("res.json"));

    echo json_encode($arr);
?>