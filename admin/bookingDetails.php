<?php
session_start();
require '../controller/define.php';
require  '../controller/adminControl.php';
if(!isset($_SESSION['admin'])){
    header('Location: '.SERVER.'/404');
}else{
    $id = $_GET['order'];
    $book = detailsBooking($id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />

    <?php require_once '../includes/head.php'; ?>

    <link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/neon-core.css">
    <link rel="stylesheet" href="assets/css/neon-theme.css">
    <link rel="stylesheet" href="assets/css/neon-forms.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link href="<?php echo SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>

    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script>$.noConflict();</script>

    <!--[if lt IE 9]>
    <script src="assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?= SERVER; ?>/third_party/html5shiv/html5shiv.min.js"></script>
    <script src="<?= SERVER ?>/third_party/respond.min.js"></script>
    <![endif]-->

    <style>
        a, a:hover, a:focus{
            color: #373e4a;
        }
    </style>
</head>
<body class="page-body  page-fade" data-url="http://neon.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <?php include 'menu.php'; ?>

    <div class="main-content">
        <div class="row">

            <!-- Profile Info and Notifications -->
            <div class="col-md-6 col-sm-8 clearfix">

            </div>


            <!-- Raw Links -->
            <div class="col-md-6 col-sm-4 clearfix hidden-xs">
                <ul class="list-inline links-list pull-right">
                    <li class="sep"></li>
                    <li>
                        <a href="<?= SERVER; ?>/controller/logout">
                            Log Out <i class="entypo-logout right"></i>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <hr />
        <div class="row">
            <div class="col-sm-12">
                <h1>Order Details</h1>
                <br/><br/>
                <div class="row">
                    <div class="col-sm-6">
                        <table class="table">
                            <tr>
                                <td><label>Name:</label></td>
                                <td><?php echo $book['u_fname'], " ", $book['u_lname']; ?></td>
                            </tr>
                            <tr>
                                <td><label>Email:</label></td>
                                <td><?php echo $book['u_email']; ?></td>
                            </tr>
                            <tr>
                                <td><label>Contact:</label></td>
                                <td><?php echo $book['u_contact']; ?></td>
                            </tr>
                            <tr>
                                <td><label>Date of Booking:</label></td>
                                <td><?php $DOB = strtotime($book['date_of_booking']) ;$DOB = date("d M, Y", $DOB); echo $DOB; ?></td>
                            </tr>
                            <tr>
                                <td><label>Date of Program:</label></td>
                                <td><?php $DOB = strtotime($book['order_date']) ;$DOB = date("d M, Y", $DOB); echo $DOB; ?></td>
                            </tr>
                            <tr>
                                <td><label>Shift and Time:&nbsp;&nbsp;</label></td>
                                <td><?php echo $book['order_shift']; ?></td>
                            </tr>
                            <tr>
                                <td><label>Order Purpose:</label></td>
                                <td><?php echo $book['order_purpose']; ?></td>
                            </tr>
                            <tr>
                                <td><label>Status:</label></td>
                                <td><?php echo $book['status_cond']; ?></td>
                            </tr>
                            <tr class="info">
                                <td><label>Total Cost:</label></td>
                                <td>&#2547;&nbsp;<?php echo $book['total_cost']; ?></td>
                            </tr>
                            <tr class="success">
                                <td><label>Paid Cost:</label></td>
                                <td>&#2547;&nbsp;<?php echo $book['paid_cost']; ?></td>
                            </tr>
                            <tr class="warning">
                                <td><label>Due Cost:</label></td>
                                <td>&#2547;&nbsp;<?php echo $book['total_cost'] - $book['paid_cost']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h3>Services</h3>
                        <?php $service = explode('|', $book['services']); ?>
                        <br/><br/>
                        <div class="col-sm-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center">Service</th>
                                    <th class="text-center">Price</th>
                                </tr>
                                <?php
                                $countserv = 1;
                                foreach($service as $se): ?>
                                    <tr>
                                        <td><?php echo getServiceName((int)$se); ?></td>
                                        <td class="text-right">&#2547;&nbsp;<?php echo getServicePrice((int)$se); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                </div>
                <?php if($book['g_title'] != null): ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Welcome Gate</h3><br/>
                            <div class="col-sm-3 text-center">
                                <div class="solid-border">
                                    <div class="idffi h-180 zoom">
                                        <img src="<?php echo SERVER; ?>/assets/img/gate/<?php echo $book['g_image']; ?>" alt="<?php echo $book['g_title']; ?>"/>
                                    </div>
                                    <h3><?php echo $book['g_title']; ?></h3>
                                    <p><span>Price:&nbsp;&#2547;&nbsp;<?php echo $book['g_price']; ?></span></p>
                                </div>
                            </div>
                            <div class="col-sm-9"></div>
                        </div>
                    </div>
                    <br/><br/>
                <?php endif; ?>
                <?php if($book['st_title'] != null): ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Stage</h3><br/>
                            <div class="col-sm-3 text-center">
                                <div class="solid-border">
                                    <div class="idffi h-180 zoom">
                                        <img src="<?php echo SERVER; ?>/assets/img/stage/<?php echo $book['st_image']; ?>" alt="<?php echo $book['st_title']; ?>"/>
                                    </div>
                                    <h3><?php echo $book['st_title']; ?></h3>
                                    <p><span>Price:&nbsp;&#2547;&nbsp;<?php echo $book['st_price']; ?></span></p>
                                </div>
                            </div>
                            <div class="col-sm-9"></div>
                        </div>
                    </div>
                    <br/><br/>
                <?php endif; ?>
                <h3>Food Menu</h3>
                <br/>
                <?php if($book['sm_title'] != null): ?>
                    <div class="row">
                        <div class="col-sm-12 ">
                            <div class="col-sm-4 text-center">
                                <div class="col-sm-12 solid-border set-menu">
                                    <h3><?php echo $book['sm_title']; ?></h3>
                                    <?php $menuDesc = explode('|', $book['sm_description']);
                                    foreach($menuDesc as $md):?>
                                        <p><?php echo $md; ?></p>
                                    <?php endforeach; ?>
                                    <p>Price:&nbsp;&#2547;&nbsp;<?php echo $book['sm_price']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                <?php endif; ?>
                <?php if($book['food'] != 0): ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php $foodItem = explode('|', $book['food']); ?>
                            <?php
                            $count = 0;
                            foreach($foodItem as $f): ?>
                                <div class="col-md-3 text-center">
                                    <div class="solid-border">
                                        <div class="idffi h-180 zoom">
                                            <img src="<?php echo SERVER; ?>/assets/img/food/<?php echo getFoodImage((int) $f);  ?>" alt="<?php echo getFoodTitle((int) $f); ?>"/>
                                        </div>
                                        <h3><?php echo getFoodTitle((int) $f); ?></h3>
                                        <p><span>Price:&nbsp;&#2547;&nbsp;<?php echo getFoodPrice((int) $f); ?></span></p>
                                        <?php $count++; ?>
                                    </div>
                                </div>
                                <?php
                                if($count%4 == 0){
                                    echo "</div></div><br/><div class='row'><div class='col-sm-12 text-center'> ";
                                }
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <hr/>
                <?php endif; ?>
                <div class="row">
                    <div class="col-sm-12">
                        <?php $itemAmount = explode(';', $book['fullFood']); ?>
                        <?php
                        $count = 0;
                        foreach($itemAmount as $f):
                            $FoodAmount = explode('|', $f);
                            if($FoodAmount[1] != 0):?>
                                <div class="col-sm-3 text-center">
                                    <div class="solid-border">
                                        <label for="food">
                                            <div class="idffi h-180 zoom">
                                                <img src="<?php echo SERVER; ?>/assets/img/food/<?php echo getFoodImage((int)$FoodAmount[0]); ?>" alt="<?php echo getFoodTitle((int)$FoodAmount[0]); ?>"/>
                                            </div>
                                            <h3><?php echo getFoodTitle((int)$FoodAmount[0]); ?></h3>
                                            <div class="col-xs-7"><p><span>Price:&nbsp;&#2547;&nbsp;<?php echo getFoodPrice((int)$FoodAmount[0]); ?></span></p></div>
                                            <div class="col-xs-5">
                                                <input type="number" name="amount[]" min="0" class="form-control" value="<?php echo $FoodAmount[1]; ?>" disabled="disabled">
                                            </div>
                                            <br/><br/><br/>
                                        </label>
                                        <?php $count++; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php
                            if($count%4 == 0){
                                echo "</div></div><br/><div class='row'><div class='col-sm-12 text-center'> ";
                            }
                        endforeach;
                        ?>
                    </div>
                </div>
                <br/><br/>
                <p><label>Change Status:</label>
                <form action="<?php echo SERVER; ?>/controller/changeStatusByAdmin" method="post" onsubmit="return confirmation();">
                    <input type="hidden" value="<?php echo $book['order_id']; ?>" name="order">
                    <input type="hidden" value="<?php echo $book['total_cost']; ?>" name="total">
                    <button type="submit" class="btn btn-success" name="approve">Approve</button>
                    <button type="submit" class="btn btn-danger" name="unapprove">Unapprove</button>
                    <button type="submit" class="btn btn-gold" name="complete">Complete</button>
                </form>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Imported styles on this page -->
<link rel="stylesheet" href="assets/js/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="assets/js/rickshaw/rickshaw.min.css">

<!-- Bottom scripts (common) -->
<script src="assets/js/gsap/main-gsap.js"></script>
<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/joinable.js"></script>
<script src="assets/js/resizeable.js"></script>
<script src="assets/js/neon-api.js"></script>
<script src="assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo SERVER; ?>/assets/js/custom.js"></script>


<!-- Imported scripts on this page -->
<script src="assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
<script src="assets/js/jquery.sparkline.min.js"></script>
<script src="assets/js/rickshaw/vendor/d3.v3.js"></script>
<script src="assets/js/rickshaw/rickshaw.min.js"></script>
<script src="assets/js/raphael-min.js"></script>
<script src="assets/js/morris.min.js"></script>
<script src="assets/js/toastr.js"></script>


<!-- JavaScripts initializations and stuff -->
<script src="assets/js/neon-custom.js"></script>


<!-- Demo Settings -->
<script src="assets/js/neon-demo.js"></script>

</body>
</html>