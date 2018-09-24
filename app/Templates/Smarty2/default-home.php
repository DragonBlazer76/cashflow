<?php
/**
 * Default Layout - a Layout similar with the classic Header and Footer files.
 */

// Generate the Language Changer menu.
$language = Language::code();

$languages = Config::get('languages');

//
ob_start();

foreach ($languages as $code => $info) {
?>
<li <?php if($language == $code) echo 'class="active"'; ?>>
    <a href='<?= site_url('language/' .$code); ?>' title='<?= $info['info']; ?>'><?= $info['name']; ?></a>
</li>
<?php
}

$langMenuLinks = ob_get_clean();
?>
<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	
<html lang="<?= $language; ?>">
 <!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<title><?= $title .' - ' .Config::get('app.name', SITETITLE); ?></title>
		<meta name="keywords" content="Cashflow,Auction,Buyer,Seller,Supplier,SME" />
		<meta name="description" content="" />
		<meta name="Author" content="Lignar Labs Pte Ltd" />

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

		<!-- WEB FONTS : use %7C instead of | (pipe) -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />
        
        <?php
        echo isset($meta) ? $meta : ''; // Place to pass data / plugable hook zone

        Assets::css([
        template_url('plugins/bootstrap/css/bootstrap.min.css', 'Smarty2'),
        template_url('css/essentials.css', 'Smarty2'),
        template_url('css/layout.css', 'Smarty2'),
        template_url('css/header-1.css', 'Smarty2'),
        template_url('css/color_scheme/green.css', 'Smarty2'),
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css',
//        template_url('css/icofont.css', 'Smarty2'),
        //    vendor_url('dist/css/bootstrap-theme.min.css', 'twbs/bootstrap'),
        //    'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css',
        //    template_url('css/style.css', 'Default'),
        ]);

        echo isset($css) ? $css : ''; // Place to pass data / plugable hook zone
        ?>
        
        <?php
        Assets::js([
        template_url('plugins/jquery/jquery-2.1.4.min.js', 'Smarty2'),
        template_url('js/scripts.js', 'Smarty2'),
//        template_url('plugins/styleswitcher/styleswitcher.js', 'Smarty2'),
        template_url('js/contact.js', 'Smarty2'),
//        template_url('js/app.js', 'Smarty2'),
        ]);

        echo isset($js) ? $js : ''; // Place to pass data / plugable hook zone

        ?>
        <!--script async type="text/javascript" src="<?= site_url();?>/templates/smarty2/assets/plugins/styleswitcher/styleswitcher.js"></script-->
        </head>


        <?= isset($afterBody) ? $afterBody : ''; // Place to pass data / plugable hook zone ?>
	<body class="smoothscroll enable-animation">

		<!-- wrapper -->
		<div id="wrapper">

				<div id="header" class="sticky transparent header-md clearfix">

				<!-- TOP NAV -->
				<header id="topNav">
					<div class="container">

						<!-- Mobile Menu Button -->
						<button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
							<i class="fa fa-bars"></i>
						</button>

						<!-- Logo -->
						<a class="logo pull-left scrollTo" href="#top">
							<img src="<?= template_url('/images/speedcash2.png', "Smarty2"); ?>" alt="speedca$h.to/." />
							<img src="<?= template_url('/images/speedcash1.png', "Smarty2"); ?>" alt="speedca$h.to/." />
						</a>

						<!-- 
							Top Nav 
							
							AVAILABLE CLASSES:
							submenu-dark = dark sub menu
						-->
						<div class="navbar-collapse pull-right nav-main-collapse collapse">
							<nav class="nav-main">

								<!-- 
									.nav-onepage
									Required for onepage navigation links
									
									Add .external for an external link!
								-->
								<ul id="topMain" class="nav nav-pills nav-main nav-onepage">
									<li class="active"><!-- HOME -->
										<a href="#slider">
											HOME
										</a>
									</li>
									<li class="dropdown"><!-- ABOUT -->
										<a href="#about">
											ABOUT
										</a>
									</li>
									<li><!-- WORK -->
										<a href="#work">
											HOW DOES IT WORK
										</a>
									</li>
									<li><!-- SERVICES -->
										<a href="#features">
											FEATURES
										</a>
									</li>
									<li><!-- CONTACT -->
										<a href="#contact">
											CONTACT
										</a>
									</li>
									<li><!-- CONTACT -->
										<a href="login">
											LOGIN/REGISTER
										</a>
									</li>
								</ul>

							</nav>
						</div>

					</div>
				</header>
				<!-- /Top Nav -->

			</div>


			<!-- SLIDER -->
			<section id="slider" class="fullheight parallax parallax-4" style="background-image:url('assets/Smarty2/assets/images/demo/1200x800/12-min.jpg');">
				<div class="overlay dark-5"><!-- dark overlay [0 to 9 opacity] --></div>

				<div class="display-table">
					<div class="display-table-cell vertical-align-middle">
						<div class="container">

							<div class="slider-featured-text text-center">
								<h1 class="text-white wow fadeInUp" data-wow-delay="0.4s">
                                    Welcome to Speedca<label style="color:#30c5b5;display:initial;" class="weight-600">$</label>h.to/<label style="color:#30c5b5;display:initial;" class="weight-600">.</label>
								</h1>
								<h2 class="weight-300 text-white wow fadeInUp" data-wow-delay="0.8s" style="padding-top:20px;">Take Your Business To The Next Level</h2>
							</div>
				
						</div>
					</div>
				</div>

			</section>
			<!-- /SLIDER -->



			<!-- CALLOUT -->
			<section class="callout-dark heading-title heading-arrow-bottom" style="z-index:100;">
				<div class="container">

					<div class="text-center">
						<h3 class="size-30">We Think Different That Others Can't</h3>
						<p>We can't solve problems by using the same kind of thinking we used when we created them.</p>
					</div>

				</div>
			</section>
			<!-- /CALLOUT -->



			<!-- ABOUT -->
			<section id="about">
				<div class="container">

					<header class="text-center margin-bottom-60">
						<h2>We Are Speedca$h.to/.</h2>
						<p class="lead font-lato">Start Speedca$h.to/., You and your Business Partners</p>
						<hr />
					</header>


					<div class="row">

						<div class="col-sm-6">
							<img class="img-responsive" src="<?= template_url('/images/about.jpg', "Smarty2"); ?>" alt="" />
						</div>

						<div class="col-sm-6">
							<p class="dropcap">We are a team of techies and ex-bankers that are out to simplify finance for SMEs, enabling them to grow faster and smarter</p>

							<hr />

						</div>

					</div>


				</div>
			</section>
			<!-- /ABOUT -->
			<!-- -->
