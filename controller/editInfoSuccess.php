<?php
    session_start();
    require '../model/db.php';
    require 'define.php';
    if(isset($_POST['editInfo'])){
        $name = $_POST['userName'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $user = $_SESSION['user'];
        $userId = $_SESSION['id'];

        $exp = explode(" ", $name);
        $fname = $exp[0];
        $lname ='';
        for($i=1; $i<count($exp); $i++){
            $lname .= $exp[$i].' ';
        }

        if(!checkEditedEmail($email, $userId)){
            updateInfo($fname, $lname, $email, $contact, $user);
            echo '<script language="javascript">
                        alert("Successfully Updated !!");
                        window.location="'.SERVER.'/profile";
                      </script>';
        }else{
            echo '<script language="javascript">
                        alert("Email has been used by another user !!");
                        window.location="'.SERVER.'/editProfile";
                      </script>';
        }
    }
?>