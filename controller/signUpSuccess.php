<?php
session_start();
require '../model/db.php';
require 'define.php';

if(isset($_POST['signUpBtn'])){
    $fname    = $_POST['fname'];
    $lname    = $_POST['lname'];
    $email    = $_POST['email'];
    $contact  = $_POST['contact'];
    $postPass = $_POST['pass'];
    $pass     = password_hash($postPass, PASSWORD_BCRYPT);
    $captcha  = '';

    if (isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
    }
    if (!$captcha) {
        echo '<script language="javascript">
                            alert("Please check the the captcha form.");
                            window.location="'.SERVER.'/signup";
                          </script>';
    }

    $secretKey = '6Ld3rg8TAAAAADLoleP1CehvC4L7M2Bj87F2z5Jv';

    require_once "../third_party/recaptchalib.php";

    /** check secret key */
    $reCaptcha = new ReCaptcha($secretKey);

    /** if submitted check response */
    if ($_POST["g-recaptcha-response"]) {
        $response = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $captcha
        );
    }

    if (!$response->success) {
        echo '<script language="javascript">
                            alert("You are Spammer ! Get the F%%k out");
                            window.location="'.SERVER.'";
                          </script>';
    } elseif (!checkUserEmail($email)) {
        insertUser($fname, $lname, $email, $contact, $pass);
        $_SESSION['user']= $email;
        $row = getUserID($email);
        $_SESSION['id'] = $row['s_id'];
        echo '<script language="javascript">
                            alert("Successfully Registered !!");
                            window.location="'.SERVER.'";
                          </script>';
    }else{
        echo '<script language="javascript">
                            alert("Email Already Inserted !! Sign Up Failed");
                            window.location="'.SERVER.'/signup";
                          </script>';
    }
}
