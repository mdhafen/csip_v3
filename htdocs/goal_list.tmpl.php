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

<?php if ( count( $data['questions'] ) ) { ?>
<h3>Smart Goals</h3>

<form method="post" action="<?= $data['_config']['base_url'] ?>goal_list.php?category=<?= $data['categoryid'] ?>">
<ol>
  <?php $count = 1; ?>
  <?php foreach ( (array) $data['questions'] as $question ) { ?>
<!-- <div class="question_list_item"> -->
<!-- <div class="counter"><?php if ( $question['type'] != 9 ) { echo $count++; } ?></div> -->
<!-- <div class="question"><?= $question['input_html'] ?></div> -->
<!-- </div> -->
<li>
<?= $question['input_html'] ?>
</li>
<?php } ?>
</ol>
<?php
if ( $data['inputs'] ) {
  if ( ( $data['_session']['CAN_update_csip'] && $data['csip']['category'][ $data['categoryid'] ]['category_class'] == 'CSIP' ) || 
     ( $data['_session']['CAN_update_sap'] && $data['csip']['category'][ $data['categoryid'] ]['category_class'] == 'SAP' ) ) {
    if ( ! $data['csip']['loc_demo'] ) {
?>
<input type="submit" name="op" value="Save Answers">
<?php
    }
  }
}
?>
</form>
<?php } ?>

<div>
<?php
  if ( $data['csip']['category'][ $data['categoryid'] ]['goal'] ) {
?><ol>
<?php
    foreach ( (array) $data['csip']['category'][ $data['categoryid'] ]['goal'] as $goal ) {
?>
<li><a href="goal.php?categoryid=<?= $data['categoryid'] ?>&goalid=<?= $goal['goalid'] ?>"><?php echo substr( $goal['goal'], 0, 40 ) ?>...</a><span class="pad-left"><a href="goal.php?categoryid=<?= $data['categoryid'] ?>&goalid=<?= $goal['goalid'] ?>">[Edit]</a></span><span class="pad-left"><a href="goal_delete.php?categoryid=<?= $data['categoryid'] ?>&goalid=<?= $goal['goalid'] ?>">[Delete]</a></span></li>
<?php
    }
?></ol>
<?php
  }
?>
<div class="pad_top_bottom">
<a href="<?= $data['_config']['base_url'] ?>goal.php?categoryid=<?= $data['categoryid'] ?>">Add a Goal</a>
</div>
</div>

<?php include( 'csip-close.php' ); ?>
<?php include( 'doc-close.php' ); ?>
