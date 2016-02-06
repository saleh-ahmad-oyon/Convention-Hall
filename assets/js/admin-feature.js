$('.tableRow').each(function (i) {
    $("td:first", this).html(i + 1);
});
function deleteFeature(x){
    var row = $(x).closest("tr").index() + 1;
    var id = $(x).closest("tr").find("td.FeaID").text();
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
                        featureID : id
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
                    success : function(){
                        swal({
                            title : 'Deleted!',
                            text : 'Row has been deleted.',
                            type : 'success'
                        });
                    },
                    complete: function(){
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
        '<td class="FeaID hide-block"></td>' +
        '<td class="editDesc"> <input type="text" class="editDescription" style="width: 100%"></td>' +
        '<td class="text-center">' +
        '<button type="button" class="btn btn-info btn-sm btn-icon icon-left addBtn" onclick="addData(this);"><i class="entypo-plus"></i>Add</button>' +
        '<button type="button" class="btn btn-default btn-sm btn-icon icon-left featureEditBtn hide-block" onclick="editFeature(this)"> <i class="entypo-pencil"></i>Edit</button>&nbsp;&nbsp;&nbsp;' +
        '<button type="button" class="btn btn-orange btn-sm btn-icon icon-left featureUpdateBtn hide-block" onclick="updateFeature(this)"><i class="entypo-upload"></i>Update </button>' +
        '<button class="btn btn-danger btn-sm btn-icon icon-left dltFeatureBtn hide-block" onclick="deleteFeature(this)"><i class="entypo-cancel"></i>Delete </button>' +
        '</td>' +
        '</tr>'
    );
}
function addData(x){
    var addFeature = $(x).closest("tr").find("input.editDescription").val();
    var id = $(x).closest("tr").find("td.FeaID");
    var fea = $(x).closest("tr").find("td.desc");
    var EF = $(x).closest("tr").find("td.editDesc");
    var dlt = $(x).closest("tr").find("button.dltFeatureBtn");
    var edit = $(x).closest("tr").find("button.featureEditBtn");
    if(addFeature == ''){
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
                addNewFeature : addFeature
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
                id.html(
                    data
                );
                EF.hide();
                fea.html(
                    addFeature
                );
                fea.show();
                dlt.show();
                edit.show();
            }
        });
    }
}
function editFeature(x){
    $(x).hide();
    $(x).closest("tr").find("button.dltFeatureBtn").hide();
    $(x).closest("tr").find("button.featureUpdateBtn").show();
    $(x).closest("tr").find("td.desc").hide();
    $(x).closest("tr").find("td.editDesc").show();
}
function updateFeature(x){
    var feature = $(x).closest("tr").find("input.editDescription").val();
    var id = $(x).closest("tr").find("td.FeaID").text();
    var dlt = $(x).closest("tr").find("button.dltFeatureBtn");
    var upd = $(x).closest("tr").find("button.featureUpdateBtn");
    var edit = $(x).closest("tr").find("button.featureEditBtn");
    var fh = $(x).closest("tr").find("td.desc");
    var editFT = $(x).closest("tr").find("td.editDesc");


    if(feature == ''){
        alert('Field is empty !!');
    }else{
        $.ajax({
            type: 'POST',
            url: baseurl + 'miscellaneousControl',
            data:{
                updFeature : feature,
                featureID : id
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

                fh.html(
                    feature
                );
                fh.show();
                editFT.hide();
            }
        });
    }
}