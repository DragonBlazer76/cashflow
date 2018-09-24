
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
        template_url('js/invoice.js', 'smarty'),
        'https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js',
    ]);

    echo isset($js) ? $js : ''; // Place to pass data / plugable hook zone

    echo isset($footer) ? $footer : ''; // Place to pass data / plugable hook zone
?>

                    <div id="RejectModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Confirm Reject?</h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <h4>Are you sure you want to reject this bid? You cannot revert back after reject.</h4>
                                    <input type="hidden" name="invId" id="invId" value=""/>
                                    <input type="hidden" name="a_id" id="a_id" value=""/>
                                </div>
                                

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button id="btnRejectMdl" name="btnRejectMdl" type="button" class="btn btn-3d btn-danger">Confirm Reject?</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div id="bidModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Send for Bid?</h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <h4>Do you want to send for discount?</h4>
                                    <input type="hidden" name="invId" id="invId" value=""/>
                                </div>
                                

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button id="btnDeleteMdl" name="btnDeleteMdl" type="button" class="btn btn-3d btn-success">Confirm?</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="listinvoice">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                     Invoice No
                                </th>
                                <th class="hidden-xs">
                                     Supplier
                                </th>
                                <th class="hidden-xs">
                                     Invoice Date
                                </th>
                                <th class="hidden-xs">
                                     Expiry Date
                                </th>
                                <th class="hidden-xs">
                                     Grand Totals
                                </th>
                                <th class="hidden-xs">
                                     Requested Rate
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                     Bid
                                </th>
                                <th>
                                     Reject
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                    <!--
                            <tr>
                                <td>
                                     Trident
                                </td>
                                <td>
                                     Internet Explorer 4.0
                                </td>
                                <td>
                                     Win 95+
                                </td>
                                <td>
                                     4
                                </td>
                                <td>
                                     X
                                </td>
                            </tr>
                            <tr>
                                <td>
                                     Trident
                                </td>
                                <td>
                                     Internet Explorer 5.0
                                </td>
                                <td>
                                     Win 95+
                                </td>
                                <td>
                                     5
                                </td>
                                <td>
                                     C
                                </td>
                            </tr>
                    -->
                        </tbody>
                    </table>


<script type="text/javascript">var plugin_path = '/templates/smarty/assets/plugins/';</script>
<script type="text/javascript">
    loadScript(plugin_path + "datatables/js/jquery.dataTables.min.js", function() {
        loadScript(plugin_path + "datatables/js/dataTables.tableTools.min.js", function() {
            loadScript(plugin_path + "datatables/dataTables.bootstrap.js", function() {
                loadScript(plugin_path + "select2/js/select2.full.min.js", function() {

                    //var oTable = table.dataTable({
                    var table = $('#listinvoice').DataTable( {
                        "columns": [
                            {
                                "className":      'details-control',
                                "orderable":      false,
                                "data":           null,
                                "defaultContent": ''
                            },
                            { "data": "invoice_no"},
                            { "data": "supplier_name", "className": 'hidden-xs' },
                            { "data": "invoice_date", "className": 'hidden-xs' },
                            { "data": "expiry_date", "className": 'hidden-xs' },
                            { "data": "grand_total", "className": 'hidden-xs' },
                            { "data": "discount_rate", "className": 'hidden-xs' },
                            { 
                                 "data": "status",
                                 "render" : function(data, type, row, meta){
                                    if (data.bid_status == 0) {
                                       return "<span class=\"label label-default\">No Bid</span>";
                                    }
                                    else if (data.bid_status == 1) {
                                       return "<span class=\"label label-primary\">Bidded</span>";
                                    }
                                    else if (data.bid_status == 2) {
                                        return "<span class=\"label label-danger\">Rejected</span>";
                                    }
                                    else if (data.bid_status == 3) {
                                        return "<span class=\"label label-success\">Won</span>";
                                    }
                                    else if (data.bid_status == 4) {
                                        return "<span class=\"label label-danger\">Lost</span>";
                                    }
                                 },
                                 "orderable":   false
                            },
                            { 
                                 "data": "status",
                                 "render" : function(data, type, row, meta){
                                    if (data.bid_status == 0) {
                                        return '<button type="button" class="btn btn-link btn-xs" style="margin-left:-5px;" onclick="window.location.href=\'/invoice/bid?inv_id='+data.invoice_id+'&a_id='+data.auction_id+'\';">Bid</button>';
                                    }
                                    else {
                                        return '<button type="button" class="btn btn-link btn-xs" style="margin-left:-5px;" disabled>Bid</button>';
                                    }
                                 },
                                 "orderable":      false
                            },
                            { 
                                 "data": "status",
                                 "render" : function(data, type, row, meta){
                                    if (data.bid_status == 0) {
                                        return '<button type="button" class="reject-Btn btn btn-link btn-xs" style="margin-left:-5px;" data-toggle="modal" data-target="#RejectModal" data-invid="'+data.invoice_id+'" data-aid="'+data.auction_id+'">Reject</button>';
                                    }
                                    else {
                                        return '<button type="button" class="delete-Btn btn btn-link btn-xs" style="margin-left:-5px;" disabled>Reject</button>';
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
                            [1, 'asc']
                        ],
                        "lengthMenu": [
                            [5, 10, 20, -1],
                            [5, 10, 20, "All"] // change per page values here
                        ],
                        // set the initial value
                        "pageLength": 10,
                        "ajax": '/getbidlisttble',
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
                    $('#listinvoice tbody').on('click', 'td.details-control', function () {
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