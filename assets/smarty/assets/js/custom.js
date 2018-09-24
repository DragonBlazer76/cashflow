/** ********************************************** **
	Your Custom Javascript File
	Put here all your custom functions
*************************************************** **/



/** Remove Panel
	Function called by app.js on panel Close (remove)
 ************************************************** **/
	function _closePanel(panel_id) {
		/** 
			EXAMPLE - LOCAL STORAGE PANEL REMOVE|UNREMOVE

			// SET PANEL HIDDEN
			localStorage.setItem(panel_id, 'closed');
			
			// SET PANEL VISIBLE
			localStorage.removeItem(panel_id);
		**/	
	}

$(function() {
    
     $(document).ready(function(){
        setInterval(function () {   
                                    
             $.ajax({
                type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
                url         : '/getnotification', // the url where we want to POST
                data        : null, // our data object
                dataType    : 'json', // what type of data do we expect back from the server
                encode      : true
            })
                // using the callback
                .done(function(data) { 
                    // errors and validation messages
                    if (data.success) {
                        $.each(data.message, function(key, value) {
                            _toastr(value.msg,"top-right",value.type,false);
                        }); 
                    }
                });
         },  5000);
     });
    
    $('#chk_profile').click(function(event) {
        var formData = {
            'chk_profile'       : $('input[name=chk_profile]').prop( "checked" )
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/changeprofile', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
            // using the callback
            .done(function(data) { 
                // errors and validation messages
                if (!data.success) {
                    if (data.errors.desc) {
                        _toastr(data.errors.desc,"top-right","error",false);
                    }
                    
                } else {
                    setTimeout(function () {    
                        window.location.href = '/';
                                // Start the tour
                        
                    },  1);
                }
            });
    });    
    
    


});