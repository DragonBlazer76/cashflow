<?php
    Assets::js([
        template_url('plugins/jquery/jquery-2.1.4.min.js', 'smarty'),
        template_url('js/app.js', 'smarty'),
        template_url('js/custom.js', 'smarty'),
        template_url('js/profile.js', 'smarty'),
    ]);

    echo isset($js) ? $js : ''; // Place to pass data / plugable hook zone 
?>

<div>

				<!-- /page title -->

<section>
				<div>

					<!-- RIGHT -->
					<div class="col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4 margin-bottom-80">

						<ul class="nav nav-tabs nav-top-border">
							<li class="active"><a href="#info" data-toggle="tab">Personal Info</a></li>
							<li><a href="#ProfilePicture" data-toggle="tab">Profile Picture</a></li>
							<li><a href="#password" data-toggle="tab">Password</a></li>
                            <!--li><a href="#company" data-toggle="tab">Company</a></li-->
                            <li><a href="#supplier" data-toggle="tab">Company</a></li>
						</ul>

						<div class="tab-content margin-top-20">
                            

							<!-- PERSONAL INFO TAB -->
							<div class="tab-pane fade in active" id="info">
								<form action="#" method="post" method="post" id="frmPersonal" name="frmPersonal">
									<div class="form-group">
										<label class="control-label">First Name</label>
										<input type="FirstName" id="first_name" name="first_name" id class="form-control" value="<?=$first_name; ?>">
									</div>
									<div class="form-group">
										<label class="control-label">Last Name</label>
										<input type="LastName" class="form-control" id="last_name" name="last_name" value="<?=$last_name; ?>">
									</div>
									<div class="form-group">
										<label class="control-label">Mobile Number</label>
										<input type="MobileNumber" class="form-control" id="mobile_number" name="mobile_number" value="<?=$mobile_number; ?>">
									</div>
									<div class="form-group">
                                        <label class="select">Location</label><br>
							             <select id="sel_country" name="sel_country" required style="background-color: #ffffff;width: 100%">
                                             
                                                <option value="" disabled selected>-- Select a country * --</option>
                                                <?=$country_list; ?>
							             </select>
							             <i></i>
									</div>
                                    
									<div class="form-group">
										<label class="control-label">Email</label>
										<input type="text" class="form-control" id="email_id" name="email_id"value="<?=$email; ?>">
									</div>
									<div class="margiv-top10">
										<button id="btnSubmit" type="submit" class="btn btn-primary pull-right"><i id="icnCheck" name="icnCheck" class="fa fa-check"></i><i style='text-align: center;padding-right: 0px;display:none;' class="glyphicon glyphicon-refresh" id="icnSpinner" name="icnSpinner"></i>Save Profile</button>
                                        <button class="btn btn-danger pull-right">Cancel</button>
									</div>
								</form>
							</div>
							<!-- /PERSONAL INFO TAB -->

							<!-- Profile Picture -->
							<div class="tab-pane fade" id="ProfilePicture">

								<form class="clearfix" action="#" method="post" enctype="multipart/form-data" id= "profilepic" name="profilepic">
									<div class="form-group">

										<div class="row">

											<div class="col-md-3 col-sm-4">

												<div class="thumbnail">
													<img class="img-responsive" src="<?= $image; ?>" alt="" />
												</div>

											</div>

											<div class="col-md-9 col-sm-8">

												<div class="sky-form nomargin">
													<label class="label">Select File</label>
													<label for="file" class="input input-file">
														<div class="button">
															<input type="file" name= "newPicture" id="newPicture" accept="image/jpeg,image/png" onchange="this.parentNode.nextSibling.value = this.value">Browse
														</div><input type="text" readonly>
													</label>
												</div>

												<!--a href="#" class="btn btn-danger btn-xs noradius"><i class="fa fa-times"></i> Remove Picture</a-->

												<div class="clearfix margin-top-20">
													<span class="label label-warning">NOTE! </span>
													<p>
														Ensure your image is either in Jpeg format or PNG format only.
													</p>
												</div>

											</div>

										</div>

									</div>

									<div class="margiv-top10">
										<button id="btnSubmit" type="submit" class="btn btn-primary pull-right" ><i id="icnCheck" name="icnCheck" class="fa fa-check"></i><i style='text-align: center;padding-right: 0px;display:none;' class="glyphicon glyphicon-refresh" id="icnSpinner" name="icnSpinner"></i> Chanage Profile Picture</button>
                                        <button class="btn btn-danger pull-right">Cancel</button>
									</div>
								</form>

							</div>
							<!-- /profile picture -->

							<!-- PASSWORD TAB -->
							<div class="tab-pane fade" id="password">

								<form action="#" method="post" method="post" id="frmChgPwd" name="frmChgPwd">

									<div class="form-group">
										<label class="control-label">Current Password</label>
										<input type="password" class="form-control" id="current_pwd" name="current_pwd">
									</div>
									<div class="form-group">
										<label class="control-label">New Password</label>
										<input type="password" class="form-control" id="new_pwd" name="new_pwd">
									</div>
									<div class="form-group">
										<label class="control-label">Re-type New Password</label>
										<input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd">
									</div>

									<div class="margiv-top10">
										<button id="btnSubmit" type="submit" class="btn btn-primary pull-right"><i id="icnCheck" name="icnCheck" class="fa fa-check"></i><i style='text-align: center;padding-right: 0px;display:none;' class="glyphicon glyphicon-refresh" id="icnSpinner" name="icnSpinner"></i> Change Password</button>
                                        <button class="btn btn-danger pull-right">Cancel</button>
									</div>
								</form>

							</div>
							<!-- /PASSWORD TAB -->
                            
                          <!-- Company TAB -->
							<!--div class="tab-pane fade" id="company">

								<form role="form" action="#" method="post" id="CompanyPro" name="CompanyPro">
									<div class="form-group">
										<label class="control-label">Company Name</label>
										<input type="text" class="form-control" id="company_name" name="company_name"value="<?=$company_name; ?>">
									</div>
									<div class="form-group">
										<label class="control-label">Registration No</label>
										<input type="text" placeholder="EUXXXXXXXXXXXXX" class="form-control"id="registration_number" name="registration_number"value="<?=$registration_number; ?>">
									</div>
									<div class="form-group">
										<label class="control-label">Company Address</label>
										<input type="text" placeholder="Acme Street" class="form-control"id="company_address" name="company_address"value="<?=$company_address; ?>">
									</div>
									<div class="form-group">
                                        <label class="select">Location</label><br>
							             <select id="country_code" name="country_code" required style="background-color: #ffffff;width: 100%">
                                <option value="" disabled selected>-- Select a country * --</option>
                                             <?=$country_list2; ?>
							             </select>
							             <i></i>	
									</div>
									<div class="form-group">
										<label class="control-label">Industry</label>
										<input type="text" placeholder="Waste Management" class="form-control"id="industry" name="industry"value="<?=$industry; ?>">
									</div>
									<div class="form-group">
										<label class="control-label">Website Url</label>
										<input type="text" class="form-control" id="website_url" name="website_url"value="<?=$website_url; ?>">
									</div>
									<div class="margiv-top10">
										<button id="btnSubmit" type="submit" class="btn btn-primary pull-right"><i id="icnCheck" name="icnCheck" class="fa fa-check"></i><i style='text-align: center;padding-right: 0px;display:none;' class="glyphicon glyphicon-refresh" id="icnSpinner" name="icnSpinner"></i>Save Profile</button>
                                        <button class="btn btn-danger pull-right">Cancel</button>
									</div>
								</form>

									</div-->

							<!-- /Company TAB -->
                            
                            <!-- supplier TAB -->
							<div class="tab-pane fade" id="supplier">

								<form role="form" action="/updatesupplierfirsttime" method="post" id="SupName" name="SupName">
									<div class="form-group">
										<label class="control-label">Supplier Name *</label>
										<input type="text" class="form-control" id="supplier_name" name="supplier_name"value="<?=$supplier_name; ?>">
									</div>
									<div class="form-group">
										<label class="control-label">Address 1 *</label>
										<input type="text" class="form-control"id="supplier_addr1" name="supplier_addr1"value="<?=$supplier_addr1; ?>">
									</div>
                                    <div class="form-group">
										<label class="control-label">Address 2</label>
										<input type="text" class="form-control"id="supplier_addr2" name="supplier_addr2"value="<?=$supplier_addr2; ?>">
									</div>
                                      <div class="form-group">
										<label class="control-label">State</label>
										<input type="text" class="form-control"id="supplier_state" name="supplier_state"value="<?=$supplier_state; ?>">
									</div>
                                      <div class="form-group">
										<label class="control-label">Postal Code *</label>
										<input type="text" class="form-control"id="supplier_postal" name="supplier_postal"value="<?=$supplier_postal; ?>">
									</div>
									<div class="form-group">
                                        <label class="select">Country *</label><br>
							             <select id="supplier_country_code" name="supplier_country_code" required style="background-color: #ffffff;width: 100%">
                                <option value="" disabled selected>-- Select a country * --</option>
                                             <?=$supplier_country_code; ?>
							             </select>
							             <i></i>	
									</div>
