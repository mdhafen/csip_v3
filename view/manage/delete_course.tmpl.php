<!DOCTYPE html>
<html>
	<head>
	<?php include $data['_config']['base_dir'] .'/view/head.php';?>
	</head>
	<body>
		<?php include $data['_config']['base_dir'] .'/view/menu.php'; ?>

        <div class="uk-container uk-container-center uk-animation-fade">
            <br>

<div class="uk-panel uk-panel-box uk-panel-box-primary">
<h3>Delete Course</h3>

<?php if ( $data['deleted'] ) { ?>
<div class="uk-alert uk-alert-success">Course Deleted</div>
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=<?= $data['_config']['base_url'] ?>manage/courses.php">
<?php } else { ?>
<form method="post" action="<?= $data['_config']['base_url'] ?>manage/delete_course.php">
<input type="hidden" name="courseid" id="courseid" value="<?= $data['course']['courseid'] ?>">
<div>
Are you sure you want to delete <?= $data['course']['course_name'] ?> ( <?= $data['course']['courseid'] ?> )?
</div>
<input type="submit" name="op" id="op" value="Delete">
<input type="reset" name="cancel" id="cancel" value="Cancel" onclick="window.location='<?= $data['_config']['base_url'] ?>manage/courses.php'">
</form>

<div>
    You will also be deleting:

<table>
<tr>
<td><?= $data['dependants']['answers'] ?></td>
<td>Answers</td>
</tr>
<tr>
<td><?= $data['dependants']['approves'] ?></td>
<td>Course Approvals</td>
</tr>
</table>
</div>
<?php } ?>

	</div>
	<br>
	<?php include $data['_config']['base_dir'] .'/view/footer.php'; ?>
	</div>
    </body>
</html>
