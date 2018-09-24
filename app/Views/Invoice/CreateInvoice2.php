
<?php

// only for jquery grid table
Assets::css([
    template_url('/plugins/jqgrid/css/ui.jqgrid.css', 'smarty'),
    template_url('/css/layout-jqgrid.css', 'smarty'),
]);

echo isset($css) ? $css : ''; // Place to pass data / plugable hook zone

    Assets::js([
        template_url('plugins/jquery/jquery-2.1.4.min.js', 'smarty'),
        template_url('js/app.js', 'smarty'),
        template_url('js/custom.js', 'smarty'),
        template_url('js/invoice.js', 'smarty'),
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


					<div class="row">
                        <form id="frm_verify" name="frm_verify" style="margin-bottom: 0px;">
                            <input type="hidden" id="inv_id" name="inv_id" value="<?= Input::get('inv_id', ''); ?>">
                        </form>
                        <div class="panel panel-default" style="padding-left:15px;padding-right:15px;">
                            <div class="panel-body">
                                <div class="row process-wizard process-wizard-success">

                                    <div class="col-xs-4 process-wizard-step complete">
                                        <div class="text-center process-wizard-stepnum">Step 1</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="process-wizard-dot"></a>
                                        <div class="process-wizard-info text-center">Input main invoice details.</div>
                                    </div>

                                    <div class="col-xs-4 process-wizard-step active"><!-- complete -->
                                        <div class="text-center process-wizard-stepnum">Step 2</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="process-wizard-dot"></a>
                                        <div class="process-wizard-info text-center">Input all the products/services items</div>
                                    </div>

                                    <div class="col-xs-4 process-wizard-step disabled"><!-- complete -->
                                        <div class="text-center process-wizard-stepnum">Step 3</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="process-wizard-dot"></a>
                                        <div class="process-wizard-info text-center">Verified Data and Confirm.</div>
                                    </div>


                                </div>
                            </div>
                        </div>


                            
                            
						<div class="col-md-12">

							<div class="panel panel-default">
								<div class="panel-heading panel-heading-transparent">
									<strong>3. INPUT ALL YOUR PRODUCTS/SERVICES ITEMS</strong>
								</div>

								<div class="panel-body">
                                    <!-- HTML JQGRID TABLE -->
                                    <table id="jqgrid"></table>
                                    <div id="pager_jqgrid"></div>


                                    
<!-- PAGE LEVEL SCRIPTS -->
        <script type="text/javascript">var plugin_path = '/templates/smarty/assets/plugins/';</script>
		<script type="text/javascript">
            
			loadScript(plugin_path + "jqgrid/js/jquery.jqGrid.js", function(){
				loadScript(plugin_path + "jqgrid/js/i18n/grid.locale-en.js", function(){
					loadScript(plugin_path + "bootstrap.datepicker/js/bootstrap-datepicker.min.js", function(){


						// ----------------------------------------------------------------------------------------------------
						jQuery("#jqgrid").jqGrid({
                            url: '/getinvoicedetails?inv_id=<?php echo $_GET['inv_id']; ?>',
							datatype : "json",
                            mtype: "GET",
							height : '100%',
							colNames : ['Item No', 'Inv No', 'Name', 'Quantity', 'Unit Price', 'Total'],
							colModel : [ 
								{ name : 'invoice_item_id', index : 'invoice_item_id', hidden: true}, 
								{ name : 'invoice_id', index : 'invoice_id', editable : true, hidden: true}, 
								{ name : 'item_name', index : 'item_name', editable : true }, 
								{ name : 'item_qty', index : 'item_qty', align : "center", editable : true }, 
								{ name : 'item_unit_price', index : 'item_unit_price', align : "right", editable : true }, 
								{ name : 'item_total_price', index : 'item_total_price', align : "right", editable : true, formatoptions:{decimalSeparator:".", thousandsSeparator: ",", decimalPlaces: 2, prefix: "$"}, formatter:'currency' },
                            ],
							rowNum : 10,
							rowList : [10, 20, 30],
							pager : '#pager_jqgrid',
							sortname : 'invoice_item_id',
							toolbarfilter: true,
							viewrecords : true,
							sortorder : "asc",
							gridComplete: function(){
								var ids = jQuery("#jqgrid").jqGrid('getDataIDs');
								for(var i=0;i < ids.length;i++){
									var cl = ids[i];
									be = "<button class='btn btn-xs btn-default btn-quick' title='Edit Row' onclick=\"jQuery('#jqgrid').editRow('"+cl+"');\"><i class='fa fa-pencil'></i></button>"; 
									se = "<button class='btn btn-xs btn-default btn-quick' title='Save Row' onclick=\"jQuery('#jqgrid').saveRow('"+cl+"');\"><i class='fa fa-save'></i></button>";
									ca = "<button class='btn btn-xs btn-default btn-quick' title='Cancel' onclick=\"jQuery('#jqgrid').restoreRow('"+cl+"');\"><i class='fa fa-times'></i></button>";  
									jQuery("#jqgrid").jqGrid('setRowData',ids[i],{act:be+se+ca});
								}	
							},
							editurl : "/updateinvitems",
							multiselect : true,
							autowidth : true,
                            footerrow : true,
	                        userDataOnFooter : true,
						});			
						// ----------------------------------------------------------------------------------------------------

						//enable datepicker
						function pickDate( cellvalue, options, cell ) {
							setTimeout(function(){
								jQuery(cell) .find('input[type=text]')
										.datepicker({format:'yyyy-mm-dd' , autoclose:true}); 
							}, 0);
						}

						jQuery("#jqgrid").jqGrid('navGrid', "#pager_jqgrid", {
							edit : false,
							add : false,
							del : true,
						},
                        {reloadAfterSubmit:true}, // edit options
                        {reloadAfterSubmit:true}, // add options
                        {url:'/deleteinvitems', reloadAfterSubmit:true}, // del options
                        {} // search options                  
                        );

						jQuery("#jqgrid").jqGrid('inlineNav', "#pager_jqgrid", {
                            addParams:{
                                addRowParams:{
                                    extraparam:{"invoice_id":"<?php echo $_GET['inv_id']; ?>"},
                                    successfunc: function (val){
                                            var $self = $(this);
                                            setTimeout(function () {
                                                $self.trigger("reloadGrid");
                                            }, 50);
                                    }
                                },
                                position: "last"
                                
                            },
                            editParams:{
                                successfunc: function (val){
                                        var $self = $(this);
                                        setTimeout(function () {
                                            $self.trigger("reloadGrid");
                                        }, 50);
                                }
                            }
                        });

						// Get Selected ID's
//						jQuery("a.get_selected_ids").bind("click", function() {
//							s = jQuery("#jqgrid").jqGrid('getGridParam', 'selarrrow');
//							alert(s);
//						});
//
//						// Select/Unselect specific Row by id
//						jQuery("a.select_unselect_row").bind("click", function() {
//							jQuery("#jqgrid").jqGrid('setSelection', "13");
//						});
//
//						// Select/Unselect specific Row by id
//						jQuery("a.delete_row").bind("click", function() {
//							var su=jQuery("#jqgrid").jqGrid('delRowData',1);
//							if(su) alert("Succes. Write custom code to delete row from server"); else alert("Already deleted or not in list");
//						});


						// On Resize
						jQuery(window).resize(function() {

							if(window.afterResize) {
								clearTimeout(window.afterResize);
							}

							window.afterResize = setTimeout(function() {

								/**
									After Resize Code
									.................
								**/

								jQuery("#jqgrid").jqGrid('setGridWidth', jQuery("#middle").width() - 32);

							}, 500);

						});

						// ----------------------------------------------------------------------------------------------------

						/**
							@STYLING
						**/
						jQuery(".ui-jqgrid").removeClass("ui-widget ui-widget-content");
						jQuery(".ui-jqgrid-view").children().removeClass("ui-widget-header ui-state-default");
						jQuery(".ui-jqgrid-labels, .ui-search-toolbar").children().removeClass("ui-state-default ui-th-column ui-th-ltr");
						jQuery(".ui-jqgrid-pager").removeClass("ui-state-default");
						jQuery(".ui-jqgrid").removeClass("ui-widget-content");

						jQuery(".ui-jqgrid-htable").addClass("table table-bordered table-hover");
						jQuery(".ui-pg-div").removeClass().addClass("btn btn-sm btn-primary");
						jQuery(".ui-icon.ui-icon-plus").removeClass().addClass("fa fa-plus");
						jQuery(".ui-icon.ui-icon-pencil").removeClass().addClass("fa fa-pencil");
						jQuery(".ui-icon.ui-icon-trash").removeClass().addClass("fa fa-trash-o");
						jQuery(".ui-icon.ui-icon-search").removeClass().addClass("fa fa-search");
						jQuery(".ui-icon.ui-icon-refresh").removeClass().addClass("fa fa-refresh");
						jQuery(".ui-icon.ui-icon-disk").removeClass().addClass("fa fa-save").parent(".btn-primary").removeClass("btn-primary").addClass("btn-success");
						jQuery(".ui-icon.ui-icon-cancel").removeClass().addClass("fa fa-times").parent(".btn-primary").removeClass("btn-primary").addClass("btn-danger");

						jQuery( ".ui-icon.ui-icon-seek-prev" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
						jQuery(".ui-icon.ui-icon-seek-prev").removeClass().addClass("fa fa-backward");

						jQuery( ".ui-icon.ui-icon-seek-first" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
						jQuery(".ui-icon.ui-icon-seek-first").removeClass().addClass("fa fa-fast-backward");		  	

						jQuery( ".ui-icon.ui-icon-seek-next" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
						jQuery(".ui-icon.ui-icon-seek-next").removeClass().addClass("fa fa-forward");

						jQuery( ".ui-icon.ui-icon-seek-end" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
						jQuery(".ui-icon.ui-icon-seek-end").removeClass().addClass("fa fa-fast-forward");
			
					});
				});
			});
		</script>

                             

                                    <div class="row">

                                        <div class="col-md-12 col-sm-12" style="text-align: right;">
                                            <button id="btn_cancel2" name="btn_cancel2" type="button" class="btn btn-3d btn-danger margin-top-30" data-toggle="modal" data-target="#deleteModal">
                                                <i class="fa fa-ban"></i> Cancel
                                            </button>
                                            <button id="btnBack1" name="btnBack1" type="submit" class="btn btn-3d btn-primary margin-top-30" style="width:90px;" onclick="location.href='1?inv_id=<?php echo $_GET['inv_id']; ?>&o=2';" >
                                                <i id="icnSpinner" class="fa fa-angle-left"></i>Back   
                                            </button>
                                            <button id="btnSubmit2" name="btnSubmit2" type="submit" class="btn btn-3d btn-success margin-top-30" style="width:90px;" onclick="location.href='3?inv_id=<?php echo $_GET['inv_id']; ?>';" >
                                                Next   <i id="icnSpinner" class="fa fa-angle-right"></i>
                                            </button>
                                        </div>
                                    </div>
								</div>
							</div>
                            

						</div>




					</div>


