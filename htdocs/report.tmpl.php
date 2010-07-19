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

<h2>Table Of Contents</h2>
<?php
foreach ( (array) $data['category_list'] as $categoryid => $category ) {
  if ( $category['category_type'] == 1 ) {
?>
<h3><a target="_BLANK" href="<?= $category['type_target'] ?>"><?= $category['category_name'] ?></a></h3>
<?php
  } else {
?>
<h3><a href="#cat_<?= $categoryid ?>"><?= $category['category_name'] ?></a></h3>
<?php
  }
}
?>

<?php foreach ( (array) $data['category_list'] as $categoryid => $category ) { ?>
<hr size="15" noshade="noshade">
<a name="cat_<?= $categoryid ?>"></a>
<h2 class="category_name"><?= $category['category_name'] ?></h2>
<?php   if ( $category['category_type'] == 1 ) { ?>
<h3>No Part: <a target="_BLANK" href="<?= $category['type_target'] ?>">Link to another web site</a></h3>
<?php   } else { ?>
<?php     foreach ( (array) $category['part'] as $part => $questions ) { ?>
<h3><?= ( $part == 1 ) ? "Part $part: Student Achievment Data Analysis" : ( ( $part == -1 ) ? "Smart Goals" : "Part $part: Analysis Summary" ) ?></h3>
<ol>
<?php       foreach ( (array) $questions as $ques ) { ?>
<li>
<?= $ques ?>
</li>
<?php       } ?>
</ol>
<?php     } ?>
<?php
          if ( count( (array) $data['csip']['category'][ $category['categoryid'] ]['goal'] ) ) {
	    foreach ( (array) $data['csip']['category'][ $category['categoryid'] ]['goal'] as $goal ) {
?>

<hr size="5" noshade="noshade">
<?php if ( $data['csip']['category'][ $category['categoryid'] ]['custom_goal'] ) { ?>
<table class="goal">
<tr>

<td>
<div class="title">Goal</div>
<div class='report_goal_description'><?= $goal['goal'] ?></div>
</td>

<?php   if ( $data['csip']['version'] < 3 ) { ?>
<td>
<div>
<div class="title">Progress Report</div>
<div class='report_goal_progress'><?= $goal['progress'] ?></div>
</div>

<div>
<div class="title">End of Year Reflection</div>
<div class='report_goal_report'><?= $goal['report'] ?></div>
</div>
</td>
<?php   } ?>

</tr>
</table>
<?php } ?>

<h4 class="title">Action Plans</h4>

<table class="subgoals">
<?php
foreach ( (array) $goal['activity'] as $activity ) {
  $activity_highlight = ! $activity_highlight;
  $a_light = ( $activity_highlight ) ? "highlighted" : "lowlighted";
  $plan_count++;
?>
<tr class='<?= $a_light ?>'>
<td>
<div class="title">Action Plan <?= $plan_count ?></div>
<?php if ( $data['csip']['category'][ $data['categoryid'] ]['custom_goal_focus'] ) { ?>
<div>
This Action Plan addresses: <?= $activity['focus'] ?>
</div>
<?php } ?>
Description:<br>
<div class='report_goal_activity_description'><?= $activity['activity'] ?></div>
<table>
<tr>
<td>
Expected Completion Date:<br>
<div class='report_goal_activity_date'><?php
if ( $activity['complete_date'] ) {
  echo date('m/d/Y', strtotime( $activity['complete_date'] ) );
}
?></div> (MM/DD/YYYY)
</td>
<td>
Action Plan is:<br>
<input type="radio" name="<?= $activity['activityid'] ?>_complete" id="<?= $activity['activityid'] ?>_c_y" value="yes"<?php if ( $activity['completed'] == 1 ) { ?> checked="checked"<?php } ?> disabled="disabled">Complete<br>
<input type="radio" name="<?= $activity['activityid'] ?>_complete" id="<?= $activity['activityid'] ?>_c_n" value="no"<?php if ( $activity['completed'] === 0 || $activity['completed'] === '0' ) { ?> checked="checked"<?php } ?> disabled="disabled">Not Complete<br>
<input type="radio" name="<?= $activity['activityid'] ?>_complete" id="<?= $activity['activityid'] ?>_c_p" value="postponed" disabled="disabled">Postponed<br>
</td>
</tr>
</table>
</td>
<td>
<div class="title">Key People</div>
<table>
<tr><th>Name</th><th>Email Address</th></tr>
<tbody>
<?php
   $people_highlight = 0;
   foreach ( (array) $activity['activity_people'] as $people ) {
     $people_highlight = ! $people_highlight;
     $p_light = ( $people_highlight ) ? "highlighted" : "lowlighted";
?>
<tr class="<?= $p_light ?>">
<td><div class='report_goal_activity_people_name'><?= $people['fullname'] ?></div></td>
<td><div class='report_goal_activity_people_email'><?= $people['people_email'] ?></div></td>
</tr>
<?php
     }
   $people_highlight = ! $people_highlight;
   $p_light = ( $people_highlight ) ? "highlighted" : "lowlighted";
?>
</tbody>
</table>

<div>
<div class="title">Progress Report</div>
<div class='report_goal_activity_progress'><?= $activity['progress'] ?></div>
</div>

<div>
<div class="title">End of Year Reflection</div>
<div class='report_goal_activity_report'><?= $activity['report'] ?></div>
</div>

</td>
</tr>
<?php } ?>
</table>

<?php
	      }
	    }
        }
?>
<?php } ?>

<?php include( 'csip-close.php' ); ?>
<?php include( 'doc-close.php' ); ?>
