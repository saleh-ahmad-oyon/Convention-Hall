<?php
/**
 * Created by PhpStorm.
 * User: Oyon
 * Date: 2/9/2016
 * Time: 1:36 PM
 */
session_start();
require '../controller/define.php';
require  '../controller/adminControl.php';
if(!isset($_SESSION['admin'])){
    header('Location: '.SERVER.'/404');
}else{
    $gate = getGate();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once '../includes/head.php'; ?>
    <link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/neon-core.css">
    <link rel="stylesheet" href="assets/css/neon-theme.css">
    <link rel="stylesheet" href="assets/css/neon-forms.css">
    <link href="<?php echo SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>

    <script src="<?php echo SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
    <script>$.noConflict();</script>

    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
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
                        <a href="<?php echo SERVER; ?>/controller/logout">
                            Log Out <i class="entypo-logout right"></i>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <hr />

        <div class="row">
            <div class="col-sm-12">
                <h1>Welcome Gates</h1>
                <br/><br/>
                <button class="btn btn-success"><i class="entypo-plus"></i> Add</button>
            </div>
        </div>
        <br/><br/>
        <div class="row">
            <div class="col-sm-12">
                <?php
                $count = 0;
                foreach($gate as $g): ?>
                    <div class="col-sm-3 text-center">
                        <div class="solid-border gates">
                            <div class="idffi h-180 zoom">
                                <img src="<?php echo SERVER; ?>/assets/img/gate/<?php echo $g['g_image']; ?>" alt="<?php echo $g['g_title']; ?>"/>
                            </div>
                            <h3><?php echo $g['g_title']; ?></h3>
                            <p><span>Price:&nbsp;&#2547;&nbsp;<?php echo $g['g_price']; ?></span></p>
                            <p>
                                <button onclick="showAjaxModal(<?php echo $g['g_id']; ?>);" class="btn btn-orange"><i class="entypo-pencil"></i> Edit</button>
                                <button class="btn btn-danger"><i class="entypo-trash"></i> Delete</button>
                            </p>
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
        <script type="text/javascript">
            function showAjaxModal(id)
            {
                jQuery('#modal-gate').modal('show', {backdrop: 'static'});
                jQuery.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data:{
                        gateID : id
                    },
                    cache : false,
                    url: "data/ajax-req-gate",
                    error: function() {
                        swal({
                            title: 'Failed!',
                            text: 'An error occured !!',
                            type: 'error'
                        });
                    },
                    success: function(response)
                    {
                        jQuery('#modal-gate .modal-body').html(
                            response.key + '<br/>' +
                            '<h4>Name: </h4>' +
                            '<input type="text" id="name" class="form-control" value="' + response.Name + '" /><br/>' +
                                response.image + '<br/>' +
                            '<h4>Price: </h4>' +
                            '<input type="number" step="0.01" id="price" class="form-control" value="' + response.value + '" />'
                        );
                    }
                });
            }
        </script>


        <!-- Modal-->
        <div class="modal fade" id="modal-gate">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title">Edit Gate Information</h3>
                    </div>
                    <div class="modal-body">
                        <!--Loading Ajax Request-->
                        Content is loading...
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--SWAL-->
<link href="<?php echo SERVER; ?>/assets/css/sweetalert2.css" rel="stylesheet">
<script src="<?php echo SERVER; ?>/assets/js/sweetalert2.min.js"></script>

<!-- Bottom scripts (common) -->
<script src="assets/js/gsap/main-gsap.js"></script>
<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/joinable.js"></script>
<script src="assets/js/resizeable.js"></script>
<script src="assets/js/neon-api.js"></script>
<script src="assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

<!-- JavaScripts initializations and stuff -->
<script src="assets/js/neon-custom.js"></script>


<!-- Demo Settings -->
<script src="assets/js/neon-demo.js"></script>

</body>
</html>