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
}
$addiFood = additionalFood();
$addiFoodFull = additionalFoodFull();
$setMenu = getSetMenu();
$shift = allShift();
$advantage = getAdvantages();
$feature = getAllFeatures();
$basic = basicServices();
$misc = Misc();
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <?php require_once 'includes/head.php'; ?>
        <link href="<?php echo SERVER; ?>/assets/css/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>
        <link href="<?php echo SERVER; ?>/assets/css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet"/>
        <script src="<?php echo SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
        <script src="<?php echo SERVER; ?>/assets/js/jquery.totop.js"></script>
        <link href="<?php echo SERVER; ?>/assets/css/totop.css" rel="stylesheet"/>
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

            jQuery(document).ready(function(){

                jQuery('a[href^="#"]').click(function(e) {
                    jQuery('html,body').animate({ scrollTop: jQuery(this.hash).offset().top}, 1000);
                    return false;
                    e.preventDefault();
                });
            });
        </script>
        <script src="<?php echo SERVER; ?>/assets/css/bootstrap-3.3.5-dist/js/bootstrap.js"></script>

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
                                <a class="navbar-brand" href="<?php echo SERVER; ?>">
                                    <img src="<?php echo SERVER; ?>/assets/img/logo/logo_with_text.png" width="50px">
                                </a>
                            </div>
                            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                                <form class="navbar-form navbar-left" role="search" method="get" action="<?php echo SERVER; ?>/searchResult">
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
                                                <li><a href="<?php echo SERVER; ?>/profile"><i class="fa fa-user font17"></i>&nbsp;&nbsp;Personal Info</a></li>
                                                <li><a href="<?php echo SERVER; ?>/myBookings"><i class="fa fa-cutlery"></i>&nbsp;&nbsp;My Bookings</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="<?php echo SERVER; ?>/changePass"><i class="fa fa-lock"></i>&nbsp;&nbsp;Change Password</a></li>
                                            </ul>
                                        </li>
                                    <?php endif; ?>

                                    <li><a href="<?php echo SERVER; ?>/booking">Book Now</a></li>
                                    <?php if(!$login): ?>
                                        <li><a href="<?php echo SERVER; ?>/login">Login</a></li>
                                    <?php else: ?>
                                        <li><a href="<?php echo SERVER; ?>/controller/logout">Logout</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <div class="container">
                        <div class="row" id="service">
                            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                <h1>Our Services</h1>
                                <br/><br/>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 solid-border service">
                                        <h3>Basic Charges</h3>
                                        <?php foreach($basic as $b): ?>
                                        <p><?php echo $b['serv_name']; ?> &#2547; <?php echo $b['Serv_price']; ?></p>
                                        <?php endforeach;; ?>
                                        <p>N. B. <?php echo $misc['misc_vat']; ?>% vat applicable</p>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 solid-border service">
                                        <h3>Advantages</h3>
                                        <?php foreach($advantage as $a): ?>
                                        <p><?php echo $a['adv_desc']; ?></p>
                                        <?php endforeach;; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="col-sm-12 col-md-12 col-lg-12 solid-border service">
                                        <h3>Features</h3>
                                        <?php foreach($feature as $f): ?>
                                        <p><?php echo $f['f_desc']; ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 solid-border service">
                                        <h3>Program Schedule:</h3>
                                        <?php foreach($shift as $s): ?>
                                        <p><?php echo $s['shift_name'], " ", $s['shift_time']; ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <b>N. B. If you have any extra guest(s), we will provide service to them but you have to pay &#2547; <?php echo $misc['misc_extra_cost']; ?> per guest.</b>
                            </div>
                        </div>
                        <br/><br/>
                        <div class="row" id="menu">
                            <h1>Menu</h1>
                            <br/><br/>
                            <div class="col-xs-12 com-sm-12 col-md-12 col-lg-12 text-center">
                                <?php
                                $count = 0;
                                foreach($setMenu as $sm): ?>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 solid-border set-menu">
                                        <h3><?php echo $sm['sm_title']; ?></h3>
                                        <?php $menuDesc = explode('|', $sm['sm_description']);
                                        foreach($menuDesc as $md):?>
                                        <p><?php echo $md; ?></p>
                                            <?php endforeach; ?>
                                        <p>Price:&nbsp;&#2547;&nbsp;<?php echo $sm['sm_price']; ?></p>
                                        <?php $count++; ?>
                                    </div>
                                </div>
                                <?php
                                    if($count%3 == 0){
                                        echo "</div></div><br/><div class='row'><div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center'> ";
                                    }
                                endforeach; ?>
                            </div>
                        </div>
                        <br/>
                        <hr/>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                <?php
                                    $count = 0;
                                    foreach($addiFood as $f): ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
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
                                            echo "</div></div><br/><div class='row'><div class='col-sm-12 col-md-12 col-lg-12 text-center'> ";
                                        }
                                    endforeach; ?>
                            </div>
                        </div>
                        <br/>
                        <hr/>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                <?php
                                    $count = 0;
                                    foreach($addiFoodFull as $f): ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
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
                                            echo "</div></div><br/><div class='row'><div class='col-sm-12 col-md-12 col-lg-12 text-center'> ";
                                        }
                                    endforeach; ?>
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
        <div id="totopscroller"> </div>
        <script>
            $(function(){
                $('#totopscroller').totopscroller({
                    //link:'<?php echo SERVER; ?>'
                });
            })
        </script>
    </body>
</html>