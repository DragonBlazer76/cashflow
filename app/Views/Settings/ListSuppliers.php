
<?php

// only for jquery grid table
Assets::css([
    template_url('css/layout-datatables.css', 'smarty'),
]);

echo isset($css) ? $css : ''; // Place to pass data / plugable hook zone

    Assets::js([
        template_url('plugins/jquery/jquery-2.1.4.min.js', 'smarty'),
        template_url('js/app.js', 'smarty'),
        template_url('js/invoice.js', 'smarty'),
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
                                    <h4>Are you sure you want to delete? Data deleted will not be able to restore.</h4>
                                    <input type="hidden" name="invId" id="invId" value=""/>
                                </div>
                                

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button id="btnDeleteMdl" name="btnDeleteMdl" type="button" class="btn btn-3d btn-danger">Confirm Delete?</button>
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

                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="listsupplier">
                        <thead>
                            <tr>
                                <th>
                                     Supplier Name
                                </th>
                                <th class="hidden-xs">
                                     Supplier Email
                                </th>
                                <th class="hidden-xs">
                                     Supplier Phone 1
                                </th>
                                <th class="hidden-xs">
                                     Supplier Credit Terms
                                </th>
                                <th>
                                     Edit
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

                    var table = $('#listsupplier').DataTable( {
                        "columns": [
                            { "data": "supplier_name"},
                            { "data": "supplier_email", "className": 'hidden-xs' },
                            { "data": "supplier_phone1", "className": 'hidden-xs' },
                            { "data": "supplier_credit_terms", "className": 'hidden-xs' },
                            { 
                                 "data": "supplier_id",
                                 "render" : function(data, type, row, meta) {
                                        return '<button type="button" class="btn btn-link btn-xs" onclick="window.location.href=\'/invoice/edit/1?supplier_id='+data+'&o=2\';">Edit</button>';
                                 },
                                 "orderable":      false
                            },
                            { 
                                 "data": "supplier_id",
                                 "render" : function(data, type, row, meta){
                                        return '<button type="button" class="delete-Btn btn btn-link btn-xs" data-toggle="modal" data-target="#deleteModal" data-id="'+data+'">Delete</button>';
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
                        "ajax": '/getsupplierslisttble',
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
                    $('#listsupplier tbody').on('click', 'td.details-control', function () {
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