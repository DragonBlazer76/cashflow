        <div class="padding-15">

			<div class="login-box">

				<!--
				<div class="alert alert-danger noradius">Email not found!</div>
				<div class="alert alert-success noradius">Email sent!</div>
				-->
				<div id="divInfo" name="divInfo" class="alert alert-info" style="margin-bottom: 0px; display:none;">
					The reset link will be sent to your email address. Click the link and reset your account password.
				</div>
				<!-- password form -->
				<form id="recover_form" name="recover_form" action="reset" method="post" class="sky-form boxed ">
					<header><i class="fa fa-users"></i> Forgot Password</header>
					
					<fieldset>	
					
						<label class="label">E-mail</label>
						<label class="input">
							<i class="icon-append fa fa-envelope"></i>
							<input id="email" name="email" type="email" required>
							<span class="tooltip tooltip-top-right">Type your Email</span>
						</label>
						<a href="/">Back to Login</a>

					</fieldset>

					<footer>
						<button id="btnSubmit" type="submit" class="btn btn-primary pull-right"><i style='text-align: center;padding-right: 0px;' class="glyphicon glyphicon-refresh" id="icnSpinner" name="icnSpinner"></i>&nbsp; Reset Passsword</button>
					</footer>
				</form>
				<!-- /password form -->




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