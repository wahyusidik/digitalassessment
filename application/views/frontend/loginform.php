<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.1.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>SDMP | Log in</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo PLUGIN_PATH; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo PLUGIN_PATH; ?>simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo PLUGIN_PATH; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo PLUGIN_PATH; ?>uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo PLUGIN_PATH; ?>select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo CSS_PATH; ?>pages/login-soft.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo CSS_PATH; ?>components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo CSS_PATH; ?>plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo CSS_PATH; ?>layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo CSS_PATH; ?>themes/darkblue.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo CSS_PATH; ?>custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="index.html">
	<h2> Digital Assesment Center</h2>
	<!-- <img src="<?php echo IMG_PATH; ?>logo-big.png" alt=""/> -->
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="<?php echo base_url();?>register/validate" method="post">
		<h3 class="form-title">Masuk ke Akun Anda</h3>
		<div class="alert alert-danger display-hide error-validate">
			<button class="close" data-close="alert"></button>
			<span>
			Masukkan Email dan Password. </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Email</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" name="email"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
			<input type="checkbox" name="remember" value="1"/> Ingat saya</label>
			<button type="submit" class="btn blue pull-right">
			Masuk <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
		<div class="forget-password">
			<h4>Lupa password ?</h4>
			<p>
				klik link <a href="javascript:;" id="forget-password">ini</a>
				untuk reset password.
			</p>
		</div>
	</form>
	<!-- END LOGIN FORM -->
	<!-- BEGIN FORGOT PASSWORD FORM -->
	<form class="forget-form" action="index.html" method="post">
		<h3>Lupa Password ?</h3>
		<p>
			 Masukkan emal anda untuk reset your password.
		</p>
		<div class="form-group">
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
			</div>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn">
			<i class="m-icon-swapleft"></i> Kembali </button>
			<button type="submit" class="btn blue pull-right">
			Kirim <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END FORGOT PASSWORD FORM -->

</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright hide">
	 
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo PLUGIN_PATH; ?>jquery.min.js" type="text/javascript"></script>
<script src="<?php echo PLUGIN_PATH; ?>jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo PLUGIN_PATH; ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo PLUGIN_PATH; ?>jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo PLUGIN_PATH; ?>uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo PLUGIN_PATH; ?>jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo PLUGIN_PATH; ?>jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo PLUGIN_PATH; ?>backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo PLUGIN_PATH; ?>select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo JS_PATH; ?>core/app.js" type="text/javascript"></script>
<script src="<?php echo JS_PATH; ?>layout.js" type="text/javascript"></script>
<script src="<?php echo JS_PATH; ?>demo.js" type="text/javascript"></script>
<script src="<?php echo JS_PATH; ?>custom/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
  Metronic.init(); // init metronic core components
Layout.init(); // init current layout
  Login.init();
  Demo.init();
       // init background slide images
       $.backstretch([
        "<?php echo IMG_PATH; ?>1.jpg",
        ], {
          fade: 1000,
          duration: 8000
    }
    );
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>