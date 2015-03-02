<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?= $data['_config']['base_url'] ?>images/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="<?= $data['_config']['base_url'] ?>images/apple-touch-icon.png">

        <title>Digital CSIP</title>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?= $data['_config']['base_url'] ?>uikit/css/uikit.gradient.css" />
        <link rel="stylesheet" href="<?= $data['_config']['base_url'] ?>uikit/css/components/datepicker.gradient.css" />
        <link rel="stylesheet" href="<?= $data['_config']['base_url'] ?>custom.css" />
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="<?= $data['_config']['base_url'] ?>uikit/js/uikit.js"></script>
		<script src="<?= $data['_config']['base_url'] ?>uikit/js/components/datepicker.js"></script>
		<script src="<?= $data['_config']['base_url'] ?>scripts.js"></script>
	</head>
	<body>
		<nav class="uk-navbar">
			<div class="uk-container uk-container-center">
				<a href="<?= $data['_config']['base_url'] ?>index.php" class="uk-navbar-brand">Digital CSIP <font size="1pt">v. 5.0.bse</font></a>
				<div class="uk-navbar-flip">
					<a href="#mainmenu-id" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas="{target:'#mainmenu-id'}"></a>
				</div>
			</div>
		</nav>
		<br>

		<div class="uk-container uk-container-center uk-animation-scale-up">
			<div class="uk-width-medium-1-2 uk-panel-box uk-align-center">
				<h1 align="center">Digital CSIP</h1>
                <hr>
				<div class="uk-text-center">
					<form class="uk-form" method="post" action="">
						<div id="registered" class="uk-alert-success" style="display:none;">
							<strong>You have successfully registered.<br>Please signin with your email and password.</strong>
						</div>
						<div id="passwordchange" class="uk-alert-success" style="display:none;">
							<strong>Your password has been successfully changed.<br>Please signin with your new password.</strong>
						</div>
						<fieldset>
							<label class="uk-form-label" for="_username">Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<input type="text" placeholder="username" id="_username" name="_username">
							<br><br>
							<label class="uk-form-label" for="_password">Password&nbsp;</label>
							<input type="password" id="_password" placeholder="password" name="_password">
						</fieldset>

						<br>
						<button class="uk-button uk-button-success uk-button-large">Login</button>
					</form>
				</div>
                <br>
                <hr>
                <div class="uk-text-center" style="font-size: 10px;">
					This system displays best in the Chrome or Firefox browser.
		</div>
	</div>
	<br>
	<?php include 'footer.php'; ?>
	</div>
    </body>
</html>
