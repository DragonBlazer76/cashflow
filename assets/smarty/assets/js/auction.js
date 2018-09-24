$(function() {
    $('#auction_form1').submit(function(event) {
        $('#icnSpinner').addClass('fa-pulse');
        $('#icnSpinner').addClass('fa-spinner');
        $('#icnSpinner').removeClass('fa-angle-right');
        $('#btnSubmit').prop('disabled', true); 
        
        
        var formData = {
            'inv_id'            : $('input[name=hid_inv]').val(),
            'txt_rdr'          : $('input[name=txt_rdr]').val(),
            'expiry_date'          : $('input[name=expiry_date]').val()
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/saveauction1', // the url where we want to POST
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
                        $('#icnSpinner').addClass('fa-angle-right');
                        $('#btnSubmit').prop('disabled', false);
                        _toastr(data.errors.desc,"top-right","error",false);
                    }
                    
                } else {                    
                    _toastr("Auction created successfully","top-right","success",false);
                    setTimeout(function () {
                        $('#icnSpinner').removeClass('fa-pulse');
                        $('#icnSpinner').removeClass('fa-spinner');
                        $('#icnSpinner').addClass('fa-angle-right');
                        $('#btnSubmit').prop('disabled', false);
                        window.location.href = '/listauction';
                    },  3000);
                }
            });
        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
    
    $('#btnCancelMdl').click(function(event) {       
        window.location.href = '/listauction';
    });
    
    $(document).on("click", ".auction-Btn", function () {
        var myID = $(this).data('id');
        $(".modal-body #auctionId").val( myID );
    });
    
    $('#btnCancelAuctionMdl').click(function(event) {
        
        var formData = {
            'auction_id'            : $('input[name=auctionId]').val()
        };
        
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/cancelauction', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
            })
            // using the callback
            .done(function(data) { 
            // errors and validation messages
                    if (!data.success) {
                        if (data.errors.desc) {
                            $('#cancelModal').modal('toggle');
                            _toastr(data.errors.desc,"top-right","error",false);
                        }

                    } else {
                        _toastr("Auction is cancelled","top-right","success",false);
                        setTimeout(function () {
                            window.location.href = '/listauction';
                        },  3000);
                    }
            });
    });
});