<?php
    require 'controller/define.php';

    $login = false;
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
                            <div class="col-md-offset-3 col-md-6">
                                <br/>
                                <div id="myCarousel" class="carousel slide" >
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                        <li data-target="#myCarousel" data-slide-to="2"></li>
                                        <li data-target="#myCarousel" data-slide-to="3"></li>
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active">
                                            <img src="<?= SERVER ?>/assets/img/hall/1.jpg" alt="">
                                        </div>

                                        <div class="item">
                                            <img src="<?= SERVER ?>/assets/img/hall/2.jpg" alt="">
                                        </div>

                                        <div class="item">
                                            <img src="<?= SERVER ?>/assets/img/hall/4.jpg" alt="">
                                        </div>

                                        <div class="item">
                                            <img src="<?= SERVER ?>/assets/img/hall/setara_4.jpg" alt="">
                                        </div>
                                    </div>

                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
        <audio autoplay="autoplay" controls="controls" loop="loop" class="hidden">
            <source src="<?= SERVER; ?>/assets/audio/shania-twain-from-this-moment-on.ogg" />
        </audio>
        <footer>
            <?php require "includes/footer.php";?>
        </footer>

        <script src="<?= SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
        <script src="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
        <script>
            $(document).ready(function(){
                $('.carousel').carousel({
                    interval: 2000
                });
                $('#myCarousel').carousel('cycle');
            });
        </script>
    </body>
</html>