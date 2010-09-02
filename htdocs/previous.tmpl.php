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

<h3>Previous Year Report</h3>

<?php if ( $data['updated'] ) { ?>
<div class="important">Changes Saved</div>
<?php } ?>

<?php foreach ( (array) $data['previous'] as $goal ) { ?>
<div class="pad_bottom">
<div><?= $goal['goal'] ?></div>

<?php
  foreach ( (array) $goal['activity'] as $aid => $activity ) {
    $activity_highlight = ! $activity_highlight;
    $a_light = ( $activity_highlight ) ? "highlighted" : "lowlighted";
?>
<div class="<?= $a_light ?>">
Description:<br>
<div class="report_goal_activity_description"><?= $activity['activity'] ?></div>
<br>
Expected Completion Date:
<div class="report_goal_activity_date"><?php
    if ( $activity['complete_date'] ) {
      echo date('m/d/Y', strtotime( $activity['complete_date'] ) );
    }
?></div>
<br><br>
Activity is:
<div>
<form method="post" action="previous.php?category=<?= $data['categoryid'] ?>">
<input type="hidden" name="activityid" value="<?= $aid ?>">
<label for="<?= $aid ?>_c_y"><input type="radio" name="<?= $aid ?>_complete" id="<?= $aid ?>_c_y" value="yes" <?= ( $activity['completed'] == 1 ) ? "checked='checked'" : "" ?>>Complete</label><br>
<label for="<?= $aid ?>_c_n"><input type="radio" name="<?= $aid ?>_complete" id="<?= $aid ?>_c_n" value="no" <?= ( $activity['completed'] === 0 || $activity['completed'] === "0" ) ? "checked='checked'" : "" ?>>Not Complete</label><br>
<br>
<?php if ( $activity['forwarded'] ) { ?>
<div>Activity is already forwarded</div>
<?php } else { ?>
<label for="<?= $aid ?>_forward"><input type="checkbox" name="<?= $aid ?>_forward" id="<?= $aid ?>_forward" value="forward">Forward this Activity to the current Period</label><br>
<?php } ?>
<?php
$class = $data['csip']['category'][ $data['categoryid'] ]['category_class'];
if ( ( $data['_session']['CAN_update_csip'] && ( $class == 'CSIP' || $class == 'OPT' ) || 
     ( $data['_session']['CAN_update_sap'] && ( $class == 'SAP' || $class == 'MAND' ) ) ) {
  if ( ! $data['csip']['loc_demo'] ) {
?>
<div class="pad_top_bottom">
<input type="submit" name="op" value="Save This Report">
</div>
<?php
  }
}
?>
</form>
</div>

</div>
<?php } ?>

</div>
<?php } ?>

<?php include( 'csip-close.php' ); ?>
<?php include( 'doc-close.php' ); ?>