<!--
			<section>
				<div class="container">
			     
                    <div class="container">
                    <header class="text-center margin-bottom-5">
						<h4>What are we helping to solve?</h4>
						<p class="lead font-lato">We seeked to find the pain point of our customers</p>
						<div class="divider divider-center"> divider 
						<i class="fa fa-chevron-down"></i>
					</div>
				    </header>
                    </div>
                    
					<div class="row">
-->
					
                        <!---->
<!--
						<div class="col-lg-4 col-md-4 col-sm-4">
							<figure class="margin-bottom-20">
								<img class="img-responsive" src="<?= template_url('images/toomuchmoney.jpg', "Smarty2"); ?>" alt="Traditional Processes" />
							</figure>

							<h4 class="nomargin-bottom">Higher Returns</h4>
							<small class="font-lato size-18 margin-bottom-30 block">Cumbersome and tedious</small>
							<p class="text-muted size-14">Getting higher return on cash and getting paid early.</p>
							
						</div>

						<div class="col-lg-4 col-md-4 col-sm-4">
							<figure class="margin-bottom-20">
								<img class="img-responsive" src="<?= template_url('images/toomuchmoney.jpg', "Smarty2"); ?>" alt="service" />
							</figure>

							<h4 class="nomargin-bottom">Returns</h4>
							<small class="font-lato size-18 margin-bottom-30 block">It's very simple but powerful</small>
							<p class="text-muted size-14">On the other hand, buyers who are sitting on excess cash often earn negligible returns on this cash</p>

						</div>

					</div>

				</div>
			</section>
