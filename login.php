<?php
    require 'controller/define.php';
    $login = false;
    if (isset($_COOKIE['user']) || isset($_SESSION['user'])) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = $_COOKIE['user'];
        }
        $login = true;
    }
    if ($login) {
        header('Location: '.SERVER.'');
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php require_once 'includes/head.php'; ?>
        <link href="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?= SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>
        <style>body { padding-top: 70px; }</style>
    </head>
    <body>
    <div id="wrap">
        <main>
            <header>
                <?php require 'includes/nav.php'; ?>
            </header>
            <section>
                <div class="cover-image-sign-up"></div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-offset-2 col-sm-8 col-lg-offset-4 col-lg-4">
                            <div class="padding-20">
                                <div class="padding-border solid-border">
                                    <h1>Login</h1>
                                    <form action="<?= SERVER; ?>/controller/loginSuccess" method="post">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" autofocus="autofocus" />
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="pass" />
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" checked="checked" name="remember"> Remember Me
                                            </label>
                                        </div>
                                        <br/>
                                        <button type="submit" name="loginbtn" class="btn btn-primary btn-block">Login</button>
                                    </form>
                                    <span class="text-danger">
                                        <?php
                                        if(isset($_GET['err']) && $_GET['err'] == 1){
                                            echo '*Username and Password do not match !!';
                                            echo nl2br("\n");
                                        }
                                        ?>
                                    </span>
                                    <br/>
                                    <a href="<?= SERVER; ?>/signup" name="signupbtn" class="btn btn-success btn-block">Sign Up</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 col-lg-4 hidden-xs"></div>
                    </div>
                </div>
                <br/>
            </section>
        </main>
    </div>
    <footer>
        <?php require "includes/footer.php";?>
    </footer>
    <script src="<?= SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
    <script src="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
    </body>
</html>