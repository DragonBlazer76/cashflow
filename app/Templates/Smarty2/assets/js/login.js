$(function() {
    // process the form
    $('#login_form').submit(function(event) {
        
        $('#divLoginErr').hide();
        $('#icnSpinner').show();
        $('#btnSubmit').prop('disabled', true);
//        $('#btnTransferIn').text("Processing...");   
        
        var formData = {
            'email'             : $('input[name=email]').val(),
            'password'          : $('input[name=password]').val(),
            'loggedin'          : $('input[name=chkloggedin]').val()
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/signin', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
            // using the callback
            .done(function(data) { 
                // errors and validation messages
                if (!data.success) {
                    if (data.errors.desc) {
                        $('#divErrorSignInLabel').text(data.errors.desc);
                        $('#divLoginErr').show();
                        $('#icnSpinner').hide();
                        $('#btnSubmit').prop('disabled', false);
//                        $('#modal-amt-in').focus();
//                        $('#modal-amt-in').css('border-color', 'red');
                        setTimeout(function () {    
                            $('#divLoginErr').hide();
                        },  5000);
                    }
                    
//                    $('#btnTransferIn').prop('disabled', false);
//                    $('#btnTransferIn').text("Transfer");
                } else {
                    $('#icnSpinner').hide();
                    $('#btnSubmit').prop('disabled', false);
                    window.location.href = 'dashboard';
                    //$('#btnTransferIn').prop('disabled', false);
//                    $('#balance-value_in').text(data.amount);
//                    $('#poker-balance-value_in').text(data.money);
//                    $('#divSuccessTransIn').show();
//                    setTimeout(function () {    
//                        window.location.href = 'wallet';
//                    },  2000);
                }
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
    
    $('#recover_form').submit(function(event) {
        
        $('#divInfo').hide();
        $('#icnSpinner').addClass('fa-pulse');
        $('#btnSubmit').prop('disabled', true);  
        
        var formData = {
            'email'             : $('input[name=email]').val()
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/reset', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
            // using the callback
            .done(function(data) { 
                // errors and validation messages
                if (!data.success) {
                    if (data.errors.desc) {
                        $('#divInfo').removeClass('alert-info');
                        $('#divInfo').addClass('alert-danger');
                        $('#divInfo').text(data.errors.desc);
                        $('#divInfo').show();
                        $('#icnSpinner').removeClass('fa-pulse');
                        $('#btnSubmit').prop('disabled', false);
                        setTimeout(function () {    
                            $('#divInfo').hide();
                        },  5000);
                    }
                    
                } else {
                    $('#icnSpinner').removeClass('fa-pulse');
                    $('#btnSubmit').prop('disabled', false);
                    $('#divInfo').addClass('alert-info');
                    $('#divInfo').removeClass('alert-danger');
                    $('#divInfo').text('The reset link will be sent to your email address. Click the link and reset your account password.');
                    $('#divInfo').show();

                }
            });
        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
    
    
    $('#chgpwd_frm').submit(function(event) {
        
        $('#divInfo').hide();
        $('#icnSpinner').addClass('fa-pulse');
        $('#icnSpinner').show();
        $('#btnSubmit').prop('disabled', true);  
        
        var formData = {
            'email'             : $('input[name=hid_email]').val(),
            'token'             : $('input[name=hid_token]').val(),
            'new_pwd'           : $('input[name=new_pwd]').val(),
            'cfm_pwd'           : $('input[name=cfm_pwd]').val()
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/chgpwd2', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
            // using the callback
            .done(function(data) { 
                // errors and validation messages
                if (!data.success) {
                    if (data.errors.desc) {
                        $('#divInfo').removeClass('alert-success');
                        $('#divInfo').addClass('alert-danger');
                        $('#divInfo').text(data.errors.desc);
                        $('#divInfo').show();
                        $('#icnSpinner').removeClass('fa-pulse');
                        $('#icnSpinner').hide();
                        $('#btnSubmit').prop('disabled', false);
                        setTimeout(function () {    
                            $('#divInfo').hide();
                        },  5000);
                    }
                    
                } else {
                    $('#icnSpinner').removeClass('fa-pulse');
                    $('#icnSpinner').hide();
                    $('#btnSubmit').prop('disabled', false);
                    $('#divInfo').addClass('alert-success');
                    $('#divInfo').removeClass('alert-danger');
                    $('#divInfo').text('Password changed successfully. Please wait 5 seconds to redirect back.');
                    $('#divInfo').show();
                    setTimeout(function () {    
                        window.location.href = '/';
                    },  5000);

                }
            });
        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
    
    $('#register_form').submit(function(event) {
        
        $('#divLoginErr').hide();
        $('#icnSpinner').show();
        $('#icnCheck').hide();
        $('#btnSubmit').prop('disabled', true); 
        
        var formData = {
            'email'             : $('input[name=email]').val(),
            'new_pwd'           : $('input[name=new_pwd]').val(),
            'cfm_pwd'           : $('input[name=cfm_pwd]').val(),
            'first_name'        : $('input[name=first_name]').val(),
            'last_name'         : $('input[name=last_name]').val(),
            'sel_country'       : $('select[name=sel_country]').val(),
            'chk_buyer'         : $('input[name=chk_buyer]').prop( "checked" ),
            'chk_agree'         : $('input[name=chk_agree]').prop( "checked" ),
            'chk_news'          : $('input[name=chk_news]').prop( "checked" )
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/register2', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
            // using the callback
            .done(function(data) { 
                // errors and validation messages
                if (!data.success) {
                    if (data.errors.desc) {
                        $('#divLoginErr').removeClass('alert-success');
                        $('#divLoginErr').addClass('alert-danger');
                        $('#divErrorSignInLabel').text(data.errors.desc);
                        $('#divLoginErr').show();
                        $('#icnSpinner').hide();
                        $('#icnCheck').show();
                        $('#btnSubmit').prop('disabled', false);
                        setTimeout(function () {    
                            $('#divLoginErr').hide();
                        },  5000);
                    }
                    
                } else {
                    $('#icnSpinner').hide();
                    $('#icnCheck').show();
                    $('#btnSubmit').prop('disabled', false);
                    $('#divLoginErr').addClass('alert-success');
                    $('#divLoginErr').removeClass('alert-danger');
                    $('#divLoginErr').text('Account registered successfully. Please check your email to verify.');
                    $('#divLoginErr').show();
                    setTimeout(function () {    
                        window.location.href = '/';
                    },  5000);
                }
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
});