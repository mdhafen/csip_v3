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

<h2><?= $data['csip']['category'][ $data['categoryid'] ]['category_name'] ?></h2>

<h3>Part <?= $data['part'] ?>: <?php
  if ( $data['part'] == 1 ) { ?>
Student Achievment Data Analysis<?php
  } else { ?>
Analysis Summary<?php
  }
?></h3>

<form method="post" action="<?= $data['_config']['base_url'] ?>category.php?category=<?= $data['categoryid'] ?>&part=<?= $data['part'] ?>">
<ol>
<?php foreach ( $data['questions'] as $question ) { ?>
<li>
<?= $question['input_html'] ?>
</li>
<?php } ?>
</ol>
<?php
if ( ( $data['_session']['CAN_update_csip'] && $data['csip']['category'][ $data['categoryid'] ]['category_class'] == 'CSIP' ) || 
     ( $data['_session']['CAN_update_sap'] && $data['csip']['category'][ $data['categoryid'] ]['category_class'] == 'SAP' ) ) {
  if ( ! $data['csip']['loc_demo'] ) {
?>
<input type="submit" name="op" value="Save Answers">
<?php
  }
}
?>
</form>

<?php include( 'csip-close.php' ); ?>
<?php include( 'doc-close.php' ); ?>
