<?php
function db_conn(){
    $SERVER = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'convention_hall';
    $conn = new PDO('mysql:host='.$SERVER.';dbname='.$db.';charset=utf8', $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $conn;
}

function checkUserEmail($email){
    $conn = db_conn();
    $stmt = $conn->prepare("SELECT COUNT(*) as `num` FROM `user` WHERE `u_email` = ?");
    $stmt->execute(array($email));

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return ($row['num'] == 1) ? true : false ;
}

function insertUser($fname, $lname, $email, $contact, $pass){
    $conn = db_conn();
    $stmt = $conn->prepare("INSERT INTO `user`(`u_fname`, `u_lname`, `u_email`, `u_contact`, `u_pass`) VALUES (:fname, :lname, :email, :contact, :pass)");
    $stmt->execute(array(':fname' => $fname, ':lname' => $lname, ':email' => $email, ':contact' => $contact, ':pass' => $pass));
    $conn = null;
}

function loginSuccess($email, $pass){
    $conn = db_conn();
    $stmt = $conn->prepare("SELECT COUNT(*) as `num` FROM `user` WHERE `u_email` = ?");
    $stmt->execute(array($email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['num'] == 1){
        $user = $email;

        $stmt2 = $conn->prepare("SELECT `u_pass` FROM `user` WHERE `u_email` = ?");
        $stmt2->execute(array($user));
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
    $stmt = $conn->query('SELECT `am_id`, `am_title`, `am_image`, `am_price` FROM `additional_menu` WHERE `am_title` NOT LIKE \'%full%\' order by `am_title` asc');
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function personalInfo($user){
    $conn = db_conn();
    $stmt = $conn->prepare("SELECT `u_fname`, `u_lname`, `u_email`, `u_contact` FROM `user` WHERE `u_email` = ?");
    $stmt->execute(array($user));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function updatePass($newPass, $email){
    $conn = db_conn();
    $stmt = $conn->prepare("UPDATE `user` SET `u_pass`= ? WHERE `u_email` = ?");
    $stmt->execute(array($newPass, $email));
    $conn = null;
}
function updateInfo($fname, $lname, $email, $contact, $user){
    $conn = db_conn();
    $stmt = $conn->prepare("UPDATE `user` SET `u_fname`=:fname,`u_lname`=:lname,`u_email`=:email,`u_contact`=:contact WHERE `u_email`=:user");
    $stmt->execute(array(':fname' => $fname, ':lname' => $lname, ':email' => $email, ':contact' => $contact, ':user' => $user));
    $conn = null;
}
function getUserID($email){
    $conn = db_conn();
    $stmt = $conn->prepare("SELECT `s_id` FROM `user` WHERE `u_email` = ?");
    $stmt->execute(array($email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function checkEditedEmail($email, $userId){
    $conn = db_conn();

    $stmt = $conn->prepare("SELECT COUNT(*) as `num` FROM `user` WHERE `u_email` = ? and `s_id` <> ?");
    $stmt->execute(array($email, $userId));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return ($row['num'] == 1) ? true : false ;
}
function stage(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT `st_id`, `st_title`, `st_image`, `st_price` FROM `stage` order by `st_title` asc');
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function gate(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT `g_id`, `g_title`, `g_image`, `g_price` FROM `gate` order by `g_title` asc');
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getServices(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT * FROM `services` order by `serv_name` asc');
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getPurposes(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT `p_name` FROM `puposes`');
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getShift(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT `shift_name`, `shift_time` FROM `shift`');
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function similarDateShift($date, $shift){
    $conn = db_conn();
    $stmt = $conn->prepare("SELECT COUNT(*) as `num` FROM `hall_booking` WHERE `order_date` = ? AND `order_shift` = ?");
    $stmt->execute(array($date, $shift));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return ($row['num'] == 1) ? true : false ;
}
function setOrder($user, $date, $shift, $purpose, $service, $guest, $gate, $stage, $food, $totalCost, $fullamount, $setMenu){
    $conn = db_conn();
    $stmt = $conn->prepare("INSERT INTO `hall_booking`(`user_id`, `order_date`, `order_shift`, `order_purpose`, `services`, `guest_number`, `welcome_gate`, `stage`, `food`, `total_cost`, `fullFood`, `set_menu`) VALUES (:usr,:dat,:shift,:purpose,:service,:guest,:gate,:stage,:food, :totalCost, :fullamount, :setMenu)");
    $stmt->execute(array(':usr' => $user, ':dat' => $date, ':shift' => $shift, ':purpose' => $purpose, ':service' => $service, ':guest' => $guest, ':gate' => $gate, ':stage' => $stage, ':food' => $food, ':totalCost' => $totalCost, ':fullamount' => $fullamount, ':setMenu' => $setMenu));
    $conn = null;
}
function getUserOreders($user){
    $conn = db_conn();
    $stmt = $conn->prepare("SELECT hall_booking.order_date, hall_booking.order_shift, `order_id`,  hall_booking.order_purpose, hall_booking.services, status.status_cond, hall_booking.guest_number, gate.g_title, gate.g_image, gate.g_price, stage.st_title, stage.st_image, stage.st_price, hall_booking.food, hall_booking.total_cost, set_menu.sm_title, set_menu.sm_description, set_menu.sm_price, hall_booking.paid_cost, hall_booking.fullFood
FROM hall_booking
LEFT JOIN gate ON gate.g_id = hall_booking.welcome_gate
LEFT JOIN stage ON stage.st_id = hall_booking.stage
LEFT JOIN set_menu ON set_menu.sm_id = hall_booking.set_menu
INNER JOIN `status` ON status.status_id = hall_booking.order_status WHERE hall_booking.user_id = ?");
    $stmt->execute(array($user));
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getFoodTitle($fid){
    $conn = db_conn();
    $stmt = $conn->prepare("SELECT `am_title` FROM `additional_menu` WHERE `am_id` = ?");
    $stmt->execute(array($fid));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['am_title'];
}
function getFoodImage($fid){
    $conn = db_conn();
    $stmt = $conn->prepare("SELECT `am_image` FROM `additional_menu` WHERE `am_id` = ?");
    $stmt->execute(array($fid));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['am_image'];
}
function getFoodPrice($fid){
    $conn = db_conn();
    $stmt = $conn->prepare("SELECT `am_price` FROM `additional_menu` WHERE `am_id` = ?");
    $stmt->execute(array($fid));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['am_price'];
}
function getServiceName($sid){
    $conn = db_conn();
    $stmt = $conn->prepare("SELECT `serv_name` FROM `services` WHERE `serv_id` = ?");
    $stmt->execute(array($sid));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['serv_name'];
}
function getServicePrice($sid){
    $conn = db_conn();
    $stmt = $conn->prepare("SELECT `Serv_price` FROM `services` WHERE `serv_id` = ?");
    $stmt->execute(array($sid));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['Serv_price'];
}
function getGateValue($gate){
    $conn = db_conn();
    $stmt = $conn->prepare("SELECT `g_price` FROM `gate` WHERE `g_id` = ?");
    $stmt->execute(array($gate));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['g_price'];
}
function getStageValue($stage){
    $conn = db_conn();
    $stmt = $conn->prepare("SELECT `st_price` FROM `stage` WHERE `st_id` = ?");
    $stmt->execute(array($stage));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['st_price'];
}
function getPriceSetMenu($setMenu){
    $conn = db_conn();
    $stmt = $conn->prepare("SELECT `sm_price` FROM `set_menu` WHERE `sm_id` = ?");
    $stmt->execute(array($setMenu));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['sm_price'];
}
function checkAdmin($user, $pass){
    $conn = db_conn();
    $stmt = $conn->prepare("SELECT COUNT(*) as `num` FROM `adminlogin` WHERE `a_user` = ? AND `a_pass` = ?");
    $stmt->execute(array($user, $pass));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return ($row['num'] == 1) ? true : false ;

}
function getDateShift(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT `order_id`, `order_date`, `order_shift` FROM `hall_booking`');
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getPendingInfo(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT user.u_fname, user.u_lname, user.u_email, user.u_contact, `order_id`, `order_date`, `order_shift`, `order_purpose`, `services`, `food`, `guest_number`, gate.g_title, set_menu.sm_title, set_menu.sm_description, set_menu.sm_price, stage.st_title, status.status_cond, `total_cost`, `paid_cost`, hall_booking.fullFood
FROM `hall_booking`
INNER JOIN user ON user.s_id = hall_booking.user_id
LEFT JOIN gate ON gate.g_id = hall_booking.welcome_gate
LEFT JOIN stage ON stage.st_id = hall_booking.stage
LEFT JOIN set_menu ON set_menu.sm_id = hall_booking.set_menu
INNER JOIN status ON status.status_id = hall_booking.order_status
WHERE `order_status` = 1 ORDER BY hall_booking.order_id DESC');
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function changeStatus($order, $paid, $o){
    $conn = db_conn();
    $stmt = $conn->prepare("UPDATE `hall_booking` SET `order_status`= :orderStatus, `paid_cost`= :paidCost WHERE `order_id` = :orderID");
    $stmt->execute(array(':orderStatus' => $o, ':paidCost' => $paid, ':orderID' => $order));
    $conn = null;
}
function deleteOrder($order){
    $conn = db_conn();
    $stmt = $conn->prepare("DELETE FROM `hall_booking` WHERE `order_id` = ?");
    $stmt->execute(array($order));
    $conn = null;
}
function getOrderInfo(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT user.u_fname, user.u_lname, user.u_email, user.u_contact, `order_id`, `order_date`, `order_shift`, `order_purpose`, `services`, `food`, `guest_number`, gate.g_title, set_menu.sm_title, set_menu.sm_description, set_menu.sm_price, stage.st_title, status.status_cond, `total_cost`, `paid_cost`, hall_booking.fullFood
FROM `hall_booking`
INNER JOIN user ON user.s_id = hall_booking.user_id
LEFT JOIN gate ON gate.g_id = hall_booking.welcome_gate
LEFT JOIN stage ON stage.st_id = hall_booking.stage
LEFT JOIN set_menu ON set_menu.sm_id = hall_booking.set_menu
INNER JOIN status ON status.status_id = hall_booking.order_status ORDER BY hall_booking.order_id DESC');
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function sameDate(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT DISTINCT(order_date) FROM `hall_booking`');
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $twice = array();
    foreach($row as $r){
        $re = $r['order_date'];
        $stmt2 = $conn->prepare("SELECT COUNT(*) as `num` FROM `hall_booking` WHERE `order_date` = ?");
        $stmt2->execute(array($re));
        $row2 = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row2['num'] == 2){
            $twice[] = $re;
        }
    }
    return $twice;
}
function getItemName($item){
    $conn = db_conn();
    $stmt = $conn->query('SELECT `am_title`, `am_image`,`am_price` FROM `additional_menu` WHERE `keywords` LIKE \'%'.$item.'%\' or `am_price` BETWEEN 1 and \''.$item.'\' order by `am_title` asc');
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function addiFoodFull(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT `am_id`, `am_title`, `am_image`, `am_price` FROM `additional_menu` WHERE `am_title` LIKE \'%full%\' order by `am_title` asc');
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function setMenu(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT `sm_id`, `sm_title`, `sm_description`, `sm_price` FROM `Set_Menu`');
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getAdvc(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT `adv_desc` FROM `advantages`');
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getFeatures(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT `f_desc` FROM `features`');
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getServiceID($quantity){
    $conn = db_conn();
    $stmt = $conn->query('SELECT `serv_id` FROM `services` WHERE `serv_name` LIKE \'%'.$quantity.'%\'');
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['serv_id'];
}
?>