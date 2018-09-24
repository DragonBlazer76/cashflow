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
<html lang="<?= $language; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title><?= $title .' - ' .Config::get('app.name', SITETITLE); ?></title>		
    <meta name="description" content="" />
    <meta name="Author" content="Lignar Labs Pte Ltd" />

    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

    <!-- WEB FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />

    <!-- CORE CSS -->
    <!--link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /-->

    <!-- THEME CSS -->
    <!-- link href="assets/css/essentials.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" /-->
    
<?php
echo isset($meta) ? $meta : ''; // Place to pass data / plugable hook zone

Assets::css([
    template_url('plugins/jquery/jquery-ui.min.css', 'smarty'),
    template_url('/plugins/bootstrap/css/bootstrap.min.css', 'smarty'),
    template_url('/css/essentials.css', 'smarty'),
    template_url('/css/layout.css', 'smarty'),
    template_url('/css/color_scheme/green.css', 'smarty'),
    'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css',
    template_url('/css/icofont.css', 'smarty'),
    template_url('/css/bootstrap-tour.min.css', 'smarty'),
]);

echo isset($css) ? $css : ''; // Place to pass data / plugable hook zone
?>
</head>
<body class="tour-step tour-step-seven">


<?= isset($afterBody) ? $afterBody : ''; // Place to pass data / plugable hook zone ?>

		<!-- WRAPPER -->
		<div id="wrapper">

			<!-- 
				ASIDE 
				Keep it outside of #wrapper (responsive purpose)
			-->
			<aside id="aside">
				<!--
					Always open:
					<li class="active alays-open">

					LABELS:
						<span class="label label-danger pull-right">1</span>
						<span class="label label-default pull-right">1</span>
						<span class="label label-warning pull-right">1</span>
						<span class="label label-success pull-right">1</span>
						<span class="label label-info pull-right">1</span>
				-->
                    <div class="text-center margin-left-20 margin-right-20 margin-top-10">
                        <img class="img-responsive margin-bottom-10" src="<?= (empty(Auth::user()->image))?'/assets/smarty/assets/images/noavatar.jpg':Auth::user()->image; ?>" alt="" style="width:80px;border-radius: 50%;" />
                        <h3 class="size-14 margin-top-0 margin-bottom-10 bold" style="color:#ffffff;"><?=Auth::user()->first_name . ' ' . Auth::user()->last_name; ?></h3>
                    </div>
                    <div class="profile selection" required style="background-color:#5a6667;">
                    <label class="switch switch switch-round" style="margin-top:10px; margin-left:20px; margin-right:0px;margin-bottom:20px;">
                        <b style="color:white;">Profile Selection</b>&nbsp; <input id="chk_profile" name="chk_profile" type="checkbox" <?php echo (Auth::user()->buyer_seller == 1) ? "checked" : "" ?>>
                        <span id="span_buyer" class="switch-label" data-on="Buyer" data-off="Seller"></span>
                    </label>
                    </div>
                
				<nav id="sideNav"><!-- MAIN MENU -->
 
                    
                   <!-- Navigation Bar-->
					<ul class="nav nav-list">
						<li class="<?= ($main_nav=='Dashboard')?'active':''; ?>"><!-- dashboard -->
							<a class="dashboard" href="/dashboard"><!-- warning - url used by default by ajax (if eneabled) -->
								<i class="main-icon fa fa-dashboard tour-step tour-step-two"></i> <span>Dashboard</span>                                
							</a>
						</li>
        <?php if (Auth::user()->buyer_seller == 1) { ?>
						<li class="<?= ($main_nav=='Auction')?'active':''; ?>">
							<a href="#">
								<i class="fa fa-menu-arrow pull-right"></i>
								<i class="main-icon fa fa-gavel"></i> <span class="tour-step tour-step-four">Auction</span>
							</a>
							<ul><!-- submenus -->
								<li class="<?= ($main_nav=='Auction') && ($sub_nav=='List')?'active':''; ?>"><a href="/listauction">Lists</a></li>
                                <li class="<?= ($main_nav=='Auction') && ($sub_nav=='Create')?'active':''; ?>"><a href="/auction/new/1">Create</a></li>
							</ul>
                        </li>
        <?php } ?>
                        <li class="<?= ($main_nav=='Invoice')?'active':''; ?>">
							<a href="#">
								<i class="fa fa-menu-arrow pull-right"></i>
								<i class="main-icon icofont icofont-file-text"></i> <span class="tour-step tour-step-three">Invoice</span>
							</a>
							<ul><!-- submenus -->
                        <?php if (Auth::user()->buyer_seller == 1) { ?>
								<li class="<?= ($main_nav=='Invoice') && ($sub_nav=='List')?'active':''; ?>"><a href="/listinvoice">Lists</a></li>
                                <li class="<?= ($main_nav=='Invoice') && ($sub_nav=='New')?'active':''; ?>"><a href="/invoice/new/1">New</a></li>
								<!--li><a href="graphs-morris.html">Import</a></li-->
                        <?php } else { ?>
                                <li class="<?= ($main_nav=='Invoice') && ($sub_nav=='List Bid')?'active':''; ?>"><a href="/listbid">List Bid</a></li>
                        <?php } ?>
							</ul>
						</li>
						<li class="<?= ($main_nav=='Settings')?'active':''; ?>">
							<a href="#">
                                <i class="fa fa-menu-arrow pull-right"></i>
								<i class="main-icon fa fa-gears"></i> <span class="tour-step tour-step-five">Settings</span>
							</a>
                            <ul><!-- submenus -->
								<li class="<?= ($main_nav=='Settings') && ($sub_nav=='Profile')?'active':''; ?>"><a href="/profile">Profile</a></li>
							</ul>
						</li>
					</ul>

					<!-- SECOND MAIN LIST -->
					<h3>MORE</h3>
					<ul class="nav nav-list">
						<li>
							<a href="/notification">
								<i class="main-icon fa fa-commenting"></i>
								<span class="pull-right label <?php echo (Auth::user()->msg_count > 0) ? "label-warning" : "label-default" ?>"><?=Auth::user()->msg_count; ?></span> <span class="tour-step tour-step-six">Notification</span>
							</a>
						</li>
					</ul>

				</nav>

				<span id="asidebg"><!-- aside fixed background --></span>
			</aside>
			<!-- /ASIDE -->


			<!-- HEADER -->
			<header id="header" style="border-bottom:1px solid;border-color:#ddd;">

				<!-- Mobile Button -->
				<button id="mobileMenuBtn"></button>

				<!-- Logo -->
				<span class="logo pull-left tour-step tour-step-one">
					<img src="/assets/smarty/assets/images/speedcash2.png" alt="admin panel" height="50" />
				</span>

				<!--form method="get" action="page-search.html" class="search pull-left hidden-xs">
					<input type="text" class="form-control" name="k" placeholder="Search for something..." />
				</form-->

				<nav>

					<!-- OPTIONS LIST -->
					<ul class="nav pull-right">

						<!-- USER OPTIONS -->
						<li class="dropdown pull-left">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<img class="user-avatar" alt="" src="<?= (empty(Auth::user()->image))?'/assets/smarty/assets/images/noavatar.jpg':Auth::user()->image; ?>" height="34" /> 
								<span class="user-name">
									<span class="hidden-xs">
										<?=Auth::user()->first_name . ' ' . Auth::user()->last_name; ?> <i class="fa fa-angle-down"></i>
                                        
									</span>
								</span>
                                
							</a>
							<ul class="dropdown-menu hold-on-click">
								<li><!-- my inbox -->
									<a href="/notification"><i class="fa fa-commenting"></i> Notification
										<span class="pull-right label <?php echo (Auth::user()->msg_count > 0) ? "label-warning" : "label-default" ?>"><?=Auth::user()->msg_count; ?></span>
									</a>
								</li>
								<li><!-- settings -->
									<a href="/profile"><i class="fa fa-cogs"></i> Settings</a>
								</li>

								<li class="divider"></li>

								<li><!-- logout -->
									<a href="/signout"><i class="fa fa-power-off"></i> Log Out</a>
								</li>
							</ul>
						</li>
						<!-- /USER OPTIONS -->

					</ul>
					<!-- /OPTIONS LIST -->

				</nav>

			</header>
			<!-- /HEADER -->


			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1><?=$title; ?></h1>
					<ol class="breadcrumb">
						<li><a href="#"><?=$main_nav;?></a></li>
						<li class="active"><?=$sub_nav;?></li>
                        <?php if (isset($sub_sub_nav)) { 
                            echo "<li class=\"active\">$sub_sub_nav</li>";
                        } ?>
					</ol>
				</header>
				<!-- /page title -->


				<div id="content" class="padding-20">

					 <?= $content; ?>

				</div>
			</section>
			<!-- /MIDDLE -->

		</div>



<!-- DO NOT DELETE! - Forensics Profiler -->
    <script type="text/javascript">var plugin_path = '/assets/smarty/assets/plugins/';</script>
</body>
</html>
