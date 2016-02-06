$(document).ready(function() {
    $("#editVat").click(function () {
        $(this).hide();
        $("#vat").hide();
        $("#updateVat").show();
        $("#vatUp").show();
    });
    $("#editCost").click(function () {
        $(this).hide();
        $("#cost").hide();
        $("#updateCost").show();
        $("#upInputCost").show();
    });
    $('#updateVat').click(function(){
        var vat = $('#updVat').val();
        if(vat == ''){
        alert("Vat field is empty !!");
        }else{
            $.ajax({
                type: 'POST',
                url: baseurl + 'miscellaneousControl',
                data: {
                updatedVat : $('#updVat').val()
                },
                cache: false,
                error: function() {
                    swal({
                        title: 'Failed!',
                        text: 'An error occured !!',
                        type: 'error'
                    });
                },
                success: function()
                {
                    $('#vat').html(
                    $('#updVat').val()
                    );
                    $('#editVat').show();
                    $("#vat").show();
                    $("#updateVat").hide();
                    $("#vatUp").hide();
                }
            });
        }
    });
    $('#updateCost').click(function(){
        var cost = $('#updCost').val();
        if(cost == ''){
        alert("Extra cost field is empty !!");
        }else{
            $.ajax({
                type: 'POST',
                url: baseurl + 'miscellaneousControl',
                data: {
                    updateCost : $('#updCost').val()
                },
                cache: false,
                error: function() {
                    swal({
                        title: 'Failed!',
                        text: 'An error occured !!',
                        type: 'error'
                    });
                },
                success: function()
                {
                    $('#cost').html(
                    '&#2547;&nbsp;' + parseFloat(cost).toFixed(2)
                    );
                    $('#cost').show();
                    $("#editCost").show();
                    $("#upInputCost").hide();
                    $("#updateCost").hide();
                }
            });
        }
    });
});