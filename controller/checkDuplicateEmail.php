<?php
    require '../model/db.php';
    $value = $_GET['query'];
    //$value = $_POST['query'];

    if(checkUserEmail($value)){
        echo "**Email already used";
    }
