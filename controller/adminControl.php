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
?>