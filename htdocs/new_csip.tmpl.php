<?php include( 'doc-open.php' ); ?>
<title>Welcome to Digital Comprehensive School Improvement Plan</title>
<?php
include( 'doc-head-close.php' );
include( 'doc-header-open.php' );
include( 'doc-due-key.php' );
include( 'doc-header-close.php' );
include( 'doc-menu.php' );
?>

<h1>Start a new CSIP report</h1>

<?php if ( $data['created'] ) { ?>
<div class="important">CSIP created</div>
<?php } ?>

<div>
<form method="post" action="new_csip.php">
<select name="year">
<option value="">Select the year</option>
<?php foreach ( $data['years'] as $year ) { ?>
<option value="<?= $year['yearid'] ?>"><?= $year['year_name'] ?></option>
<?php } ?>
</select><br>
<input type="submit" name="op" value="Create CSIP">
</form>
</div>

<?php include( 'csip-close.php' ); ?>
<?php include( 'doc-close.php' ); ?>
