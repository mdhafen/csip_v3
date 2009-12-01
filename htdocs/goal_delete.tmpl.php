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

<h3><?php echo substr( $data['goal']['goal'], 0, 40 ) ?></h3>

<?php if ( $data['deleted'] ) { ?>
<div>Goal Deleted</div>
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=<?= $data['_config']['base_url'] ?>goal_list.php?category=<?= $data['categoryid'] ?>">
<?php } else { ?>
<form method="post" action="<?= $data['_config']['base_url'] ?>goal_delete.php">
<input type="hidden" name="goalid" id="goalid" value="<?= $data['goal']['goalid'] ?>">
<input type="hidden" name="categoryid" id="categoryid" value="<?= $data['categoryid'] ?>">
<div>
Are you sure you want to delete <?php echo substr( $data['goal']['goal'], 0, 40 ) ?>...?
</div>
<input type="submit" name="op" id="op" value="Delete">
<input type="reset" name="cancel" id="cancel" value="Cancel" onclick="window.location='<?= $data['_config']['base_url'] ?>goal_list.php?category=<?= $data['categoryid'] ?>'">
</form>

<div>
    You will also be deleting:

<table>
<tr>
<td><?= $data['dependants']['activity'] ?></td>
<td>Activities</td>
</tr>

<tr>
<td><?= $data['dependants']['people'] ?></td>
<td>People</td>
</tr>
</table>
<?php } ?>
