
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
        template_url('js/auction.js', 'smarty'),
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

                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="listauction">
                        <thead>
                            <tr>
                                <th>
                                     Auction ID
                                </th>
                                <th class="hidden-xs">
                                     Requested Rate
                                </th>
                                <th class="hidden-xs">
                                     Auction Expiry Date
                                </th>
                                <th class="hidden-xs">
                                     Status
                                </th>
                                <th>
                                     View
                                </th>
                                <th>
                                     Cancel Auction
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

                    var table = $('#listauction').DataTable( {
                        "columns": [
                            { "data": "auction_id"},
                            { "data": "discount_rate", "className": 'hidden-xs' },
                            { "data": "auction_date", "className": 'hidden-xs' },
                            { "data": "status", "className": 'hidden-xs' },
                            { 
                                 "data": "auction_id",
                                 "render" : function(data, type, row, meta){
                                    return '<button type="button" class="btn btn-link btn-xs" onclick="window.location.href=\'/auction/view?auction_id='+data+'\';">View</button>';
                                 },
                                 "orderable":      false
                            },
                            { 
                                 "data": "c2",
                                 "render" : function(data, type, row, meta){
                                    if (data.status == 0) {
                                        return '<button type="button" class="auction-Btn btn btn-link btn-xs" data-toggle="modal" data-target="#cancelModal" data-id="'+data.auction_id+'">Cancel</button>';
                                    }
                                    else {
                                        return '<button type="button" class="btn btn-link btn-xs" disabled>Cancel</button>';
                                    }
                                 },
                                 "orderable":      false,
                            },
                            { 
                                 "data": "c2",
                                 "render" : function(data, type, row, meta){
                                    if (data.status == 3) {
                                        return '<button type="button" class="delete-Btn btn btn-link btn-xs" data-toggle="modal" data-target="#deleteModal" data-id="'+data.auction_id+'">Delete</button>';
                                    }
                                    else {
                                        return '<button type="button" class="delete-Btn btn btn-link btn-xs" disabled>Delete</button>';
                                    }
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
                        "ajax": '/getauctionlisttble',
                        "scrollX" : true,
                        "responsive": true
                    });

                    /* Formatting function for row details - modify as you need */
                    function format ( d ) {
                        // `d` is the original data object for the row
                        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                            '<tr>'+
                                '<td>Full name:</td>'+
                                '<td>'+d.invoice_no+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td>Extension number:</td>'+
                                '<td>'+d.credit_terms+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td>Extra info:</td>'+
                                '<td>And any further details here (images etc)...</td>'+
                            '</tr>'+
                        '</table>';
                    }
                    
                    // Add event listener for opening and closing details
                    $('#listauction tbody').on('click', 'td.details-control', function () {
                        var tr = $(this).closest('tr');
                        var row = table.row( tr );

                        if ( row.child.isShown() ) {
                            // This row is already open - close it
                            row.child.hide();
                            tr.removeClass('shown');
                        }
                        else {
                            // Open this row
                            row.child( format(row.data()) ).show();
                            tr.addClass('shown');
                        }
                    });
                    
                });
            });
        });
    });
</script>