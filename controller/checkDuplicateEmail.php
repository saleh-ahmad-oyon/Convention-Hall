<?php
/** required file */
require '../model/db.php';

/** @var string $value   Given email by the new user */
$value = $_GET['query'];

/** check if the email is exist */
if (checkUserEmail($value)) {
    echo "**This email has already used. Please try another email.";
}
