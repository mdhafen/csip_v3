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
<button id="ex_<?= $ex_loc['externalid'] ?>" class="uk-button" onclick="do_select(this)" data-external-id="<?= $ex_loc['locationid'] ?>" data-external-name="<?= $ex_loc['name'] ?>" data-external-mingrade="<?= $ex_loc['mingrade'] ?>" data-external-maxgrade="<?= $ex_loc['maxgrade'] ?>" data-external-exid="<?= $ex_loc['externalid'] ?>"><?= $ex_loc['name'] ?></a>
<?php
}
?>
</div>

<div class="uk-panel uk-panel-box uk-margin-top">
<form method="post" action="<?= $data['_config']['base_url'] ?>manage/new_location_from_external.php">
<table>

<tr>
<td><label for="new_locationid">Location Number</label></td>
<td><input name="new_locationid" id="new_locationid" readonly value="" ></td>
</tr>

<tr>
<td><label for="name">Name</label></td>
<td><input name="name" id="name" readonly value="" ></td>
</tr>

<tr>
<td><label for="mingrade">First Grade</label></td>
<td><input name="mingrade" id="mingrade" readonly value="" ></td>
</tr>

<tr>
<td><label for="maxgrade">Last Grade</label></td>
   <td><input name="maxgrade" id="maxgrade" readonly value="" ></td>
</tr>

<tr>
<td><label for="externalid">External ID</label></td>
<td><input type="text" name="externalid" id="externalid" readonly value="" ></td>
</tr>

</table>
<input class="uk-button" type="submit" name="op" id="op" value="Save">

<a class="uk-button" href="locations.php">Back</a>

</form>
</div>

	</div>
	<br>
	<?php include $data['_config']['base_dir'] .'/htdocs/footer.php'; ?>
	</div>
    <script>
function do_select(element) {
    var id = element.getAttribute("data-external-id");
    var name = element.getAttribute("data-external-name");
    var mingrade = element.getAttribute("data-external-mingrade");
    var maxgrade = element.getAttribute("data-external-maxgrade");
    var ex_id = element.getAttribute("data-external-exid");

	$("#new_locationid").val(id);
	$("#name").val(name);
	$("#mingrade").val(mingrade);
	$("#maxgrade").val(maxgrade);
	$("#externalid").val(ex_id);
}
    </script>
    </body>
</html>
