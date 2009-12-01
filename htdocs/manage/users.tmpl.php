<?php include( $data['_config']['base_dir'] .'/htdocs/doc-open.php' ); ?>
<title>Site Management</title>
<?php
include( $data['_config']['base_dir'] .'/htdocs/doc-head-close.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-header-open.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-header-close.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-menu.php' );
?>
<h1>Site Management &raquo; Users</h1>

<a href="<?= $data['_config']['base_url'] ?>manage/edit_user.php">Add User</a>

<table>
<caption>Users</caption>
<thead>
<tr>
<td>Location</td><td>Full Name</td><td>username</td><td>Role</td><td>Password</td><td>&nbsp;</td>
</tr>
</thead>
<tbody>
<?php foreach ( $data['users'] as $user ) { ?>
<tr>
<td><?= $user['locationid'] ?></td>
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

<?php include( $data['_config']['base_dir'] .'/htdocs/doc-close.php' ); ?>
