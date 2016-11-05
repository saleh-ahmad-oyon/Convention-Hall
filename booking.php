<?php
    session_start();

    require 'controller/bookingControl.php';
    require 'controller/define.php';

    $login = false;
    if (isset($_COOKIE['user']) || isset($_SESSION['user'])) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = $_COOKIE['user'];
        }
        $login = true;

        $shift        = getAllShift();
        $purpose      = getAllPurposes();
        $serv         = getAllServices();
        $addiFood     = getAllAdditionalFood();
        $addiFoodFull = getAllFullFood();
        $stage        = getStage();
        $gate         = getGate();
        $book         = checkSameDate();
        $setMenu      = getSetMenu();
        $booked       = implode(",", $book);
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php require_once 'includes/head.php'; ?>
        <link href="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?= SERVER; ?>/assets/css/checkbox.css" rel="stylesheet"/>
        <link href="<?= SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>
        <link href="<?= SERVER; ?>/assets/css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="<?= SERVER; ?>/assets/css/jquery-ui.min.css" rel="stylesheet"/>
        <link href="<?= SERVER; ?>/assets/css/jquery-ui.theme.min.css" rel="stylesheet"/>

        <link href="<?= SERVER; ?>/assets/css/totop.css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?= SERVER; ?>/third_party/chosen/bootstrap-chosen.css" />

        <style>
            /*.overflow {
                height: 107px;
            }*/
            body { padding-top: 70px; }
            label { margin-bottom: 0 }
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
                                    <a href="<?= SERVER; ?>/login" class="btn btn-primary">Login</a>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
            <div class="container">
                <h1 class="text-center">Booking</h1><br/><br/><br/><br/>
                <form action="<?= SERVER; ?>/controller/bookingSuccess.php" method="post" onsubmit="return confirmation();">
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
                                    <select name="shift" class="form-control" id="shift" onblur="shiftvalidate('shift1', this.value)">
                                        <option></option>
                                        <?php foreach($shift as $value): ?>
                                            <option><?= $value['shift_name'], " ", $value['shift_time']; ?></option>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="purpose" data-placeholder="" class="form-control chosen-select">
                                        <option></option>
                                        <?php foreach($purpose as $p): ?>
                                            <option><?= $p['p_name']; ?></option>
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
                                                    <label for="serv<?= $countserv; ?>" class="ccbx">
                                                <input type="checkbox" id="serv<?= $countserv; ?>" name="service[]" value="<?= $se['serv_id']; ?>"
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
                                            <td><?= $se['serv_name']; ?></td>
                                            <td class="text-right">&#2547;&nbsp;<?= $se['Serv_price']; ?></td>
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
                        <div class="col-sm-12">
                            <h3>Select Welcome Gate Design</h3>
                            <br/><br/>
                            <?php foreach($gate as $i => $g): ?>
                                <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3 padding-top-20 text-center">
                                    <div class="solid-border gates">
                                        <input type="radio" id="gate<?= $i+1 ?>" name="gate" value="<?= $g['g_id']; ?>" />
                                        <label for="gate<?= $i+1 ?>">
                                            <div class="idffi h-180 zoom">
                                                <img src="<?= SERVER; ?>/assets/img/gate/<?= $g['g_image']; ?>" alt="<?= $g['g_title']; ?>"/>
                                            </div>
                                            <h4><?= $g['g_title']; ?></h4>
                                            <p><span>Price:&nbsp;&#2547;&nbsp;<?= $g['g_price']; ?></span></p>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Select Stage Decoration</h3>
                            <br/><br/>
                            <?php foreach($stage as $i => $s): ?>
                                <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3 padding-top-20 text-center">
                                    <div class="solid-border stages">
                                        <input type="radio" id="stage<?= $i+1; ?>" name="stage" value="<?= $s['st_id']; ?>" />
                                        <label for="stage<?= $i+1; ?>">
                                            <div class="idffi h-180 zoom">
                                                <img src="<?= SERVER; ?>/assets/img/stage/<?= $s['st_image']; ?>" alt="<?= $s['st_title']; ?>"/>
                                            </div>
                                            <h4><?= $s['st_title']; ?></h4>
                                            <p><span>Price:&nbsp;&#2547;&nbsp;<?= $s['st_price']; ?></span></p>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h3>Food Menu</h3>
                            <br/><br/>
                            <?php foreach($setMenu as $i=> $sm): ?>
                                <div class="col-xs-12 col-sm-4 padding-top-20">
                                    <div class="col-md-12 solid-border set-menu">
                                        <input type="radio" id="setMenu<?= $i+1 ?>" name="setMenu" value="<?= $sm['sm_id']; ?>" />
                                        <label for="setMenu<?= $i+1 ?>">
                                            <h3><?= $sm['sm_title']; ?></h3>
                                            <?php $menuDesc = explode('|', $sm['sm_description']);
                                            foreach($menuDesc as $md):?>
                                                <p><?= $md; ?></p>
                                            <?php endforeach; ?>
                                            <p>Price:&nbsp;&#2547;&nbsp;<?= $sm['sm_price']; ?></p>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <br/><hr/>
                    <div class="row">
                        <div class="col-md-12">
                            <?php foreach($addiFood as $i => $f): ?>
                                <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3 padding-top-20 text-center">
                                    <div class="solid-border addiFood">
                                        <input type="checkbox" id="food<?= $i+1; ?>" name="food[]" value="<?= $f['am_id']; ?>"/>
                                        <label for="food<?= $i+1; ?>">
                                            <div class="idffi h-180 zoom">
                                                <img src="<?= SERVER; ?>/assets/img/food/<?= $f['am_image']; ?>" alt="<?= $f['am_title']; ?>"/>
                                            </div>
                                            <h4><?= $f['am_title']; ?></h4>
                                            <p><span>Price:&nbsp;&#2547;&nbsp;<?= $f['am_price']; ?></span></p>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <br/><hr/>
                    <div class="row">
                        <div class="col-md-12">
                            <?php foreach($addiFoodFull as $f): ?>
                                <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3 padding-top-20 text-center">
                                    <div class="solid-border">
                                        <label for="food">
                                            <div class="idffi h-180 zoom">
                                                <img src="<?= SERVER; ?>/assets/img/food/<?= $f['am_image']; ?>" alt="<?= $f['am_title']; ?>"/>
                                            </div>
                                            <h4><?= $f['am_title']; ?></h4>
                                                <div class="col-xs-7"><p><span>Price: &#2547; <?= $f['am_price']; ?></span></p></div>
                                                <div class="col-xs-5">
                                                    <input type="number" name="amount[]" min="0" class="form-control" value="0">
                                                </div>
                                            <input type="hidden" value="<?= $f['am_id']; ?>" name="foodFull[]">
                                            <br/><br/><br/>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="form-group">
                        <div class="cf">
                            <label for="agree" class="ccbx">
                                <input type="checkbox" required="required" id="agree" name="booking">&nbsp;&nbsp;I agree to pay&nbsp;&#2547; 25000.00 in advanced.
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
    <script src="<?= SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
    <script src="<?= SERVER; ?>/assets/js/jquery-ui.min.js"></script>
    <script src="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
    <script src="<?= SERVER; ?>/assets/js/checkbox.js"></script>
    <script src="<?= SERVER; ?>/assets/js/jquery.totop.js"></script>
    <script src="<?= SERVER; ?>/third_party/chosen/chosen.jquery.js"></script>
    <script>
        var array = "<?= $booked; ?>";
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
            $( "#shift" )
             .selectmenu()
             .selectmenu( "menuWidget" )
             .addClass( "overflow" );
            /*$( "#purpose" )
             .selectmenu()
             .selectmenu( "menuWidget" )
             .addClass( "overflow" );*/

        });

        //chosen (Select)
        $(function() {
            $('.chosen-select').chosen();
        });

        function confirmation() {
            var r = confirm("You have to pay T.K. 25000.00 in Advanced through bkash in 01626785569.\n\nAre you sure to continue?");
            return r ? true : false;
        }
        $(function(){
            $('#totopscroller').totopscroller({
                //link:'<?= SERVER; ?>'
            });
        })
    </script>
    <script src="<?= SERVER ?>/assets/js/validate_script.js"></script>
    </body>
</html>