<?php

    Assets::js([
        template_url('plugins/jquery/jquery-2.1.4.min.js', 'smarty'),
        template_url('js/app.js', 'smarty'),
        template_url('js/custom.js', 'smarty'),
        template_url('js/jquery.are-you-sure.js', 'smarty'),
        template_url('js/ays-beforeunload-shim.js', 'smarty'),
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

                                    <div class="col-xs-4 process-wizard-step complete"><!-- complete -->
                                        <div class="text-center process-wizard-stepnum">Step 2</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="process-wizard-dot"></a>
                                        <div class="process-wizard-info text-center">Input all the products/services items</div>
                                    </div>

                                    <div class="col-xs-4 process-wizard-step active"><!-- complete -->
                                        <div class="text-center process-wizard-stepnum">Step 3</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="process-wizard-dot"></a>
                                        <div class="process-wizard-info text-center">Verify Data and Confirm.</div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    <div class="panel panel-default" style="padding-left:15px;padding-right:15px;">
						<div class="panel-body">

							<div class="row">

								<div class="col-md-6 col-sm-6 text-left">

									<h4><strong>Supplier</strong> Details</h4>
									<ul class="list-unstyled">
										<li><strong>Name:</strong> <?=$supplier_name;?></li>
										<li><strong>Address 1:</strong> <?=$supplier_addr1;?></li>
										<li><strong>Address 2:</strong> <?=$supplier_addr2;?></li>
										<li><strong>State:</strong> <?=$supplier_state;?>  <strong>Postal:</strong> <?=$supplier_postal;?></li>
                                        <li><strong>Country:</strong> <?=$supplier_country;?></li>
                                        
									</ul>

								</div>

								<div class="col-md-6 col-sm-6 text-right">

									<h4><strong>Invoice</strong> Details</h4>
									<ul class="list-unstyled">
										<li><strong>Invoice No:</strong> <?=$invoice_no;?></li>
										<li><strong>PO No:</strong> <?=$po_no;?></li>
										<li><strong>Do No:</strong> <?=$do_no;?></li>
										<li><strong>Invoice Date:</strong> <?=$invoice_date;?></li>
                                        <li><strong>Credit Terms:</strong> <?=$credit_terms;?> days</li>
                                        <li><strong>Expiry Date:</strong> <?=$exp_date;?></li>
									</ul>

								</div>

							</div>

							<div class="table-responsive">
								<table class="table table-condensed nomargin">
									<thead>
										<tr>
											<th>Item Name</th>
											<th>Quantity</th>
											<th>Unit Price</th>
											<th>Total Price</th>
										</tr>
									</thead>
									<tbody>
                                        <?=$detail_html;?>
									</tbody>
								</table>
							</div>

							<hr class="nomargin-top" />

							<div class="row">

								<div class="col-sm-6 text-left">
									<h4><strong>Contact</strong> Details</h4>
									<ul class="list-unstyled">
										<li><strong>Phone 1:</strong> <?=$supplier_phone1;?></li>
										<li><strong>Phone 2:</strong> <?=$supplier_phone2;?></li>
										<li><strong>Email:</strong> <?=$supplier_email;?></li>
									</ul>
								</div>

								<div class="col-sm-6 text-right">

									<ul class="list-unstyled">
										<li><strong>Invoice Total:</strong> $ <?=$grand_total;?></li>
									</ul>     
								</div>

							</div>

						</div>
					</div>

					<div class="panel panel-default text-right" style="padding-left:15px;padding-right:15px;">
						<div class="panel-body">
                            <button id="btn_cancel2" name="btn_cancel2" type="button" class="btn btn-3d btn-danger" data-toggle="modal" data-target="#deleteModal">
                                <i class="fa fa-ban"></i> Cancel
                            </button>
                            <button id="btnBack1" name="btnBack1" type="submit" class="btn btn-3d btn-primary" style="width:90px;" onclick="location.href='2?inv_id=<?php echo $_GET['inv_id']; ?>';" >
                                <i id="icnSpinner" class="fa fa-angle-left"></i>Back   
                            </button>
                            <button id="btnFinshed" name="btnFinshed" type="button" class="btn btn-3d btn-success" style="width:100px;"  >
                                <i id="icnSpinner" class="fa fa-check"></i>Confirm   
                            </button>
						</div>
					</div>
</div>