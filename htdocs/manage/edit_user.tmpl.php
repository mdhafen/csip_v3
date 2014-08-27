<?php include( $data['_config']['base_dir'] .'/htdocs/doc-open.php' ); ?>
<title>Site Management - Users - <?= ($data['edit'])?"Edit":"New" ?> User</title>
<?php
include( $data['_config']['base_dir'] .'/htdocs/doc-head-close.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-header-open.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-header-close.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-menu.php' );
?>
<h1>Site Management &raquo; Users &raquo; <?= ($data['edit'])?"Edit":"New" ?> User</h1>

<?php if ( $data['saved'] ) { ?>
<div class="important">
Changes saved.
</div>
<?php } ?>

<form method="post" action="<?= $data['_config']['base_url'] ?>manage/edit_user.php">
<input type="hidden" name="userid" id="userid" value="<?= $data['user']['userid'] ?>">
<table>

<tr>
<td><label for="username">Username</label></td>
<td><input name="username" id="username" value="<?= $data['user']['username'] ?>" ></td>
</tr>

<tr>
<td><label for="fullname">Full Name</label></td>
<td><input name="fullname" id="fullname" value="<?= $data['user']['fullname'] ?>" ></td>
</tr>

<tr>
<td><label for="email">Email Address</label></td>
<td><input name="email" id="email" value="<?= $data['user']['email'] ?>" ></td>
</tr>

<tr>
<td><label for="role">User Role</label></td>
<td>
<select name="role" id="role">
<?php foreach ( (array) $data['roles'] as $roleid => $role ) { ?>
<option value="<?= $roleid ?>" <?= ($role['selected']) ? "selected='selected'" : "" ?>><?= $role['name'] ?></option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td><label for="location">User Location</label></td>
<td>
<select name="location" id="location">
<?php foreach ( $data['locations'] as $loc ) { ?>
 <option value="<?= $loc['locationid'] ?>" <?= ($loc['selected']) ? "selected='selected'" : "" ?>><?= $loc['name'] ?></option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td><label for="password">Password</label></td>
<td><input type="password" name="password" id="password" value="<?= ( $data['user']['password'] ) ? '*****' : '' ?>" ></td>
</tr>

<tr>
<td><label for="password_2">Repeat Password to confirm</label></td>
<td><input type="password" name="password_2" id="password_2" value="" ></td>
</tr>

</table>
<input type="submit" name="op" id="op" value="Save">
</form>

<?php include( $data['_config']['base_dir'] .'/htdocs/doc-close.php' ); ?>
