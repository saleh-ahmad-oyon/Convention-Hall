<?php
session_start();
require '../model/db.php';
require 'define.php';

$order = $_POST['order'];

if(isset($_POST['delete'])){
    deleteOrder($order);
    echo '<script language="javascript">
                    alert("Order Deleted !!");
                    window.location="'.SERVER.'";
                  </script>';
}
?>