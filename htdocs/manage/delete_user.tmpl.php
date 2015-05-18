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
<h3>Delete User</h3>

<?php if ( $data['deleted'] ) { ?>
<div class="uk-alert uk-alert-success">User Deleted</div>
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=<?= $data['_config']['base_url'] ?>manage/users.php">
<?php } else { ?>
<form method="post" action="<?= $data['_config']['base_url'] ?>manage/delete_user.php">
<input type="hidden" name="userid" id="userid" value="<?= $data['user']['userid'] ?>">
<div>
Are you sure you want to delete <?= $data['user']['fullname'] ?> ( <?= $data['user']['username'] ?> )?
</div>
<input type="submit" name="op" id="op" value="Delete">
<input type="reset" name="cancel" id="cancel" value="Cancel" onclick="window.location='<?= $data['_config']['base_url'] ?>manage/users.php'">
</form>
<?php } ?>

	</div>
	<br>
	<?php include $data['_config']['base_dir'] .'/htdocs/footer.php'; ?>
	</div>
    </body>
</html>
