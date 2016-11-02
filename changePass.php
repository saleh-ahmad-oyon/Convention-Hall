<?php
    session_start();

    require 'controller/define.php';

    $login = false;
    if (isset($_COOKIE['user']) || isset($_SESSION['user'])) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = $_COOKIE['user'];
        }
        $login = true;
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
                <?php require 'includes/nav.php';?>
            </header>
            <section>
                <div class="change-pass"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3"></div>
                            <div class="col-md-5">
                                <div class="col-md-12 padding-20">
                                    <div class="padding-border solid-border">
                                        <h3 class="text-center">Changing Password</h3>
                                        <br/><br/>
                                        <form action="<?= SERVER; ?>/controller/changePasswordSuccess" method="post">
                                            <div class="form-group">
                                                <p id="oldPass" class="text-white"></p>
                                                <label>Old Password</label>
                                                <input type="password"
                                                       id="oldPass1"
                                                       class="form-control"
                                                       name="oldPass"
                                                       required="required"
                                                       onblur="validatePassword('oldPass', this.value)" />
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password"
                                                       class="form-control"
                                                       name="newPass"
                                                       required="required"
                                                       id="newPass"
                                                       pattern="(?=^.{4,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                                                       onchange="this.setCustomValidity(this.validity.patternMismatch ? 'The password must contain one or more uppercase characters, one or more lowercase characters, one or more numeric values, one or more special characters, and length must be greater than or equal to 4' : ''); if(this.checkValidity()) form.confirmNewPass.pattern = this.value;" />
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password"
                                                       class="form-control"
                                                       name="confirmNewPass"
                                                       required="required"
                                                       id="confirmNewPass"
                                                       pattern="(?=^.{4,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                                                       onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" />
                                            </div>
                                            <br/>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-success" name="changePass">Confirm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                </div>
            </section>
            <br /><br />
        </main>
    </div>
    <footer>
        <?php require "includes/footer.php";?>
    </footer>

    <script src="<?= SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
    <script src="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
    <script src="<?= SERVER; ?>/assets/js/validate_script.js"></script>
    <script src="<?= SERVER; ?>/assets/js/custom.js"></script>
</body>
</html>