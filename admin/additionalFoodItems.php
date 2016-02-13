<?php
/**
 * Created by PhpStorm.
 * User: Oyon
 * Date: 2/13/2016
 * Time: 1:52 PM
 */
session_start();
require '../controller/define.php';
require  '../controller/adminControl.php';
if(!isset($_SESSION['admin'])){
    header('Location: '.SERVER.'/404');
}else{
    $stage = getStage();
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
    <script>//$.noConflict();</script>

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
                <h1>Stage Decoration</h1>
                <br/><br/>
                <button class="btn btn-success" data-toggle="modal" data-target="#modal-stage-add"><i class="entypo-plus"></i> Add</button>
            </div>
        </div>

        <div class="modal fade" id="modal-stage-add">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title">Add Stage Decoration</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <form id="newStage" action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <h4>Name:</h4>
                                            <input type="text" required="required" name="add_stage_name" id="add_stage_name" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <h4>Cost:</h4>
                                            <input type="number" required="required" step="0.01" name="add_stage_price" id="add_stage_price" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <h4>Select an Image:</h4>
                                            <input type="file" accept="image/*" name="add_stage_image" id="add_stage_image" class="dropify" data-default-file="<?php echo DEFAULT__IMAGE ?>/Demo.png" />
                                        </div>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="add_stage_close" class="btn btn-default" onclick="dissmissAddModal();">Cancel</button>
                        <button type="submit" class="btn btn-info">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br/><br/>
        <div id="stage-content">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    $count = 0;
                    foreach($stage as $s): ?>
                        <div class="col-sm-3 text-center">
                            <div class="solid-border stages">
                                <div class="idffi h-180 zoom">
                                    <img src="<?php echo SERVER; ?>/assets/img/stage/<?php echo $s['st_image']; ?>" alt="<?php echo $s['st_title']; ?>"/>
                                </div>
                                <h3><?php echo $s['st_title']; ?></h3>
                                <p><span>Price: &#2547; <?php echo $s['st_price']; ?></span></p>
                                <p>
                                    <button onclick="showAjaxModal(<?php echo $s['st_id']; ?>);" class="btn btn-orange"><i class="entypo-pencil"></i> Edit</button>
                                    <button class="btn btn-danger" onclick="deleteStageDecoration(<?php echo $s['st_id']; ?>);"><i class="entypo-trash"></i> Delete</button>
                                </p>
                                <?php $count++; ?>
                            </div>
                        </div>
                        <?php
                        if($count%4 == 0){
                            echo "</div></div><br/><div class='row'><div class='col-sm-12 text-center'>";
                        }
                    endforeach;
                    ?>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function dissmissAddModal(){
                $('#add_stage_name').val('');
                $('#add_stage_price').val('');
                $('#modal-stage-add').modal('hide');
            }

            $(document).ready(function(){
                $('form#newStage').submit(function(e){
                    e.preventDefault();
                    var name = $('#add_stage_name').val();
                    var cost = $('#add_stage_price').val();
                    if(name == '' || cost == ''){
                        swal({
                            title: 'Error!',
                            text: 'Every Field must be filled !!',
                            type: 'error'
                        });
                    }else{
                        $.ajax({
                            type: 'POST',
                            url: "data/ajax-req-gate",
                            dataType: 'json',
                            data: new FormData(this),
                            contentType: false,
                            cache : false,
                            processData: false,
                            error: function() {
                                swal({
                                    title: 'Failed!',
                                    text: 'An error occured !!',
                                    type: 'error'
                                });
                            },
                            success : function(response){
                                var i;
                                var out ='';
                                var count =0;

                                for(i=0; i < response.length; ++i){
                                    out += '<div class="col-sm-3 text-center">' +
                                        '<div class="solid-border stages">' +
                                        '<div class="idffi h-180 zoom">' +
                                        '<img src="<?php echo SERVER; ?>/assets/img/stage/' + response[i].st_image + '" alt="' + response[i].st_title + '"/>' +
                                        '</div>' +
                                        '<h3>'+response[i].st_title+'</h3>' +
                                        '<p><span>Price: &#2547; ' + response[i].st_price + '</span></p>' +
                                        '<p>' +
                                        '<button onclick="showAjaxModal(' + response[i].st_id + ');" class="btn btn-orange"><i class="entypo-pencil"></i> Edit</button> ' +
                                        '<button class="btn btn-danger" onclick="deleteStageDecoration(' + response[i].st_id + ');"><i class="entypo-trash"></i> Delete</button>' +
                                        '</p>' +
                                        '</div>' +
                                        '</div>';
                                    count++;
                                    if(count%4 ==0){
                                        out += '</div></div><br/><div class="row"><div class="col-sm-12 text-center">';
                                    }
                                }
                                var ht = '<div class="row">' +
                                    '<div class="col-sm-12">' +
                                    out +
                                    '</div>' +
                                    '</div>';
                                $('#stage-content').html(ht);
                                swal({
                                    title: 'Successful!',
                                    text: 'A Stage Decoration has been added !!',
                                    type: 'success'
                                });
                                $('#add_stage_close').click();
                            }
                        });
                    }
                });
                $('form#editStage').submit(function(e){
                    e.preventDefault();
                    var stageName = $('#edit_stage_name').val();
                    var stageCost = $('#edit_stage_price').val();
                    if(stageName == '' || stageCost == ''){
                        swal({
                            title: 'Error!',
                            text: 'Every Field must be filled !!',
                            type: 'error'
                        });
                    }else {
                        $.ajax({
                            type: 'POST',
                            url: "data/ajax-req-gate",
                            dataType: 'json',
                            data: new FormData(this),
                            contentType: false,
                            cache : false,
                            processData: false,
                            error: function() {
                                swal({
                                    title: 'Failed!',
                                    text: 'An error occured !!',
                                    type: 'error'
                                });
                            },
                            success : function(response){
                                var i;
                                var out ='';
                                var count =0;

                                for(i=0; i < response.length; ++i){
                                    out += '<div class="col-sm-3 text-center">' +
                                        '<div class="solid-border stages">' +
                                        '<div class="idffi h-180 zoom">' +
                                        '<img src="<?php echo SERVER; ?>/assets/img/stage/' + response[i].st_image + '" alt="' + response[i].st_title + '"/>' +
                                        '</div>' +
                                        '<h3>'+response[i].st_title+'</h3>' +
                                        '<p><span>Price: &#2547; ' + response[i].st_price + '</span></p>' +
                                        '<p>' +
                                        '<button onclick="showAjaxModal(' + response[i].st_id + ');" class="btn btn-orange"><i class="entypo-pencil"></i> Edit</button> ' +
                                        '<button class="btn btn-danger" onclick="deleteStageDecoration(' + response[i].st_id + ');"><i class="entypo-trash"></i> Delete</button>' +
                                        '</p>' +
                                        '</div>' +
                                        '</div>';
                                    count++;
                                    if(count%4 ==0){
                                        out += '</div></div><br/><div class="row"><div class="col-sm-12 text-center">';
                                    }
                                }
                                var ht = '<div class="row">' +
                                    '<div class="col-sm-12">' +
                                    out +
                                    '</div>' +
                                    '</div>';
                                $('#stage-content').html(ht);
                                swal({
                                    title: 'Successful!',
                                    text: 'Welcome gate has been modified !!',
                                    type: 'success'
                                });
                                $('#edit_stage_close').click();
                            }
                        });
                    }
                });
            });

            function deleteStageDecoration(key){
                swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this !',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel !',
                    confirmButtonClass: 'confirm-class',
                    cancelButtonClass: 'cancel-class',
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'POST',
                            url: 'data/ajax-req-gate',
                            dataType: 'json',
                            data:{
                                stageKey : key
                            },
                            cache : false,
                            beforeSend: function(){
                                swal.disableButtons();
                            },
                            error: function() {
                                swal({
                                    title: 'Failed!',
                                    text: 'An error occured !!',
                                    type: 'error'
                                });
                            },

                            success : function(response){
                                var i;
                                var out ='';
                                var count =0;

                                for(i=0; i < response.length; ++i){
                                    out += '<div class="col-sm-3 text-center">' +
                                        '<div class="solid-border stages">' +
                                        '<div class="idffi h-180 zoom">' +
                                        '<img src="<?php echo SERVER; ?>/assets/img/stage/' + response[i].st_image + '" alt="' + response[i].st_title + '"/>' +
                                        '</div>' +
                                        '<h3>'+response[i].st_title+'</h3>' +
                                        '<p><span>Price: &#2547; ' + response[i].st_price + '</span></p>' +
                                        '<p>' +
                                        '<button onclick="showAjaxModal(' + response[i].st_id + ');" class="btn btn-orange"><i class="entypo-pencil"></i> Edit</button> ' +
                                        '<button class="btn btn-danger" onclick="deleteStageDecoration(' + response[i].st_id + ');"><i class="entypo-trash"></i> Delete</button>' +
                                        '</p>' +
                                        '</div>' +
                                        '</div>';
                                    count++;
                                    if(count%4 ==0){
                                        out += '</div></div><br/><div class="row"><div class="col-sm-12 text-center">';
                                    }
                                }
                                var ht = '<div class="row">' +
                                    '<div class="col-sm-12">' +
                                    out +
                                    '</div>' +
                                    '</div>';
                                $('#stage-content').html(ht);
                                swal(
                                    'Deleted!',
                                    'Stage Decoration has been deleted.',
                                    'success'
                                );
                            }
                        });
                    } else {
                        swal(
                            'Cancelled',
                            'Your data is safe :)',
                            'error'
                        );
                    }
                });
            }
            function showAjaxModal(id) {
                $('#modal-stage').modal('show', {
                    backdrop: 'static'
                });
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data:{
                        stageID : id
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
                        $('#edit_stage_name').val(response.Name);
                        $('#edit_stage_price').val(response.value);
                        $('#edit_stage_key').val(response.key);
                    }
                });
            }
        </script>

        <!-- Modal-->
        <div class="modal fade" id="modal-stage">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title">Edit Stage Information</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <form id="editStage" action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <h4>Name:</h4>
                                            <input type="text" required="required" value="" name="edit_stage_name" id="edit_stage_name" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <h4>Cost:</h4>
                                            <input type="number" required="required" value="" step="0.01" name="edit_stage_price" id="edit_stage_price" class="form-control" />
                                        </div>
                                        <input type="hidden" id="edit_stage_key" name="edit_stage_key"/>
                                        <div class="form-group">
                                            <h4>Select an Image:</h4>
                                            <input type="file" accept="image/*" value="" name="edit_stage_image" id="edit_stage_image" class="dropify" data-default-file="<?php echo DEFAULT__IMAGE ?>/Demo.png" />
                                        </div>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="edit_stage_close" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-info">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--SWAL-->
<link href="<?php echo SERVER; ?>/assets/css/sweetalert2.css" rel="stylesheet">
<script src="<?php echo SERVER; ?>/assets/js/sweetalert2.min.js"></script>

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