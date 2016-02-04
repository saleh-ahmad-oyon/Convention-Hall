<?php
session_start();
require 'controller/define.php';
require 'controller/indexControl.php';
$login =false;
if(isset($_COOKIE['user']) || isset($_SESSION['user'])){
    if(!isset($_SESSION['user'])){
        $_SESSION['user'] = $_COOKIE['user'];
    }
    $login = true;

    $user = $_SESSION['user'];
    $proInfo = getPersonalInfo($user);
} elseif(!$login){
    header('Location: '.SERVER.'/404');
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <?php require_once 'includes/head.php'; ?>
    <link href="<?php echo SERVER; ?>/assets/css/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>
    <link href="<?php echo SERVER; ?>/assets/css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet"/>
    <script src="<?php echo SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
    <script src="<?php echo SERVER; ?>/assets/css/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
    <style>
        body { padding-top: 51px; }
    </style>
</head>
<body>
    <div id="wrap">
        <main>
            <header>
                <?php require 'includes/nav.php'; ?>
            </header>
            <section>
                <div class="profile-back"></div>
        <div class="container">
            <div class="col-md-12">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="padding-20">
                        <div class="padding-border solid-border">
                            <h3 class="text-center">Personal Information</h3><br/>
                            <table class="table table-bordered">
                                <tr>
                                    <td><label>Name</label></td>
                                    <td><?php echo htmlentities(stripslashes($proInfo['u_fname'])), " ", htmlentities(stripslashes($proInfo['u_lname'])); ?></td>
                                </tr>
                                <tr>
                                    <td><label>Email</label></td>
                                    <td><?php echo htmlentities(stripslashes($proInfo['u_email'])); ?></td>
                                </tr>
                                <tr>
                                    <td><label>Contact</label></td>
                                    <td><?php echo htmlentities(stripslashes($proInfo['u_contact'])); ?></td>
                                </tr>
                            </table>
                            <br/><br/>
                            <div class="text-center">
                                <a href="<?php echo SERVER; ?>/editProfile" class="btn btn-success">Update</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </section>
            <br/>
        </main>
    </div>
    <footer>
        <?php require "includes/footer.php";?>
    </footer>
</body>
</html>