<?php
    require 'controller/define.php';

    $login =false;
    if (isset($_COOKIE['user']) || isset($_SESSION['user'])) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = $_COOKIE['user'];
        }
        $login = true;
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php require_once 'includes/head.php'; ?>
        <link href="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?= SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>
        <style>
            body { padding-top: 70px; }
        </style>
    </head>
    <body>
        <div id="wrap">
            <main>
                <header>
                    <?php require 'includes/nav.php'; ?>
                </header>
                <section>
                    <div class="container">
                        <div class="com-md-12">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <br/>
                                <div id="googleMap" style="width:500px;height:380px;"></div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
        <footer>
            <?php require "includes/footer.php";?>
        </footer>

        <script src="<?= SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
        <script src="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2A618H4TLuOR0DZKlMWqcufONoBOng-c&callback=initMap"></script>
        <script src="<?= SERVER ?>/assets/js/googlemap.js"></script>
    </body>
</html>