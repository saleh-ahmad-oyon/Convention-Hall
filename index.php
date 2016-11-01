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
    }

    $addiFood     = additionalFood();
    $addiFoodFull = additionalFoodFull();
    $setMenu      = getSetMenu();
    $shift        = allShift();
    $advantage    = getAdvantages();
    $feature      = getAllFeatures();
    $basic        = basicServices();
    $misc         = Misc();
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <?php require_once 'includes/head.php'; ?>
        <link href="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?= SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>
        <link href="<?= SERVER; ?>/assets/css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="<?= SERVER; ?>/assets/css/totop.css" rel="stylesheet"/>
        <style>
            .row-padding{
                padding-top: 123px;
            }
            .row-padding-62{
                padding-top: 62px;
            }
            .fixed-top-nav {
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 2;
                box-shadow: 0 1px 2px rgba(0,0,0,.1);
            }
        </style>
    </head>
    <body>
        <div id="wrap">
            <main>
                <header>
                </header>
                <section>
                    <div class="cover-image"></div>
                    <div class="sjdvjhg">
                        <h1 class="asasas">Ahmad Convention Hall</h1>
                    </div>
                    <div class="fixed-top-nav-top"></div>
                    <nav class="navbar navbar-default main-content" id="fixed-top-nav-sec">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="<?= SERVER; ?>">
                                    <img src="<?= SERVER; ?>/assets/img/logo/logo_with_text.png" width="50px">
                                </a>
                            </div>
                            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                                <form class="navbar-form navbar-left" role="search" method="get" action="<?= SERVER; ?>/searchResult">
                                    <div class="form-group">
                                        <input type="search" class="form-control" placeholder="Search" name="search">
                                    </div>
                                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </form>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#service">Services</a></li>
                                    <li><a href="#menu">Menu</a></li>
                                    <?php if($login): ?>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?= SERVER; ?>/profile"><i class="fa fa-user font17"></i>&nbsp;&nbsp;Personal Info</a></li>
                                                <li><a href="<?= SERVER; ?>/myBookings"><i class="fa fa-cutlery"></i>&nbsp;&nbsp;My Bookings</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="<?= SERVER; ?>/changePass"><i class="fa fa-lock"></i>&nbsp;&nbsp;Change Password</a></li>
                                            </ul>
                                        </li>
                                    <?php endif; ?>

                                    <li><a href="<?= SERVER; ?>/booking">Book Now</a></li>
                                    <?php if(!$login): ?>
                                        <li><a href="<?= SERVER; ?>/login">Login</a></li>
                                    <?php else: ?>
                                        <li><a href="<?= SERVER; ?>/controller/logout">Logout</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <div class="container">
                        <div class="row" id="service">
                            <div class="col-sm-12 text-center">
                                <h1>Our Services</h1>
                                <div class="col-xs-12 col-sm-6 padding-top-20">
                                    <div class="col-xs-12 solid-border service">
                                        <h3>Basic Charges</h3>
                                        <?php foreach($basic as $b): ?>
                                        <p><?= $b['serv_name']; ?> &#2547; <?= $b['Serv_price']; ?></p>
                                        <?php endforeach;; ?>
                                        <p>N. B. <?= $misc['misc_vat']; ?>% vat applicable</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 padding-top-20">
                                    <div class="col-xs-12 solid-border service">
                                        <h3>Advantages</h3>
                                        <?php foreach($advantage as $a): ?>
                                        <p><?= $a['adv_desc']; ?></p>
                                        <?php endforeach;; ?>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 padding-top-20">
                                    <div class="col-xs-12 solid-border service">
                                        <h3>Features</h3>
                                        <?php foreach($feature as $f): ?>
                                            <p><?= $f['f_desc']; ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 padding-top-20">
                                    <div class="col-xs-12 solid-border service">
                                        <h3>Program Schedule:</h3>
                                        <?php foreach($shift as $s): ?>
                                            <p><?= $s['shift_name'], " ", $s['shift_time']; ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="row">
                            <div class="col-sm-12">
                                <b>N. B. If you have any extra guest(s), we will provide service to them but you have to pay &#2547; <?= $misc['misc_extra_cost']; ?> per guest.</b>
                            </div>
                        </div>
                        <br/><br/>
                        <div class="row" id="menu">
                            <h1>Menu</h1>
                            <div class="col-xs-12 text-center">
                                <?php foreach($setMenu as $sm): ?>
                                    <div class="col-xs-12 col-sm-4 padding-top-20">
                                        <div class="col-xs-12 solid-border set-menu">
                                            <h3><?= $sm['sm_title']; ?></h3>
                                            <?php $menuDesc = explode('|', $sm['sm_description']);
                                            foreach($menuDesc as $md):?>
                                            <p><?= $md; ?></p>
                                                <?php endforeach; ?>
                                            <p>Price:&nbsp;&#2547;&nbsp;<?= $sm['sm_price']; ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <br/>
                        <hr/>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <?php foreach($addiFood as $f): ?>
                                    <div class="col-sm-4 col-md-3 padding-top-20">
                                        <div class="solid-border">
                                            <div class="idffi h-180 zoom">
                                                <img src="<?= SERVER; ?>/assets/img/food/<?= $f['am_image']; ?>" alt="<?= $f['am_title']; ?>"/>
                                            </div>
                                            <h4><?= $f['am_title']; ?></h4>
                                            <p><span>Price:&nbsp;&#2547;&nbsp;<?= $f['am_price']; ?></span></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <br/>
                        <hr/>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <?php foreach($addiFoodFull as $f): ?>
                                    <div class="col-sm-4 col-md-3 padding-top-20">
                                        <div class="solid-border">
                                            <div class="idffi h-180 zoom">
                                                <img src="<?= SERVER; ?>/assets/img/food/<?= $f['am_image']; ?>" alt="<?= $f['am_title']; ?>"/>
                                            </div>
                                            <h4><?= $f['am_title']; ?></h4>
                                            <p><span>Price:&nbsp;&#2547;&nbsp;<?= $f['am_price']; ?></span></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </section>
                <?= str_repeat('<br/>', 3); ?>
            </main>
        </div>
        <footer>
            <?php require "includes/footer.php";?>
        </footer>
        <div id="totopscroller"></div>
        <script src="<?= SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
        <script src="<?= SERVER; ?>/assets/js/jquery.totop.js"></script>
        <script>
            function sticky_relocate() {
                var window_top = $(window).scrollTop();
                var div_top = $('.fixed-top-nav-top').offset().top;
                if (window_top > div_top) {
                    $('#fixed-top-nav-sec').addClass('fixed-top-nav');
                    $('#service').addClass('row-padding');
                    $('#menu').addClass('row-padding-62');
                } else {
                    $('#fixed-top-nav-sec').removeClass('fixed-top-nav');
                    $('#service').removeClass('row-padding');
                    $('#menu').removeClass('row-padding-62');
                }
            }
            $(function() {
                $(window).scroll(sticky_relocate);
                sticky_relocate();
            });

            $(document).ready(function(){

                $('a[href^="#"]').click(function(e) {
                    jQuery('html,body').animate({ scrollTop: jQuery(this.hash).offset().top}, 1000);
                    return false;
                    e.preventDefault();
                });
            });
        </script>
        <script src="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
        <script>
            $(function(){
                $('#totopscroller').totopscroller({
                    //link:'<?= SERVER; ?>'
                });
            });
        </script>
    </body>
</html>