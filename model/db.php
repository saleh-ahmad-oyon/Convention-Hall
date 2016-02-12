<?php
require_once 'db_connection.php';
function checkUserEmail($email){
    $conn = db_conn();
    $selectQuery = "SELECT COUNT(1) as `num` FROM `user` WHERE `u_email` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($email));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return ($row['num'] == 1) ? true : false ;
}
function insertUser($fname, $lname, $email, $contact, $pass){
    $conn = db_conn();
    $selectQuery = "call new_user(:fname, :lname, :email, :contact, :pass)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array(':fname' => $fname, ':lname' => $lname, ':email' => $email, ':contact' => $contact, ':pass' => $pass));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function addSchedule($shift, $time){
    $conn = db_conn();
    $selectQuery = "call insert_schedule(:shift, :time)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array(':shift' => $shift, ':time' => $time));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function addCharges($service, $price){
    $conn = db_conn();
    $selectQuery = "call insert_service(:service, :price)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array(':service' => $service, ':price' => $price));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function getScheduleID($shift, $time){
    $conn = db_conn();
    $selectQuery = "SELECT `shift_id` FROM `shift` WHERE `shift_name` = ? AND `shift_time` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($shift, $time));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['shift_id'];
}
function loginSuccess($email, $pass){
    $conn = db_conn();
    $selectQuery = "SELECT COUNT(1) as `num` FROM `user` WHERE `u_email` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($email));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['num'] == 1){
        $user = $email;
        $selectQuery2 = "SELECT `u_pass` FROM `user` WHERE `u_email` = ?";
        try{
            $stmt2 = $conn->prepare($selectQuery2);
            $stmt2->execute(array($user));
        }catch(PDOException $e){
            handle_sql_errors($selectQuery, $e->getMessage());
        }
        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $dataPass = $row2['u_pass'];
        if(password_verify($pass, $dataPass)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function addiFood(){
    $conn = db_conn();
    $selectQuery = 'select * from addi_food';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function personalInfo($user){
    $conn = db_conn();
    $selectQuery = "SELECT `u_fname`, `u_lname`, `u_email`, `u_contact` FROM `user` WHERE `u_email` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($user));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function updatePass($newPass, $email){
    $conn = db_conn();
    $selectQuery = "UPDATE `user` SET `u_pass`= ? WHERE `u_email` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($newPass, $email));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function updateInfo($fname, $lname, $email, $contact, $user){
    $conn = db_conn();
    $selectQuery = "UPDATE `user` SET `u_fname`=:fname,`u_lname`=:lname,`u_email`=:email,`u_contact`=:contact WHERE `u_email`=:user";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array(':fname' => $fname, ':lname' => $lname, ':email' => $email, ':contact' => $contact, ':user' => $user));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function getUserID($email){
    $conn = db_conn();
    $selectQuery = "SELECT `s_id` FROM `user` WHERE `u_email` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($email));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function checkEditedEmail($email, $userId){
    $conn = db_conn();
    $selectQuery = "SELECT COUNT(1) as `num` FROM `user` WHERE `u_email` = ? and `s_id` <> ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($email, $userId));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return ($row['num'] == 1) ? true : false ;
}
function stage(){
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM stage_view';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function gate(){
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM gate_view';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getServices(){
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM service_view';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getPurposes(){
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM purpose_view';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getShift(){
    $conn = db_conn();
    $selectQuery = 'SELECT `shift_name`, `shift_time` FROM `shift`';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }

    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function similarDateShift($date, $shift){
    $conn = db_conn();
    $selectQuery = "SELECT COUNT(1) as `num` FROM `hall_booking` WHERE `order_date` = :date AND `order_shift` = :shift";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array(':date' => $date, ':shift' => $shift));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return ($row['num'] == 1) ? true : false ;
}
function setOrder($user, $date, $shift, $purpose, $service, $guest, $gate, $stage, $food, $totalCost, $fullamount, $setMenu, $today){
    $conn = db_conn();
    $selectQuery = "call give_booking(:usr, :dat, :shift, :purpose, :service, :guest, :gate, :stage, :food, :totalCost, :fullamount, :setMenu, :today)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array(':usr' => $user, ':dat' => $date, ':shift' => $shift, ':purpose' => $purpose, ':service' => $service, ':guest' => $guest, ':gate' => $gate, ':stage' => $stage, ':food' => $food, ':totalCost' => $totalCost, ':fullamount' => $fullamount, ':setMenu' => $setMenu, ':today' => $today));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function getUserOrders($orderID){
    $conn = db_conn();
    $selectQuery = "CALL user_orders(?)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($orderID));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function getFoodTitle($fid){
    $conn = db_conn();
    $selectQuery = "SELECT `am_title` FROM `additional_menu` WHERE `am_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($fid));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['am_title'];
}
function getFoodImage($fid){
    $conn = db_conn();
    $selectQuery = "SELECT `am_image` FROM `additional_menu` WHERE `am_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($fid));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['am_image'];
}
function getFoodPrice($fid){
    $conn = db_conn();
    $selectQuery = "SELECT `am_price` FROM `additional_menu` WHERE `am_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($fid));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['am_price'];
}
function getServiceName($sid){
    $conn = db_conn();
    $selectQuery = "SELECT `serv_name` FROM `services` WHERE `serv_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($sid));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['serv_name'];
}
function getServicePrice($sid){
    $conn = db_conn();
    $selectQuery = "SELECT `Serv_price` FROM `services` WHERE `serv_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($sid));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['Serv_price'];
}
function getGateValue($gate){
    $conn = db_conn();
    $selectQuery = "SELECT `g_price` FROM `gate` WHERE `g_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($gate));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['g_price'];
}
function getGateInfo($gate){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `gate` WHERE `g_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($gate));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function getStageValue($stage){
    $conn = db_conn();
    $selectQuery = "SELECT `st_price` FROM `stage` WHERE `st_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($stage));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['st_price'];
}
function getStageInfo($stage){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `stage` WHERE `st_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($stage));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function getPriceSetMenu($setMenu){
    $conn = db_conn();
    $selectQuery = "SELECT `sm_price` FROM `set_menu` WHERE `sm_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($setMenu));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['sm_price'];
}
function checkAdmin($user, $pass){
    $conn = db_conn();
    $selectQuery = "SELECT COUNT(1) as `num` FROM `adminlogin` WHERE `a_user` = ? AND `a_pass` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($user, $pass));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return ($row['num'] == 1) ? true : false ;

}
function getDateShift(){
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `order_date_shift`';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function changeStatus($order, $paid, $o){
    $conn = db_conn();
    $selectQuery = "UPDATE `hall_booking` SET `order_status`= :orderStatus, `paid_cost`= :paidCost WHERE `order_id` = :orderID";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array(':orderStatus' => $o, ':paidCost' => $paid, ':orderID' => $order));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function updateGate($name, $cost, $image, $id){
    $conn = db_conn();
    $selectQuery = "UPDATE `gate` SET `g_title`= :title,`g_image`= :image,`g_price`= :price WHERE `g_id` = :id";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array(':title' => $name, ':image' => $image, ':price' => $cost, ':id' => $id));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function deleteOrder($order){
    $conn = db_conn();
    $selectQuery = "DELETE FROM `hall_booking` WHERE `order_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($order));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function deleteGate($gateID){
    $conn = db_conn();
    $selectQuery = "DELETE FROM `gate` WHERE `g_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($gateID));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function deleteSchedule($id){
    $conn = db_conn();
    $selectQuery = "DELETE FROM `shift` WHERE `shift_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($id));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function deleteFeature($id){
    $conn = db_conn();
    $selectQuery = "DELETE FROM `features` WHERE `f_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($id));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function deleteAdvantage($id){
    $conn = db_conn();
    $selectQuery = "DELETE FROM `advantages` WHERE `adv_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($id));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }

    $conn = null;
}
function getOrderInfo($id){
    $conn = db_conn();
    $selectQuery = 'call admin_orders(?)';
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($id));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function sameDate(){
    $conn = db_conn();
    $selectQuery = 'SELECT DISTINCT(order_date) FROM `hall_booking`';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $twice = array();
    foreach($row as $r){
        $re = $r['order_date'];
        $selectQuery2 = "SELECT COUNT(1) as `num` FROM `hall_booking` WHERE `order_date` = :odate";
        try{
            $stmt2 = $conn->prepare($selectQuery2);
            $stmt2->execute(array(':odate' => $re));
        }catch(PDOException $e){
            handle_sql_errors($selectQuery, $e->getMessage());
        }
        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $selectQuery3 = "SELECT COUNT(1) as `num` FROM shift";
        try{
            $stmt3 = $conn->query($selectQuery3);
        }catch(PDOException $e){
            handle_sql_errors($selectQuery, $e->getMessage());
        }
        $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
        if($row2['num'] == $row3['num']){
            $twice[] = $re;
        }
    }
    return $twice;
}
function getItemName($item){
    $conn = db_conn();
    $selectQuery = 'SELECT `am_title`, `am_image`,`am_price` FROM `additional_menu` WHERE `keywords` LIKE \'%'.$item.'%\' or `am_price` BETWEEN 1 and \''.$item.'\' order by `am_title` asc';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function addiFoodFull(){
    $conn = db_conn();
    $selectQuery = 'select * from addi_food_full';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function setMenu(){
    $conn = db_conn();
    $selectQuery = 'SELECT `sm_id`, `sm_title`, `sm_description`, `sm_price` FROM `Set_Menu`';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getAdvc(){
    $conn = db_conn();
    $selectQuery = 'SELECT `adv_id`, `adv_desc` FROM `advantages`';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getFeatures(){
    $conn = db_conn();
    $selectQuery = 'SELECT `f_id`, `f_desc` FROM `features`';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getServiceID($quantity){
    $conn = db_conn();
    $selectQuery = 'SELECT `serv_id` FROM `services` WHERE `serv_name` LIKE \'%'.$quantity.'%\'';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['serv_id'];
}
function getBasicServices(){
    $conn = db_conn();
    $selectQuery = 'SELECT `serv_name`, `Serv_price` FROM `services` WHERE `serv_id` BETWEEN 1 AND 4';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getBookingInfo($user){
    $conn = db_conn();
    $selectQuery = "SELECT `order_id`, `order_date`,`order_purpose`,`total_cost`, `paid_cost`,`date_of_booking` FROM `hall_booking` WHERE `user_id` = ? ORDER BY `order_id` DESC";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($user));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getMisc(){
    $conn = db_conn();
    $selectQuery = 'SELECT `misc_id`, `misc_vat`, `misc_extra_cost` FROM `misc`';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function getTotalUser(){
    $conn = db_conn();
    $selectQuery = 'SELECT COUNT(`s_id`) as `num` FROM `user`';
    try {
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
            handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['num'];
}
function getPendingBookings(){
    $conn = db_conn();
    $selectQuery = 'SELECT COUNT(1) as `num` FROM `hall_booking` WHERE `order_status` = 1';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['num'];
}
function getApprovedBookings(){
    $conn = db_conn();
    $selectQuery = 'SELECT COUNT(1) as `num` FROM `hall_booking` WHERE `order_status` = 2';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['num'];
}
function getTotalBookings(){
    $conn = db_conn();
    $selectQuery = 'SELECT COUNT(`order_id`) as `num` FROM `hall_booking`';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['num'];
}
function getPending(){
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM pending_bookings';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function allBookingInfo(){
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM all_booking_info';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function updateVat($vat){
    $conn = db_conn();
    $selectQuery = "UPDATE `misc` SET `misc_vat`= ? WHERE `misc_id` = 1";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($vat));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function updateExtraCost($cost){
    $conn = db_conn();
    $selectQuery = "UPDATE `misc` SET `misc_extra_cost` = ? WHERE `misc_id` = 1";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($cost));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function getSchedule(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT * FROM schedule_view');
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function updateSchedule($shift, $time, $id){
    $conn = db_conn();
    $selectQuery = "UPDATE `shift` SET `shift_name`= ?,`shift_time`= ? WHERE `shift_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($shift, $time, $id));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function updateServices($service, $price, $id){
    $conn = db_conn();
    $selectQuery = "UPDATE `services` SET `serv_name`= :service,`Serv_price`= :price WHERE `serv_id` = :id";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array(':service' => $service, ':price' => $price, ':id' => $id));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function updateFeature($feature, $id){
    $conn = db_conn();
    $selectQuery = "UPDATE `features` SET `f_desc`= ? WHERE `f_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($feature, $id));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function updateAdvantage($adv, $id){
    $conn = db_conn();
    $selectQuery = "UPDATE `advantages` SET `adv_desc`= ? WHERE `adv_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($adv, $id));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function addFeature($desc){
    $conn = db_conn();
    $selectQuery = "call insert_feature(?)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($desc));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function insertNewGate($name, $cost, $image){
    $conn = db_conn();
    $selectQuery = "call insert_gate(:name, :image, :cost)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array(':name' => $name, ':image' =>$image, ':cost' => $cost));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function addAdvantages($advantage){
    $conn = db_conn();
    $selectQuery = "call insert_advantage(?)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($advantage));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
function getFeatureID($desc){
    $conn = db_conn();
    $selectQuery = "SELECT `f_id` FROM `features` WHERE `f_desc` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($desc));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['f_id'];
}
function getAdvantageID($advantage){
    $conn = db_conn();
    $selectQuery = "SELECT `adv_id` FROM `advantages` WHERE `adv_desc` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($advantage));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['adv_id'];
}
function getServID($service, $price){
    $conn = db_conn();
    $selectQuery = "SELECT `serv_id` FROM `services` WHERE `serv_name` = ? AND `Serv_price` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($service, $price));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['serv_id'];
}
function deleteService($id){
    $conn = db_conn();
    $selectQuery = "DELETE FROM `services` WHERE `serv_id` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute(array($id));
    }catch(PDOException $e){
        handle_sql_errors($selectQuery, $e->getMessage());
    }
    $conn = null;
}
?>