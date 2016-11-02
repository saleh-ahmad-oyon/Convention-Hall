<?php
    session_start();

    require 'controller/define.php';
    require 'controller/indexControl.php';

    $login = false;
    if (isset($_COOKIE['user']) || isset($_SESSION['user'])) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = $_COOKIE['user'];
        }
        $login = true;

        $user    = $_SESSION['user'];
        $proInfo = getPersonalInfo($user);
    } elseif (!$login){
        header('Location: '.SERVER.'/404');
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <?php require_once 'includes/head.php'; ?>
    <link href="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?= SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>
    <link href="<?= SERVER; ?>/assets/css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet"/>
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
            <div class="col-xxs-12">
                <div class="col-md-offset-4 col-md-4 col-sm-offset-1 col-sm-10 col-xxs-12">
                    <div class="padding-20">
                        <div class="padding-border solid-border">
                            <h3 class="text-center">Personal Information</h3><br/>
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <td><label>Name</label></td>
                                    <td class="break-big-word">
                                        <?= htmlentities(stripslashes($proInfo['u_fname'])), " ", htmlentities(stripslashes($proInfo['u_lname'])); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Email</label></td>
                                    <td class="break-big-word">
                                        <?= htmlentities(stripslashes($proInfo['u_email'])); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Contact</label></td>
                                    <td class="break-big-word">
                                        <?= htmlentities(stripslashes($proInfo['u_contact'])); ?>
                                    </td>
                                </tr>
                            </table>
                            <br/><br/>
                            <div class="text-center">
                                <a href="<?= SERVER; ?>/editProfile" class="btn btn-success">Update</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-1 hidden-xs"></div>
            </div>
        </div>
    </section>
            <br/>
        </main>
    </div>
    <footer>
        <?php require "includes/footer.php";?>
    </footer>

    <script src="<?= SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
    <script src="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
</body>
</html>