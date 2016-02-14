<?php
    require '../model/db.php';
    function totalUser(){
        $totalUser = getTotalUser();
        return $totalUser;
    }
    function pendingBookings(){
        $pendingBookings = getPendingBookings();
        return $pendingBookings;
    }
    function approvedBookings(){
        $approved = getApprovedBookings();
        return $approved;
    }
    function totalBookings(){
        $totalBookings = getTotalBookings();
        return $totalBookings;
    }
    function pendingInfo(){
        $pending = getPending();
        return $pending;
    }
    function approveInfo(){
        $approve = getApprove();
        return $approve;
    }
    function completeBookingInfo(){
        $approve = getCompleteBookingInfo();
        return $approve;
    }
    function bookingInfo(){
        $booking = allBookingInfo();
        return $booking;
    }
    function detailsBooking($id){
        $book = getOrderInfo($id);
        return $book;
    }
    function Misc(){
        $row = getMisc();
        return $row;
    }
    function schedule(){
        $row = getSchedule();
        return $row;
    }
    function feature(){
        $row = getFeatures();
        return $row;
    }
    function advantages(){
        $row = getAdvc();
        return $row;
    }
    function services(){
        $row = getServices();
        return $row;
    }
function getGate(){
    $gate = gate();
    return $gate;
}
function getStage(){
    $stage = stage();
    return $stage;
}
function getAllAdditionalFood(){
    $addiFood = addiFood();
    return $addiFood;
}
function getAllFullFood(){
    $addiFoodFull = addiFoodFull();
    return $addiFoodFull;
}
function getPersonalInfo(){
    $proInfo = getAllPersonalInfo();
    return $proInfo;
}
?>