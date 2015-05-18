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

<a href="<?= $data['_config']['base_url'] ?>manage/edit_user.php">Add User</a>

<table>
<caption>Users</caption>
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
<a href="<?= $data['_config']['base_url'] ?>manage/edit_user.php?userid=<?= $user['userid'] ?>">Edit</a> 
<a href="<?= $data['_config']['base_url'] ?>manage/delete_user.php?userid=<?= $user['userid'] ?>">Delete</a>
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
