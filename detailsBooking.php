<?php
session_start();
require 'controller/define.php';
require "controller/indexControl.php";
$login =false;
if(isset($_COOKIE['user']) || isset($_SESSION['user'])){
    if(!isset($_SESSION['user'])){
        $_SESSION['user'] = $_COOKIE['user'];
    }
    $login = true;

    $orderID = $_GET['order'];
    $login = true;
    $row = getOrders($orderID);
} elseif(!$login){
    header('Location: '.SERVER.'/404');
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <?php require_once 'includes/head.php'; ?>
    <link href="<?php echo SERVER; ?>/assets/css/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>
    <link href="<?php echo SERVER; ?>/assets/css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet"/>
    <script src="<?php echo SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
    <script src="<?php echo SERVER; ?>/assets/css/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
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
            <h1 class="text-center">Booking Details</h1>
            <br/><br/>
            <div class="container orders-list">
                    <div class="row">
                        <div class="col-md-12">
                            <p><label>Status:</label><span
                                    <?php if($row['status_cond'] == "Pending"): ?>
                                        class="text-warning"
                                    <?php elseif($row['status_cond'] == "Approve"): ?>
                                        class="text-success"
                                    <?php elseif($row['status_cond'] == "Unaprove"): ?>
                                        class="text-danger"
                                    <?php endif; ?>
                                > <?php echo $row['status_cond']; ?></span></p>
                            <p><label>Booking Date:</label> <?php $DOB = strtotime($row['date_of_booking']) ;$DOB = date("d M, Y", $DOB); echo $DOB; ?></p>
                            <p><label>Program Date:</label> <?php $DOB = strtotime($row['order_date']) ;$DOB = date("d M, Y", $DOB); echo $DOB; ?></p>
                            <p><label>Shift and Time:</label> <?php echo $row['order_shift']; ?></p>
                            <p><label>Purpose:</label> <?php echo $row['order_purpose']; ?></p>
                            <p><label>No. of Guests:</label> <?php echo $row['guest_number']; ?></p>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Services</h3>
                            <?php $service = explode('|', $row['services']); ?>
                            <br/><br/>
                            <div class="col-md-6">
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
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                    <br/><br/>
                    <?php if($row['g_title'] != null): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Welcome Gate</h3><br/>
                                <div class="col-md-3 text-center">
                                    <div class="solid-border">
                                        <div class="idffi h-180 zoom">
                                            <img src="<?php echo SERVER; ?>/assets/img/gate/<?php echo $row['g_image']; ?>" alt="<?php echo $row['g_title']; ?>"/>
                                        </div>
                                        <h3><?php echo $row['g_title']; ?></h3>
                                        <p><span>Price:&nbsp;&#2547;&nbsp;<?php echo $row['g_price']; ?></span></p>
                                    </div>
                                </div>
                                <div class="col-md-9"></div>
                            </div>
                        </div>
                        <br/><br/>
                    <?php endif; ?>
                    <?php if($row['st_title'] != null): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Stage</h3><br/>
                                <div class="col-md-3 text-center">
                                    <div class="solid-border">
                                        <div class="idffi h-180 zoom">
                                            <img src="<?php echo SERVER; ?>/assets/img/stage/<?php echo $row['st_image']; ?>" alt="<?php echo $row['st_title']; ?>"/>
                                        </div>
                                        <h3><?php echo $row['st_title']; ?></h3>
                                        <p><span>Price:&nbsp;&#2547;&nbsp;<?php echo $row['st_price']; ?></span></p>
                                    </div>
                                </div>
                                <div class="col-md-9"></div>
                            </div>
                        </div>
                        <br/><br/>
                    <?php endif; ?>
                    <h3>Food Menu</h3>
                    <br/>
                    <?php if($row['sm_title'] != null): ?>
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="col-md-4 text-center">
                                    <div class="col-md-12 solid-border set-menu">
                                        <h3><?php echo $row['sm_title']; ?></h3>
                                        <?php $menuDesc = explode('|', $row['sm_description']);
                                        foreach($menuDesc as $md):?>
                                            <p><?php echo $md; ?></p>
                                        <?php endforeach; ?>
                                        <p>Price:&nbsp;&#2547;&nbsp;<?php echo $row['sm_price']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                    <?php endif; ?>
                    <?php if($row['food'] != 0): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?php $foodItem = explode('|', $row['food']); ?>
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
                                        echo "</div></div><br/><div class='row'><div class='col-md-12 text-center'> ";
                                    }
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <hr/>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php $itemAmount = explode(';', $row['fullFood']); ?>
                            <?php
                            $count = 0;
                            foreach($itemAmount as $f):
                                $FoodAmount = explode('|', $f);
                                if($FoodAmount[1] != 0):?>
                                    <div class="col-md-3 text-center">
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
                                    echo "</div></div><br/><div class='row'><div class='col-md-12 text-center'> ";
                                }
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="row">
                        <div class="col-md-12">
                            <table>
                                <tr>
                                    <td><label>Total Cost:</label></td>
                                    <td class="text-right">&#2547;&nbsp;<?php echo $row['total_cost']; ?></td>
                                </tr>
                                <tr>
                                    <td><label>You've Paid:</label></td>
                                    <td class="text-right">&#2547;&nbsp;<?php echo $row['paid_cost']; ?></td>
                                </tr>
                                <tr>
                                    <td><label>Pending Cost:&nbsp;&nbsp;</label></td>
                                    <td class="text-right">&#2547;&nbsp;<?php echo ($row['total_cost'] - $row['paid_cost']).".00"; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <form action="<?php echo SERVER; ?>/controller/deleteOrder" method="post" onsubmit="return confirmation();">
                                    <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order">
                                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <br/><br/>
                    <?php if($row['status_cond'] == "Pending"): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-warning">N.B. You have to pay &#2547;&nbsp;25000.00 in advanced through bkash in 01626785569. For more details, please contact +880-1626785569</label>
                            </div>
                        </div>
                    <?php endif; ?>
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
<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/custom.js"></script>