<?php
session_start();
require '../model/db.php';
    if(isset($_POST['changePass'])){

        $oldpass = $_POST['oldPass'];
        $np = $_POST['newPass'];
        $cNewPass = $_POST['confirmNewPass'];
        $email = $_SESSION['user'];
        if(loginSuccess($email, $oldpass)){
            if($np == $cNewPass){
                $newPass = password_hash($np, PASSWORD_BCRYPT);
                updatePass($newPass, $email);
                echo '<script language="javascript">
							alert("Password Updated !!");
							window.location="http://localhost/convention";
						  </script>';
            }else{
                echo '<script language="javascript">
							alert("New Password did not match with Confirm New Password!!");
							window.location="http://localhost/convention/changePass.php";
						  </script>';
            }
        }else{
            echo '<script language="javascript">
							alert("Old Password did not match !!");
							window.location="http://localhost/convention/changePass.php";
						  </script>';
        }
    }
?>