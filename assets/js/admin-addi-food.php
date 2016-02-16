/**
 * Created by Oyon on 2/16/2016.
 */
<?php
    header("Content-type: application/javascript");
    require_once '../../controller/define.php';
?>
function dissmissAddModal(){
    $('#add_addi_food_name').val('');
    $('#add_addi_food_price').val('');
    $('#add_addi_food_keys').val('');
    $('#modal-addifood-add').modal('hide');
}

$(document).ready(function(){
    $('form#newAddiFood').submit(function(e){
        e.preventDefault();
        var name = $('#add_addi_food_name').val();
        var cost = $('#add_addi_food_price').val();
        var keys = $('#add_addi_food_keys').val();
        if(name == '' || cost == '' || keys == ''){
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
                            '<div class="solid-border addiFood">' +
                            '<div class="idffi h-180 zoom">' +
                            '<img src="<?php echo SERVER; ?>/assets/img/food/' + response[i].am_image + '" alt="' + response[i].am_title + '"/>' +
                            '</div>' +
                            '<h3>'+response[i].am_title+'</h3>' +
                            '<p><span>Price: &#2547; ' + response[i].am_price + '</span></p>' +
                            '<p>' +
                            '<button onclick="showAjaxModal(' + response[i].am_id + ');" class="btn btn-orange"><i class="entypo-pencil"></i> Edit</button> ' +
                            '<button class="btn btn-danger" onclick="deleteAdditionalFood(' + response[i].am_id + ');"><i class="entypo-trash"></i> Delete</button>' +
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
                    $('#addifood-content').html(ht);
                    swal({
                        title: 'Successful!',
                        text: 'An additional food has been added !!',
                        type: 'success'
                    });
                    $('#add_addi_food_close').click();
                }
            });
        }
    });
    $('form#editAddiFood').submit(function(e){
        e.preventDefault();
        var Name = $('#edit_addi_food_name').val();
        var Cost = $('#edit_addi_food_price').val();
        var Keywords = $('#edit_addi_food_keywords').val();
        if(Name == '' || Cost == '' || Keywords == ''){
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
                            '<div class="solid-border addiFood">' +
                            '<div class="idffi h-180 zoom">' +
                            '<img src="<?php echo SERVER; ?>/assets/img/food/' + response[i].am_image + '" alt="' + response[i].am_title + '"/>' +
                            '</div>' +
                            '<h3>'+response[i].am_title+'</h3>' +
                            '<p><span>Price: &#2547; ' + response[i].am_price + '</span></p>' +
                            '<p>' +
                            '<button onclick="showAjaxModal(' + response[i].am_id + ');" class="btn btn-orange"><i class="entypo-pencil"></i> Edit</button> ' +
                            '<button class="btn btn-danger" onclick="deleteAdditionalFood(' + response[i].am_id + ');"><i class="entypo-trash"></i> Delete</button>' +
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
                    $('#addifood-content').html(ht);
                    swal({
                        title: 'Successful!',
                        text: 'Additional Food item has been modified !!',
                        type: 'success'
                    });
                    $('#edit_addi_food_close').click();
                }
            });
        }
    });
});

function deleteAdditionalFood(key){
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
                    addiFoodKey : key
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
                            '<div class="solid-border addiFood">' +
                            '<div class="idffi h-180 zoom">' +
                            '<img src="<?php echo SERVER; ?>/assets/img/food/' + response[i].am_image + '" alt="' + response[i].am_title + '"/>' +
                            '</div>' +
                            '<h3>'+response[i].am_title+'</h3>' +
                            '<p><span>Price: &#2547; ' + response[i].am_price + '</span></p>' +
                            '<p>' +
                            '<button onclick="showAjaxModal(' + response[i].am_id + ');" class="btn btn-orange"><i class="entypo-pencil"></i> Edit</button> ' +
                            '<button class="btn btn-danger" onclick="deleteAdditionalFood(' + response[i].am_id + ');"><i class="entypo-trash"></i> Delete</button>' +
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
                    $('#addifood-content').html(ht);
                    swal(
                        'Deleted!',
                        'Additional Food has been deleted.',
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
    $('#modal-addi-food').modal('show', {
        backdrop: 'static'
    });
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data:{
            addiFoodID : id
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
            $('#edit_addi_food_name').val(response.am_title);
            $('#edit_addi_food_price').val(response.am_price);
            $('#edit_addi_food_keywords').val(response.keywords);
            $('#edit_addi_food_key').val(response.am_id);
        }
    });
}
