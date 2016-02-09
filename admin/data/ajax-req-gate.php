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
}


?>