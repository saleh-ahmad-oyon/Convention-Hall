<?php
    session_start();
    require '../model/db.php';
    require 'define.php';

    if(isset($_POST['signUpBtn'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $postPass = $_POST['pass'];
        $pass = password_hash($postPass, PASSWORD_BCRYPT);
        $captcha ='';
        if(isset($_POST['g-recaptcha-response'])){
            $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
            echo '<h2>Please check the the captcha form.</h2>';
            exit;
        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Ld3rg8TAAAAADLoleP1CehvC4L7M2Bj87F2z5Jv&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);

        $decoded_response = json_decode($response, true);


        if ($decoded_response["success"] == FALSE) {
            echo '<script language="javascript">
                                alert("You are Spammer ! Get the F%%k out");
                                window.location="'.SERVER.'";
                              </script>';
        }
        elseif(!checkUserEmail($email)){
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
?>