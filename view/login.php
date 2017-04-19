<!DOCTYPE html>
<html>
	<head>
 <?php include 'head.php'; ?>
	</head>
	<body>
		<nav class="uk-navbar">
			<div class="uk-container uk-container-center">
				<a href="<?= $data['_config']['base_url'] ?>index.php" class="uk-navbar-brand">Digital CSIP <font size="1pt">v. 8.0.bse</font></a>
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
					<form class="uk-form" method="post" action="<?= $data['_config']['this_url'] ?>">

<?php if ( !empty($data['NOTPERMITTED']) ) { ?>
						<div id="errors" class="uk-panel uk-alert uk-alert-danger">
							<strong>You do not have access to that function.</strong>
						</div>
<?php } ?>
<?php if ( !empty($data['DBLOGIN']) ) { ?>
						<div id="errors" class="uk-panel uk-alert">
							<strong>Please enter the Database username and password to continue.</strong>
						</div>
<?php } ?>

						<fieldset>
							<label class="uk-form-label" for="_username">Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<input type="text" placeholder="username" id="_username" name="_username">
							<br><br>
							<label class="uk-form-label" for="_password">Password&nbsp;</label>
							<input type="password" id="_password" placeholder="password" name="_password">
						</fieldset>

						<br>
						<button class="uk-button uk-button-success uk-button-large">Login</button>
						<input type="hidden" name="_op" value="do_login">
					</form>
				</div>
<?php if ( !empty($data['_config']['authen_external_login_html']) ) { ?>
				<div id="external_auth_wrapper" class="uk-text-center">
<br><hr>
<?= $data['_config']['authen_external_login_html'] ?>
				</div>
<?php } ?>

                <br>
                <hr>
                <div class="uk-text-center" style="font-size: 10px;">
					This system displays best in the Chrome or Firefox browser.
		</div>
	</div>
	<br>
	<?php include 'footer.php'; ?>
	</div>

<script type="text/javascript">
$( document ).ready( function() {
  $("div#external_auth_wrapper form").addClass("uk-form");
  $("div#external_auth_wrapper .external_auth_button").addClass("uk-button uk-button-large uk-button-success");
});

</script>
    </body>
</html>
