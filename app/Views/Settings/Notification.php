
<?php

// only for jquery grid table
Assets::css([
    template_url('css/layout-datatables.css', 'smarty'),
]);

echo isset($css) ? $css : ''; // Place to pass data / plugable hook zone

    Assets::js([
        template_url('plugins/jquery/jquery-2.1.4.min.js', 'smarty'),
        template_url('js/app.js', 'smarty'),
        template_url('js/custom.js', 'smarty'),
        template_url('js/notification.js', 'smarty'),
        'https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js',
    ]);

    echo isset($js) ? $js : ''; // Place to pass data / plugable hook zone

    echo isset($footer) ? $footer : ''; // Place to pass data / plugable hook zone
?>

                    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Confirm Cancel?</h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <h4>Are you sure you want to cancel? Data will not be saved.</h4>
                                    <input type="hidden" name="invId" id="invId" value=""/>
                                </div>
                                

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button id="btnDeleteMdl" name="btnDeleteMdl" type="button" class="btn btn-danger">Confirm Delete?</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div id="cancelModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Cancel Auction?</h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <h4>Are you sure you want to cancel this auction?</h4>
                                    <input type="hidden" name="auctionId" id="auctionId" value=""/>
                                </div>
                                

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button id="btnCancelAuctionMdl" name="btnCancelAuctionMdl" type="button" class="btn btn-danger">Confirm?</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <form role="form" action="/updatenotify" method="post" id="NotifyForm" name="NotifyForm">
                        <input id="hid_id" name="hid_id" type="hidden" value="">
                    </form>

                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="listnotify">
                        <thead>
                            <tr>
                                <th>
                                     Message
                                </th>
                                <th>
                                     id
                                </th>
                                <th>
                                     Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>


<script type="text/javascript">var plugin_path = '/templates/smarty/assets/plugins/';</script>
<script type="text/javascript">
    loadScript(plugin_path + "datatables/js/jquery.dataTables.min.js", function() {
        loadScript(plugin_path + "datatables/js/dataTables.tableTools.min.js", function() {
            loadScript(plugin_path + "datatables/dataTables.bootstrap.js", function() {
                loadScript(plugin_path + "select2/js/select2.full.min.js", function() {

                    var table = $('#listnotify').DataTable( {
                        "columns": [
                            { "data": "message"},
                            { "data": "read", "visible": false, "orderable":      false},
                            { 
                                 "data": "id",
                                 "render" : function(data, type, row, meta){
                                    return '<button type="button" class="delete-Btn btn btn-link btn-xs" data-toggle="modal" data-target="#deleteModal"  data-id="'+data+'">Delete</button>';
                                 },
                                 "orderable":      false,
                            },
                        ],
                        "columnDefs": [{
                            "orderable": false,
                            "targets": [0]
                        }],
                        "order": [
                            [0, 'asc']
                        ],
                        "lengthMenu": [
                            [5, 10, 20, -1],
                            [5, 10, 20, "All"] // change per page values here
                        ],
                        // set the initial value
                        "pageLength": 10,
                        "ajax": '/getnotifylist',
                        "scrollX" : true,
                        "responsive": true,
                        "rowCallback": function( row, data, dataIndex ) {
                            if (data.read == "0") {
                                $(row).addClass( 'bold' );
                            }
                        }
                    });

                    $('#listnotify tbody').on( 'click', 'tr', function (e) {
                        var data = table.row( this ).data();
                        
                        if (e.target.className == 'delete-Btn btn btn-link btn-xs') {
                            $('#deleteModal').modal();
                            var myID = data.id;
                            $(".modal-body #invId").val( myID );
                            e.stopPropagation();
                            return;
                        }
                        
                        
                        $('#hid_id').val(data.id);
                        if (data.read == "1") {
                            return;
                        }
                        
                        var formData = {
                                    'hid_id'           : $('input[name=hid_id]').val()
                                };

                                $.ajax({
                                    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                                    url         : '/updatenotify', // the url where we want to POST
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
                                                    location.reload();
                                                },  1);
                                            }
                                    });
                        
                    });

                    
                    
                    
                });
            });
        });
    });
</script>