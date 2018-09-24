$(function() {
    $('#invoice_form1').areYouSure();

    $('#sel_supplier').change(function() {
       var selected_option = $(this).val();
       $.ajax({
          url: '/getsupplierdetails?supp_id='+selected_option,
          type: 'get',
          cache: false,
          success: function(return_data) {
              var obj = jQuery.parseJSON(return_data);
              if (obj != null) {
                $('#supp_addr1').val(obj.supplier_addr1);
                $('#supp_addr2').val(obj.supplier_addr2);
                $('#supp_state').val(obj.supplier_state);
                $('#supp_postal').val(obj.supplier_postal);
                $('#supp_country').val(obj.supplier_country_code);
                $('#supp_email').val(obj.supplier_email);
                $('#supp_phone1').val(obj.supplier_phone1);
                $('#supp_phone2').val(obj.supplier_phone2);
                $('#supp_bank_name').val(obj.supplier_bank_name);
                $('#supp_bank_ac').val(obj.supplier_bank_ac);
                $('#supp_bank_code').val(obj.supplier_bank_code);
                $('#supp_bank_swift').val(obj.supplier_bank_swift);
                $('#tax_type').val(obj.tax_id);
                $('#tax_rate').val(obj.tax_value);
                $('#credit_terms').val(obj.supplier_credit_terms);
              }
              else {
                $('#supp_addr1').val('');
                $('#supp_addr2').val('');
                $('#supp_state').val('');
                $('#supp_postal').val('');
                $('#supp_country').val('');
                $('#supp_email').val('');
                $('#supp_phone1').val('');
                $('#supp_phone2').val('');
                $('#supp_bank_name').val('');
                $('#supp_bank_ac').val('');
                $('#supp_bank_code').val('');
                $('#supp_bank_swift').val('');
                $('#tax_type').val('');
                $('#tax_rate').val('');
                $('#credit_terms').val('');
              }
          }
       });
    });
    
    
    $('#tax_type').change(function() {
       var selected_option = $(this).val();
       $.ajax({
          url: '/gettaxdetails?tax_id='+selected_option,
          type: 'get',
          cache: false,
          success: function(return_data) {
              var obj = jQuery.parseJSON(return_data);
              if (obj != null) {
                $('#tax_rate').val(obj.tax_value);
              }
              else {
                $('#tax_rate').val('');
              }
          }
       });
    });
    
    
    
    $('#btn_cancel').click(function(event) {
        window.location.href = 'dashboard';
        //event.preventDefault();
    });
    
    
    $('#invoice_form1').submit(function(event) {
//        $('#divInfo').hide();
        $('#icnSpinner').addClass('fa-pulse');
        $('#icnSpinner').addClass('fa-spinner');
        $('#icnSpinner').removeClass('fa-angle-right');
        $('#btnSubmit').prop('disabled', true);  
        
        var formData = {
            'email'             : $('input[name=email]').val()
        };
//
//        // process the form
//        $.ajax({
//            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
//            url         : '/reset', // the url where we want to POST
//            data        : formData, // our data object
//            dataType    : 'json', // what type of data do we expect back from the server
//            encode      : true
//        })
//            // using the callback
//            .done(function(data) { 
//                // errors and validation messages
//                if (!data.success) {
//                    if (data.errors.desc) {
//                        $('#divInfo').removeClass('alert-info');
//                        $('#divInfo').addClass('alert-danger');
//                        $('#divInfo').text(data.errors.desc);
//                        $('#divInfo').show();
//                        $('#icnSpinner').removeClass('fa-pulse');
//                        $('#btnSubmit').prop('disabled', false);
//                        setTimeout(function () {    
//                            $('#divInfo').hide();
//                        },  5000);
//                    }
//                    
//                } else {
//                    $('#icnSpinner').removeClass('fa-pulse');
//                    $('#btnSubmit').prop('disabled', false);
//                    $('#divInfo').addClass('alert-info');
//                    $('#divInfo').removeClass('alert-danger');
//                    $('#divInfo').text('The reset link will be sent to your email address. Click the link and reset your account password.');
//                    $('#divInfo').show();
//
//                }
//            });
//        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
});