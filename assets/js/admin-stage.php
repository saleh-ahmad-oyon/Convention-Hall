<?php
/**
 * Created by PhpStorm.
 * User: Oyon
 * Date: 2/16/2016
 * Time: 8:47 PM
 */
header("Content-type: application/javascript");
require_once '../../controller/define.php';
?>

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