-->
			<!-- / -->
			
			<!-- -->
			<section id="work">
				<div class="container">

					<header class="text-center">
						<h2 class="nomargin">How does Speedca$h.to/. works</h2>
						<p class="font-lato size-20 nomargin">We truly care about our customers</p>
					</header>
					
					<div class="divider divider-center"><!-- divider -->
						<i class="fa fa-chevron-down"></i>
					</div>

					<ul class="process-steps nav nav-tabs nav-justified margin-top-100">
						<li class="active">
							<a href="#step1" data-toggle="tab">1</a>
							<h5>Reduce Waiting Time</h5>
						</li>
						<li>
							<a href="#step2" data-toggle="tab">2</a>
							<h5>Simplfy Process</h5>
						</li>
						<li>
							<a href="#step3" data-toggle="tab">3</a>
							<h5>Familiar Auction System</h5>
						</li>
						<li>
							<a href="#step4" data-toggle="tab">4</a>
							<h5>Higher Returns</h5>
						</li>
					</ul>

					<div class="tab-content margin-top-30">
						<div class="tab-pane active" id="step1">
							<strong>Reach</strong> Depending on your trade and working capital objectives, Speedca$h.to/. helps you reach out to your entire network of buyers and suppliers in a few easy clicks.
						</div>

						<div class="tab-pane" id="step2">
							<strong>User Friendly Interface</strong>  Speedca$h.to/ is simple to use and accessible to non-boarded trade partners. Thus you and your trade network can immediately participate and enjoy the full benefits of Speedca$h.to/.
						</div>

						<div class="tab-pane" id="step3">
							<strong>Familiar</strong> auctioning system which means there is no relearning needed.
						</div>

						<div class="tab-pane" id="step4">
							<strong>Automation made easier</strong>  Smart data collates and organizes responses efficiently from multiple buyers and suppliers for your easy decision-making; and with downloadable reports for user management.
						</div>

<!--
						<div class="tab-pane" id="step5">
							<strong>Result</strong>  cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.
						</div>
