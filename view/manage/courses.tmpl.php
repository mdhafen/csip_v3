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
<h3>Courses</h3>

<a class="uk-button" href="<?= $data['_config']['base_url'] ?>manage/edit_course.php">Add Course</a>

<table class="uk-table uk-table-striped">
<thead>
<tr>
<th>Course ID</th><th>Category</th><th>Name</th><th>Minimum Grade</th><th>Maximum Grade</th><th>Active</th><th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php foreach ( $data['courses'] as $course ) { ?>
<tr>
<td><?= $course['courseid'] ?></td>
<td><?= $course['category_name'] ?></td>
<td><?= $course['course_name'] ?></td>
<td><?= $course['min_grade'] ?></td>
<td><?= $course['max_grade'] ?></td>
<td><?= $course['active'] ?></td>
<td>
<div class="uk-button-group">
<a href="<?= $data['_config']['base_url'] ?>manage/edit_course.php?courseid=<?= $course['courseid'] ?>" class="uk-button">Edit</a> 
<a href="<?= $data['_config']['base_url'] ?>manage/delete_course.php?courseid=<?= $course['courseid'] ?>" class="uk-button">Delete</a>
</div>
</td>
</tr>
<?php } ?>
</tbody>
</table>

	</div>
	<br>
	<?php include $data['_config']['base_dir'] .'/view/footer.php'; ?>
	</div>
    </body>
</html>
