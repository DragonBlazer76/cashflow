
<?php
    
    //Assets::js([
    //    'https://code.jquery.com/jquery-1.12.4.min.js',
    //    vendor_url('dist/js/bootstrap.min.js', 'twbs/bootstrap'),
    //]);

    Assets::js([
        template_url('plugins/jquery/jquery-2.1.4.min.js', 'smarty'),
        template_url('js/app.js', 'smarty'),
//        template_url('js/jquery.are-you-sure.js', 'smarty'),
//        template_url('js/ays-beforeunload-shim.js', 'smarty'),
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

                    <form id="invoice_form1" name="invoice_form1"  action="saveinvoice1" method="post" enctype="multipart/form-data" style="margin-bottom:-10px;">
                    
                    <input type="hidden" id="opr" name="opr" value="<?= Input::get('o', ''); ?>">
                    <input type="hidden" id="inv_id" name="inv_id" value="<?= Input::get('inv_id', ''); ?>">
					<div class="row">

                            
						<div class="col-md-12">

							<div class="panel panel-default">
								<div class="panel-heading panel-heading-transparent">
									<strong>1. INPUT YOUR SUPPLIER</strong>
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
                                                                <div class="autosuggest" data-minLength="1" data-queryURL="php/view/demo.autosuggest.php?limit=10&search=">
                                                                    <input type="text" name="src" placeholder="US State" class="form-control typeahead" />
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
                            
						</div>

					</div>
                </form>


