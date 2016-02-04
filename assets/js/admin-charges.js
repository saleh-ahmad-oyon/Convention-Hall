
$('.tableRow').each(function (i) {
    $("td:first", this).html(i + 1);
});
function dltService(x){
    var row = $(x).closest("tr").index() + 1;
    var id = $(x).closest("tr").find("td.servID").text();
    swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this row',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            confirmButtonClass: 'confirm-class',
            cancelButtonClass: 'cancel-class',
            closeOnConfirm: false,
            closeOnCancel: false },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: 'POST',
                    url: baseurl + 'miscellaneousControl',
                    data:{
                        ServId : id
                    },
                    cache : false,
                    error: function() {
                        swal({
                            title: 'Failed!',
                            text: 'An error occured !!',
                            type: 'error'
                        });
                    },
                    success : function(){
                        swal({
                            title : 'Deleted!',
                            text : 'Row has been deleted.',
                            type : 'success'
                        });
                        document.getElementById("myTable").deleteRow(row);
                    }
                });
            } else {
                swal(
                    'Cancelled',
                    'Your row is safe :)',
                    'error'
                );
            }
        });
}
function addRow(){
    $('#myTable tr:last').after(
        '<tr>' +
        '<td>' + parseInt($("#myTable tr:last").index() + 2) +'</td>' +
        '<td class="service hide-block"></td>' +
        '<td class="editService"><input type="text" class="inpService" style="width: 100%;" /></td>' +
        '<td class="price text-right hide-block"></td>' +
        '<td class="servID hide-block"></td>' +
        '<td class="editPrice"><input type="number" step="0.50" min="0" class="inpPrice" style="width: 100%;" /></td>' +
        '<td class="text-center">' +
        '<button type="button" class="btn btn-info btn-sm btn-icon icon-left addBtn" onclick="addData(this);"><i class="entypo-plus"></i>Add</button>' +
        '<button type="button" class="btn btn-orange btn-sm btn-icon icon-left serviceUpdateBtn hide-block" onclick="updateService(this)"> <i class="entypo-upload"></i>Update</button>' +
        '<button type="button" class="btn btn-default btn-sm btn-icon icon-left serviceEditBtn hide-block" onclick="editService(this)"><i class="entypo-pencil"></i>Edit</button>&nbsp;&nbsp;&nbsp;' +
        '<button class="btn btn-danger btn-sm btn-icon icon-left dltServiceBtn hide-block" onclick="dltService(this);"><i class="entypo-cancel"></i>Delete </button>' +
        '</td>' +
        '</tr>'
    );
}
function addData(x){
    var addService = $(x).closest("tr").find("input.inpService").val();
    var addPrice = $(x).closest("tr").find("input.inpPrice").val();
    var id = $(x).closest("tr").find("td.servID");
    var sh = $(x).closest("tr").find("td.service");
    var tm = $(x).closest("tr").find("td.price");
    var ES = $(x).closest("tr").find("td.editService");
    var ET = $(x).closest("tr").find("td.editPrice");
    var dlt = $(x).closest("tr").find("button.dltServiceBtn");
    var edit = $(x).closest("tr").find("button.serviceEditBtn");
    if(addService == '' || addPrice == ''){
        swal({
            title: 'Error!',
            text: 'You have to fill both fields !!',
            type: 'error'
        });
    }else{
        $.ajax({
            type: 'POST',
            url: baseurl + 'miscellaneousControl',
            data:{
                addNewService : addService,
                addNewPrice : addPrice
            },
            cache : false,
            error: function() {
                swal({
                    title: 'Failed!',
                    text: 'An error occured !!',
                    type: 'error'
                });
            },
            success : function(data){
                $(x).hide();
                dlt.show();
                edit.show();
                sh.html(
                    addService
                );
                sh.show();
                tm.html(
                    '&#2547;&nbsp;' + parseFloat(addPrice).toFixed(2)
                );
                id.html(
                    data
                );
                tm.show();
                ES.hide();
                ET.hide();
            }
        });
    }
}
function editService(x) {
    $(x).hide();
    $(x).closest("tr").find("button.dltServiceBtn").hide();
    $(x).closest("tr").find("button.serviceUpdateBtn").show();
    $(x).closest("tr").find("td.service").hide();
    $(x).closest("tr").find("td.editService").show();
    $(x).closest("tr").find("td.price").hide();
    $(x).closest("tr").find("td.editPrice").show();
}
function updateService(x){
    var Serv = $(x).closest("tr").find("input.inpService").val();
    var sid = $(x).closest("tr").find("td.servID").text();
    var Price = $(x).closest("tr").find("input.inpPrice").val();
    var dlt = $(x).closest("tr").find("button.dltServiceBtn");
    var edit = $(x).closest("tr").find("button.serviceEditBtn");
    var SR = $(x).closest("tr").find("td.service");
    var editSR = $(x).closest("tr").find("td.editService");
    var PR = $(x).closest("tr").find("td.price");
    var edtPR = $(x).closest("tr").find("td.editPrice");
    if(Serv == '' || Price == ''){
        swal({
            title: 'Error!',
            text: 'You have to fill both fields !!',
            type: 'error'
        });
    }else{
        $.ajax({
            type: 'POST',
            url: baseurl + 'miscellaneousControl',
            data:{
                updService : Serv,
                updPrice : Price,
                serviceID : sid
            },
            cache : false,
            error: function() {
                swal({
                    title: 'Failed!',
                    text: 'An error occured !!',
                    type: 'error'
                });
            },
            success : function(){
                $(x).hide();
                dlt.show();
                edit.show();
                SR.html(
                    Serv
                );
                SR.show();
                editSR.hide();
                PR.html(
                    '&#2547;&nbsp;' + parseFloat(Price).toFixed(2)
                );
                PR.show();
                edtPR.hide();
            }
        });
    }
}