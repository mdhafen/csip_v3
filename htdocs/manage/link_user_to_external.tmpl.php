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
<h3>External User Link</h3>

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
<button id="ex_<?= $ex_user['externalid'] ?>" class="uk-button" onclick="do_update(this)" data-external-exid="<?= $ex_user['externalid'] ?>"><?= $ex_user['fullname'] ?></a>
<?php
}
?>
</div>
<a class="uk-button" href="edit_user.php?userid=<?= $data['userid'] ?>">Back</a>

<form id="update_link_form" method="post" action="<?= $data['_config']['base_url'] ?>manage/link_user_to_external.php">
<input type="hidden" name="userid" id="userid" value="<?= $data['userid'] ?>">
<input type="hidden" name="externalid" id="externalid" value="">
</form>

	</div>
	<br>
	<?php include $data['_config']['base_dir'] .'/htdocs/footer.php'; ?>
	</div>
    <script>
function do_update(element) {
    var ex_id = element.getAttribute("data-external-exid");

	$("#externalid").val(ex_id);
	$("#update_link_form").submit();
}
    </script>
    </body>
</html>
