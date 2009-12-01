<?php include( $data['_config']['base_dir'] .'/htdocs/doc-open.php' ); ?>
<title>Site Management - Locations</title>
<?php
include( $data['_config']['base_dir'] .'/htdocs/doc-head-close.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-header-open.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-header-close.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-menu.php' );
?>
<h1>Site Management &raquo; Locations</h1>

<a href="<?= $data['_config']['base_url'] ?>manage/edit_location.php">Add Location</a>

<table>
<caption>Locations</caption>
<thead>
<tr>
<td>Location ID</td><td>Name</td><td>Minimum Grade</td><td>Maximum Grade</td><td>Location Category</td><td>Location Sub-Category</td><td>Location Is For Demo</td><td>&nbsp;</td>
</tr>
</thead>
<tbody>
<?php foreach ( $data['locations'] as $loc ) { ?>
<tr>
<td><?= $loc['locationid'] ?></td>
<td><?= $loc['name'] ?></td>
<td><?= $loc['mingrade'] ?></td>
<td><?= $loc['maxgrade'] ?></td>
<td><?= $loc['loc_category'] ?></td>
<td><?= $loc['loc_subcategory'] ?></td>
<td><?= $loc['loc_demo'] ?></td>
<td>
<a href="<?= $data['_config']['base_url'] ?>manage/edit_location.php?locationid=<?= $loc['locationid'] ?>">Edit</a> 
<a href="<?= $data['_config']['base_url'] ?>manage/delete_location.php?locationid=<?= $loc['locationid'] ?>">Delete</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>

<?php include( $data['_config']['base_dir'] .'/htdocs/doc-close.php' ); ?>
