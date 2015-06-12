<!DOCTYPE html>
<html>
	<head>
	<?php include $data['_config']['base_dir'] .'/htdocs/head.php';?>
	</head>
	<body>
		<?php include $data['_config']['base_dir'] .'/htdocs/menu.php'; ?>

        <div class="uk-container uk-container-center uk-animation-fade">
            <br>

<div class="uk-panel uk-panel-box uk-panel-box-primary">
<h3>Change User Course Assignments for <?= $data['user']['fullname'] ?></h3>

<?php if ( $data['saved'] ) { ?>
<div class="uk-alert uk-alert-success">
Changes saved.
</div>
<?php } ?>

<form method="post" action="<?= $data['_config']['base_url'] ?>manage/user_courses.php">
<input type="hidden" name="userid" id="userid" value="<?= $data['user']['userid'] ?>">
For location: <select name="locationid" id="location" onchange="this.form.submit()">
<option value="">Select the location</option>
<?php foreach ( $data['locations'] as $loc ) { ?>
<option value="<?= $loc['locationid'] ?>"<?= (!empty($data['locationid']) && $data['locationid'] == $loc['locationid']) ? " selected='selected'" : "" ?>><?= $loc['name'] ?></option>
<?php } ?>
</select>
</form>

Courses:
<ul>
<?php foreach ( $data['user_courses'] as $courseid ) { ?>
<form method="post" action="<?= $data['_config']['base_url'] ?>manage/user_courses.php">
<input type="hidden" name="userid" id="userid" value="<?= $data['user']['userid'] ?>">
<input type="hidden" name="locationid" id="locationid" value="<?= $data['locationid'] ?>">
  <li>
    <?= $data['courses'][$courseid]['course_name'] ?>
    <input class="uk-button" type="submit" name="op" id="op" value="Delete">
  </li>
</form>
<?php } ?>
  <li>
<form method="post" action="<?= $data['_config']['base_url'] ?>manage/user_courses.php">
<input type="hidden" name="userid" id="userid" value="<?= $data['user']['userid'] ?>">
<input type="hidden" name="locationid" id="locationid" value="<?= $data['locationid'] ?>">
    <select>
      <option value="">Add a Course</option>
<?php foreach ( $data['course_by_cat'] as $category => $courses ) { ?>
      <optgroup label="<?= $category ?>">
<?php   foreach ( $courses as $course ) { ?>
<?php     if ( in_array( $course['courseid'], $data['user_courses'] ) ) { continue; } ?>
        <option value="<?= $course['courseid'] ?>"><?= $course['course_name'] ?></option>
<?php   } ?>
      </optgroup>
<?php } ?>
    </select>
<input class="uk-button" type="submit" name="op" id="op" value="Add">
  </li>
</ul>


<a class="uk-button" href="users.php">Back</a>

</form>

	</div>
	<br>
	<?php include $data['_config']['base_dir'] .'/htdocs/footer.php'; ?>
	</div>
    </body>
</html>
