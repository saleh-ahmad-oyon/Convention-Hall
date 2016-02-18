/**
 * Created by Oyon on 2/18/2016.
 */
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
                    text: 'Set Menu has been modified !!',
                    type: 'success'
                });
                $('#edit_set_menu_close').click();
            }
        });
    }
}