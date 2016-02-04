$('.tableRow').each(function (i) {
    $("td:first", this).html(i + 1);
});
function deleteAdvantage(x){
    var row = $(x).closest("tr").index() + 1;
    var AID = $(x).closest("tr").find("td.advID").text();
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
                        advID : AID
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
        '<td class="desc hide-block"></td>' +
        '<td class="advID hide-block"></td>' +
        '<td class="editDesc"> <input type="text" class="editDescription" style="width: 100%"></td>' +
        '<td class="text-center">' +
        '<button type="button" class="btn btn-info btn-sm btn-icon icon-left addBtn" onclick="addData(this);"><i class="entypo-plus"></i>Add</button>' +
        '<button type="button" class="btn btn-default btn-sm btn-icon icon-left advantageEditBtn hide-block" onclick="editAdvantage(this);"> <i class="entypo-pencil"></i>Edit</button>&nbsp;&nbsp;&nbsp;' +
        '<button type="button" class="btn btn-orange btn-sm btn-icon icon-left advantageUpdateBtn hide-block" onclick="updateAdvantage(this);"><i class="entypo-upload"></i>Update </button>' +
        '<button class="btn btn-danger btn-sm btn-icon icon-left dltAdvantageBtn hide-block" onclick="deleteAdvantage(this);"><i class="entypo-cancel"></i>Delete</button>' +
        '</td>' +
        '</tr>'
    );
}
function addData(x){
    var addAdvantage = $(x).closest("tr").find("input.editDescription").val();
    var id = $(x).closest("tr").find("td.advID");
    var adv = $(x).closest("tr").find("td.desc");
    var EA = $(x).closest("tr").find("td.editDesc");
    var dlt = $(x).closest("tr").find("button.dltAdvantageBtn");
    var edit = $(x).closest("tr").find("button.advantageEditBtn");
    if(addAdvantage == ''){
        swal({
            title: 'Error!',
            text: 'Field is empty !!',
            type: 'error'
        });
    }else{
        $.ajax({
            type: 'POST',
            url: baseurl + 'miscellaneousControl',
            dataType: 'json',
            data:{
                addNewAdvantage : addAdvantage
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
                $(x).hide();
                id.html(
                    response.advKey
                );
                EA.hide();
                adv.html(
                    addAdvantage
                );
                adv.show();
                dlt.show();
                edit.show();
            }
        });
    }
}
function editAdvantage(x){
    $(x).hide();
    $(x).closest("tr").find("button.dltAdvantageBtn").hide();
    $(x).closest("tr").find("button.advantageUpdateBtn").show();
    $(x).closest("tr").find("td.desc").hide();
    $(x).closest("tr").find("td.editDesc").show();
}
function updateAdvantage(x){
    var advantage = $(x).closest("tr").find("input.editDescription").val();
    var id = $(x).closest("tr").find("td.advID").text();
    var dlt = $(x).closest("tr").find("button.dltAdvantageBtn");
    var upd = $(x).closest("tr").find("button.advantageUpdateBtn");
    var edit = $(x).closest("tr").find("button.advantageEditBtn");
    var ad = $(x).closest("tr").find("td.desc");
    var editAD = $(x).closest("tr").find("td.editDesc");

    if(advantage == ''){
        swal({
            title: 'Error!',
            text: 'Field is empty !!',
            type: 'error'
        });
    }else{
        $.ajax({
            type: 'POST',
            url: baseurl + 'miscellaneousControl',
            data:{
                updAdvantage : advantage,
                advantageID : id
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
                dlt.show();
                upd.hide();
                edit.show();

                ad.html(
                    advantage
                );
                ad.show();
                editAD.hide();
            }
        });
    }
}