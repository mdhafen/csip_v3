<?php include( 'doc-open.php' ); ?>
<title>Welcome to Digital Comprehensive School Improvement Plan</title>
<?php
include( 'doc-head-close.php' );
include( 'doc-header-open.php' );
include( 'doc-header-close.php' );
?>

<?php if ( $data['updated'] ) { ?>
<div class="important">Subgoal updated</div>
Go to the <a href="<?= $data['_config']['base_url'] ?>category_list.php">Category List</a> or <a href="<?= $data['_config']['base_url'] ?>?_logout=1">Logout</a> and close the browser.
<?php } else { ?>
<h1>Subgoal Report</h1>

<form method="post" action="<?= $data['_config']['base_url'] ?>respond.php">
<input type="hidden" name="activity" value="<?= $data['activityid'] ?>">
<input type="hidden" name="goal" value="<?= $data['goalid'] ?>">
<input type="hidden" name="category" value="<?= $data['categoryid'] ?>">
<input type="hidden" name="csip" value="<?= $data['csipid'] ?>">

Subgoal is:<br>
<label for="complete_y"><input type="radio" name="complete" id="complete_y" value="yes" <?= ( $data['response'] == 1 ) ? "checked='checked'" : "" ?>>Complete</label><br>
<label for="complete_n"><input type="radio" name="complete" id="complete_n" value="no" <?= ( $data['response'] === 0 ) ? "checked='checked'" : "" ?>>Not Complete</label><br>

<div class="title">Progress Report</div>
<textarea rows="7" cols="50" name="progress"><?= $data['activity']['progress'] ?></textarea><br>

<div class="title">End of Year Reflection</div>
<textarea rows="7" cols="50" name="report"><?= $data['activity']['report'] ?></textarea><br>

<input type="submit" name="op" value="Save">
</form>

<?php } ?>

<?php include( 'doc-close.php' ); ?>
