<?php
/** starts session */
session_start();

/** required file */
require '../model/db.php';

/**
 * @var string $value   Old Password of the user
 * @var string $email   email of the user
 */
$value = $_POST['query'];
$email = $_SESSION['user'];

/** check if the old password matched */
if (!loginSuccess($email, $value)) {
    echo "**Please insert correct old password.";
}
