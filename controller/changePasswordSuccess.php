<?php
session_start();

require 'define.php';
require '../model/db.php';

if($_SERVER["REQUEST_METHOD"] != "POST") {
    /** @Link 404 Page */
    header('Location: '.SERVER.'/404');
    return;
}

if (!isset($_POST['changePass'])) {
    echo '<script language="javascript">
              alert("Old Password did not match !!");
              window.location="'.SERVER.'/changePass";
          </script>';
    return;
}

$oldpass  = $_POST['oldPass'];
$np       = $_POST['newPass'];
$cNewPass = $_POST['confirmNewPass'];
$email    = $_SESSION['user'];

if ($np != $cNewPass) {
    echo '<script language="javascript">
              alert("You have to put same password on both fields !!");
              window.location="'.SERVER.'/changePass";
          </script>';
    return;
}

if(!loginSuccess($email, $oldpass)) {
    echo '<script language="javascript">
                    alert("New Password did not match with Confirm New Password!!");
                    window.location="'.SERVER.'/changePass.php";
                  </script>';
    return;
}

$newPass = password_hash($np, PASSWORD_BCRYPT);
updatePass($newPass, $email);
echo '<script language="javascript">
          alert("Password Updated !!");
          window.location="'.SERVER.'";
      </script>';
