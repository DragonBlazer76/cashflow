$(function() {
    // process the form
    $('#frmChgPwd').submit(function(event) {
        
        $('#icnSpinner').addClass('fa-pulse');
        $('#icnSpinner').show();
        $('#icnCheck').hide();
        $('#btnSubmit').prop('disabled', true);  
        
        var formData = {
            'current_pwd'             : $('input[name=current_pwd]').val(),
            'new_pwd'          : $('input[name=new_pwd]').val(),
            'confirm_pwd'          : $('input[name=confirm_pwd]').val()
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/profile_password', // the url where we want to POST
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
                        $('#icnSpinner').hide();
                        $('#icnCheck').show();
                        $('#btnSubmit').prop('disabled', false);
                        _toastr(data.errors.desc,"top-right","error",false);
                    }
                    
//                    $('#btnTransferIn').prop('disabled', false);
//                    $('#btnTransferIn').text("Transfer");
                } else {
                    $('#icnSpinner').removeClass('fa-pulse');
                    $('#icnSpinner').hide();
                    $('#icnCheck').show();
                    $('#btnSubmit').prop('disabled', false);
                    _toastr("Your password has been changed successfully","top-right","success",false);
                }
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
    
    // process the form
    $('#frmPersonal').submit(function(event) {
        
        $('#icnSpinner').addClass('fa-pulse');
        $('#icnSpinner').show();
        $('#icnCheck').hide();
        $('#btnSubmit').prop('disabled', true);  
        
        var formData = {
            'first_name'             : $('input[name=first_name]').val(),
            'last_name'          : $('input[name=last_name]').val(),
            'mobile_number'          : $('input[name=mobile_number]').val(),
            'sel_country'       : $('select[name=sel_country]').val(),
            'email_id'              : $('input[name=email_id]').val()
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/personal_profile', // the url where we want to POST
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
                        $('#icnSpinner').hide();
                        $('#icnCheck').show();
                        $('#btnSubmit').prop('disabled', false);
                        _toastr(data.errors.desc,"top-right","error",false);
                    }
                    
//                    $('#btnTransferIn').prop('disabled', false);
//                    $('#btnTransferIn').text("Transfer");
                } else {
                    $('#icnSpinner').removeClass('fa-pulse');
                    $('#icnSpinner').hide();
                    $('#icnCheck').show();
                    $('#btnSubmit').prop('disabled', false);
                    _toastr("Your profile has been updated","top-right","success",false);
                }
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
    
     // process the form
    $('#profilepic').submit(function(event) {
        $('#icnSpinner').addClass('fa-pulse');
        $('#icnSpinner').show();
        $('#icnCheck').hide();
        $('#btnSubmit').prop('disabled', true);  
//          _toastr("Your profile picture has been updated","top-right","success",false);
        var formData = new FormData();

        formData.append('newPicture', $('#newPicture')[0].files[0]); // right side js left side html

        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/profile_picture', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            contentType : false,
            processData : false,
            encode      : true
        })
            .done(function(data) { 
                // errors and validation messages
                if (!data.success) {
                    if (data.errors.desc) {
                        $('#icnSpinner').removeClass('fa-pulse');
                        $('#icnSpinner').hide();
                        $('#icnCheck').show();
                        $('#btnSubmit').prop('disabled', false);
                        _toastr(data.errors.desc,"top-right","error",false);
                    }
                    
//                    $('#btnTransferIn').prop('disabled', false);
//                    $('#btnTransferIn').text("Transfer");
                } else {
                    $('#icnSpinner').removeClass('fa-pulse');
                    $('#icnSpinner').hide();
                    $('#icnCheck').show();
                    $('#btnSubmit').prop('disabled', false);
                    _toastr("Your profile has been updated","top-right","success",false);
                }
            });
        

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
        
    });
    
    // process the form
    $('#CompanyPro').submit(function(event) {
        
        $('#icnSpinner').addClass('fa-pulse');
        $('#icnSpinner').show();
        $('#icnCheck').hide();
        $('#btnSubmit').prop('disabled', true);  
        
        var formData = {
            'company_name'             : $('input[name=company_name]').val(),
            'registration_number'      : $('input[name=registration_number]').val(),
            'company_address'          : $('input[name=company_address]').val(),
            'country_code'             : $('select[name=country_code]').val(),
            'industry'                 : $('input[name=industry]').val(),
            'website_url'              : $('input[name=website_url]').val()
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/company_profile', // the url where we want to POST
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
                        $('#icnSpinner').hide();
                        $('#icnCheck').show();
                        $('#btnSubmit').prop('disabled', false);
                        _toastr(data.errors.desc,"top-right","error",false);
                    }
                    
//                    $('#btnTransferIn').prop('disabled', false);
//                    $('#btnTransferIn').text("Transfer");
                } else {
                    $('#icnSpinner').removeClass('fa-pulse');
                    $('#icnSpinner').hide();
                    $('#icnCheck').show();
                    $('#btnSubmit').prop('disabled', false);
                    _toastr("Your profile has been updated","top-right","success",false);
                }
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
});
//$(function uploadProfilePicture() {
//    //change profile pic
//   
//    var file2 = document.getElementById("newPicture").files [0];
//    var ext = file2.type;
//    var formdata= new FormData();
//    formdata.append("pic",file2);
//    formdata.append("ext",ext); // ('pic': file2, 'ext: ext)
//    var ajax = new XMLHttpRequest();
//    ajax.upload.addEventListener()
//    ajax.open("POST", "");
//    ajax.send(formdata);
//    
//}
//  
//  function changeProfilePicture() {
//    
//    var selectedImg= $('#profileImage') [0].files[0];
//    
//    if (selectedImg)
//        
//    {
//        var previewId = document.getElementById('profileImage');
//        previewId.src = '';
//        
//        var  oReader = new FileReader();
//        oReader.onload = function(e)
//        {
//            previewId.src=e.target.result;
//        }
//        oReader.readAsDataURL(selectedImg);
//        
//        $('#uploadButton').removeClass('disabled');    
//    }
//        
//        
//}