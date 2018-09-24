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
<!doctype html>
<html lang="en-US">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title><?= $title .' - ' .Config::get('app.name', SITETITLE); ?></title>
		<meta name="description" content="" />
		<meta name="Author" content="Lignar Labs Pte Ltd" />

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

		<!-- WEB FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />

		<!-- CORE CSS -->
		<!--link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<!-- THEME CSS -->
		<!-- link href="assets/css/essentials.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/layout.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" /-->
<?php
echo isset($meta) ? $meta : ''; // Place to pass data / plugable hook zone

Assets::css([
    template_url('plugins/bootstrap/css/bootstrap.min.css', 'smarty'),
    template_url('css/essentials.css', 'smarty'),
    template_url('css/layout.css', 'smarty'),
    template_url('css/color_scheme/green.css', 'smarty'),
    template_url('/css/font-awesome.min.css', 'smarty'),
]);

echo isset($css) ? $css : ''; // Place to pass data / plugable hook zone
?>
	</head>
	<!--
		.boxed = boxed version
	-->
	<body style="background-image: url('templates/smarty/assets/images/login.jpg'); no-repeat center center fixed;-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">


        <?= $content; ?>

<?php
    
    //Assets::js([
    //    'https://code.jquery.com/jquery-1.12.4.min.js',
    //    vendor_url('dist/js/bootstrap.min.js', 'twbs/bootstrap'),
    //]);

//    Assets::js([
//        template_url('plugins/jquery/jquery-2.1.4.min.js', 'smarty'),
//        template_url('js/app.js', 'smarty'),
//    ]);
//
//    echo isset($js) ? $js : ''; // Place to pass data / plugable hook zone

    echo isset($footer) ? $footer : ''; // Place to pass data / plugable hook zone
?>

<!-- DO NOT DELETE! - Forensics Profiler -->
    <script type="text/javascript">var plugin_path = 'assets/Smarty/assets/plugins/';</script>
	</body>
</html>
