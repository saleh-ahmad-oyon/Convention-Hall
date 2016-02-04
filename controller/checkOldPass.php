<?php
    session_start();
    require '../model/db.php';

    $value = $_POST['query'];
    $email = $_SESSION['user'];
    if(!loginSuccess($email, $value)){
        echo "**Old Password didn't match !!";
    }
?>