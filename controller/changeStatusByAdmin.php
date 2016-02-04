<?php
    session_start();
    require '../model/db.php';

    $order = $_POST['order'];
    $total = $_POST['total'];

    if(isset($_POST['approve'])){
        changeStatus($order, 25000.00, 2);
        echo '<script language="javascript">
                    alert("Status Changed to Approve !!");
                    window.location="http://localhost/convention/admin";
                  </script>';
    }elseif(isset($_POST['unapprove'])){
        changeStatus($order, 0.00, 4);
        echo '<script language="javascript">
                    alert("Status Changed to Unapprove !!");
                    window.location="http://localhost/convention/admin";
                  </script>';
    }elseif(isset($_POST['complete'])){
        changeStatus($order, $total, 3);
        echo '<script language="javascript">
                    alert("Status Changed to Complete !!");
                    window.location="http://localhost/convention/admin";
                  </script>';
    }
?>