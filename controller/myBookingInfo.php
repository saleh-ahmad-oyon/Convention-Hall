<?php
    require_once '../model/db.php';

    $userID = $_GET['id'];
    $row = getBookingInfo($userID);
    $outp = "[";
    foreach($row as $r){
        if ($outp != "[") {
            $outp .= ",";
        }

        $DOB = strtotime($r['date_of_booking']) ;
        $DOB = date("d M, Y", $DOB);

        $DOP = strtotime($r['order_date']) ;
        $DOP = date("d M, Y", $DOP);

        $outp .= '{"DoB":"'  . $DOB . '",';
        $outp .= '"DoP":"'   . $DOP . '",';
        $outp .= '"purpose":"'. $r['order_purpose'] . '",';
        $outp .= '"totalCost":"'   . $r['total_cost'] . '",';
        $outp .= '"paidCost":"'. $r['paid_cost'] . '",';
        $outp .= '"keyID":"'. $r['order_id'] . '"}';
    }
    $outp .="]";
    echo $outp;
?>