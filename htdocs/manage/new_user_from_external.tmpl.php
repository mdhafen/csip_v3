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
<h3>New User</h3>

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

<div class="uk-panel uk-panel-box">
<p>Click on a user to select</p>
<?php
foreach ( $data['users'] as $ex_user ) {
?>
<button id="ex_<?= $ex_user['externalid'] ?>" class="uk-button" onclick="do_select(this)" data-external-name="<?= $ex_user['fullname'] ?>"  data-external-username="<?= $ex_user['username'] ?>" data-external-email="<?= $ex_user['email'] ?>" data-external-role="<?= $ex_user['role'] ?>" data-external-exid="<?= $ex_user['externalid'] ?>"><?= $ex_user['fullname'] ?></button>
<?php
}
?>
</div>

<div class="uk-panel uk-panel-box uk-margin-top">
<form method="post" action="<?= $data['_config']['base_url'] ?>manage/new_user_from_external.php">
<table>

<tr>
<td><label for="username">Username</label></td>
<td><input type="text" name="username" id="username" readonly value="" ></td>
</tr>

<tr>
<td><label for="fullname">Name</label></td>
<td><input type="text" name="fullname" id="fullname" readonly value="" ></td>
</tr>

<tr>
<td><label for="email">Email Address</label></td>
<td><input type="text" name="email" id="email" readonly value="" ></td>
</tr>

<tr>
<td><label for="role">Role</label></td>
   <td><input type="text" name="role" id="role" readonly value="" ></td>
</tr>

<tr>
<td><label for="externalid">External ID</label></td>
<td><input type="text" name="externalid" id="externalid" readonly value="" ></td>
</tr>

</table>
<input class="uk-button" type="submit" name="op" id="op" value="Save">

<a class="uk-button" href="users.php">Back</a>

</form>
</div>

	</div>
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

	$("#username").val(username);
	$("#fullname").val(name);
	$("#email").val(email);
	$("#role").val(role);
	$("#externalid").val(ex_id);
}
    </script>
    </body>
</html>
