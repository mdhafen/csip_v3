<?php include( $data['_config']['base_dir'] .'/htdocs/doc-open.php' ); ?>
<title>Site Management - Users - Delete Location</title>
<?php
include( $data['_config']['base_dir'] .'/htdocs/doc-head-close.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-header-open.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-header-close.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-menu.php' );
?>
<h1>Site Management &raquo; Users &raquo; Delete Location</h1>

<?php if ( $data['deleted'] ) { ?>
<div class="important">Location Deleted</div>
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=<?= $data['_config']['base_url'] ?>manage/locations.php">
<?php } else { ?>
<form method="post" action="<?= $data['_config']['base_url'] ?>manage/delete_location.php">
<input type="hidden" name="locationid" id="locationid" value="<?= $data['location']['locationid'] ?>">
<div>
Are you sure you want to delete <?= $data['location']['name'] ?> ( <?= $data['location']['locationid'] ?> )?
</div>
<input type="submit" name="op" id="op" value="Delete">
<input type="reset" name="cancel" id="cancel" value="Cancel" onclick="window.location='<?= $data['_config']['base_url'] ?>manage/locations.php'">
</form>

<div>
    You will also be deleting:

<table>
<tr>
<td><?= $data['dependants']['user'] ?></td>
<td>Users</td>
</tr>
<tr>
<td><?= $data['dependants']['csip'] ?></td>
<td>CSIPs</td>
</tr>
<tr>
<td><?= $data['dependants']['answer'] ?></td>
<td>Answers</td>
</tr>
<tr>
<tr>
<td><?= $data['dependants']['goal'] ?></td>
<td>Goals</td>
</tr>
<tr>
<td><?= $data['dependants']['activity'] ?></td>
<td>Activities</td>
</tr>
<tr>
<td><?= $data['dependants']['activity_people'] ?></td>
<td>People</td>
</tr>
</table>
</div>
<?php } ?>

<?php include( $data['_config']['base_dir'] .'/htdocs/doc-close.php' ); ?>
