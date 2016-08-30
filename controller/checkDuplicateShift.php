<?php
require '../model/db.php';

$value = $_GET['query'];
$dob   = $_GET['date'];
$date  = str_replace('/', '-', $dob);
$date  = date('Y-m-d', strtotime($date));

if (similarDateShift($date, $value)) {
    echo "**$value has already booked !! Please select another shift.";
}
