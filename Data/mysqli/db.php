<?php
    function db_conn(){
        $SERVER = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'convention_hall';
        $conn = mysqli_connect($SERVER, $user, $pass, $db) or die(mysqli_connect_error());
        return $conn;
    }

    function checkUserEmail($email){
        $conn = db_conn();
        $sql = "SELECT COUNT(*) as `num` FROM `user` WHERE `u_email` = '$email'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return ($row['num'] == 1) ? true : false ;
    }

    function insertUser($fname, $lname, $email, $contact, $pass){
        $conn = db_conn();
        $sql = "INSERT INTO `user`(`u_fname`, `u_lname`, `u_email`, `u_contact`, `u_pass`) VALUES ('$fname', '$lname', '$email', '$contact', '$pass')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }

    function loginSuccess($email, $pass){
        $conn = db_conn();
        $sql = "SELECT COUNT(*) as `num` FROM `user` WHERE `u_email` = '$email'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($row['num'] == 1){
            $user = $email;
            $sql2 = "SELECT `u_pass` FROM `user` WHERE `u_email` = '$user'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            $dataPass = $row2['u_pass'];
            return (password_verify($pass, $dataPass)) ? true : false;
        }else{
            return false;
        }
    }
    function multiRow($SQL){
        $conn = db_conn();
        $sql = $SQL;
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = array();
        for($i=0; $i < mysqli_num_rows($result); $i++){
            $row[] = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
        return $row;
    }
    function addiFood(){
        $sql = "SELECT `am_id`, `am_title`, `am_image`, `am_price` FROM `additional_menu` WHERE `am_title` NOT LIKE '%full%' order by `am_title` asc";
        $row = multiRow($sql);
        return $row;
    }
    function personalInfo($user){
        $conn = db_conn();
        $sql = "SELECT `u_fname`, `u_lname`, `u_email`, `u_contact` FROM `user` WHERE `u_email` = '$user'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
    }
    function updatePass($newPass, $email){
        $conn = db_conn();
        $sql = "UPDATE `user` SET `u_pass`= '$newPass' WHERE `u_email` = '$email'";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }
    function updateInfo($fname, $lname, $email, $contact, $user){
        $conn = db_conn();
        $sql = "UPDATE `user` SET `u_fname`='$fname',`u_lname`='$lname',`u_email`='$email',`u_contact`='$contact' WHERE `u_email`='$user'";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }
    function getUserID($email){
        $conn = db_conn();
        $sql = "SELECT `s_id` FROM `user` WHERE `u_email` = '$email'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
    }
    function checkEditedEmail($email, $userId){
        $conn = db_conn();
        $sql = "SELECT COUNT(*) as `num` FROM `user` WHERE `u_email` = '$email' and `s_id` <> $userId";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return ($row['num'] == 1) ? true : false ;
    }
    function stage(){
        $sql = "SELECT `st_id`, `st_title`, `st_image`, `st_price` FROM `stage` order by `st_title` asc";
        $row = multiRow($sql);
        return $row;
    }
    function gate(){
        $sql = "SELECT `g_id`, `g_title`, `g_image`, `g_price` FROM `gate` order by `g_title` asc";
        $row = multiRow($sql);
        return $row;
    }
    function getServices(){
        $sql = "SELECT * FROM `services` order by `serv_name` asc";
        $row = multiRow($sql);
        return $row;
    }
    function getPurposes(){
        $sql = "SELECT `p_name` FROM `puposes`";
        $row = multiRow($sql);
        return $row;
    }
    function getShift(){
        $sql = "SELECT `shift_name`, `shift_time` FROM `shift`";
        $row = multiRow($sql);
        return $row;
    }
    function similarDateShift($date, $shift){
        $conn = db_conn();
        $sql = "SELECT COUNT(*) as `num` FROM `hall_booking` WHERE `order_date` = '$date' AND `order_shift` = '$shift'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return ($row['num'] == 1) ? true : false ;
    }
    function setOrder($user, $date, $shift, $purpose, $service, $guest, $gate, $stage, $food, $totalCost, $fullamount, $setMenu){
        $conn = db_conn();
        $sql = "INSERT INTO `hall_booking`(`user_id`, `order_date`, `order_shift`, `order_purpose`, `services`, `guest_number`, `welcome_gate`, `stage`, `food`, `total_cost`, `fullFood`, `set_menu`) VALUES ($user,'$date','$shift','$purpose','$service',$guest,$gate,$stage,'$food', $totalCost, '$fullamount', $setMenu)";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }
    function getUserOreders($user){
        $conn = db_conn();
        $sql = "SELECT hall_booking.order_date, hall_booking.order_shift, `order_id`,  hall_booking.order_purpose, hall_booking.services, status.status_cond, hall_booking.guest_number, gate.g_title, gate.g_image, gate.g_price, stage.st_title, stage.st_image, stage.st_price, hall_booking.food, hall_booking.total_cost, set_menu.sm_title, set_menu.sm_description, set_menu.sm_price, hall_booking.paid_cost, hall_booking.fullFood
FROM hall_booking
LEFT JOIN gate ON gate.g_id = hall_booking.welcome_gate
LEFT JOIN stage ON stage.st_id = hall_booking.stage
LEFT JOIN set_menu ON set_menu.sm_id = hall_booking.set_menu
INNER JOIN `status` ON status.status_id = hall_booking.order_status WHERE hall_booking.user_id = $user";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = array();
        for($i=0; $i < mysqli_num_rows($result); $i++){
            $row[] = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
        return $row;
    }
    function getFoodTitle($fid){
        $conn = db_conn();
        $sql = "SELECT `am_title` FROM `additional_menu` WHERE `am_id` = $fid";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row['am_title'];
    }
    function getFoodImage($fid){
        $conn = db_conn();
        $sql = "SELECT `am_image` FROM `additional_menu` WHERE `am_id` = $fid";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row['am_image'];
    }
    function getFoodPrice($fid){
        $conn = db_conn();
        $sql = "SELECT `am_price` FROM `additional_menu` WHERE `am_id` = $fid";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row['am_price'];
    }
    function getServiceName($sid){
        $conn = db_conn();
        $sql = "SELECT `serv_name` FROM `services` WHERE `serv_id` = $sid";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row['serv_name'];
    }
    function getServicePrice($sid){
        $conn = db_conn();
        $sql = "SELECT `Serv_price` FROM `services` WHERE `serv_id` = $sid";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row['Serv_price'];
    }
    function getGateValue($gate){
        $conn = db_conn();
        $sql = "SELECT `g_price` FROM `gate` WHERE `g_id` = $gate";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row['g_price'];
    }
    function getStageValue($stage){
        $conn = db_conn();
        $sql = "SELECT `st_price` FROM `stage` WHERE `st_id` = $stage";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row['st_price'];
    }
    function getPriceSetMenu($setMenu){
        $conn = db_conn();
        $sql = "SELECT `sm_price` FROM `set_menu` WHERE `sm_id` = $setMenu";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row['sm_price'];
    }
    function checkAdmin($user, $pass){
        $conn = db_conn();
        $sql = "SELECT COUNT(*) as `num` FROM `adminlogin` WHERE `a_user` = '$user' AND `a_pass` = '$pass'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return ($row['num'] == 1) ? true : false ;

    }
    function getDateShift(){
        $conn = db_conn();
        $sql = "SELECT `order_id`, `order_date`, `order_shift` FROM `hall_booking`";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = array();
        for($i=0; $i < mysqli_num_rows($result); $i++){
            $row[] = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
        return $row;
    }
    function getPendingInfo(){
        $sql = "SELECT user.u_fname, user.u_lname, user.u_email, user.u_contact, `order_id`, `order_date`, `order_shift`, `order_purpose`, `services`, `food`, `guest_number`, gate.g_title, set_menu.sm_title, set_menu.sm_description, set_menu.sm_price, stage.st_title, status.status_cond, `total_cost`, `paid_cost`, hall_booking.fullFood
FROM `hall_booking`
INNER JOIN user ON user.s_id = hall_booking.user_id
LEFT JOIN gate ON gate.g_id = hall_booking.welcome_gate
LEFT JOIN stage ON stage.st_id = hall_booking.stage
LEFT JOIN set_menu ON set_menu.sm_id = hall_booking.set_menu
INNER JOIN status ON status.status_id = hall_booking.order_status
WHERE `order_status` = 1 ORDER BY hall_booking.order_id DESC";
        $row = multiRow($sql);
        return $row;
    }
    function changeStatus($order, $paid, $o){
        $conn = db_conn();
        $sql = "UPDATE `hall_booking` SET `order_status`= $o, `paid_cost`= $paid WHERE `order_id` = $order";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }
    function deleteOrder($order){
        $conn = db_conn();
        $sql = "DELETE FROM `hall_booking` WHERE `order_id` = $order";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }
    function getOrderInfo(){
        $sql = "SELECT user.u_fname, user.u_lname, user.u_email, user.u_contact, `order_id`, `order_date`, `order_shift`, `order_purpose`, `services`, `food`, `guest_number`, gate.g_title, set_menu.sm_title, set_menu.sm_description, set_menu.sm_price, stage.st_title, status.status_cond, `total_cost`, `paid_cost`, hall_booking.fullFood
FROM `hall_booking`
INNER JOIN user ON user.s_id = hall_booking.user_id
LEFT JOIN gate ON gate.g_id = hall_booking.welcome_gate
LEFT JOIN stage ON stage.st_id = hall_booking.stage
LEFT JOIN set_menu ON set_menu.sm_id = hall_booking.set_menu
INNER JOIN status ON status.status_id = hall_booking.order_status ORDER BY hall_booking.order_id DESC";
        $row = multiRow($sql);
        return $row;
    }
    function sameDate(){
        $conn = db_conn();
        $sql1 = "SELECT DISTINCT(order_date) FROM `hall_booking`";
        $result1 = mysqli_query($conn, $sql1) or die(mysqli_error());
        $row = array();
        for($i=0; $i < mysqli_num_rows($result1); $i++){
            $row[] = mysqli_fetch_array($result1, MYSQLI_ASSOC);
        }
        $twice = array();
        foreach($row as $r){
            $re = $r['order_date'];
            $sql2 = "SELECT COUNT(*) as `num` FROM `hall_booking` WHERE `order_date` = '$re'";
            $result2 = mysqli_query($conn, $sql2) or die(mysqli_error());
            $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            if($row2['num'] == 2){
                $twice[] = $re;
            }
        }
        return $twice;
    }
    function getItemName($item){
        $conn = db_conn();
        $sql = "SELECT `am_title`, `am_image`,`am_price` FROM `additional_menu` WHERE `keywords` LIKE '%$item%' or `am_price` BETWEEN 1 and '$item' order by `am_title` asc";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = array();
        for($i=0; $i < mysqli_num_rows($result); $i++){
            $row[] = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
        return $row;
    }
    function addiFoodFull(){
        $conn = db_conn();
        $sql = "SELECT `am_id`, `am_title`, `am_image`, `am_price` FROM `additional_menu` WHERE `am_title` LIKE '%full%' order by `am_title` asc";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = array();
        for($i=0; $i < mysqli_num_rows($result); $i++){
            $row[] = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
        return $row;
    }
    function setMenu(){
        $sql = "SELECT `sm_id`, `sm_title`, `sm_description`, `sm_price` FROM `Set_Menu`";
        $row = multiRow($sql);
        return $row;
    }
    function getAdvc(){
        $sql = "SELECT `adv_desc` FROM `advantages`";
        $row = multiRow($sql);
        return $row;
    }
    function getFeatures(){
        $sql = "SELECT `f_desc` FROM `features`";
        $row = multiRow($sql);
        return $row;
    }
    function getServiceID($quantity){
        $conn = db_conn();
        $sql = "SELECT `serv_id` FROM `services` WHERE `serv_name` LIKE '%$quantity%'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row['serv_id'];
    }
?>