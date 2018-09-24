		<div class="padding-15">

			<div class="login-box">

               <div id="divLoginErr" name="divLoginErr" class="alert alert-danger" style="margin-bottom: 0px;display:none;"><!-- DANGER -->
                    <strong>Oh snap! </strong><label id="divErrorSignInLabel" name="divErrorSignInLabel">Error</label>
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
				<form id="login_form" name="login_form" action="signin" method="post" class="sky-form boxed"  enctype="application/x-www-form-urlencoded">
                <!-- login form -->
 
					<header><i class="fa fa-users"></i> Sign In -  <a href="/">Speedca$h.to</a></header>

					<!--
					<div class="alert alert-danger noborder text-center weight-400 nomargin noradius">
						Invalid Email or Password!
					</div>

					<div class="alert alert-warning noborder text-center weight-400 nomargin noradius">
						Account Inactive!
					</div>

					<div class="alert alert-default noborder text-center weight-400 nomargin noradius">
						<strong>Too many failures!</strong> <br />
						Please wait: <span class="inlineCountdown" data-seconds="180"></span>
					</div>
					-->

					<fieldset>	
					
						<section>
							<label class="label">E-mail</label>
							<label class="input">
								<i class="icon-append fa fa-envelope"></i>
								<input id="email" name="email" type="email" class="form-control" required>
								<span class="tooltip tooltip-top-right">Email Address</span>
							</label>
						</section>
						
						<section>
							<label class="label">Password</label>
							<label class="input">
								<i class="icon-append fa fa-lock"></i>
								<input id="password" name="password" type="password" required>
								<b class="tooltip tooltip-top-right">Type your Password</b>
							</label>
							<label class="checkbox"><input id="chkloggedin" name="chkloggedin" type="checkbox" name="checkbox-inline"><i></i>Keep me logged in</label>
						</section>

					</fieldset>

					<footer>
						<button id="btnSubmit" type="submit" class="btn btn-primary pull-right"><i style='text-align: center;padding-right: 0px; display: none;' class="fa fa-spinner fa-pulse fa-fw" id="icnSpinner" name="icnSpinner"></i> Sign In</button>
						<div class="forgot-password pull-left">
							<a href="recover">Forgot password?</a> <br />
							<a href="register"><b>Need to Register?</b></a><br />
						</div>
					</footer>
				</form>
				<!-- /login form -->

				<!--hr />

				<div class="text-center" style="color: white;">
					Or sign in using:
				</div>


				<div class="socials margin-top-10 text-center">
					<a href="#" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
					<a href="#" class="btn btn-twitter"><i class="fa fa-twitter"></i> Twitter</a>
				</div-->

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