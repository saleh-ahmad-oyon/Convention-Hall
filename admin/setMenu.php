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
    <link rel="stylesheet" href="<?php echo SERVER ?>/assets/css/todos.css" />
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

        <script type="text/javascript">
            function dissmissAddModal(){
                $('#add_setmenu_name').val('');
                $('#new-todo').val('');
                $('#todo-list').html('');
                $('#add_setmenu_price').val('');
                $('#modal-setmenu-add').modal('hide');
            }

            function addNewSetMenu()
            {
                var name = $('#add_setmenu_name').val();
                var cost = $('#add_setmenu_price').val();

                var dataList = $("#todo-list li label").map(function() {
                    return $(this).html();
                }).get();

                var menuItems = dataList.join('|');

                if(name == '' || cost == '' || menuItems== ''){
                    swal({
                        title: 'Error!',
                        text: 'Every Field must be filled !!',
                        type: 'error'
                    });
                }else{
                    $.ajax({
                        type: 'POST',
                        url: "data/ajax-req-food",
                        dataType: 'json',
                        data: {
                            newSetMenuTitle : name,
                            newSetMenuItems : menuItems,
                            newSetMenuCost  : cost
                        },
                        cache : false,
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
                            var item = '';
                            var j;

                             for(i=0; i < response.length; ++i){

                             out += '<div class="col-xs-4 text-center">' +
                             '<div class="col-xs-12 set-menu">' +
                             '<h3>'+response[i].sm_title+'</h3>';
                                 item = response[i].sm_description.split("|");
                                 for(j=0; j<item.length; ++j){
                                     out +='<p>' + item[j] + '</p>';
                                 }
                             out += '<p>Price: &#2547; ' + response[i].sm_price + '</p>' +
                             '<p>' +
                             '<button onclick="showAjaxModal(' + response[i].sm_id + ');" class="btn btn-orange"><i class="entypo-pencil"></i> Edit</button> ' +
                             '<button class="btn btn-danger" onclick="deleteSetMenu(' + response[i].sm_id + ');"><i class="entypo-trash"></i> Delete</button>' +
                             '</p>' +
                             '</div>' +
                             '</div>';
                             count++;
                             if(count%3 ==0){
                             out += '</div></div><br/><div class="row"><div class="col-sm-12 text-center">';
                             }
                             }
                             var ht = '<div class="row">' +
                             '<div class="col-sm-12">' +
                             out +
                             '</div>' +
                             '</div>';
                             $('#setmenu-content').html(ht);
                             swal({
                                 title: 'Successful!',
                                 text: 'A Set Menu has been added !!',
                                 type: 'success'
                             });
                             $('#add_setmenu_close').click();
                        }
                    });
                }
            }

            function deleteSetMenu(key){
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
                            url: 'data/ajax-req-food',
                            dataType: 'json',
                            data:{
                                setMenuKey : key
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
                                var item = '';
                                var j;

                                for(i=0; i < response.length; ++i){

                                    out += '<div class="col-xs-4 text-center">' +
                                        '<div class="col-xs-12 set-menu">' +
                                        '<h3>'+response[i].sm_title+'</h3>';
                                    item = response[i].sm_description.split("|");
                                    for(j=0; j<item.length; ++j){
                                        out +='<p>' + item[j] + '</p>';
                                    }
                                    out += '<p>Price: &#2547; ' + response[i].sm_price + '</p>' +
                                        '<p>' +
                                        '<button onclick="showAjaxModal(' + response[i].sm_id + ');" class="btn btn-orange"><i class="entypo-pencil"></i> Edit</button> ' +
                                        '<button class="btn btn-danger" onclick="deleteSetMenu(' + response[i].sm_id + ');"><i class="entypo-trash"></i> Delete</button>' +
                                        '</p>' +
                                        '</div>' +
                                        '</div>';
                                    count++;
                                    if(count%3 ==0){
                                        out += '</div></div><br/><div class="row"><div class="col-sm-12 text-center">';
                                    }
                                }
                                var ht = '<div class="row">' +
                                    '<div class="col-sm-12">' +
                                    out +
                                    '</div>' +
                                    '</div>';
                                $('#setmenu-content').html(ht);
                                swal(
                                    'Deleted!',
                                    'Set Menu has been deleted.',
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
                $('#modal-edit-setmenu').modal('show', {
                    backdrop: 'static'
                });
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data:{
                        setItemsID : id
                    },
                    cache : false,
                    url: "data/ajax-req-food",
                    error: function() {
                        swal({
                            title: 'Failed!',
                            text: 'An error occured !!',
                            type: 'error'
                        });
                    },
                    success: function(response)
                    {
                        var j ;
                        var out = '';
                        menu = response.items.split("|");
                        for(j=0; j<menu.length; ++j){
                            out += '<div class="items">' +
                                '<input type="text" class="form-control" value="' +menu[j]+ '" style="width: 86%;display: inline" />' +
                                '<button class="btn btn-danger pull-right" onclick="deleteItems(this);" style="width: 13%"><i class="entypo-trash"></i></button><br/><br/>' +
                                    '</div>';
                        }
                        $('#edit_set_menu_name').val(response.Name);
                        $('#edit_set_menu_price').val(response.value);
                        $('#edit_set_menu_key').val(response.key);
                        $('#foodItems').html(out);
                    }
                });
            }
            function deleteItems(x) {
                $currentListItem = $(x).closest('.items');
                $currentListItem.html('');
                $currentListItem.remove();
            }
            function additems(){
                var items = $('#foodItems').html();
                items += '<div class="items">' +
                    '<input type="text" class="form-control" style="width: 86%;display: inline" />' +
                    '<button class="btn btn-danger pull-right" onclick="deleteItems(this);" style="width: 13%"><i class="entypo-trash"></i></button><br/><br/>' +
                    '</div>';
                $('#foodItems').html(items);
            }
            
            function updateSetMenu() {
                 var name = $('#edit_set_menu_name').val();
                 var cost = $('#edit_set_menu_price').val();
                var key = $('#edit_set_menu_key').val();

                var dataList = $("#foodItems input").map(function() {
                    if($(this).val() != '')
                        return $(this).val();
                }).get();

                var editedItems =  dataList.join('|');
                console.log(editedItems);

                 if(name == '' || cost == '' || key == '' || editedItems == ''){
                 swal({
                     title: 'Error!',
                     text: 'Every Field must be filled !!',
                     type: 'error'
                 });
                 }else {
                     $.ajax({
                         type: 'POST',
                         url: "data/ajax-req-food",
                         dataType: 'json',
                         data: {
                             setMenuEditedName : name,
                             setMenuEditedCost : cost,
                             setMenuEditedKey : key,
                             setMenuItems : editedItems

                         },
                         cache : false,
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
                             var item = '';
                             var j;

                             for(i=0; i < response.length; ++i){

                                 out += '<div class="col-xs-4 text-center">' +
                                     '<div class="col-xs-12 set-menu">' +
                                     '<h3>'+response[i].sm_title+'</h3>';
                                 item = response[i].sm_description.split("|");
                                 for(j=0; j<item.length; ++j){
                                     out +='<p>' + item[j] + '</p>';
                                 }
                                 out += '<p>Price: &#2547; ' + response[i].sm_price + '</p>' +
                                     '<p>' +
                                     '<button onclick="showAjaxModal(' + response[i].sm_id + ');" class="btn btn-orange"><i class="entypo-pencil"></i> Edit</button> ' +
                                     '<button class="btn btn-danger" onclick="deleteSetMenu(' + response[i].sm_id + ');"><i class="entypo-trash"></i> Delete</button>' +
                                     '</p>' +
                                     '</div>' +
                                     '</div>';
                                 count++;
                                 if(count%3 ==0){
                                     out += '</div></div><br/><div class="row"><div class="col-sm-12 text-center">';
                                 }
                             }
                             var ht = '<div class="row">' +
                                 '<div class="col-sm-12">' +
                                 out +
                                 '</div>' +
                                 '</div>';
                             $('#setmenu-content').html(ht);
                             swal({
                                 title: 'Successful!',
                                 text: 'Welcome gate has been modified !!',
                                 type: 'success'
                             });
                             $('#edit_set_menu_close').click();
                         }
                     });
                 }
            }
        </script>

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