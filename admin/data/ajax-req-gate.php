<?php
/**
 * Created by PhpStorm.
 * User: Oyon
 * Date: 2/9/2016
 * Time: 3:52 PM
 */
require '../../model/db.php';
$resp = array();
if(isset($_POST['gateID'])){
    $gateID = $_POST['gateID'];
    $row = getGateInfo($gateID);
    $resp['key'] = $row['g_id'];
    $resp['Name'] = $row['g_title'];
    $resp['image'] = $row['g_image'];
    $resp['value'] = $row['g_price'];
    echo json_encode($resp);
}elseif(isset($_POST['stageID'])){
    $stageID = $_POST['stageID'];
    $row = getStageInfo($stageID);
    $resp['key'] = $row['st_id'];
    $resp['Name'] = $row['st_title'];
    $resp['image'] = $row['st_image'];
    $resp['value'] = $row['st_price'];
    echo json_encode($resp);
}


?>