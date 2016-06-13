<!DOCTYPE html>
<html>
	<head>
	<?php include 'head.php';?>
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

        <div class="uk-container uk-container-center uk-animation-fade">

<?php if ( !empty($data['ERROR']) ) { ?>
<div class="uk-alert uk-alert-danger">
<?php if ( !empty($data['INSTALL_USER_EXTERNAL']) ) { ?><div>External Users is set.  No user information will be entered in this database, but this program will get it from another database.</div><?php } ?>

<?php if ( !empty($data['INSTALL_CREATETABLES_CANT_READ']) ) { ?><div>The database hasn&apos;t been setup.  This program will now attempt to create the necessary tables for you.<br>Can&apos;t read the sql files.  You will have to do it yourself.</div><?php } ?>
<?php if ( !empty($data['INSTALL_CREATETABLES_FAILED']) ) { ?><div>The database hasn&apos;t been setup.  This program will now attempt to create the necessary tables for you.<br>There was an error.  You will have to check on the state of the database and tables yourself.<br>Error message: <?= $data['INSTALL_CREATETABLES_FAILED'] ?></div><?php } ?>

<?php if ( !empty($data['INSTALL_ALREADY_ADDED_ADMIN']) ) { ?><div>There are already users for managing the program.  This program won&apos;t create more for you.</div><?php } ?>

<?php if ( !empty($data['INSTALL_NO_LOCATION']) ) { ?><div>The location identifier and location name must be specified.  An existing location identifier may be supplied.</div><?php } ?>
<?php if ( !empty($data['INSTALL_ADD_LOCATION_FAILED']) ) { ?><div>Creating the specified location in the database failed.</div><?php } ?>

<?php if ( !empty($data['INSTALL_PASS_NOMATCH']) ) { ?><div>Passwords don&apos;t match.</div><?php } ?>
<?php if ( !empty($data['INSTALL_USERNAME_USED']) ) { ?><div>That username is already in use.</div><?php } ?>
<?php if ( !empty($data['INSTALL_ADD_USER_FAILED']) ) { ?><div>Creating the specified user in the database failed.</div><?php } ?>
</div>
<?php } ?>

<?php if ( !empty($data['INSTALL_DONE']) ) { ?><div><a href="index.php">Installation is complete.  Please login to add users.</a></div><?php } ?>

	<div class="uk-flex uk-flex-middle uk-flex-center">
	<div class="uk-panel uk-panel-box">
		<h1>Please enter user information</h1>
		<div>This user will be the first system administrator, and will create further users.</div>
		<form class="uk-form" method="post" action="install.php">
			<?php if ( !empty($data['checks_passed']) ) { ?><input type="hidden" name="checks_passed" value="1"><?php } ?>
			<?php if ( !empty($data['step']) ) { ?><input type="hidden" name="step" value="<?= $data['step'] ?>"><?php } ?>
			<fieldset class="uk-form-horizontal">
				<div class="uk-form-row">
					<label class="uk-form-label" for="locationid"></label>
					<div class="uk-form-controls"><input type="text" placeholder="Location Identifier" id="locationid" name="locationid"></div>
				</div>

				<div class="uk-form-row">
					<label class="uk-form-label" for="locationname"></label>
					<div class="uk-form-controls"><input type="text" placeholder="Location Name" id="locationname" name="locationname"></div>
				</div>

				<div class="uk-form-row">
					<label class="uk-form-label" for="username">Username</label>
					<div class="uk-form-controls"><input type="text" placeholder="username" id="username" name="username"></div>
				</div>

				<div class="uk-form-row">
					<label class="uk-form-label" for="password">Password</label>
					<div class="uk-form-controls"><input type="password" id="password" placeholder="password" name="password"></div>
				</div>

				<div class="uk-form-row">
					<label class="uk-form-label" for="password_confirm">Confirm Password</label>
					<div class="uk-form-controls"><input type="password" id="password_confirm" placeholder="password again" name="password_confirm"></div>
				</div>

				<div class="uk-form-row">
					<label class="uk-form-label" for="fullname"></label>
					<div class="uk-form-controls"><input type="text" placeholder="Full Name" id="fullname" name="fullname"></div>
				</div>

				<div class="uk-form-row">
					<label class="uk-form-label" for="email"></label>
					<div class="uk-form-controls"><input type="text" placeholder="email address" id="email" name="email"></div>
				</div>

				<div class="uk-form-row">
					<button class="uk-button uk-button-success uk-button-large">Submit</button>
				</div>
			</fieldset>
		</form>
	</div>
	</div>

</div>
<?php
include 'footer.php';
?>
	</body>
</html>
