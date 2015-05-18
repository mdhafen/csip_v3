<!DOCTYPE html>
<html>
	<head>
	<?php include $data['_config']['base_dir'] .'/htdocs/head.php';?>
	</head>
	<body>
		<?php include $data['_config']['base_dir'] .'/htdocs/menu.php'; ?>

        <div class="uk-container uk-container-center uk-animation-fade">
            <br>

<div class="uk-panel uk-panel-box uk-panel-box-primary">
<h3><?= ($data['edit'])?"Edit":"New" ?> Location</h3>

<?php if ( $data['saved'] ) { ?>
<div class="uk-alert uk-alert-success">
Changes saved.
</div>
<?php } ?>

<form method="post" action="<?= $data['_config']['base_url'] ?>manage/edit_location.php">
<input type="hidden" name="locationid" id="locationid" value="<?= $data['location']['locationid'] ?>">
<?php if ( $data['error'] ) { ?>
<div class="uk-alert uk-alert-warning">
There was an error
<?php
foreach ( (array) $data['error'] as $err ) {
    print "<div>$err</div>\n";
}
?>
</div>
<?php } ?>
<table>

<tr>
<td><label for="new_locationid">Location Number</label></td>
<td><input name="new_locationid" id="new_locationid" value="<?= $data['location']['locationid'] ?>" ></td>
</tr>

<tr>
<td><label for="name">Name</label></td>
<td><input name="name" id="name" value="<?= $data['location']['name'] ?>" ></td>
</tr>

<tr>
<td><label for="mingrade">First Grade</label></td>
<td><input name="mingrade" id="mingrade" value="<?= $data['location']['mingrade'] ?>" ></td>
</tr>

<tr>
<td><label for="maxgrade">Last Grade</label></td>
<td><input name="maxgrade" id="maxgrade" value="<?= $data['location']['maxgrade'] ?>" ></td>
</tr>

<tr>
<td><label for="loc_demo">Location is Demo</label></td>
<td><input type="checkbox" name="loc_demo" id="loc_demo" <?= ( $data['location']['loc_demo'] ) ? "checked='checked'" : "" ?> ></td>
</tr>

</table>
<input class="uk-button" type="submit" name="op" id="op" value="Save">

<a class="uk-button" href="locations.php">Back</a>

</form>

	</div>
	<br>
	<?php include $data['_config']['base_dir'] .'/htdocs/footer.php'; ?>
	</div>
    </body>
</html>
