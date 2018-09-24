$(function() {
    // process the form
    $('#frmContact').submit(function(event) {
        
        $('#icnSpinner').removeClass('fa-check');
        $('#icnSpinner').addClass('fa-spinner');
        $('#icnSpinner').addClass('fa-pulse');
        $('#btnSubmit').prop('disabled', true);
        
        var formData = {
            'contact_name'      : $('input[name=contact_name]').val(),
            'contact_email'     : $('input[name=contact_email]').val(),
            'contact_phone'     : $('input[name=contact_phone]').val(),
            'contact_subject'   : $('input[name=contact_subject]').val(),
            'contact_message'   : $('textarea[name=contact_message]').val()
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/contact', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
            // using the callback
            .done(function(data) { 
                // errors and validation messages
                if (!data.success) {
                    if (data.errors.desc) {
                        $('#icnSpinner').removeClass('fa-pulse');
                        $('#icnSpinner').removeClass('fa-spinner');
                        $('#icnSpinner').addClass('fa-check');
                        $('#btnSubmit').prop('disabled', false);
                        $('#alert_failed').show();
                    }
                    
                } else {
                    $('#icnSpinner').removeClass('fa-pulse');
                    $('#icnSpinner').removeClass('fa-spinner');
                    $('#icnSpinner').addClass('fa-check');
                    $('#btnSubmit').prop('disabled', false);
                    $('#alert_success').show();
                    setTimeout(function () {
                            window.location.href = '/';
                        },  8000);
                }
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
    
    $('#frmSubscribe').submit(function(event) {
        
        $('#icnSubscribe').removeClass('fa-check');
        $('#icnSubscribe').addClass('fa-spinner');
        $('#icnSubscribe').addClass('fa-pulse');
        $('#btnSubscribe').prop('disabled', true);
        
        var formData = {
            'email'      : $('input[name=sub_email]').val()
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/subscribe', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
            // using the callback
            .done(function(data) { 
                // errors and validation messages
                if (!data.success) {
                    if (data.errors.desc) {
                        $('#icnSubscribe').removeClass('fa-pulse');
                        $('#icnSubscribe').removeClass('fa-spinner');
                        $('#icnSubscribe').addClass('fa-check');
                        $('#btnSubscribe').prop('disabled', false);
                        _toastr("Error in subscribing!","bottom-right","success",false);
                    }
                    
                } else {
                    $('#icnSubscribe').removeClass('fa-pulse');
                    $('#icnSubscribe').removeClass('fa-spinner');
                    $('#icnSubscribe').addClass('fa-check');
                    $('#btnSubscribe').prop('disabled', false);
                     _toastr("Subscription successful! Thank you!","bottom-right","success",false);
                }
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
});