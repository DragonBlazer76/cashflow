$(function() {
  
    $('#btnDeleteMdl').click(function(event) {
        
        var formData = {
            'inv_id'            : $('input[name=invId]').val()
        };
        
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/deletenotify', // the url where we want to POST
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
                        _toastr("Notification deleted successfully","top-right","success",false);
                        setTimeout(function () {
                            window.location.href = '/notification';
                        },  3000);
                    }
            });
    });
    

  
});