-->
					</div>

				</div>
			</section>
			<!-- / -->
            
            <!--supplier-->
            <section class="theme-color">

	       <div class="container">
				<header class="text-center">
						<h2 class="nomargin">Why buyers and suppliers love Speedca$h.to/.</h2>
						<p class="font-lato size-20 nomargin">With Speedca$h.to/, suppliers can now unlock cash in the supply chain by offering early payment discount.
                        </p>
				</header>
					
				<div class="divider divider-center"><!-- divider -->
						<i class="fa fa-chevron-down"></i>
				</div>
            </div>    
            </section>
            
        <section id="flip">           
        <div class="row" style="padding-top:15px; padding-right:100px;">
	               <div class="col-md-6">

		      <div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center">
			 <div class="front">
				<div class="box1">
                    <h3>What's in it for the supplier</h3>
				<div class="box-icon-title">
				    <i class="fa fa-tint"></i>
				    <h2>Improve your cashflow</h2>
				</div>
				<div class="box-icon-title">
				    <i class="fa fa-rocket"></i>
				    <h2>Access earlier payment</h2>
                </div>       
                <div class="box-icon-title">
				    <i class="fa fa-files-o"></i>
				    <h2>cut down paperwork and contracts</h2>
				</div>
				<div class="box-icon-title">
				    <i class="fa fa-mouse-pointer"></i>
				    <h2>Facilitate income in a few clicks</h2>
				</div>	           
				</div>
			 </div>

			<div class="back">
				<div class="box2">
						<h3>Speedca$h.to/. Buyer's flow</h3>
					<hr />
					<img class="img-responsive" src="<?= template_url('images/supplier.png', "Smarty2"); ?>" alt="" />
				</div>
			</div>
		</div>

	</div>

	<div class="col-md-6">
		<div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center">
			<div class="front">
				<div class="box1">
	               <h3>What's in it for the buyer</h3>
					<div class="box-icon-title">
						<i class="fa fa-money"></i>
						<h2>Generate higher returns on cash</h2>
					</div>
                <div class="box-icon-title">
						<i class="fa fa-random"></i>
						<h2>Improve finanical health of supply chain</h2>
				</div>
                <div class="box-icon-title">
						<i class="fa fa-random"></i>
						<h2>Improve gross margin &amp; EBITDA</h2>
				</div>
                <div class="box-icon-title">
						<i class="fa fa-balance-scale"></i>
						<h2>Increase your profitability</h2>
				</div>    
                </div>    
			</div>

			<div class="back">
				<div class="box2">
					<h3>Speedca$h.to/. Buyer's flow</h3>
					<hr />
					<img class="img-responsive" src="<?= template_url('images/buyer.png', "Smarty2"); ?>" alt="" />
				</div>
			</div>
		</div>

	</div>
		</div>
	    </section>       
            <!--/supplier-->

        
              
			<!-- SERVICES -->
			<section id="features">
				<div class="container">

					<header class="text-center margin-bottom-60">
						<h2>Our Features</h2>
						<p class="lead font-lato">We enable Speedca$h.to be easier and smarter between businesses</p>
						<hr />
					</header>

					<p class="lead">We help you to cut through the long and winding process of getting suppliers and vendors to get payment done in timely and efficient manner with our state of the art auctioning and bidding system.</p>
					
					<div class="divider divider-center divider-color"><!-- divider -->
						<i class="fa fa-chevron-down"></i>
					</div>

					<!-- FEATURED BOXES 3 -->
					<div class="row">

						<div class="col-md-4 col-xs-6">
							<div class="text-center">
								<i class="ico-color ico-lg ico-rounded ico-hover et-laptop"></i>
								<h4>Dashboard</h4>
								<p class="font-lato size-14">View your entire supply chain at a glance</p>
							</div>
						</div>
						<div class="col-md-4 col-xs-6">
							<div class="text-center">
								<i class="ico-color ico-lg ico-rounded ico-hover et-adjustments"></i>
								<h4>Administration</h4>
								<p class="font-lato size-14">Customise your user access levels for your company.</p>
							</div>
						</div>
						<div class="col-md-4 col-xs-6">
							<div class="text-center">
								<i class="ico-color ico-lg ico-rounded ico-hover et-wallet"></i>
                                <h4>Make Money</h4>
								<p class="font-lato size-14">Enable cheaper financing for you and your partners.</p>
							</div>
						</div>
						<div class="col-md-4 col-xs-6">
							<div class="text-center">
								<i class="ico-color ico-lg ico-rounded ico-hover et-streetsign"></i>
								<h4>Business Analytics</h4>
								<p class="font-lato size-14">Coming Soon</p>
							</div>
						</div>

						<div class="col-md-4 col-xs-6">
							<div class="text-center">
								<i class="ico-color ico-lg ico-rounded ico-hover et-piechart"></i>
								<h4>Profit Margins</h4>
								<p class="font-lato size-14">Improve your profit margins</p>
							</div>
						</div>
						<div class="col-md-4 col-xs-6">
							<div class="text-center">
								<i class="ico-color ico-lg ico-rounded ico-hover et-mobile"></i>
								<h4>Mobile</h4>
								<p class="font-lato size-14">Coming soon</p>
							</div>
						</div>

					</div>
					<!-- /FEATURED BOXES 3 -->

				</div>
			</section>
			
			<!-- /SERVICES -->


			<!-- CONTACT -->
			<section id="contact">
				<div class="container">

					<header class="text-center margin-bottom-60">
						<h2>Contact Us</h2>
						<p class="lead font-lato">Drop us an message! We promise we won't bite</p>
						<hr />
					</header>


					<div class="row">

						<!-- FORM -->
						<div class="col-md-12 col-sm-12">

							<h3>Drop us a line or just say <strong><em>Hello!</em></strong></h3>

							
							<!--
								MESSAGES
								
									How it works?
									The form data is posted to php/contact.php where the fields are verified!
									php.contact.php will redirect back here and will add a hash to the end of the URL:
										#alert_success 		= email sent
										#alert_failed		= email not sent - internal server error (404 error or SMTP problem)
										#alert_mandatory	= email not sent - required fields empty
										Hashes are handled by assets/js/contact.js

									Form data: required to be an array. Example:
										contact[email][required]  WHERE: [email] = field name, [required] = only if this field is required (PHP will check this)
										Also, add `required` to input fields if is a mandatory field. 
										Example: <input required type="email" value="" class="form-control" name="contact[email][required]">

									PLEASE NOTE: IF YOU WANT TO ADD OR REMOVE FIELDS (EXCEPT CAPTCHA), JUST EDIT THE HTML CODE, NO NEED TO EDIT php/contact.php or javascript
												 ALL FIELDS ARE DETECTED DINAMICALY BY THE PHP

									WARNING! Do not change the `email` and `name`!
												contact[name][required] 	- should stay as it is because PHP is using it for AddReplyTo (phpmailer)
												contact[email][required] 	- should stay as it is because PHP is using it for AddReplyTo (phpmailer)
							-->

							<!-- Alert Success -->
							<div id="alert_success" class="alert alert-success margin-bottom-30">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Thank You!</strong> Your message successfully sent! We will contact you shortly.
							</div><!-- /Alert Success -->


							<!-- Alert Failed -->
							<div id="alert_failed" class="alert alert-danger margin-bottom-30">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Error!</strong> Internal server error!
							</div><!-- /Alert Failed -->


							<!-- Alert Mandatory -->
							<div id="alert_mandatory" class="alert alert-danger margin-bottom-30">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Sorry!</strong> You need to complete all mandatory (*) fields!
							</div><!-- /Alert Mandatory -->


							<form id="frmContact" name="frmContact" action="/contact" method="post" enctype="multipart/form-data">
								<fieldset>
									<input type="hidden" name="action" value="contact_send" />

									<div class="row">
										<div class="form-group">
											<div class="col-md-4">
												<label for="contact:name">Full Name *</label>
												<input required type="text" value="" class="form-control" name="contact_name" id="contact_name">
											</div>
											<div class="col-md-4">
												<label for="contact:email">E-mail Address *</label>
												<input required type="email" value="" class="form-control" name="contact_email" id="contact_email">
											</div>
											<div class="col-md-4">
												<label for="contact:phone">Phone</label>
												<input type="text" value="" class="form-control" name="contact_phone" id="contact_phone">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<div class="col-md-12">
												<label for="contact:subject">Subject *</label>
												<input required type="text" value="" class="form-control" name="contact_subject" id="contact_subject">
											</div>
											
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<div class="col-md-12">
												<label for="contact:message">Message *</label>
												<textarea required maxlength="10000" rows="8" class="form-control" name="contact_message" id="contact_message"></textarea>
											</div>
										</div>
									</div>

								</fieldset>

								<div class="row">
									<div class="col-md-12">
										<button id="btnSubmit" name="btnSubmit" type="submit" class="btn btn-primary"><i id="icnSpinner" class="fa fa-check" style='text-align: center;padding-right: 0px;'></i> SEND MESSAGE</button>
									</div>
								</div>
							</form>

						</div>
						<!-- /FORM -->


						<!-- INFO -->
