<?php
session_start();

require '../model/db.php';
require 'define.php';

function getTotalBookingAmount($service, $guest, $gate, $stage, $food, $full, $amount, $setMenu)
{
    $serv = explode('|', $service);
    $grandTotal = 0.00;
    $serviceTotal = 0.00;

    foreach ($serv as $s) {
        if ($s != 2) {
            $serviceTotal+=(double)getServicePrice($s);
        } else {
            $serviceTotal+=(double)(getServicePrice($s) * $guest);
        }
    }

    $gateTotal    = getGateValue($gate);
    $stageTotal   = getStageValue($stage);
    $setMenuTotal = getPriceSetMenu($setMenu);

    $foo = explode('|', $food);
    $foodTotal = 0.00;

    foreach ($foo as $f) {
        $foodTotal+=(double)getFoodPrice($f);
    }

    $fullamount = 0.00;
    $j=0;

    for ($i=0; $i<count($full); $i++) {
        for ($j; $j<$i+1 ; $j++) {
            $fullamount += ((double)getFoodPrice($full[$i]) * $amount[$j]);
        }
    }

    $grandTotal = $serviceTotal + $gateTotal + $stageTotal + ($foodTotal * $guest) + $fullamount + ($setMenuTotal * $guest);
    $vat = $grandTotal * 0.15;
    $grandTotal += $vat;
    return floor($grandTotal);
}

if (isset($_POST['bookingbtn'])) {
    $user = $_SESSION['id'];

    $dob  = $_POST['dobooking'];
    $date = str_replace('/', '-', $dob);
    $date = date('Y-m-d', strtotime($date));

    $shift   = $_POST['shift'];
    $purpose = $_POST['purpose'];
    $service = '';

    if (!empty($_POST['service'])) {
        $service = implode('|', $_POST['service']);
    }

    $service .= '1|2';
    $guest = $_POST['guestNum'];

    if ($guest <=500) {
        $service.='|'.getServiceID(500);
    } else {
        $service.='|'.getServiceID(1000);
    }

    $gate = 0;
    If (isset($_POST['gate'])) {
        $gate = $_POST['gate'];
    }

    $stage = 0;
    If (isset($_POST['stage'])) {
        $stage = $_POST['stage'];
    }
    $setMenu = 0;
    If (isset($_POST['setMenu'])) {
        $setMenu = $_POST['setMenu'];
    }

    $food = '0';
    if (!empty($_POST['food'])) {
        $food = implode('|', $_POST['food']);
    }

    $amount = $_POST['amount'];
    $full   = $_POST['foodFull'];

    $fullamount = '';
    $j = 0;
    for ($i=0; $i<count($full); $i++) {
        for ($j; $j<$i+1 ; $j++) {
            $fullamount .= $full[$i].'|'.$amount[$j].';';
        }
    }
    $fullamount = rtrim($fullamount, ';');

    $totalCost  = getTotalBookingAmount($service, $guest, $gate, $stage, $food, $full, $amount, $setMenu);

    if (!similarDateShift($date, $shift)) {
        setOrder($user, $date, $shift, $purpose, $service, $guest, $gate, $stage, $food, $totalCost, $fullamount, $setMenu, date("Y-m-d"));
        echo '<script language="javascript">
                alert("Temporarily Booked !!\nYour Total Cost is '.$totalCost. '.00");
                window.location="'.SERVER.'/myBookings";
              </script>';
    } else {
        echo '<script language="javascript">
                alert("Date and shift have already chosen !!");
                window.location="'.SERVER.'/booking";
              </script>';
    }
}
