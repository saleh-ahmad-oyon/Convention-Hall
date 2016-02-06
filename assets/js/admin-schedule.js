function dltSchedule(x){
    var row = $(x).closest("tr").index() + 1;
    var id = $(x).closest("tr").find("td.labID").text();
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
                        scheduleID : id
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
                    success : function(data){
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
        '<td class="shift hide-block"></td>' +
        '<td class="editShift"><input type="text" class="inpShift" style="width: 100%;" /></td>' +
        '<td class="time hide-block"></td>' +
        '<td class="labID hide-block"></td>' +
        '<td class="editTime"><input type="text" class="inpTime" style="width: 100%;" /></td>' +
        '<td class="text-center">' +
        '<button type="button" class="btn btn-info btn-sm btn-icon icon-left addBtn" onclick="addData(this);"><i class="entypo-plus"></i>Add</button>' +
        '<button type="button" class="btn btn-orange btn-sm btn-icon icon-left scheduleUpdateBtn hide-block" onclick="updateSchedule(this)"> <i class="entypo-upload"></i>Update</button>' +
        '<button type="button" class="btn btn-default btn-sm btn-icon icon-left scheduleEditBtn hide-block" onclick="editSchedule(this)"><i class="entypo-pencil"></i>Edit</button>&nbsp;&nbsp;&nbsp;' +
        '<button class="btn btn-danger btn-sm btn-icon icon-left dltScheduleBtn hide-block"  onclick="dltSchedule(this);"><i class="entypo-cancel"></i>Delete </button>' +
        '</td>' +
        '</tr>'
    );
}
function addData(x){
    var addShift = $(x).closest("tr").find("input.inpShift").val();
    var addTime = $(x).closest("tr").find("input.inpTime").val();
    var id = $(x).closest("tr").find("td.labID");
    var sh = $(x).closest("tr").find("td.shift");
    var tm = $(x).closest("tr").find("td.time");
    var ES = $(x).closest("tr").find("td.editShift");
    var ET = $(x).closest("tr").find("td.editTime");
    var dlt = $(x).closest("tr").find("button.dltScheduleBtn");
    var edit = $(x).closest("tr").find("button.scheduleEditBtn");
    if(addShift == '' || addTime == ''){
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
                addNewShift : addShift,
                addNewTime : addTime
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
                    addShift
                );
                sh.show();
                tm.html(
                    addTime
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
function editSchedule(x) {
    $(x).hide();
    $(x).closest("tr").find("button.dltScheduleBtn").hide();
    $(x).closest("tr").find("button.scheduleUpdateBtn").show();
    $(x).closest("tr").find("td.shift").hide();
    $(x).closest("tr").find("td.editShift").show();
    $(x).closest("tr").find("td.time").hide();
    $(x).closest("tr").find("td.editTime").show();
}
function updateSchedule(x){
    var Shift = $(x).closest("tr").find("input.inpShift").val();
    var id = $(x).closest("tr").find("td.labID").text();
    var time = $(x).closest("tr").find("input.inpTime").val();
    var dlt = $(x).closest("tr").find("button.dltScheduleBtn");
    var upd = $(x).closest("tr").find("button.scheduleUpdateBtn");
    var edit = $(x).closest("tr").find("button.scheduleEditBtn");
    var sh = $(x).closest("tr").find("td.shift");
    var editSH = $(x).closest("tr").find("td.editShift");
    var tm = $(x).closest("tr").find("td.time");
    var edtTM = $(x).closest("tr").find("td.editTime");
    if(Shift == '' || time == ''){
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
                updShift : Shift,
                updTime : time,
                ID : id
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
                sh.html(
                    Shift
                );
                sh.show();
                editSH.hide();
                tm.html(
                    time
                );
                tm.show();
                edtTM.hide();
            }
        });
    }
}