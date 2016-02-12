<?php
/**
 * Created by PhpStorm.
 * User: Oyon
 * Date: 2/9/2016
 * Time: 3:52 PM
 */

//require database function
require '../../model/db.php';

//declare an array which will be returnd as JSON
$resp = array();

if(isset($_POST['gateID'])){           //Get Gate Information
    $gateID = $_POST['gateID'];
    $row = getGateInfo($gateID);
    $resp['key'] = $row['g_id'];
    $resp['Name'] = $row['g_title'];
    $resp['image'] = $row['g_image'];
    $resp['value'] = $row['g_price'];
    echo json_encode($resp);
}elseif(isset($_POST['stageID'])){   //Get Stage Information
    $stageID = $_POST['stageID'];
    $row = getStageInfo($stageID);
    $resp['key'] = $row['st_id'];
    $resp['Name'] = $row['st_title'];
    $resp['image'] = $row['st_image'];
    $resp['value'] = $row['st_price'];
    echo json_encode($resp);
}elseif(isset($_POST['add_name'])){            //Add Gate Information
    $name = $_POST['add_name'];
    $cost = $_POST['add_price'];

    $target_dir = '../../assets/img/gate/';
    $fn = $_FILES["add_image"]["name"];

    $target_file = $target_dir . basename($fn);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    if(!empty($fn)) {
        $file = $_FILES['add_image'];
        $check = getimagesize($_FILES["add_image"]["tmp_name"]);
        if ($check !== false) {
            $file_path = $target_dir . $file['name'];
            move_uploaded_file($file['tmp_name'], $file_path);

            $image = $file['name'];
        }
    }else{
        $image = "Demo.png";
    }
    insertNewGate($name, $cost, $image);
    $row = gate();
    $resp = $row;
    echo json_encode($resp);
}elseif(isset($_POST['gateKey'])){   // Delete Gate Information
    $id = $_POST['gateKey'];
    deleteGate($id);

    $row = gate();
    $resp = $row;
    echo json_encode($resp);
}elseif(isset($_POST['edit_name'])){
    $name = $_POST['edit_name'];
    $cost = $_POST['edit_price'];
    $id = $_POST['edit_key'];

    $target_dir = '../../assets/img/gate/';
    $fn = $_FILES["edit_image"]["name"];

    $target_file = $target_dir . basename($fn);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    if(!empty($fn)) {
        $file = $_FILES['edit_image'];
        $check = getimagesize($_FILES["edit_image"]["tmp_name"]);
        if ($check !== false) {
            $file_path = $target_dir . $file['name'];
            move_uploaded_file($file['tmp_name'], $file_path);

            $image = $file['name'];
        }
    }else{
        $image = "Demo.png";
    }

    //call function to modify Welcome gate
    updateGate($name, $cost, $image, $id);
    $row = gate();
    $resp = $row;
    echo json_encode($resp);
}
?>