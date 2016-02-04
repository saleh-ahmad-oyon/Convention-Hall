<?php
require_once 'define.php';
require_once '../model/db.php';
$row = getDateShift();
$outp ='';
$i=0;
foreach($row as $r){
    $shift = explode(" ", $r['order_shift']);
    $url = SERVER.'/admin/bookingDetails?order='.$r['order_id'];
    $outp[$i]['title'] = $shift[0];
    $outp[$i]['url'] = $url;
    $outp[$i]['start'] = $r['order_date'];
    $i++;
}
echo json_encode($outp, JSON_UNESCAPED_SLASHES);
?>