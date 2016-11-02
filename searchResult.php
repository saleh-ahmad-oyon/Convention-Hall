<?php
    session_start();

    require 'controller/indexControl.php';
    require 'controller/define.php';

    $login = false;
    if (isset($_COOKIE['user']) || isset($_SESSION['user'])) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = $_COOKIE['user'];
        }
        $login = true;
    }

    $items = false;
    if (isset($_GET['search'])) {
        $items       = true;
        $item        = $_GET['search'];
        $getItemName = getItems($item);
    }
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <?php require_once 'includes/head.php'; ?>
        <link href="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?= SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>
        <link href="<?= SERVER; ?>/assets/css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet"/>
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
                        <div class="row text-center">
                            <?php if($items): ?>
                            <h1>Search Results for <?php echo $item; ?>...</h1>
                            <br/><br/>
                            <?php foreach($getItemName as $f): ?>
                                <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3 padding-top-20">
                                    <div class="solid-border">
                                        <div class="idffi h-180 zoom">
                                            <img src="<?= SERVER; ?>/assets/img/food/<?= $f['am_image']; ?>" alt="<?= $f['am_title']; ?>"/>
                                        </div>
                                        <h4><?= $f['am_title']; ?></h4>
                                        <p><span>Price:&nbsp;&#2547;&nbsp;<?= $f['am_price']; ?></span></p>
                                    </div>
                                </div>
                            <?php endforeach; endif;?>
                        </div>
                    </div>
                </section>
                <br /><br /><br />
            </main>
        </div>
        <footer>
            <?php require "includes/footer.php";?>
        </footer>

        <script src="<?= SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
        <script src="<?=SERVER; ?>/assets/css/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
    </body>
</html>
