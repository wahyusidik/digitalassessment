<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="index.html" method="post">
		<div class="form-title">
			<span class="form-title">Selamat Datang.</span>
			<span class="form-subtitle">Silakan login.</span>
		</div>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Masukkan username dan password. </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary btn-block uppercase">Login</button>
		</div>
		<div class="form-actions">
			<div class="pull-left">
				<label class="rememberme check">
				<input type="checkbox" name="remember" value="1"/>Ingat saya </label>
			</div>
			<div class="pull-right forget-password-block">
				<a href="javascript:;" id="forget-password" class="forget-password">Lupas Password?</a>
			</div>
		</div>
	</form>
	<!-- END LOGIN FORM -->
	<!-- BEGIN FORGOT PASSWORD FORM -->
	<form class="forget-form" action="index.html" method="post">
		<div class="form-title">
			<span class="form-title">Lupa Password ?</span>
			<span class="form-subtitle">Masukkan email untuk mereset password Anda.</span>
		</div>
		<div class="form-group">
			<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn btn-default">Back</button>
			<button type="submit" class="btn btn-primary uppercase pull-right">Submit</button>
		</div>
	</form>
	<!-- END FORGOT PASSWORD FORM -->