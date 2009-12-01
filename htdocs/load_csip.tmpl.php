<?php include( 'doc-open.php' ); ?>
<title>Welcome to Digital Comprehensive School Improvement Plan</title>
<?php
include( 'doc-head-close.php' );
include( 'doc-header-open.php' );
include( 'doc-due-key.php' );
include( 'doc-header-close.php' );
include( 'doc-menu.php' );
?>

<h1>Select a CSIP Report</h1>

<?php if ( $data['csips'] ) { ?>
<form method="post" action="<?= $data['_config']['base_url'] ?>load_csip.php">
<select name="csipid" id="csipid">
  <?php foreach ( (array) $data['csips'] as $csip ) { ?>
<option value="<?= $csip['csipid'] ?>">Year: <?= $csip['year_name'] ?> , Location: <?= $csip['name'] ?></option>
<?php } ?>
</select>
<br>
<input type="submit" name="submit" id="submit" value="Select">
</form>
<?php } ?>

<?php if ( $data['loaded'] ) { ?>
<div class="loaded">
CSIP Report Loaded.
</div>
<?php
if ( $data['_session']['CAN_update_csip'] || $data['_session']['CAN_update_sap'] ) {
  $target = 'category_list.php';
} else {
  $target = 'report.php';
}
?>
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=<?= $data['_config']['base_url'] ?><?= $target ?>">
<?php } ?>

<?php
if ( $data['errors'] ) {
echo '<div class="error">', "\n";
  foreach ( (array) $data['errors'] as $error ) {
    switch ( $error ) {
    case 'NOTYOURS' : {
      echo "Can't load CSIPs from other schools<br>\n";
      break;
    }
    }
  }
  echo '</div>', "\n";
}
?>

<?php include( 'csip-close.php' ); ?>
<?php include( 'doc-close.php' ); ?>
