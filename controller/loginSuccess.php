<?php
    session_start();
    require '../model/db.php';
    require 'define.php';

    if(isset($_POST['loginbtn'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        if(loginSuccess($email, $pass)){
            $_SESSION['user']= $email;
            $row = getUserID($email);
            $_SESSION['id'] = $row['s_id'];
            $cookie_name = "user";
            $cookie_value = $email;
            $cookie_name2 = "id";
            $cookie_value2 = $row['s_id'];
            if(isset($_POST['remember'])){
                setcookie($cookie_name, $cookie_value, time() + (3600 * 24 * 30), "/");
                setcookie($cookie_name2, $cookie_value2, time() + (3600 * 24 * 30), "/");
            }
            header('Location: '.SERVER.'');
        }else{
            header('Location: '.SERVER.'/login?err=1');
        }
    }
