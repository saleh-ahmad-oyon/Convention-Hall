<?php
    require_once 'model/db.php';

    function Misc(){
        $row = getMisc();
        return $row;
    }
    function additionalFood(){
        $addiFood = addiFood();
        return $addiFood;
    }
    function additionalFoodFull(){
        $addiFoodFull = addiFoodFull();
        return $addiFoodFull;
    }
    function getSetMenu(){
        $setMenu = setMenu();
        return $setMenu;
    }
    function allShift(){
        $shift = getShift();
        return $shift;
    }
    function getPersonalInfo($user){
        $proInfo = personalInfo($user);
        return $proInfo;
    }
    function getOrders($orderID){
        $order = getUserOrders($orderID);
        return $order;
    }
    function getItems($item){
        $getItemName = getItemName($item);
        return $getItemName;
    }
    function getAdvantages(){
        $advantage = getAdvc();
        return $advantage;
    }
    function getAllFeatures(){
        $feature = getFeatures();
        return $feature;
    }
    function basicServices(){
        $basic = getBasicServices();
        return $basic;
    }
?>