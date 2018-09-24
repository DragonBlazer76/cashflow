
<?php
    
    Assets::js([
        template_url('plugins/jquery/jquery-2.1.4.min.js', 'smarty'),
        template_url('plugins/jquery/jquery-ui.min.js', 'smarty'),
        template_url('js/app.js', 'smarty'),
        template_url('js/custom.js', 'smarty'),
        template_url('plugins/typeahead.bundle.js', 'smarty'),
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
                                    <button type="button" class="close btn-3d" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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

                    <form id="invoice_form1" name="invoice_form1"  action="saveinvoice1" method="post" enctype="multipart/form-data">
                    
                    <input type="hidden" id="opr" name="opr" value="<?= Input::get('o', ''); ?>">
                    <input type="hidden" id="inv_id" name="inv_id" value="<?= Input::get('inv_id', ''); ?>">
					<div class="row">
                        <div class="panel panel-default" style="padding-left:15px;padding-right:15px;">
                            <div class="panel-body">
                                <div class="row process-wizard process-wizard-success">

                                    <div class="col-xs-4 process-wizard-step active">
                                        <div class="text-center process-wizard-stepnum">Step 1</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="#" class="process-wizard-dot"></a>
                                        <div class="process-wizard-info text-center">Input main invoice details.</div>
                                    </div>

                                    <div class="col-xs-4 process-wizard-step disabled"><!-- complete -->
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


                            
                            
						<div class="col-md-6">

							<div class="panel panel-default">
								<div class="panel-heading panel-heading-transparent">
									<strong>1. SELECT YOUR SUPPLIER</strong>
								</div>

								<div class="panel-body">

<!--                                    <div class="toggle transparent">-->

<!--										<div class="toggle active">-->
<!--											<label>Supplier Details</label>-->
											<div class="toggle-content" style="display: block;">
                                                <fieldset>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12">
                                                                <label>Supplier Name *</label>
                                                                <div id="divSupp" class="" data-minLength="1" >
                                                                    <input type="text" name="supp_name" id="supp_name" class="form-control autosuggest" value="<?=$supp_name; ?>">
                                                                    <input type="hidden" name="supp_id" id="supp_id">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12">
                                                                <label>Address 1 *</label>
                                                                <input type="text" id="supp_addr1" name="supp_addr1" value="<?=$supp_addr1; ?>" class="form-control required" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12">
                                                                <label>Address 2 </label>
                                                                <input type="text" id="supp_addr2" name="supp_addr2" value="<?=$supp_addr2; ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <label>State</label>
                                                                <input type="text" id="supp_state" name="supp_state" value="<?=$supp_state; ?>" class="form-control">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <label>Postal Code *</label>
                                                                <input type="text" id="supp_postal" name="supp_postal" value="<?=$supp_postal; ?>" class="form-control required" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12">
                                                                <label>Country *</label>
                                                                <select id="supp_country" name="supp_country" class="form-control pointer required" required >

                                                                    <option value="">--- Select ---</option>
                                                                    <?=$country_list; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12">
                                                                <label>Email *</label>
                                                                <input type="text" id="supp_email" name="supp_email" value="<?=$supp_email; ?>" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <label>Phone 1 *</label>
                                                                <input type="text" id="supp_phone1" name="supp_phone1" value="<?=$supp_phone1; ?>" class="form-control" required>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <label>Phone 2</label>
                                                                <input type="text" id="supp_phone2" name="supp_phone2" value="<?=$supp_phone2; ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
											</div>
<!--										</div>-->

<!--
										<div class="toggle">
											<label>Bank Account Details</label>
											<div class="toggle-content">
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12">
                                                                <label>Bank Name *</label>
                                                                <input type="text" id="supp_bank_name" name="supp_bank_name" value="" class="form-control required" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12">
                                                                <label>Bank Account No *</label>
                                                                <input type="text" id="supp_bank_ac" name="supp_bank_ac" value="" class="form-control required" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <label>Bank Code</label>
                                                                <input type="text" id="supp_bank_code" name="supp_bank_code" value="" class="form-control" required>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <label>Bank Swift Code</label>
                                                                <input type="text" id="supp_bank_swift" name="supp_bank_swift" value="" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
											</div>
										</div>
-->

<!--									</div>-->

								</div>
							</div>
                            

						</div>

						<div class="col-md-6">
						
							<!-- ------ -->
							<div class="panel panel-default">
                                
                                
								<div class="panel-heading panel-heading-transparent">
									<strong>2. INVOICE DETAILs</strong>
								</div>

								<div class="panel-body">


											<fieldset>

												<div class="row">
													<div class="form-group">
														<div class="col-md-6 col-sm-6">
															<label>Invoice No *</label>
															<input type="text" id="invoice_no" name="invoice_no" value="<?=$inv_no; ?>" class="form-control required" required>
														</div>
														<div class="col-md-6 col-sm-6">
															<label>PO No *</label>
															<input type="text" id="po_no" name="po_no" value="<?=$po_no; ?>" class="form-control required" required>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="form-group">
														<div class="col-md-6 col-sm-6">
															<label>DO No </label>
															<input type="text" id="do_no" name="do_no" value="<?=$do_no; ?>" class="form-control">
														</div>
														<div class="col-md-6 col-sm-6">
															<label>Invoice Date *</label>
															<input type="text" id="inv_date" name="inv_date" value="<?=$inv_date; ?>" class="form-control datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false" required>
														</div>
													</div>
												</div>
                                                
<!--
												<div class="row">
													<div class="form-group">
														<div class="col-md-6 col-sm-6">
															<label>Tax Type * </label>
															     <select id="tax_type" name="tax_type" class="form-control pointer required" required>
                                                                    <option value="">--- Select ---</option>
                                                                    <!--?=$ret_tax_list; ?>
                                                                </select>
														</div>
														<div class="col-md-6 col-sm-6">
															<label>Tax Rate *</label>
															<input type="text" id="tax_rate" name="tax_rate" value="" class="form-control" required>
														</div>
													</div>
												</div>
-->
                                                
												<div class="row">
													<div class="form-group">
														<div class="col-md-6 col-sm-6">
															<label>Credit Terms</label>
															<input type="text" id="credit_terms" name="credit_terms" value="<?=$credit_terms; ?>" class="form-control">
														</div>
													</div>
												</div>

                                                <div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>
																File Attachment 
																<small id="lblInvDoc" class="text-muted">Invoice Documents - <?=$inv_doc; ?></small>
															</label>

                                                            <input class="custom-file-upload" type="file" id="inv_attachment" name="inv_attachment"  data-btn-text="Select a File" />
														</div>
													</div>
												</div>

												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>
																File Attachment 
																<small class="text-muted">PO Documents - <?=$inv_po; ?></small>
															</label>

															<!-- custom file upload -->
<!--
															<div class="fancy-file-upload fancy-file-primary">
																<i class="fa fa-upload"></i>
																<input type="file" class="form-control" id="po_attachment" name="po_attachment" onchange="jQuery(this).next('input').val(this.value);" 
                                                                accept=".xls,.xlsx,.zip,.doc,.docx,.txt,.pdf,.jpg,.jpeg,.png"/>
																<input type="text" class="form-control" placeholder="no file selected" readonly="" />
																<span class="button">Choose File</span>
															</div>
															<small class="text-muted block">Max file size: 5Mb (doc/docx/xls/xlsx/txt/zip/pdf/jpg/png)</small>
-->
                                                            <input class="custom-file-upload" type="file" id="po_attachment" name="po_attachment"  data-btn-text="Select a File" />
														</div>
													</div>
												</div>
                                                
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>
																File Attachment 
																<small class="text-muted">DO Documents - <?=$inv_do; ?></small>
															</label>

															<input class="custom-file-upload" type="file" id="do_attachment" name="do_attachment"  data-btn-text="Select a File" />

														</div>
													</div>
												</div>

											</fieldset>

											<div class="row">
												<div class="col-md-6 col-sm-6">

												</div>
                                                <div class="col-md-6 col-sm-6" style="align:right;">
                                                    <button id="btn_cancel2" name="btn_cancel2" type="button" class="btn btn-3d btn-danger margin-top-30" data-toggle="modal" data-target="#deleteModal">
                                                        <i class="fa fa-ban"></i> Cancel
                                                    </button>
													<button id="btnSubmit" name="btnSubmit" type="submit" class="btn btn-3d btn-success margin-top-30" style="width:90px;">
												        Next   <i id="icnSpinner" class="fa fa-angle-right"></i>
													</button>
												</div>
											</div>



								</div>

							</div>
							<!-- /----- -->

						</div>



					</div>
                </form>


