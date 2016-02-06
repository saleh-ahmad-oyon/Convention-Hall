<?php
    session_start();
    require 'controller/bookingControl.php';
    require 'controller/define.php';

    $login =false;
    if(isset($_COOKIE['user']) || isset($_SESSION['user'])){
        if(!isset($_SESSION['user'])){
            $_SESSION['user'] = $_COOKIE['user'];
        }
        $login = true;

        $shift = getAllShift();
        $purpose = getAllPurposes();
        $serv = getAllServices();
        $addiFood = getAllAdditionalFood();
        $addiFoodFull = getAllFullFood();
        $stage = getStage();
        $gate = getGate();
        $book = checkSameDate();
        $setMenu = getSetMenu();
        $booked = implode(",", $book);
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php require_once 'includes/head.php'; ?>
        <link href="<?php echo SERVER; ?>/assets/css/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo SERVER; ?>/assets/css/checkbox.css" rel="stylesheet"/>
        <link href="<?php echo SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>
        <link href="<?php echo SERVER; ?>/assets/css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet"/>
        <script src="<?php echo SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
        <link href="<?php echo SERVER; ?>/assets/css/jquery-ui.min.css" rel="stylesheet"/>
        <link href="<?php echo SERVER; ?>/assets/css/jquery-ui.theme.min.css" rel="stylesheet"/>
        <script src="<?php echo SERVER; ?>/assets/js/jquery-ui.min.js"></script>
        <script src="<?php echo SERVER; ?>/assets/css/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
        <script src="<?php echo SERVER; ?>/assets/js/checkbox.js"></script>
        <script src="<?php echo SERVER; ?>/assets/js/jquery.totop.js"></script>
        <link href="<?php echo SERVER; ?>/assets/css/totop.css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo SERVER; ?>/third_party/chosen/bootstrap-chosen.css" />
        <script src="<?php echo SERVER; ?>/third_party/chosen/chosen.jquery.js"></script>
        <script>
            var array = "<?php echo $booked; ?>";
            $(function() {
                $( "#datepicker" ).datepicker({
                    beforeShowDay: function(date){
                        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                        return [ array.indexOf(string) == -1 ]
                    },
                    showOnFocus: true,
                    showOtherMonths: true,
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: "dd/mm/yy",
                    minDate: '+0D'
                });
                /*$( "#shift" )
                    .selectmenu()
                    .selectmenu( "menuWidget" )
                    .addClass( "overflow" );*/
                /*$( "#purpose" )
                    .selectmenu()
                    .selectmenu( "menuWidget" )
                    .addClass( "overflow" );*/

            });

            //chosen (Select)
            $(function() {
                $('.chosen-select').chosen();
            });
        </script>
        <style>
            /*.overflow {
                height: 107px;
            }*/
            body { padding-top: 70px; }
        </style>
    </head>
    <body>
    <div id="wrap">
        <main>
            <header>
                <?php require_once 'includes/nav.php' ?>
            </header>
            <section>
            <?php if(!$login):  ?>
                <div class="cover-image-page-not-found"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="col-md-12 text-center">
                                    <h4>You have to login to Book Hall.</h4>
                                    <br/>
                                    <a href="<?php echo SERVER; ?>/login" class="btn btn-primary">Login</a>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
            <div class="container">
                <h1 class="text-center">Booking</h1><br/><br/><br/><br/>
                <form action="<?php echo SERVER; ?>/controller/bookingSuccess.php" method="post" onsubmit="return confirmation();">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <h3>Select Date</h3>
                                <div class="form-group">
                                    <input type="text" id="datepicker" placeholder="dd/mm/yyyy" name="dobooking" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Select Shift</h3>
                                <div class="form-group">
                                    <p id="shift1" class="text-danger"></p>
                                    <select name="shift" class="form-control" id="shift" onblur="validate('shift1', this.value)">
                                        <option></option>
                                        <?php foreach($shift as $value): ?>
                                            <option><?php echo $value['shift_name'], " ", $value['shift_time']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Select The purpose</h3>
                            <br/><br/>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="purpose" data-placeholder="" class="form-control chosen-select">
                                        <option></option>
                                        <?php foreach($purpose as $p): ?>
                                            <option><?php echo $p['p_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Select The Services</h3>
                            <br/><br/>
                            <div class="col-md-10">
                                <table class="table table-bordered">
                                    <tr>
                                        <th></th>
                                        <th class="text-center">Service</th>
                                        <th class="text-center">Price</th>
                                    </tr>
                                    <?php
                                    $countserv = 1;
                                    foreach($serv as $se): ?>
                                        <tr>
                                            <td>
                                                <div class="cf">
                                                    <label for="serv<?php echo $countserv; ?>" class="ccbx">
                                                <input type="checkbox" id="serv<?php echo $countserv; ?>" name="service[]" value="<?php echo $se['serv_id']; ?>"
                                                    <?php if(strpos($se['serv_name'],'Service Charge')!== false || strpos($se['serv_name'],'Hall Charge')!== false) :?>
                                                        checked="checked" disabled="disabled"
                                                    <?php endif; $countserv++; ?>
                                                    <?php if(strpos($se['serv_name'],'Kitchen Charge')!== false): ?>
                                                    disabled="disabled"
                                                       <?php endif; ?>
                                                />
                                                        </label>
                                                    </div>
                                            </td>
                                            <td><?php echo $se['serv_name']; ?></td>
                                            <td class="text-right">&#2547;&nbsp;<?php echo $se['Serv_price']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>No. Of Guests</h3>
                            <br/><br/>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="guestNum" required="required" id="phnNum" class="form-control" min="0" title="Number of Guests">
                                </div>
                            </div>
                            <div class="col-md-8"></div>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Select Welcome Gate Design</h3>
                            <br/><br/>
                            <?php
                            $count = 0;
                            foreach($gate as $g): ?>
                                <div class="col-md-3 text-center">
                                    <div class="solid-border gates">
                                        <input type="radio" id="gate<?php echo $count; ?>" name="gate" value="<?php echo $g['g_id']; ?>" />
                                        <label for="gate<?php echo $count; ?>">
                                            <div class="idffi h-180 zoom">
                                                <img src="<?php echo SERVER; ?>/assets/img/gate/<?php echo $g['g_image']; ?>" alt="<?php echo $g['g_title']; ?>"/>
                                            </div>
                                            <h3><?php echo $g['g_title']; ?></h3>
                                            <p><span>Price:&nbsp;&#2547;&nbsp;<?php echo $g['g_price']; ?></span></p>
                                        </label>
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
                    <br/><br/>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Select Stage Decoration</h3>
                            <br/><br/>
                            <?php
                            $count = 0;
                            $stCount = 1;
                            foreach($stage as $s): ?>
                                <div class="col-md-3 text-center">
                                    <div class="solid-border stages">
                                        <input type="radio" id="stage<?php echo $stCount; ?>" name="stage" value="<?php echo $s['st_id']; ?>" />
                                        <label for="stage<?php echo $stCount; ?>">
                                            <div class="idffi h-180 zoom">
                                                <img src="<?php echo SERVER; ?>/assets/img/stage/<?php echo $s['st_image']; ?>" alt="<?php echo $s['st_title']; ?>"/>
                                            </div>
                                            <h3><?php echo $s['st_title']; ?></h3>
                                            <p><span>Price:&nbsp;&#2547;&nbsp;<?php echo $s['st_price']; ?></span></p>
                                        </label>
                                        <?php $stCount++; $count++; ?>
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
                    <br/><br/>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3>Food Menu</h3>
                            <br/><br/>
                            <?php
                            $count = 0;
                            foreach($setMenu as $sm): ?>
                                <div class="col-md-4">
                                    <div class="col-md-12 solid-border set-menu">
                                        <input type="radio" id="setMenu<?php echo $count; ?>" name="setMenu" value="<?php echo $sm['sm_id']; ?>" />
                                        <label for="setMenu<?php echo $count; ?>">
                                            <h3><?php echo $sm['sm_title']; ?></h3>
                                            <?php $menuDesc = explode('|', $sm['sm_description']);
                                            foreach($menuDesc as $md):?>
                                                <p><?php echo $md; ?></p>
                                            <?php endforeach; ?>
                                            <p>Price:&nbsp;&#2547;&nbsp;<?php echo $sm['sm_price']; ?></p>
                                        </label>
                                        <?php $count++; ?>
                                    </div>
                                </div>
                                <?php
                                if($count%3 == 0){
                                    echo "</div></div><br/><div class='row'><div class='col-md-12 text-center'> ";
                                }
                            endforeach; ?>
                        </div>
                    </div>
                    <br/><hr/>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $count = 0;
                            $foodCount = 1;
                            foreach($addiFood as $f): ?>
                                <div class="col-md-3 text-center">
                                    <div class="solid-border addiFood">
                                        <input type="checkbox" id="food<?php echo $foodCount; ?>" name="food[]" value="<?php echo $f['am_id']; ?>"/>
                                        <label for="food<?php echo $foodCount; ?>">
                                            <div class="idffi h-180 zoom">
                                                <img src="<?php echo SERVER; ?>/assets/img/food/<?php echo $f['am_image']; ?>" alt="<?php echo $f['am_title']; ?>"/>
                                            </div>
                                            <h3><?php echo $f['am_title']; ?></h3>
                                            <p><span>Price:&nbsp;&#2547;&nbsp;<?php echo $f['am_price']; ?></span></p>
                                        </label>
                                        <?php $foodCount++; $count++; ?>
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
                    <br/><hr/>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $count = 0;
                            foreach($addiFoodFull as $f): ?>
                                <div class="col-md-3 text-center">
                                    <div class="solid-border">
                                        <label for="food">
                                            <div class="idffi h-180 zoom">
                                                <img src="<?php echo SERVER; ?>/assets/img/food/<?php echo $f['am_image']; ?>" alt="<?php echo $f['am_title']; ?>"/>
                                            </div>
                                            <h3><?php echo $f['am_title']; ?></h3>
                                                <div class="col-xs-7"><p><span>Price:&nbsp;&#2547;&nbsp;<?php echo $f['am_price']; ?></span></p></div>
                                                <div class="col-xs-5">
                                                    <input type="number" name="amount[]" min="0" class="form-control" value="0">
                                                </div>
                                            <input type="hidden" value="<?php echo $f['am_id']; ?>" name="foodFull[]">
                                            <br/><br/><br/>
                                        </label>
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
                    <br/><br/>
                    <div class="form-group">
                        <div class="cf">
                            <label for="agree" class="ccbx">
                                <input type="checkbox" required="required" id="agree" name="booking">&nbsp;&nbsp;I agree to pay&nbsp;&#2547; 25000.00 advanced.
                            </label>
                        </div>
                    </div>
                    <br/><br/>
                    <button type="submit" class="btn btn-success" name="bookingbtn">Book Now</button>
                </form>
            </div>
                <br /><br />
            <?php endif; ?>
        </section>
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
<script>
    function confirmation() {
        var r = confirm("You have to pay T.K. 25000.00 in Advanced through bkash in 01626785569.\n\nAre you sure to continue?");
        return r ? true : false;
    }

    //AJAX Code to check  input field values when onblur event triggerd.
    function validate(field, query)
    {
        var date1 = document.getElementById('datepicker').value  ;

        var xmlhttp;

        if (window.XMLHttpRequest)
        {// for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function()
        {
            if (xmlhttp.readyState != 4 && xmlhttp.status == 200)
            {
                document.getElementById(field).innerHTML = "Validating..";
            }
            else if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                document.getElementById(field).innerHTML = xmlhttp.responseText;
                if(xmlhttp.responseText != ''){
                    document.getElementById('shift').value = '';
                }
            }
            else
            {
                document.getElementById(field).innerHTML = "Error Occurred. <a href='booking.php'>Reload Or Try Again</a> the page.";
            }
        }
        xmlhttp.open("GET", "controller/checkDuplicateShift.php?query=" + query + "&date=" + date1, false);
        xmlhttp.send();
    }
</script>