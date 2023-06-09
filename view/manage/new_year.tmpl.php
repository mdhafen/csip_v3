<!DOCTYPE html>
<html>
	<head>
	<?php include $data['_config']['base_dir'] .'/view/head.php';?>
	</head>
	<body>
		<?php include $data['_config']['base_dir'] .'/view/menu.php'; ?>

        <div class="uk-container uk-container-center uk-animation-fade">
            <br>

<div class="uk-panel uk-panel-box uk-panel-box-primary">
<h3>New Year</h3>

<?php if ( $data['created'] ) { ?>
<div class="uk-alert uk-alert-success">
Year created.<br>
<?= $data['new_csips'] ?> New CSIPS created.
</div>
<?php } ?>

<form method="post" action="<?= $data['_config']['base_url'] ?>manage/new_year.php">
<table>

<tr>
<td><label for="year_name">Year Name</label></td>
<td><input name="year_name" id="year_name" value="" ></td>
</tr>

<tr>
<td><label for="due_dates">CSIP Due Dates</label></td>
<td>
  <textarea name="due_dates" id="due_dates" rows="7" cols="50">
October : Teams identify ES
October : Teams identify EXTENSIONS
October : Teams administer two CFAs
November : School Board reviews CSIPs
February : Teams administer two add&apos;l CFAs
April : Teams complete REFLECTION process
</textarea>
</td>
</tr>

<tr>
<td><label for="version">Question Version</label></td>
<td>
<select name="version" id="version">
<?php foreach ( $data['versions'] as $version ) { ?>
  <option value="<?= $version ?>"><?= $version ?></option>
<?php } ?>
</select>
</td>
</tr>

</table>
<input type="submit" name="op" id="op" value="Save Year">
</form>

	</div>
	<br>
	<?php include $data['_config']['base_dir'] .'/view/footer.php'; ?>
	</div>
    </body>
</html>
