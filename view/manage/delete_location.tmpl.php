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
<h3>Delete Location</h3>

<?php if ( $data['deleted'] ) { ?>
<div class="uk-alert uk-alert-success">Location Deleted</div>
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=<?= $data['_config']['base_url'] ?>manage/locations.php">
<?php } else { ?>
<form method="post" action="<?= $data['_config']['base_url'] ?>manage/delete_location.php">
<input type="hidden" name="locationid" id="locationid" value="<?= $data['location']['locationid'] ?>">
<div>
Are you sure you want to delete <?= $data['location']['name'] ?> ( <?= $data['location']['locationid'] ?> )?
</div>
<input type="submit" name="op" id="op" value="Delete">
<input type="reset" name="cancel" id="cancel" value="Cancel" onclick="window.location='<?= $data['_config']['base_url'] ?>manage/locations.php'">
</form>

<div>
    You will also be deleting:

<table>
<tr>
<td><?= $data['dependants']['user'] ?></td>
<td>Users</td>
</tr>
<tr>
<td><?= $data['dependants']['csip'] ?></td>
<td>CSIPs</td>
</tr>
<tr>
<td><?= $data['dependants']['answer'] ?></td>
<td>Answers</td>
</tr>
<tr>
<td><?= $data['dependants']['course'] ?></td>
<td>Course Links at <?= $data['location']['name'] ?></td>
</tr>
</table>
</div>
<?php } ?>

	</div>
	<br>
	<?php include $data['_config']['base_dir'] .'/view/footer.php'; ?>
	</div>
    </body>
</html>
