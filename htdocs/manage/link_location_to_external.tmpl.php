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
<h3>New Location</h3>

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
<p>Click on a location to select</p>
<?php
foreach ( $data['locations'] as $ex_loc ) {
?>
<button id="ex_<?= $ex_loc['externalid'] ?>" class="uk-button" onclick="do_update(this)" data-external-exid="<?= $ex_loc['externalid'] ?>"><?= $ex_loc['name'] ?></a>
<?php
}
?>
</div>
<a class="uk-button" href="edit_location.php?locationid=<?= $data['locationid'] ?>">Back</a>

<form id="update_link_form" method="post" action="<?= $data['_config']['base_url'] ?>manage/link_location_to_external.php">
<input type="hidden" name="locationid" id="locationid" value="<?= $data['locationid'] ?>">
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
