<?php include( 'doc-open.php' ); ?>
<title>Welcome to Digital Comprehensive School Improvement Plan</title>
<?php
include( 'doc-head-close.php' );
include( 'doc-header-open.php' );
include( 'doc-header-close.php' );
include( 'doc-menu.php' );
?>

<h1>Welcome to the Digital CSIP</h1>

<p>
<a href="<?= $data['_config']['base_url'] ?>load_csip.php">Select</a> the current CSIP report or a report from a previous year,<br>
<!-- 
or<br>
Begin a <a href="<?= $data['_config']['base_url'] ?>new_csip.php">New CSIP report</a> ( This only needs to be done once.  If the report has already been created <a href="<?= $data['_config']['base_url'] ?>load_csip.php">select it</a>. ) -->
</p>

<!--
<p>
<a target='_BLANK' href="<?= $data['_config']['base_url'] ?>docs/Digital CSIP Instruction.pdf">Instructions</a> for using Digital CSIP
</p>

<p>
<a target='_BLANK' href="<?= $data['_config']['base_url'] ?>docs/Digital CSIP Blank Goal.pdf">Print blank</a> action plan forms.
</p>
 -->

<?php include( 'doc-close.php' ); ?>