<!--
									<div class="form-group">
										<label class="control-label">Email *</label>
										<input type="text" class="form-control"id="supplier_email" name="supplier_email"value="">
									</div>
-->
									<div class="form-group">
										<label class="control-label">Phone 1 *</label>
										<input type="text" class="form-control" id="supplier_phone1" name="supplier_phone1"value="<?=$supplier_phone1; ?>">
									</div>
                                    	<div class="form-group">
										<label class="control-label">Phone 2</label>
										<input type="text" class="form-control" id="supplier_phone2" name="supplier_phone2"value="<?=$supplier_phone2; ?>">
									</div>
                                    	<div class="form-group">
										<label class="control-label">Credit Terms *</label>
										<input type="text" class="form-control" id="supplier_credit_terms" name="supplier_credit_terms"value="<?=$supplier_credit_terms; ?>">
									</div>
									<div class="margiv-top10">
										<button id="btnSubmitSupp" type="submit" class="btn btn-primary pull-right"><i id="icnCheck" name="icnCheck" class="fa fa-check"></i><i style='text-align: center;padding-right: 0px;display:none;' class="glyphicon glyphicon-refresh" id="icnSpinner" name="icnSpinner"></i>Save Profile</button>
                                        <button class="btn btn-danger pull-right">Cancel</button>
									</div>
								</form>

									</div>

							<!-- /supplier TAB -->
						</div>

					</div>


					<!-- LEFT -->
					<div class="col-lg-3 col-md-3 col-sm-4 col-lg-pull-9 col-md-pull-9 col-sm-pull-8">
					
						<div class="thumbnail text-center">
							<img class="img-responsive" src="<?= $image; ?>" alt="" />
							<h2 class="size-18 margin-top-10 margin-bottom-0">
                                <?=$user_name;?>
                            </h2>
							<h3 class="size-20 margin-top-0 margin-bottom-10"><?=$first_name. ' ' .$last_name ?></h3>
						</div>
                        <!--div class="profile selection" required style="background-color:#ffffff;border:1px solid;border-color:#ddd;border-radius:4px;margin-bottom:20px">
                        <label class="switch switch-default switch-round" style="margin-top:10px; margin-bottom:10px; margin-left:20px; margin-right:0px;">
                            <b>Profile Selection</b>&nbsp; <input id="chk_buyer" name="chk_buyer" type="checkbox" checked="">
                            <span id="span_buyer" class="switch-label" data-on="Buyer" data-off="Seller"></span>
                        </label>
                        </div-->
                        
                    </div>
                        </div>                                          
						<!-- completed -->
                        <!--
						<div class="margin-bottom-30">
							<label>88% completed profile</label>
							<div class="progress progress-xxs">
								<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100" style="width: 88%; min-width: 2em;"></div>
							</div>
						</div>
						<!-- /completed -->

						<!-- SIDE NAV -->
                        <!--
						<ul class="side-nav list-group margin-bottom-60" id="sidebar-nav">
							<li class="list-group-item"><a href="page-profile-projects.html"><i class="fa fa-tasks"></i> Quoutations</a></li>
							<li class="list-group-item"><a href="l"><i class="fa fa-history"></i>Invocices</a></li>
							<li class="list-group-item active"><a href="profile.php"><i class="fa fa-gears"></i> Settings</a></li>
						</ul>
						<!-- /SIDE NAV -->


						<!-- info -->
						
    
    
    
