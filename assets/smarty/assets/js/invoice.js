$(function() {
//    $('#invoice_form1').areYouSure();

    $('#supp_name').change(function() {

       var selected_option = $("#supp_id").val();
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
//                $('#supp_bank_name').val(obj.supplier_bank_name);
//                $('#supp_bank_ac').val(obj.supplier_bank_ac);
//                $('#supp_bank_code').val(obj.supplier_bank_code);
//                $('#supp_bank_swift').val(obj.supplier_bank_swift);
//                $('#tax_type').val(obj.tax_id);
//                $('#tax_rate').val(obj.tax_value);
                $('#credit_terms').val(obj.supplier_credit_terms);
              }
              else {
                $('#supp_id').val('');
                $('#supp_addr1').val('');
                $('#supp_addr2').val('');
                $('#supp_state').val('');
                $('#supp_postal').val('');
                $('#supp_country').val('');
                $('#supp_email').val('');
                $('#supp_phone1').val('');
                $('#supp_phone2').val('');
//                $('#supp_bank_name').val('');
//                $('#supp_bank_ac').val('');
//                $('#supp_bank_code').val('');
//                $('#supp_bank_swift').val('');
//                $('#tax_type').val('');
//                $('#tax_rate').val('');
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

        $('#icnSpinner').addClass('fa-pulse');
        $('#icnSpinner').addClass('fa-spinner');
        $('#icnSpinner').removeClass('fa-angle-right');
        $('#btnSubmit').prop('disabled', true); 
        
        var formData = new FormData();
        //formData.append('sel_supplier', $('select[name=sel_supplier]').val());
        formData.append('supp_id', $('input[name=supp_id]').val());
        formData.append('supp_name', $('input[name=supp_name]').val());
        formData.append('email', $('input[name=supp_email]').val());
        formData.append('supp_addr1', $('input[name=supp_addr1]').val());
        formData.append('supp_addr2', $('input[name=supp_addr2]').val());
        formData.append('supp_state', $('input[name=supp_state]').val());
        formData.append('supp_postal', $('input[name=supp_postal]').val());
        formData.append('supp_country', $('select[name=supp_country]').val());
        formData.append('supp_phone1', $('input[name=supp_phone1]').val());
        formData.append('supp_phone2', $('input[name=supp_phone2]').val());
//        formData.append('supp_bank_name', $('input[name=supp_bank_name]').val());
//        formData.append('supp_bank_ac', $('input[name=supp_bank_ac]').val());
//        formData.append('supp_bank_code', $('input[name=supp_bank_code]').val());
//        formData.append('supp_bank_swift', $('input[name=supp_bank_swift]').val());
        formData.append('invoice_no', $('input[name=invoice_no]').val());
        formData.append('po_no', $('input[name=po_no]').val());
        formData.append('do_no', $('input[name=do_no]').val());
        formData.append('inv_date', $('input[name=inv_date]').val());
//        formData.append('tax_type', $('select[name=tax_type]').val());
//        formData.append('tax_rate', $('input[name=tax_rate]').val());
        formData.append('credit_terms', $('input[name=credit_terms]').val());
        formData.append('inv_file_data', $('#inv_attachment')[0].files[0]);
        formData.append('po_file_data', $('#po_attachment')[0].files[0]);
        formData.append('do_file_data', $('#do_attachment')[0].files[0]);
        formData.append('opr', $('input[name=opr]').val());
        formData.append('inv_id', $('input[name=inv_id]').val());
        

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/saveinvoice1', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            contentType : false,
            processData : false,
            encode      : true
        })
            // using the callback
            .done(function(data) { 
                // errors and validation messages
                if (!data.success) {
                    if (data.errors.desc) {
                        $('#icnSpinner').removeClass('fa-pulse');
                        $('#icnSpinner').removeClass('fa-spinner');
                        $('#icnSpinner').addClass('fa-angle-right');
                        $('#btnSubmit').prop('disabled', false);
                        _toastr(data.errors.desc,"top-right","error",false);
                    }
                    
                } else {
                    $('#icnSpinner').removeClass('fa-pulse');
                    $('#icnSpinner').removeClass('fa-spinner');
                    $('#icnSpinner').addClass('fa-angle-right');
                    $('#btnSubmit').prop('disabled', false);
                    window.location.href = '2?inv_id='+data.id;
                }
            });
        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
    
    $('#btnCancelMdl').click(function(event) {
        var formData = {
            'inv_id'            : $('input[name=inv_id]').val()
        };
        
       $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/deleteinvoice', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
            })
            // using the callback
            .done(function(data) { 
            // errors and validation messages
                    if (!data.success) {
                        if (data.errors.desc) {
                            $('#deleteModal').modal('toggle');
                            _toastr(data.errors.desc,"top-right","error",false);
                        }

                    } else {
                        window.location.href = '/listinvoice';
                    }
            });
    });
    
    $('#btnFinshed').click(function(event) {
        $('#btn_cancel2').prop('disabled', true);
        $('#btnBack1').prop('disabled', true);
        $('#btnFinshed').prop('disabled', true);
        _toastr("Invoice saved successfully","top-right","success",false);
        setTimeout(function () {
            $('#btn_cancel2').prop('disabled', false);
            $('#btnBack1').prop('disabled', false);
            $('#btnFinshed').prop('disabled', false);
            window.location.href = '/listinvoice';
        },  3000);
    });
    
    $('#btnCancelEditMdl').click(function(event) {       
        window.location.href = '/listinvoice';
    });
    
    $('#btnCancelBidMdl').click(function(event) {       
        window.location.href = '/listbid';
    });

    $(document).on("click", ".delete-Btn", function () {
        var myID = $(this).data('id');
        $(".modal-body #invId").val( myID );
    });
    
    $(document).on("click", ".reject-Btn", function () {
        var myID = $(this).data('invid');
        var myID2 = $(this).data('aid');
        $(".modal-body #invId").val( myID );
        $(".modal-body #a_id").val( myID2 );
    });
                   
    $('#btnDeleteMdl').click(function(event) {
        
        var formData = {
            'inv_id'            : $('input[name=invId]').val()
        };
        
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/deleteinvoice', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
            })
            // using the callback
            .done(function(data) { 
            // errors and validation messages
                    if (!data.success) {
                        if (data.errors.desc) {
                            $('#deleteModal').modal('toggle');
                            _toastr(data.errors.desc,"top-right","error",false);
                        }

                    } else {
                        _toastr("Invoice deleted successfully","top-right","success",false);
                        setTimeout(function () {
                            window.location.href = '/listinvoice';
                        },  3000);
                    }
            });
    });

    $('#frm_BidInv').submit(function(event) {
        $('#icnSpinner').addClass('fa-pulse');
        $('#icnSpinner').addClass('fa-spinner');
        $('#icnSpinner').removeClass('fa-gavel');
        $('#btnBid').prop('disabled', true);
        
        var formData = {
            'inv_id'            : $('input[name=inv_id]').val(),
            'auction_id'        : $('input[name=a_id]').val(),
            'txt_rdr'           : $('input[name=txt_rdr]').val()
        };
        
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/savebid', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
            })
            // using the callback
            .done(function(data) { 
            // errors and validation messages
                    if (!data.success) {
                        if (data.errors.desc) {
                            $('#deleteModal').modal('toggle');
                            _toastr(data.errors.desc,"top-right","error",false);
                            $('#icnSpinner').removeClass('fa-pulse');
                            $('#icnSpinner').removeClass('fa-spinner');
                            $('#icnSpinner').addClass('fa-gavel');
                            $('#btnBid').prop('disabled', false);
                        }

                    } else {
                        _toastr("Invoice bidded successfully","top-right","success",false);
                        setTimeout(function () {
                            $('#icnSpinner').removeClass('fa-pulse');
                            $('#icnSpinner').removeClass('fa-spinner');
                            $('#icnSpinner').addClass('fa-gavel');
                            $('#btnBid').prop('disabled', false);
                            window.location.href = '/listbid';
                        },  3000);
                    }
            });
        
        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
    
    $('#btnRejectMdl').click(function(event) {
        
        var formData = {
            'inv_id'            : $('input[name=invId]').val(),
            'auction_id'        : $('input[name=a_id]').val()
        };
        
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/rejectbid', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
            })
            // using the callback
            .done(function(data) { 
            // errors and validation messages
                    if (!data.success) {
                        if (data.errors.desc) {
                            $('#deleteModal').modal('toggle');
                            _toastr(data.errors.desc,"top-right","error",false);
                        }

                    } else {
                        _toastr("Bid rejected successfully","top-right","success",false);
                        setTimeout(function () {
                            window.location.href = '/listinvoice';
                        },  3000);
                    }
            });
    });
    

    $(".autosuggest").autocomplete({
            source: function (request, response) {
                $.ajax({
                    type: "GET",
                    contentType: "application/json; charset=utf-8",
                    url: "/getsearchsuppdata?searchid=" + $('#supp_name').val(),
                    //data: "{'searchid':'" + $('#supp_name').val() + "'}",
                    //data: {searchid: request.term, maxResults: 10},
                    dataType: "json",
                })
                .done(function(data) { 
                    response(data);
                });
            },
            select: function (event, ui) {
                $("#supp_name").val(ui.item.label); // display the selected text
                $("#supp_id").val(ui.item.value); // save selected id to hidden input
                $( "#supp_name" ).trigger( "change" );
                event.preventDefault(); 
            }
    });
            
    
});