<!--
						<div class="col-md-4 col-sm-4">

							<h2>Visit Us</h2>

							 
							Available heights
								height-100
								height-150
								height-200
								height-250
								height-300
								height-350
								height-400
								height-450
								height-500
								height-550
								height-600
							
							<div id="map2" class="height-400 grayscale"></div>

							<hr />

							<p>
								<span class="block"><strong><i class="fa fa-map-marker"></i> Address:</strong> Street Name, City Name, Country</span>
								<span class="block"><strong><i class="fa fa-phone"></i> Phone:</strong> <a href="tel:1800-555-1234">1800-555-1234</a></span>
								<span class="block"><strong><i class="fa fa-envelope"></i> Email:</strong> <a href="mailto:mail@yourdomain.com">mail@yourdomain.com</a></span>
							</p>

						</div>
-->
						<!-- /INFO -->

					</div>

				</div>
			</section>
			<!-- /CONTACT -->



			<!-- FOOTER -->
			<footer id="footer">
				<div class="container">

					<div class="row">
						
						<div class="col-md-4">
							<!-- Footer Logo -->
                            <img src="<?= template_url('/images/speedcash2.png', "Smarty2"); ?>" alt="speedca$h.to/."  width="252px" height="72px" />

							<!-- Small Description -->
							<p>Taking your business to the next level</p>

							<!-- Contact Address -->
							<address>
								<ul class="list-unstyled">
									<li class="footer-sprite address">
										SINGAPORE 608582<br>
										40 Toh Guan Road East 164/165<br>
										Enterprise Hub,<br>
									</li>
									<li class="footer-sprite phone">
										Phone: +65 6777 5383
									</li>
									<li class="footer-sprite email">
										<a href="mailto:support@cashflow.to">support@cashflow.to</a>
									</li>
								</ul>
							</address>
							<!-- /Contact Address -->

						</div>

						<div class="col-md-3">

							<!-- Links -->
							<h4 class="letter-spacing-1">EXPLORE SPEEDCA$H.TO/.</h4>
							<ul class="footer-links list-unstyled">
								<li><a href="#">Home</a></li>
								<li><a href="#about">About</a></li>
								<li><a href="#work">How Does It Work</a></li>
								<li><a href="#features">Features</a></li>
								<li><a href="#contact">Contact Us</a></li>
							</ul>
							<!-- /Links -->

						</div>

						<div class="col-md-4">

							<!-- Newsletter Form -->
							<h4 class="letter-spacing-1">KEEP IN TOUCH</h4>
							<p>Subscribe to Our Newsletter to get Important News &amp; Offers</p>
                           
							<form id="frmSubscribe" name="frmSubscribe" action="/subscribe" method="post" enctype="multipart/form-data">
								<div class="input-group">
									<span class="input-group-addon"><i id="icnSubscribe" class="fa fa-envelope"></i></span>
									<input type="email" id="sub_email" name="sub_email" class="form-control required" placeholder="Enter your Email">
									<span class="input-group-btn">
										<button id="btnSubscribe" name="btnSubscribe" class="btn btn-success" type="submit">Subscribe</button>
									</span>
								</div>
							</form>
							<!-- /Newsletter Form -->

							<!-- Social Icons -->
							<div class="margin-top-20">
								<a href="#" class="social-icon social-icon-border social-facebook pull-left" data-toggle="tooltip" data-placement="top" title="Facebook">

									<i class="icon-facebook"></i>
									<i class="icon-facebook"></i>
								</a>

								<a href="#" class="social-icon social-icon-border social-linkedin pull-left" data-toggle="tooltip" data-placement="top" title="Linkedin">
									<i class="icon-linkedin"></i>
									<i class="icon-linkedin"></i>
								</a>

							</div>
							<!-- /Social Icons -->

						</div>

					</div>

				</div>

				<div class="copyright">
					<div class="container">
						<ul class="pull-right nomargin list-inline mobile-block">
							<li><a href="#">Terms &amp; Conditions</a></li>
							<li>&bull;</li>
							<li><a href="#">Privacy</a></li>
						</ul>
						&copy; All Rights Reserved, Speedca$h.to/. Pte Ltd
					</div>
				</div>
			</footer>
			<!-- /FOOTER -->
        </div>
		<!-- /wrapper -->
    

		<!-- SCROLL TO TOP -->
		<a href="#" id="toTop"></a>


<!--
		 PRELOADER 
		<div id="preloader">
			<div class="inner">
				<span class="loader"></span>
			</div>
-->
<!--		</div> /PRELOADER -->

        


<!--   DO NOT DELETE! - Forensics Profiler -->
    <script type="text/javascript">var plugin_path = 'assets/Smarty2/assets/plugins/'</script>
    <!--script async type="text/javascript" src="assets/plugins/styleswitcher/styleswitcher.js"></script-->
        <?php template_url('plugins/styleswitcher/styleswitcher.js', 'Smarty2') ?>
