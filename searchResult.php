<?php
    session_start();
    require 'controller/indexControl.php';
    require 'controller/define.php';
    $login =false;
    if(isset($_COOKIE['user']) || isset($_SESSION['user'])){
        if(!isset($_SESSION['user'])){
            $_SESSION['user'] = $_COOKIE['user'];
        }
        $login = true;
    }

    $items = false;
    if(isset($_GET['search'])){
        $items = true;
        $item = $_GET['search'];
        $getItemName = getItems($item);
    }


?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <?php require_once 'includes/head.php'; ?>
        <link href="<?php echo SERVER; ?>/assets/css/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>
        <link href="<?php echo SERVER; ?>/assets/css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet"/>
        <script src="<?php echo SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
        <script src="<?php echo SERVER; ?>/assets/css/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
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
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <?php if($items): ?>
                            <h1>Search Results for <?php echo $item; ?>...</h1>
                            <br/><br/>
                            <?php
                            $count = 0;
                            foreach($getItemName as $f): ?>
                                <div class="col-md-3">
                                    <div class="solid-border">
                                        <div class="idffi h-180 zoom">
                                            <img src="<?php echo SERVER; ?>/assets/img/food/<?php echo $f['am_image']; ?>" alt="<?php echo $f['am_title']; ?>"/>
                                        </div>
                                        <h3><?php echo $f['am_title']; ?></h3>
                                        <p><span>Price:&nbsp;&#2547;&nbsp;<?php echo $f['am_price']; ?></span></p>
                                        <?php $count++; ?>
                                    </div>
                                </div>
                                <?php
                                if($count%4 == 0){
                                    echo "</div></div><br/><div class='row'><div class='col-md-12 text-center'> ";
                                }
                            endforeach; endif;?>
                        </div>
                    </div>
                </div>
            </section>
            <br /><br /><br />
        </main>
    </div>
    <footer>
        <?php require "includes/footer.php";?>
    </footer>
    </body>
</html>
