<?php

function db_conn()
{
    $SERVER = 'localhost';
    $user   = 'root';
    $pass   = '';
    $db     = 'convention_hall';

    try {
        $conn = new PDO('mysql:host='.$SERVER.';dbname='.$db.';charset=utf8', $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $conn;
}
