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
<h3><?= ($data['edit'])?"Edit":"New" ?> User</h3>

<?php if ( $data['saved'] ) { ?>
<div class="uk-alert uk-alert-success">
Changes saved.
</div>
<?php } ?>

<form method="post" action="<?= $data['_config']['base_url'] ?>manage/edit_user.php">
<input type="hidden" name="userid" id="userid" value="<?= !empty($data['user']['userid']) ? $data['user']['userid'] : "" ?>">
<table>

<tr>
<td><label for="username">Username</label></td>
<td><input name="username" id="username" value="<?= !empty($data['user']['username']) ? $data['user']['username'] : "" ?>" ></td>
</tr>

<tr>
<td><label for="fullname">Full Name</label></td>
<td><input name="fullname" id="fullname" value="<?= !empty($data['user']['fullname']) ? $data['user']['fullname'] : "" ?>" ></td>
</tr>

<tr>
<td><label for="email">Email Address</label></td>
<td><input name="email" id="email" value="<?= !empty($data['user']['email']) ? $data['user']['email'] : "" ?>" ></td>
</tr>

<tr>
<td><label for="role">User Role</label></td>
<td>
<select name="role" id="role">
<?php foreach ( (array) $data['roles'] as $roleid => $role ) { ?>
<option value="<?= $roleid ?>" <?= (!empty($role['selected'])) ? "selected='selected'" : "" ?>><?= $role['name'] ?></option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td><label for="locations">User Location</label></td>
<td>
<select name="locations[]" id="locations" multiple>
<?php foreach ( $data['locations'] as $loc ) { ?>
<option value="<?= $loc['locationid'] ?>" <?= (!empty($loc['selected'])) ? "selected='selected'" : "" ?>><?= $loc['name'] ?></option>
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

<tr>
<td><label for="externalid">External ID</label></td>
<td><input type="text" name="externalid" id="externalid" readonly value="<?= !empty($data['user']['externalid']) ? $data['user']['externalid'] : "" ?>" ><?php if ( $data['_config']['user_external_module'] ) { ?><span class="uk-margin-left">Click a button below to change External Link</span><?php } ?></td>
</tr>

</table>
<input class="uk-button" type="submit" name="op" id="op" value="Save">

<a class="uk-button" href="users.php">Back</a>

</form>

	</div>

<?php if ( $data['_config']['user_external_module'] && !empty($data['externals']) ) { ?>
<div class="uk-panel uk-panel-box">
<h2 class="uk-panel-title">Available external users</h2>
<?php  foreach ( $data['externals'] as $ex_user ) { ?>
<button id="ex_<?= $ex_user['externalid'] ?>" class="uk-button" onclick="do_select(this)" data-external-name="<?= $ex_user['fullname'] ?>"  data-external-username="<?= $ex_user['username'] ?>" data-external-email="<?= $ex_user['email'] ?>" data-external-role="<?= $ex_user['role'] ?>" data-external-exid="<?= $ex_user['externalid'] ?>"><?= $ex_user['fullname'] ?></button>
<?php  } ?>
</div>
<?php } ?>

	<br>
	<?php include $data['_config']['base_dir'] .'/htdocs/footer.php'; ?>
	</div>

    <script>
function do_select(element) {
    var username = element.getAttribute("data-external-username");
    var name = element.getAttribute("data-external-name");
    var email = element.getAttribute("data-external-email");
    var role = element.getAttribute("data-external-role");
    var ex_id = element.getAttribute("data-external-exid");

	if ( ! $("#username").val() ) { $("#username").val(username); }
	if ( ! $("#fullname").val() ) { $("#fullname").val(name); }
	if ( ! $("#email").val() ) { $("#email").val(email); }
	$("#role").val(role);
	$("#externalid").val(ex_id);
}
    </script>
    </body>
</html>
