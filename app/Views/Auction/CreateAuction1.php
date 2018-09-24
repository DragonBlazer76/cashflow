
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
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button id="btnCancelMdl" name="btnCancelMdl" type="button" class="btn btn-3d btn-danger">Cancel Changes</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <form id="auction_form1" name="auction_form1" action="/saveauction1" method="post" enctype="application/x-www-form-urlencoded">
                    
                        
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-transparent">
                            <strong>Input required discount rate and auction expiry date</strong>
                        </div>  

                        <div class="panel-body">

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Request Discount Rate (in %) *</label>
                                        <input type="text" id="txt_rdr" name="txt_rdr" value="" placeholder="0.000" data-format="9.999" class="form-control required" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Auction Expiry Date *</label>
                                        <input type="text" id="expiry_date" name="expiry_date" value="" class="form-control datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false" required>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                        
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-transparent">
                            <strong>Select the invoice(s)</strong>
                            <input type="hidden" id="hid_inv" name="hid_inv">
                        </div>  

                        <div class="panel-body">

                            <div class="row padding-15">
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>


                        </div>

                        <div class="panel-footer text-right">
                            <button id="btn_cancel2" name="btn_cancel2" type="button" class="btn btn-3d btn-danger margin-top-30" data-toggle="modal" data-target="#deleteModal">
                                <i class="fa fa-ban"></i> Cancel
                            </button>
                            <button id="btnSubmit2" name="btnSubmit2" type="submit" class="btn btn-3d btn-success margin-top-30" style="width:90px;">
                                Submit   <i id="icnSpinner" class="fa fa-check" style='text-align: center;padding-right: 0px;'></i>
                            </button>
                        </div>
                    </div>
                </form>

<script type="text/javascript">var plugin_path = '/templates/smarty/assets/plugins/';</script>
<script type="text/javascript">
    loadScript(plugin_path + "datatables/js/jquery.dataTables.min.js", function() {
        loadScript(plugin_path + "datatables/js/dataTables.tableTools.min.js", function() {
            loadScript(plugin_path + "datatables/dataTables.bootstrap.js", function() {
                loadScript(plugin_path + "select2/js/select2.full.min.js", function() {
                    var rows_selected = [];
                    var table = $('#listinvoice').DataTable( {
                        "columns": [
                            {
                                "data": "invoice_id",
                                 "render" : function(data, type, row, meta){
                                    return '<input type="checkbox" data-id="'+data+'">';
                                 },
                                 "orderable":      false,
                            },
                            { "data": "invoice_no"},
                            { "data": "supplier_name", "className": 'hidden-xs' },
                            { "data": "invoice_date", "className": 'hidden-xs' },
                            { "data": "expiry_date", "className": 'hidden-xs' },
                            { "data": "grand_total", "className": 'hidden-xs' },
                        ],
                        "columnDefs": [{
                            "orderable": false,
                            "className": "select-checkbox",
                            "targets": [0]
                        }],
                        "select": [{
                            "style":    "os",
                            "selector": "td:first-child",
                            
                        }],
                        "order": [
                            [1, 'asc']
                        ],
                        "rowCallback": function(row, data, dataIndex){
                             // Get row ID
                             var rowId = data[0];

                             // If row ID is in the list of selected row IDs
                             if($.inArray(rowId, rows_selected) !== -1){
                                $(row).find('input[type="checkbox"]').prop('checked', true);
                                $(row).addClass('selected');
                             }
                          },
                        "lengthMenu": [
                            [5, 10, 20, -1],
                            [5, 10, 20, "All"] // change per page values here
                        ],
                        // set the initial value
                        "pageLength": 10,
                        "ajax": '/getinvoiceforauction',
                        "scrollX" : true,
                        "responsive": true,
                        "searching": false
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
                    
                    $('#listinvoice tbody').on('click', 'input[type="checkbox"]', function(e){
                        var $row = $(this).closest('tr');
                        
                        // Get row ID
                        var myID = $(this).data('id');

                        // Get row data
                        var data = table.row($row).data();

                        // Determine whether row ID is in the list of selected row IDs 
                        var index = $.inArray(myID, rows_selected);

                        // If checkbox is checked and row ID is not in list of selected row IDs
                        if(this.checked && index === -1){
                            rows_selected.push(myID);

                        // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
                        } else if (!this.checked && index !== -1){
                            rows_selected.splice(index, 1);
                        }

                        if(this.checked){
                            $row.addClass('active');
                        } else {
                            $row.removeClass('active');
                        }
                        
                        var rows_elem = [];
                        $.each(rows_selected, function(index, rowId){
                           rows_elem.push(rowId);
                        });
                        
                         $('#hid_inv').val(JSON.stringify(rows_elem));
                        // Update state of "Select all" control
                        //updateDataTableSelectAllCtrl(table);

                        // Prevent click event from propagating to parent
                        e.stopPropagation();
                    });
                    
                    // Handle click on table cells with checkboxes
                    $('#listinvoice').on('click', 'tbody td, thead th:first-child', function(e){
                        $(this).parent().find('input[type="checkbox"]').trigger('click');
                    });
                    
                });
            });
        });
    });
</script>

