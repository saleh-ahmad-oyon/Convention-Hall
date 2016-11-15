<?php
session_start();
require '../controller/define.php';
require  '../controller/adminControl.php';
if(!isset($_SESSION['admin'])){
    header('Location: '.SERVER.'/404');
}else{
    $sched = schedule();
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

    <script src="assets/js/jquery-1.11.0.min.js"></script>

    <!--[if lt IE 9]>
    <script src="assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <script src="<?= SERVER; ?>/third_party/html5shiv/html5shiv.min.js"></script>
    <script src="<?= SERVER ?>/third_party/respond.min.js"></script>
    <![endif]-->
    <style>
        .login-page .login-header {
            padding: 0;
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
                <h1 class="text-center">Schedule</h1>
                <br/><br/>
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <button class="btn btn-primary" onclick="addRow();">
                        <i class="entypo-plus"></i>
                        Add Row
                    </button>
                    <br/><br/><br/>
                    <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>Shift</th>
                                    <th>Time</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($sched as $s): ?>
                                <tr>
                                    <td class="shift"><?php echo $s['shift_name']; ?></td>
                                    <td class="editShift hide-block"><input type="text" class="inpShift"  value="<?php echo $s['shift_name']; ?>"></td>
                                    <td class="time"><?php echo $s['shift_time']; ?></td>
                                    <td class="labID hide-block"><?php echo $s['shift_id']; ?></td>
                                    <td class="editTime hide-block"><input type="text" class="inpTime" value="<?php echo $s['shift_time']; ?>"></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-default btn-sm btn-icon icon-left scheduleEditBtn" onclick="editSchedule(this)">
                                            <i class="entypo-pencil"></i>
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-orange btn-sm btn-icon icon-left scheduleUpdateBtn hide-block" onclick="updateSchedule(this)">
                                            <i class="entypo-upload"></i>
                                            Update
                                        </button>&nbsp;
                                        <button class="btn btn-danger btn-sm btn-icon icon-left dltScheduleBtn" onclick="dltSchedule(this);">
                                            <i class="entypo-cancel"></i>
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                    </table>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <!-- Footer -->
        <footer>

        </footer>
    </div>
</div>
<script>
    var baseurl = '<?php echo SERVER ?>/controller/';
</script>
<script src="<?php echo SERVER; ?>/assets/js/admin-schedule.js"></script>
<!-- Imported styles on this page -->
<link rel="stylesheet" href="assets/js/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="assets/js/rickshaw/rickshaw.min.css">

<link href="<?php echo SERVER; ?>/assets/css/sweetalert2.css" rel="stylesheet">
<script src="<?php echo SERVER; ?>/assets/js/sweetalert2.min.js"></script>

<!-- Bottom scripts (common) -->
<script src="assets/js/gsap/main-gsap.js"></script>
<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/joinable.js"></script>
<script src="assets/js/resizeable.js"></script>
<script src="assets/js/neon-api.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/neon-login.js"></script>
<script src="assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>


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