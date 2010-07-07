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

<?php if ( $data['updated'] ) { ?>
<div class="important">Changes Saved</div>
<?php } ?>

<?php if ( $data['csip']['category'][ $data['categoryid'] ]['custom_goal'] ) { ?>
<form method="post" action="<?= $data['_config']['base_url'] ?>goal.php?goalid=<?= $data['goal']['goalid'] ?>&categoryid=<?= $data['categoryid'] ?>">
<table class="goal">
<tr>

<td>
<div class="title">Goal</div>
<textarea rows="15" cols="65" name="goal_description"><?= $data['goal']['goal'] ?></textarea>
</td>

<td>
<div>
<div class="title">Progress Report</div>
<textarea name="goal_progress" cols="50" rows="6"><?= $data['goal']['progress'] ?></textarea>
</div>

<div>
<div class="title">End of Year Reflection</div>
<textarea name="goal_report" cols="50" rows="6"><?= $data['goal']['report'] ?></textarea>
</div>
</td>

</tr>
</table><br>
<?php
$class = $data['csip']['category'][ $data['categoryid'] ]['category_class'];
if ( ( $data['_session']['CAN_update_csip'] && ( $class == 'CSIP' || $class == 'OPT' ) ) || 
     ( $data['_session']['CAN_update_sap'] && ( $class == 'SAP' || $class == 'MAND' ) ) ||
     ( $class == 'OTHR' && ( $data['_session']['CAN_update_sap'] || $data['_session']['CAN_update_csip'] ) ) ) {
  if ( ! $data['csip']['loc_demo'] ) {
?>
<input type="submit" name="op" id="op" value="Save">
<?php
  }
}
?>
</form>
<?php } else { ?>
<div>
In order to meet the SMART GOAL for Student Learngin the following action plans will be completed.  Be sure to indicate for each plan:
<ul>
 <li>A description of the activity</li>
 <li>How progress will be measured (data-type,frequency,etc.)</li>
</ul>
<div class="important">ACCREDITATION ALERT: Include DRSLs as part of Action Plans</div>
</div>
<?php } ?>

<h4>Action Plans</h4>

<table class="subgoals">
<?php
foreach ( (array) $data['goal']['activity'] as $activity ) {
  $activity_highlight = ! $activity_highlight;
  $a_light = ( $activity_highlight ) ? "highlighted" : "lowlighted";
  $plan_count++;
?>
<tr class='<?= $a_light ?>'>
<form method="post" action="<?= $data['_config']['base_url'] ?>goal.php?goalid=<?= $data['goal']['goalid'] ?>&categoryid=<?= $data['categoryid'] ?>">
<td>
<input type="hidden" name="activityid" value="<?= $activity['activityid'] ?>">
<div class="title">Action Plan <?= $plan_count ?></div>
<?php if ( $data['csip']['category'][ $data['categoryid'] ]['custom_goal_focus'] ) { ?>
<label for="<?= $activity['activityid'] ?>_focus">This Action Plan addresses:</label>
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
Action Plan is:<br>
<label for="<?= $activity['activityid'] ?>_c_y"><input type="radio" name="<?= $activity['activityid'] ?>_complete" id="<?= $activity['activityid'] ?>_c_y" value="yes"<?php if ( $activity['completed'] == 1 ) { ?> checked="checked"<?php } ?>>Complete</label><br>
<label for="<?= $activity['activityid'] ?>_c_n"><input type="radio" name="<?= $activity['activityid'] ?>_complete" id="<?= $activity['activityid'] ?>_c_n" value="no"<?php if ( $activity['completed'] === 0 || $activity['completed'] === '0' ) { ?> checked="checked"<?php } ?>>Not Complete</label><br>
</td>
</tr>
</table>
<?php
$class = $data['csip']['category'][ $data['categoryid'] ]['category_class'];
if ( ( $data['_session']['CAN_update_csip'] && ( $class == 'CSIP' || $class == 'OPT' ) ) || 
     ( $data['_session']['CAN_update_sap'] && ( $class == 'SAP' || $class == 'MAND' ) ) ||
     ( $class == 'OTHR' && ( $data['_session']['CAN_update_sap'] || $data['_session']['CAN_update_csip'] ) ) ) {
  if ( ! $data['csip']['loc_demo'] ) {
?>
<input type="hidden" name="op" value="Save Subgoal">
<input type="submit" name="button" id="op" value="Save Action Plan">
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
<input type="hidden" name="op" value="Delete Subgoal">
<input type="submit" name="button" id="op" value="Delete Action Plan">
<?php } ?>
</form>
</td></tr>
<?php } ?>
</table>

<?php if ( $data['goal']['goalid'] || ! $data['csip']['category'][ $data['categoryid'] ]['custom_goal'] ) { ?>
<div class="pad_top_bottom">
<a href="<?= $data['_config']['base_url'] ?>goal.php?op=Add+a+Subgoal&goalid=<?= $data['goal']['goalid'] ?>&categoryid=<?= $data['categoryid'] ?>">Add an Action Plan</a>
</div>
<?php } ?>

<div id="goal_csip_close">
<a href="<?= $data['_config']['base_url'] ?>goal_list.php?category=<?= $data['categoryid'] ?>">Back to <?= $data['csip']['category'][ $data['categoryid'] ]['category_name'] ?> Goals</a>
</div>
<?php include( 'csip-close.php' ); ?>
<?php include( 'doc-close.php' ); ?>
