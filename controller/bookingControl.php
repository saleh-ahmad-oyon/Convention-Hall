<?php
    require 'model/db.php';

    function getAllShift(){
        $shift = getShift();
        return $shift;
    }
    function getAllPurposes(){
        $purpose = getPurposes();
        return $purpose;
    }
    function getAllServices(){
        $serv = getServices();
        return $serv;
    }
    function getAllAdditionalFood(){
        $addiFood = addiFood();
        return $addiFood;
    }
    function getAllFullFood(){
        $addiFoodFull = addiFoodFull();
        return $addiFoodFull;
    }
    function getStage(){
        $stage = stage();
        return $stage;
    }
    function getGate(){
        $gate = gate();
        return $gate;
    }
    function checkSameDate(){
        $book = sameDate();
        return $book;
    }
    function getSetMenu(){
        $setMenu = setMenu();
        return $setMenu;
    }
?>