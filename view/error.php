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
					<h2>There was an error</h2>
					<div id="errors" class="uk-alert uk-alert-danger">
<?php
if ( !empty($data['errors']) ) {
   foreach ( $data['errors'] as $flag => $text ) {
?>
<p><!-- <?= $flag ?> --><?= $text ?></p>
<?php
   }
}
?>
					</div>
		                </div>
			</div>
	<br>
	<?php include 'footer.php'; ?>
	</div>
    </body>
</html>
