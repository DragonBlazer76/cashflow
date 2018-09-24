$(function() {

    $(document).ready(function(){
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/getuserfirsttime', // the url where we want to POST
            data        : null, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
            // using the callback
            .done(function(data) { 
                // errors and validation messages
                if (!data.success) {
                    if (data.errors.desc) {
                        window.location.href = 'dashboard';
                    }
                    

                } else {
                    if (data.first_time == 1) {
                        $("#firsttimeModal").modal({backdrop: false});
                        $("#supplier_id").val(data.supplier_id);
                        $("#supplier_country_code").val(data.supp_country_code);
                        $("#supplier_name").val(data.supplier_name);
                        $("#supplier_addr1").val(data.supplier_addr1);
                        $("#supplier_addr2").val(data.supplier_addr2);
                        $("#supplier_state").val(data.supplier_state);
                        $("#supplier_postal").val(data.supplier_postal);
                        $("#supplier_email").val(data.supplier_email);
                        $("#supplier_phone1").val(data.supplier_phone1);
                        $("#supplier_phone2").val(data.supplier_phone2);
                        $("#supplier_credit_terms").val(data.credit_terms);
                    }
                }
            });
    });
    
    $('#btnOkMdl').click(function(event) {
        
        var formData = {
            'supplier_id'           : $('input[name=supplier_id]').val(),
            'supplier_name'         : $('input[name=supplier_name]').val(),
            'supplier_addr1'        : $('input[name=supplier_addr1]').val(),
            'supplier_addr2'        : $('input[name=supplier_addr2]').val(),
            'supplier_state'        : $('input[name=supplier_state]').val(),
            'supplier_postal'       : $('input[name=supplier_postal]').val(),
            //'supplier_email'        : $('input[name=supplier_email]').val(),
            'supplier_phone1'       : $('input[name=supplier_phone1]').val(),
            'supplier_phone2'       : $('input[name=supplier_phone2]').val(),
            'supplier_credit_terms' : $('input[name=supplier_credit_terms]').val(),
            'supp_country'          : $('select[name=supplier_country_code]').val()
        };
        
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/updatesupplierfirsttime', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
            })
            // using the callback
            .done(function(data) { 
            // errors and validation messages
                    if (!data.success) {
                        if (data.errors.desc) {
//                            $('#deleteModal').modal('toggle');
                            _toastr(data.errors.desc,"top-right","error",false);
                        }

                    } else {
                        _toastr("Profile updated successfully.","top-right","success",false);
                        setTimeout(function () {
                            window.location.href = '/dashboard';
                        },  3000);
                    }
            });
    });
});