<?php

    Assets::js([
        template_url('plugins/jquery/jquery-2.1.4.min.js', 'smarty'),
        template_url('plugins/jquery/jquery-ui.min.js', 'smarty'),
        template_url('js/app.js', 'smarty'),
        template_url('js/custom.js', 'smarty'),
        template_url('plugins/typeahead.bundle.js', 'smarty'),
//        template_url('js/jquery.are-you-sure.js', 'smarty'),
//        template_url('js/ays-beforeunload-shim.js', 'smarty'),
        template_url('js/invoice.js', 'smarty'),
    ]);

    echo isset($js) ? $js : ''; // Place to pass data / plugable hook zone

    echo isset($footer) ? $footer : ''; // Place to pass data / plugable hook zone
?>
                    <div id="cancel_editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <button id="btnCancelBidMdl" name="btnCancelBidMdl" type="button" class="btn btn-3d btn-danger">Cancel Changes</button>
                                </div>

                            </div>
                        </div>
                    </div>


					<div class="row">
                    <form id="frm_BidInv" name="frm_BidInv" style="margin-bottom: 0px;" action="savebid" method="post" enctype="multipart/form-data">
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
                                        <li><strong>Expiry Date:</strong> <?=$exp_date;?> days</li>
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

                                <input type="hidden" id="inv_id" name="inv_id" value="<?= Input::get('inv_id', ''); ?>">
                                <input type="hidden" id="a_id" name="a_id" value="<?= Input::get('a_id', ''); ?>">

								<div class="col-sm-6 text-right">

									<ul class="list-unstyled">
										<li><strong>Invoice Total:</strong> $ <?=$grand_total;?></li>
                                        
									</ul>  
 
                                    <ul class="list-unstyled" style="float:right;">
                                        <li><strong>Requested Rate:</strong> <?=$discount_rate;?>%</li>
                                        <label>Discount Rate (in %) *</label>
                                        <input type="text" id="txt_rdr" name="txt_rdr" value="" placeholder="0.000" data-format="9.999" class="form-control required" required style="text-align:right;">
                                    </ul>  
								</div>
                                
							</div>

						</div>
					</div>

					<div class="panel panel-default text-right" style="padding-left:15px;padding-right:15px;">
						<div class="panel-body">
                            <button id="btn_cancel2" name="btn_cancel2" type="button" class="btn btn-3d btn-danger" data-toggle="modal" data-target="#cancel_editModal">
                                <i class="fa fa-ban"></i> Cancel
                            </button>
                            <button id="btnBid" name="btnBid" type="submit" class="btn btn-3d btn-success" style="width:100px;"  >
                                <i id="icnSpinner" class="fa fa-gavel" style="padding-right: 0px;margin-right: 6px;"></i>Bid   
                            </button>
						</div>
					</div>
                    </form>
</div>