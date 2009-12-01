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

<h2><?= $data['csip']['category'][ $data['categoryid'] ]['category_name'] ?></h2>
<?php
}
?>

<h3>Goal</h3>

<?php if ( $data['updated'] ) { ?>
<div class="important">Changes Saved</div>
<?php } ?>

<form method="post" action="<?= $data['_config']['base_url'] ?>goal.php?goalid=<?= $data['goal']['goalid'] ?>&categoryid=<?= $data['categoryid'] ?>">
<textarea rows="5" cols="40" name="goal_description"><?= $data['goal']['goal'] ?></textarea><br>
<?php
if ( ( $data['_session']['CAN_update_csip'] && $data['csip']['category'][ $data['categoryid'] ]['category_class'] == 'CSIP' ) || 
     ( $data['_session']['CAN_update_sap'] && $data['csip']['category'][ $data['categoryid'] ]['category_class'] == 'SAP' ) ) {
  if ( ! $data['csip']['loc_demo'] ) {
?>
<input type="submit" name="op" id="op" value="Save">
<?php
  }
}
?>
</form>

<h4>Subgoals</h4>

<table class="subgoals">
<?php
foreach ( (array) $data['goal']['activity'] as $activity ) {
  $activity_highlight = ! $activity_highlight;
  $a_light = ( $activity_highlight ) ? "highlighted" : "lowlighted";
?>
<tr class='<?= $a_light ?>'>
<form method="post" action="<?= $data['_config']['base_url'] ?>goal.php?goalid=<?= $data['goal']['goalid'] ?>&categoryid=<?= $data['categoryid'] ?>">
<td>
<input type="hidden" name="activityid" value="<?= $activity['activityid'] ?>">
<div class="title">Subgoal / Plan</div>
<?php if ( $data['csip']['category'][ $data['categoryid'] ]['custom_goal_focus'] ) { ?>
<label for="<?= $activity['activityid'] ?>_focus">This Subgoal addresses:</label>
<select name="<?= $activity['activityid'] ?>_focus" id="<?= $activity['activityid'] ?>_focus">
<option value="">Choose Best Description</option>
<?php
										foreach ( $data['focus_list'] as $focusid => $focusname ) {
  $selected = ( $focusid == $activity['focus'] ) ? "selected='selected'" : "";
?>
<option value="<?= $focusid ?>" <?= $selected ?>><?= $focusname ?></option>
<?php }?>
</select><br>
<?php } ?>
<textarea name="<?= $activity['activityid'] ?>_activity_description" cols="65" rows="15"><?= $activity['activity'] ?></textarea>
<table>
<tr>
<td>
Expected Completion Date:<br>
<input type="text" name="<?= $activity['activityid'] ?>_complete_date" size="10" value="<?php
if ( $activity['complete_date'] && $activity['complete_date'] != '0000-00-00' ) {
  echo date('m/d/Y', strtotime( $activity['complete_date'] ) );
}
?>"> (MM/DD/YYYY)
</td>
<td>
Subgoal is:<br>
<label for="<?= $activity['activityid'] ?>_c_y"><input type="radio" name="<?= $activity['activityid'] ?>_complete" id="<?= $activity['activityid'] ?>_c_y" value="yes"<?php if ( $activity['completed'] == 1 ) { ?> checked="checked"<?php } ?>>Complete</label><br>
<label for="<?= $activity['activityid'] ?>_c_n"><input type="radio" name="<?= $activity['activityid'] ?>_complete" id="<?= $activity['activityid'] ?>_c_n" value="no"<?php if ( $activity['completed'] === 0 || $activity['completed'] === '0' ) { ?> checked="checked"<?php } ?>>Not Complete</label><br>
</td>
</tr>
</table>
<?php
if ( ( $data['_session']['CAN_update_csip'] && $data['csip']['category'][ $data['categoryid'] ]['category_class'] == 'CSIP' ) || 
     ( $data['_session']['CAN_update_sap'] && $data['csip']['category'][ $data['categoryid'] ]['category_class'] == 'SAP' ) ) {
  if ( ! $data['csip']['loc_demo'] ) {
?>
<input type="submit" name="op" id="op" value="Save Subgoal">
<?php
  }
}
?>
</td>
<td>
<div class="title">Key People</div>
<table>
<tr><th>Name</th><th>Email Address</th><th></th></tr>
<tbody>
<?php
   $people_highlight = 0;
   foreach ( (array) $activity['activity_people'] as $people ) {
     $people_highlight = ! $people_highlight;
     $p_light = ( $people_highlight ) ? "highlighted" : "lowlighted";
?>
<tr class="<?= $p_light ?>">
<td><input type="hidden" name="<?= $activity['activityid'] ?>_people_id[]" value="<?= $people['activity_people_id'] ?>"><input name="<?= $activity['activityid'] ?>_fullname[]" value="<?= $people['fullname'] ?>"></td>
<td><input name="<?= $activity['activityid'] ?>_people_email[]" value="<?= $people['people_email'] ?>"></td>
<td><label for="<?= $activity['activityid'] ?>_people_delete_<?= $people['activity_people_id'] ?>"><input type="checkbox" name="<?= $activity['activityid'] ?>_people_delete_<?= $people['activity_people_id'] ?>" id="<?= $activity['activityid'] ?>_people_delete_<?= $people['activity_people_id'] ?>">Delete</label></td>
</tr>
<?php
     }
   $people_highlight = ! $people_highlight;
   $p_light = ( $people_highlight ) ? "highlighted" : "lowlighted";
?>
<tr class="<?= $p_light ?>"><td><input type="text" name="<?= $activity['activityid'] ?>_fullname[]" value=""></td><td><input type="text" name="<?= $activity['activityid'] ?>_people_email[]" value=""></td><td></td></tr>
</tbody>
</table>

<div>
<div class="title">Progress Report</div>
<textarea name="<?= $activity['activityid'] ?>_progress" cols="50" rows="7"><?= $activity['progress'] ?></textarea>
</div>

<div>
<div class="title">End of Year Reflection</div>
<textarea name="<?= $activity['activityid'] ?>_report" cols="50" rows="7"><?= $activity['report'] ?></textarea>
</div>

</td>
</form>
</tr>
<tr class='<?= $a_light ?>'><td colspan="2">
<form method="post" action="<?= $data['_config']['base_url'] ?>goal.php?goalid=<?= $data['goal']['goalid'] ?>&categoryid=<?= $data['categoryid'] ?>">
<input type="hidden" name="activityid" value="<?= $activity['activityid'] ?>">
<?php if ( $activity['activityid'] ) { ?>
<input type="submit" name="op" id="op" value="Delete Subgoal">
<?php } ?>
</form>
</td></tr>
<?php } ?>
</table>

<?php if ( $data['goal']['goalid'] ) { ?>
<div class="pad_top_bottom">
<a href="<?= $data['_config']['base_url'] ?>goal.php?op=Add+a+Subgoal&goalid=<?= $data['goal']['goalid'] ?>&categoryid=<?= $data['categoryid'] ?>">Add a Subgoal</a>
</div>
<?php } ?>

<div id="goal_csip_close">
<a href="<?= $data['_config']['base_url'] ?>goal_list.php?category=<?= $data['categoryid'] ?>">Back to <?= $data['csip']['category'][ $data['categoryid'] ]['category_name'] ?> Goals</a>
</div>
<?php include( 'csip-close.php' ); ?>
<?php include( 'doc-close.php' ); ?>
