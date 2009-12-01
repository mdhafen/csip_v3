<?php include( $data['_config']['base_dir'] .'/htdocs/doc-open.php' ); ?>
<title>Site Management - Users - Delete User</title>
<?php
include( $data['_config']['base_dir'] .'/htdocs/doc-head-close.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-header-open.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-header-close.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-menu.php' );
?>
<h1>Site Management &raquo; Users &raquo; Delete User</h1>

<?php if ( $data['deleted'] ) { ?>
<div class="important">User Deleted</div>
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=<?= $data['_config']['base_url'] ?>manage/users.php">
<?php } else { ?>
<form method="post" action="<?= $data['_config']['base_url'] ?>manage/delete_user.php">
<input type="hidden" name="userid" id="userid" value="<?= $data['user']['userid'] ?>">
<div>
Are you sure you want to delete <?= $data['user']['fullname'] ?> ( <?= $data['user']['username'] ?> ) from <?= $data['user']['locationid'] ?>?
</div>
<input type="submit" name="op" id="op" value="Delete">
<input type="reset" name="cancel" id="cancel" value="Cancel" onclick="window.location='<?= $data['_config']['base_url'] ?>manage/users.php'">
</form>
<?php } ?>

<?php include( $data['_config']['base_dir'] .'/htdocs/doc-close.php' ); ?>
