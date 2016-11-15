<?php
/**
 * Created by PhpStorm.
 * User: Oyon
 * Date: 2/13/2016
 * Time: 1:53 PM
 */
session_start();
require '../controller/define.php';
require  '../controller/adminControl.php';
if(!isset($_SESSION['admin'])){
    header('Location: '.SERVER.'/404');
}else{
    $setMenu = getSetMenu();
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
    <link rel="stylesheet" href="<?= SERVER ?>/assets/css/todos.css" />
    <link href="<?= SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>

    <script src="<?= SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
    <script>//$.noConflict();</script>

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
        .set-menu p:nth-last-child(2){
            padding: 12px 0;
            background: rgba(30,69,97,.48);
            color: #fff;
        }
        .set-menu p:last-child{
            background: #333;
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
                <h1>Set Menu</h1>
                <br/><br/>
                <button class="btn btn-success" data-toggle="modal" data-target="#modal-setmenu-add"><i class="entypo-plus"></i> Add</button>
            </div>
        </div>

        <div class="modal fade" id="modal-setmenu-add">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title">Add Set Menu</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                        <div class="form-group">
                                            <h4>Title:</h4>
                                            <input type="text" id="add_setmenu_name" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <h4>Items (add one by one pressing Enter):</h4>
                                                <input type="text" name="new-todo" id="new-todo" class="form-control" />
                                            <ul id="todo-list">
                                            </ul>
                                        </div>
                                        <div class="form-group">
                                            <h4>Cost:</h4>
                                            <input type="number" step="0.01" id="add_setmenu_price" class="form-control" />
                                        </div>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="add_setmenu_close" class="btn btn-default" onclick="dissmissAddModal();">Cancel</button>
                        <button type="submit" class="btn btn-info" onclick="addNewSetMenu()">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <br/><br/>
        <div id="setmenu-content">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    $count = 0;
                    foreach($setMenu as $sm): ?>
                        <div class="col-xs-4 text-center">
                            <div class="col-xs-12 set-menu">
                                <h3><?php echo $sm['sm_title']; ?></h3>
                                <?php $menuDesc = explode('|', $sm['sm_description']);
                                foreach($menuDesc as $md):?>
                                    <p><?php echo $md; ?></p>
                                <?php endforeach; ?>
                                <p>Price: &#2547; <?php echo $sm['sm_price']; ?></p>
                                <p>
                                    <button onclick="showAjaxModal(<?php echo $sm['sm_id']; ?>);" class="btn btn-orange"><i class="entypo-pencil"></i> Edit</button>
                                    <button class="btn btn-danger" onclick="deleteSetMenu(<?php echo $sm['sm_id']; ?>);"><i class="entypo-trash"></i> Delete</button>
                                </p>
                                <?php $count++; ?>
                            </div>
                        </div>
                        <?php
                        if($count%3 == 0){
                            echo "</div></div><br/><div class='row'><div class='col-sm-12 text-center'>";
                        }
                    endforeach;
                    ?>
                </div>
            </div>
        </div>

        <!-- Modal-->
        <div class="modal fade" id="modal-edit-setmenu">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title">Edit Set Menu Information</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <h4>Name:</h4>
                                        <input type="text" required="required" value="" name="edit_set_menu_name" id="edit_set_menu_name" class="form-control" />
                                    </div>
                                    <h4>Menu Items:</h4>
                                    <button onclick="additems()" class="btn btn-success">Add</button><br/><br/>
                                    <div id="foodItems" style="width: 100%">
                                        </div>
                                    <div class="form-group">
                                        <h4>Cost:</h4>
                                        <input type="number" required="required" value="" step="0.01" name="edit_set_menu_price" id="edit_set_menu_price" class="form-control" />
                                    </div>
                                    <input type="hidden" id="edit_set_menu_key" name="edit_set_menu_key"/>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="edit_set_menu_close" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-info" onclick="updateSetMenu();">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo SERVER ?>/assets/js/admin-setmenu.js"></script>
<!--SWAL-->
<link href="<?php echo SERVER; ?>/assets/css/sweetalert2.css" rel="stylesheet">
<script src="<?php echo SERVER; ?>/assets/js/sweetalert2.min.js"></script>

<script src="<?php echo SERVER ?>/assets/js/todos.js"></script>
<!--Dropify-->
<link rel="stylesheet" href="<?php echo SERVER; ?>/third_party/dropify/dropify.css" />

<script src="<?php echo SERVER; ?>/third_party/dropify/dropify.js"></script>
<script>
    $(document).ready(function(){
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop an image here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  '<i class="entypo-trash"></i>',
                'error':   'Sorry, this file is too large'
            }
        });
        var drEvent = $('.dropify').dropify();

        drEvent.on('dropify.beforeClear', function(event, element){
            return confirm("Do you really want to delete \"" + element.filename + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element){
            alert('File deleted');
        });
    });
</script>

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