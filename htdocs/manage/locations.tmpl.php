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
<h3>Locations</h3>

	 <a href="<?= $data['_config']['base_url'] ?>manage/edit_location.php">Add Location</a><?php if ( $data['_config']['user_external_module'] ) { ?><a href="<?= $data['_config']['base_url'] ?>manage/new_location_from_external.php" class="uk-margin-left">Add Location From External Source</a><?php } ?>

<table class="uk-table uk-table-striped">
<thead>
<tr>
<th>Location ID</th><th>Name</th><th>Minimum Grade</th><th>Maximum Grade</th><th>Location Is For Demo</th><th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php foreach ( $data['locations'] as $loc ) { ?>
<tr>
<td><?= $loc['locationid'] ?></td>
<td><?= $loc['name'] ?></td>
<td><?= $loc['mingrade'] ?></td>
<td><?= $loc['maxgrade'] ?></td>
<td><?= $loc['loc_demo'] ?></td>
<td>
<div class="uk-button-group">
<a href="<?= $data['_config']['base_url'] ?>manage/location_csips.php?locationid=<?= $loc['locationid'] ?>" class="uk-button">CSIPs</a> 
<a href="<?= $data['_config']['base_url'] ?>manage/location_courses.php?locationid=<?= $loc['locationid'] ?>" class="uk-button">Special Course Access</a> 
<a href="<?= $data['_config']['base_url'] ?>manage/edit_location.php?locationid=<?= $loc['locationid'] ?>" class="uk-button">Edit</a> 
<a href="<?= $data['_config']['base_url'] ?>manage/delete_location.php?locationid=<?= $loc['locationid'] ?>" class="uk-button">Delete</a>
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
