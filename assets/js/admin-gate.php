<?php
/**
 * Created by PhpStorm.
 * User: Oyon
 * Date: 2/16/2016
 * Time: 8:51 PM
 */
header("Content-type: application/javascript");
require_once '../../controller/define.php';
?>
function dissmissAddModal(){
$('#add_name').val('');
$('#add_price').val('');
$('#modal-gate-add').modal('hide');
}

$(document).ready(function(){
$('form#newGate').submit(function(e){
e.preventDefault();
var name = $('#add_name').val();
var cost = $('#add_price').val();
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
    '<div class="solid-border gates">' +
        '<div class="idffi h-180 zoom">' +
            '<img src="<?php echo SERVER; ?>/assets/img/gate/' + response[i].g_image + '" alt="' + response[i].g_title + '"/>' +
            '</div>' +
        '<h3>'+response[i].g_title+'</h3>' +
        '<p><span>Price: &#2547; ' + response[i].g_price + '</span></p>' +
        '<p>' +
            '<button onclick="showAjaxModal(' + response[i].g_id + ');" class="btn btn-orange"><i class="entypo-pencil"></i> Edit</button> ' +
            '<button class="btn btn-danger" onclick="deleteWelcomeGate(' + response[i].g_id + ');"><i class="entypo-trash"></i> Delete</button>' +
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
        $('#gate-content').html(ht);
        swal({
        title: 'Successful!',
        text: 'A welcome gate has been added !!',
        type: 'success'
        });
        $('#add_close').click();
        }
        });
        }
        });
        $('form#editGate').submit(function(e){
        e.preventDefault();
        var name = $('#edit_name').val();
        var cost = $('#edit_price').val();
        if(name == '' || cost == ''){
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
            '<div class="solid-border gates">' +
                '<div class="idffi h-180 zoom">' +
                    '<img src="<?php echo SERVER; ?>/assets/img/gate/' + response[i].g_image + '" alt="' + response[i].g_title + '"/>' +
                    '</div>' +
                '<h3>'+response[i].g_title+'</h3>' +
                '<p><span>Price: &#2547; ' + response[i].g_price + '</span></p>' +
                '<p>' +
                    '<button onclick="showAjaxModal(' + response[i].g_id + ');" class="btn btn-orange"><i class="entypo-pencil"></i> Edit</button> ' +
                    '<button class="btn btn-danger" onclick="deleteWelcomeGate(' + response[i].g_id + ');"><i class="entypo-trash"></i> Delete</button>' +
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
        $('#gate-content').html(ht);
        swal({
        title: 'Successful!',
        text: 'Welcome gate has been modified !!',
        type: 'success'
        });
        $('#edit_close').click();
        }
        });
        }
        });
        });

        function deleteWelcomeGate(key){
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
        gateKey : key
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
            '<div class="solid-border gates">' +
                '<div class="idffi h-180 zoom">' +
                    '<img src="<?php echo SERVER; ?>/assets/img/gate/' + response[i].g_image + '" alt="' + response[i].g_title + '"/>' +
                    '</div>' +
                '<h3>'+response[i].g_title+'</h3>' +
                '<p><span>Price: &#2547; ' + response[i].g_price + '</span></p>' +
                '<p>' +
                    '<button onclick="showAjaxModal(' + response[i].g_id + ');" class="btn btn-orange"><i class="entypo-pencil"></i> Edit</button> ' +
                    '<button class="btn btn-danger" onclick="deleteWelcomeGate(' + response[i].g_id + ');"><i class="entypo-trash"></i> Delete</button>' +
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
        $('#gate-content').html(ht);
        swal(
        'Deleted!',
        'Welcome Gate has been deleted.',
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
        $('#modal-gate').modal('show', {
        backdrop: 'static'
        });
        $.ajax({
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
        $('#edit_name').val(response.Name);
        $('#edit_price').val(response.value);
        $('#edit_key').val(response.key);
        }
        });
        }
