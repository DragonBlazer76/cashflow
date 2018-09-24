
<?php

// only for jquery grid table
Assets::css([
    template_url('css/layout-datatables.css', 'smarty'),
]);

echo isset($css) ? $css : ''; // Place to pass data / plugable hook zone

    Assets::js([
        template_url('plugins/jquery/jquery-2.1.4.min.js', 'smarty'),
        template_url('plugins/jquery/jquery-ui.min.js', 'smarty'),
        template_url('js/app.js', 'smarty'),
        template_url('js/custom.js', 'smarty'),
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
                                     Status
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
                    //var table = jQuery('#listinvoice');

                    /* Formatting function for row expanded details */
//                    function fnFormatDetails(oTable, nTr) {
//                        var aData = oTable.fnGetData(nTr);
//                        var sOut = '<table>';
//                        sOut += '<tr><td>Platform(s):</td><td>' + aData[2] + '</td></tr>';
//                        sOut += '<tr><td>Engine version:</td><td>' + aData[3] + '</td></tr>';
//                        sOut += '<tr><td>CSS grade:</td><td>' + aData[4] + '</td></tr>';
//                        sOut += '<tr><td>Others:</td><td>Could provide a link here</td></tr>';
//                        sOut += '</table>';
//
//                        return sOut;
//                    }

                    /*
                     * Insert a 'details' column to the table
                     */
//                    var nCloneTh = document.createElement('th');
//                    nCloneTh.className = "table-checkbox";
//
//                    var nCloneTd = document.createElement('td');
//                    nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';
//
//                    table.find('thead tr').each(function () {
//                        this.insertBefore(nCloneTh, this.childNodes[0]);
//                    });
//
//                    table.find('tbody tr').each(function () {
//                        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
//                    });

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
                            { 
                                 "data": "status",
                                 "render" : function(data, type, row, meta){
                                     if (data.status == 'New') {
                                        return '<span class="label label-primary">'+ data.status +'</span>';
                                     }
                                     else if (data.status == 'In Bid') {
                                         return '<span class="label label-info">'+ data.status +'</span>';
                                     }
                                     else if (data.status == 'Completed') {
                                         return '<span class="label label-success">'+ data.status +'</span>';
                                     }
                                     else if (data.status == 'Rejected') {
                                         return '<span class="label label-danger">'+ data.status +'</span>';
                                     }
                                 },
                                 "orderable":      false,
                            },
                            { 
                                 "data": "status",
                                 "render" : function(data, type, row, meta){
                                    if (data.status == 'New') {
                                       return '<button type="button" class="btn btn-link btn-xs" onclick="window.location.href=\'/invoice/edit/1?inv_id='+data.invoice_id+'&o=2\';">Edit</button>';
                                    }
                                    else {
                                        return '<button type="button" class="btn btn-link btn-xs" disabled>Edit</button>';
                                    }
                                 },
                                 "orderable":      false
                            },
                            { 
                                 "data": "status",
                                 "render" : function(data, type, row, meta){
                                    if (data.status == 'New') {
                                        return '<button type="button" class="delete-Btn btn btn-link btn-xs" data-toggle="modal" data-target="#deleteModal" data-id="'+data.invoice_id+'">Delete</button>';
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
                            [1, 'asc']
                        ],
                        "lengthMenu": [
                            [5, 10, 20, -1],
                            [5, 10, 20, "All"] // change per page values here
                        ],
                        // set the initial value
                        "pageLength": 10,
                        "ajax": '/getinvoicelisttble',
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
                    
//                    var tableWrapper = jQuery('#sample_4_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
//                    var tableColumnToggler = jQuery('#sample_4_column_toggler');
//
//                    /* modify datatable control inputs */
//                    tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
//
//                    /* Add event listener for opening and closing details
//                     * Note that the indicator for showing which row is open is not controlled by DataTables,
//                     * rather it is done here
//                     */
//                    table.on('click', ' tbody td .row-details', function () {
//                        var nTr = jQuery(this).parents('tr')[0];
//                        if (oTable.fnIsOpen(nTr)) {
//                            /* This row is already open - close it */
//                            jQuery(this).addClass("row-details-close").removeClass("row-details-open");
//                            oTable.fnClose(nTr);
//                        } else {
//                            /* Open this row */
//                            jQuery(this).addClass("row-details-open").removeClass("row-details-close");
//                            oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
//                        }
//                    });
//
//                    /* handle show/hide columns*/
//                    jQuery('input[type="checkbox"]', tableColumnToggler).change(function () {
//                        /* Get the DataTables object again - this is not a recreation, just a get of the object */
//                        var iCol = parseInt(jQuery(this).attr("data-column"));
//                        var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
//                        oTable.fnSetColumnVis(iCol, (bVis ? false : true));
//                    });
                });
            });
        });
    });
</script>