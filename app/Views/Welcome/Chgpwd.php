<div class="padding-15">

			<div class="login-box">

				<!--
				<div class="alert alert-danger">Complete all fields!</div>
				-->
                <div id="divInfo" name="divInfo" class="alert alert-danger" style="<?=$alert_style;?>">
					The link has expired. Please click <a href="recover">here</a> to go back and resend the link again.
				</div>
				<!-- change password form -->
				<form id="chgpwd_frm" name="chgpwd_frm" action="chgpwd2" method="post" class="sky-form boxed" style="<?=$form_style;?>">
					<header><i class="fa fa-users"></i>  <?=$message;?></header>
					
					<fieldset>					
					
						<label class="input">
							<i class="icon-append fa fa-lock"></i>
							<input id="new_pwd" name="new_pwd" type="password" placeholder="New Password" required>
							<b class="tooltip tooltip-bottom-right">Password needs at least 8 characters long, alphanumeric with at least 1 cap</b>
						</label>
					
						<label class="input">
							<i class="icon-append fa fa-lock"></i>
							<input id="cfm_pwd" name="cfm_pwd" type="password" placeholder="Confirm password" required>
							<b class="tooltip tooltip-bottom-right">Password needs at least 8 characters long, alphanumeric with at least 1 cap</b>
						</label>
                        
                        <input id="hid_email" name="hid_email" type="hidden" value="<?=$hid_email;?>">
                        <input id="hid_token" name="hid_token" type="hidden" value="<?=$hid_token;?>">
					</fieldset>

					<footer>
						<button id="btnSubmit" type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i><i style='text-align: center;padding-right: 0px;display:none;' class="glyphicon glyphicon-refresh" id="icnSpinner" name="icnSpinner"></i> Reset Password</button>
					</footer>

				</form>
				<!-- /change password form -->


			</div>

		</div>

<?php
    Assets::js([
        template_url('plugins/jquery/jquery-2.1.4.min.js', 'smarty'),
        template_url('js/app.js', 'smarty'),
        template_url('js/login.js', 'smarty'),
    ]);

    echo isset($js) ? $js : ''; // Place to pass data / plugable hook zone

?>