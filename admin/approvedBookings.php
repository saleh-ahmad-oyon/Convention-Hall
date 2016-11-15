<?php
/**
 * Created by PhpStorm.
 * User: Oyon
 * Date: 2/14/2016
 * Time: 3:52 PM
 */

session_start();
    require '../controller/define.php';
    require  '../controller/adminControl.php';
if(!isset($_SESSION['admin'])){
    header('Location: '.SERVER.'/404');
}else{
    $approveInfo = approveInfo();
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
    <script>$.noConflict();</script>

    <!--[if lt IE 9]>
    <script src="assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?= SERVER; ?>/third_party/html5shiv/html5shiv.min.js"></script>
    <script src="<?= SERVER ?>/third_party/respond.min.js"></script>
    <![endif]-->


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
        <h2>Approved Bookings</h2>

        <br />

        <table class="table table-bordered datatable" id="table-1">
            <thead>
            <tr>
                <th data-hide="phone">No.</th>
                <th>Date of Booking</th>
                <th data-hide="phone">Date of Program</th>
                <th data-hide="phone,tablet">Purpose</th>
                <th class="text-center">Total Payment</th>
                <th class="text-center">Pending Payment</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($approveInfo as $p): ?>
                <tr class="odd gradeX tableRow">
                    <td></td>
                    <td><?php $DOB = strtotime($p['date_of_booking']) ;$DOB = date("d M, Y", $DOB); echo $DOB; ?></td>
                    <td><?php $DOB = strtotime($p['order_date']) ;$DOB = date("d M, Y", $DOB); echo $DOB; ?></td>
                    <td><?php echo $p['order_purpose']; ?></td>
                    <td class="text-right">&#2547;&nbsp;<?php echo $p['total_cost']; ?></td>
                    <td class="text-right">&#2547;&nbsp;<?php echo ($p['total_cost'] - $p['paid_cost']).".00"; ?></td>
                    <td class="text-center">
                        <a href="<?php echo SERVER; ?>/admin/bookingDetails?order=<?php echo $p['order_id']; ?>" class="btn btn-info btn-sm btn-icon icon-left">
                            <i class="entypo-info"></i>
                            Details
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <th>No.</th>
                <th>Date of Booking</th>
                <th>Date of Program</th>
                <th>Purpose</th>
                <th class="text-center">Total Payment</th>
                <th class="text-center">Pending Payment</th>
                <th class="text-center">Action</th>
            </tr>
            </tfoot>
        </table>
        <script type="text/javascript">
            var responsiveHelper;
            var breakpointDefinition = {
                tablet: 1024,
                phone : 480
            };
            var tableContainer;

            jQuery(document).ready(function($)
            {
                $('.tableRow').each(function (i) {
                    $("td:first", this).html(i + 1);
                });

                tableContainer = $("#table-1");

                tableContainer.dataTable({
                    "sPaginationType": "bootstrap",
                    "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "bStateSave": true,


                    // Responsive Settings
                    bAutoWidth     : false,
                    fnPreDrawCallback: function () {
                        // Initialize the responsive datatables helper once.
                        if (!responsiveHelper) {
                            responsiveHelper = new ResponsiveDatatablesHelper(tableContainer, breakpointDefinition);
                        }
                    },
                    fnRowCallback  : function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        responsiveHelper.createExpandIcon(nRow);
                    },
                    fnDrawCallback : function (oSettings) {
                        responsiveHelper.respond();
                    }
                });

                $(".dataTables_wrapper select").select2({
                    minimumResultsForSearch: -1
                });
            });
        </script>
        <!-- Footer -->
        <footer>

        </footer>
    </div>
</div>
<!-- Imported styles on this page -->
<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css">
<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="assets/js/select2/select2.css">

<!-- Bottom scripts (common) -->
<script src="assets/js/gsap/main-gsap.js"></script>
<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/joinable.js"></script>
<script src="assets/js/resizeable.js"></script>
<script src="assets/js/neon-api.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/datatables/TableTools.min.js"></script>


<!-- Imported scripts on this page -->
<script src="assets/js/dataTables.bootstrap.js"></script>
<script src="assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
<script src="assets/js/datatables/lodash.min.js"></script>
<script src="assets/js/datatables/responsive/js/datatables.responsive.js"></script>
<script src="assets/js/select2/select2.min.js"></script>
<script src="assets/js/neon-chat.js"></script>


<!-- JavaScripts initializations and stuff -->
<script src="assets/js/neon-custom.js"></script>


<!-- Demo Settings -->
<script src="assets/js/neon-demo.js"></script>

</body>
</html>