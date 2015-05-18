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

<a href="<?= $data['_config']['base_url'] ?>manage/edit_location.php">Add Location</a>

<table>
<caption>Locations</caption>
<thead>
<tr>
<td>Location ID</td><td>Name</td><td>Minimum Grade</td><td>Maximum Grade</td><td>Location Is For Demo</td><td>&nbsp;</td>
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
<a href="<?= $data['_config']['base_url'] ?>manage/edit_location.php?locationid=<?= $loc['locationid'] ?>">Edit</a> 
<a href="<?= $data['_config']['base_url'] ?>manage/delete_location.php?locationid=<?= $loc['locationid'] ?>">Delete</a>
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