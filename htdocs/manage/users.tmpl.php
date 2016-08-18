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
<h3>Users</h3>

<a class="uk-button" href="<?= $data['_config']['base_url'] ?>manage/edit_user.php">Add User</a>

<table class="uk-table uk-table-striped">
<thead>
<tr>
<td>Full Name</td><td>username</td><td>Role</td><td>Password</td><td>&nbsp;</td>
</tr>
</thead>
<tbody>
<?php foreach ( $data['users'] as $user ) { ?>
<tr>
<td><?= $user['fullname'] ?></td>
<td><?= $user['username'] ?></td>
<td><?= $user['role'] ?></td>
<td><?= $user['password']?"Yes":"No" ?></td>
<td>
<div class="uk-button-group">
<a href="<?= $data['_config']['base_url'] ?>manage/user_courses.php?userid=<?= $user['userid'] ?>" class="uk-button">Course Access</a>
<a href="<?= $data['_config']['base_url'] ?>manage/edit_user.php?userid=<?= $user['userid'] ?>" class="uk-button">Edit</a> 
<a href="<?= $data['_config']['base_url'] ?>manage/delete_user.php?op=Delete&amp;userid=<?= $user['userid'] ?>" class="uk-button">Delete</a>
</div>
</td>
</tr>
<?php } ?>
</tbody>
</table>

	</div>
	<br>
	<?php include $data['_config']['base_dir'] .'/htdocs/footer.php'; ?>
	</div>
    </body>
</html>
