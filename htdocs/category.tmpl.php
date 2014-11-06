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
$class = $data['csip']['category'][ $data['categoryid'] ]['category_class'];
$can_save = 0;
if ( ( $data['_session']['CAN_update_csip'] && ( $class == 'CSIP' || $class == 'OPT' ) ) || 
     ( $data['_session']['CAN_update_sap'] && ( $class == 'SAP' || $class == 'MAND' ) ) ||
     ( $class == 'OTHR' && ( $data['_session']['CAN_update_sap'] || $data['_session']['CAN_update_csip'] ) ) ) {
  if ( ! $data['csip']['loc_demo'] ) {
    $can_save = 1;
  }
}

if ( $data['csip'] ) {
?>
<h1><?= $data['csip']['year_name'] ?> Plan for <?= $data['csip']['name'] ?></h1>
<?php
}
?>

<h2><?= $data['csip']['category'][ $data['categoryid'] ]['category_name'] ?></h2>

<h3>Question <?= $data['part'] ?>: <?php
  if ( $class == 'OPT' && $data['part'] == 1 ) { ?>
Other Information<?php
  } else if ( $data['part'] == 1 ) { ?>
Guaranteed and Viable Curriculum<?php
  } else if ( $data['part'] == 2 ) { ?>
Formative Assessments<?php
  } else if ( $data['part'] == 3 ) { ?>
Interventions<?php
  } else { ?>
Learning Extensions<?php
  }
?></h3>

<form method="post" action="<?= $data['_config']['base_url'] ?>category.php?category=<?= $data['categoryid'] ?>&part=<?= $data['part'] ?>">
<ol>
<?php foreach ( $data['questions'] as $question ) { ?>
<li>
<?= $question['input_html'] ?>
<?php if ( $can_save && $question['type'] != 9 ) { ?>
<br><input type="submit" name="op" value="Save Answers">
<?php } ?>
</li>
<?php } ?>
</ol>
</form>

<?php include( 'csip-close.php' ); ?>
<?php include( 'doc-close.php' ); ?>
