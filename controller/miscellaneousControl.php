<?php
    require '../model/db.php';
    $resp = array();
    if(isset($_POST['updatedVat'])){
        $vat = $_POST['updatedVat'];
        updateVat($vat);
    }elseif(isset($_POST['updateCost'])){
        $cost = $_POST['updateCost'];
        updateExtraCost($cost);
    }elseif(isset($_POST['ID'])){
        $shift = $_POST['updShift'];
        $time = $_POST['updTime'];
        $id = $_POST['ID'];
        updateSchedule($shift, $time, $id);
    }elseif(isset($_POST['updFeature'])){
        $feature = $_POST['updFeature'];
        $id = $_POST['featureID'];
        updateFeature($feature, $id);
    }elseif(isset($_POST['advantageID'])){
        $id = $_POST['advantageID'];
        $adv = $_POST['updAdvantage'];
        updateAdvantage($adv, $id);
    }elseif(isset($_POST['addNewShift'])){
        $shift = $_POST['addNewShift'];
        $time = $_POST['addNewTime'];
        addSchedule($shift, $time);
        $id = getScheduleID($shift, $time);
        echo $id;
    }elseif(isset($_POST['scheduleID'])){
        $id = $_POST['scheduleID'];
        deleteSchedule($id);
    }elseif(isset($_POST['addNewFeature'])){
        $desc = $_POST['addNewFeature'];
        addFeature($desc);
        $id = getFeatureID($desc);
        echo $id;
    }elseif(isset($_POST['featureID'])){
        $id = $_POST['featureID'];
        deleteFeature($id);
    }elseif(isset($_POST['addNewAdvantage'])){
        $advantage = $_POST['addNewAdvantage'];
        addAdvantages($advantage);
        $resp['advKey'] = getAdvantageID($advantage);
        echo json_encode($resp);
        //echo $resp['AdvKey'];
    }elseif(isset($_POST['advID'])){
        $Aid = $_POST['advID'];
        deleteAdvantage($Aid);
    }elseif(isset($_POST['updService'])){
        $service = $_POST['updService'];
        $price = $_POST['updPrice'];
        $id = $_POST['serviceID'];
        updateServices($service, $price, $id);
    }elseif(isset($_POST['addNewService'])){
        $service = $_POST['addNewService'];
        $price = $_POST['addNewPrice'];
        addCharges($service, $price);
        $id = getServiceID($service, $price);
        echo $id;
    }elseif(isset($_POST['ServId'])){
        $id = $_POST['ServId'];
        deleteService($id);
    }
?>