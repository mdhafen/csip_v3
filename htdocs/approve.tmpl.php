<?php include( 'doc-open.php' ); ?>
<title>Welcome to Digital Comprehensive School Improvement Plan</title>
<?php
include( 'doc-head-close.php' );
include( 'doc-header-open.php' );
include( 'doc-due-key.php' );
include( 'doc-header-close.php' );
include( 'doc-menu.php' );
?>

<?php
if ( $data['csip'] ) {
?>
<h1><?= $data['csip']['year_name'] ?> Plan for <?= $data['csip']['name'] ?></h1>
<?php
}
?>

<?php if ( $data['updated'] ) { ?>
<div class="important">Section Approved</div>
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=<?= $data['_config']['base_url'] ?>category_list.php">
<?php } ?>

<?php foreach ( (array) $data['error'] as $error ) { ?>
<div class="important"><?= $error ?></div>
<?php } ?>

<?php include( 'csip-close.php' ); ?>
<?php include( 'doc-close.php' ); ?>
