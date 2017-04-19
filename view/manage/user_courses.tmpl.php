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

<?php if ( !empty($data['locationid']) ) { ?>
Courses:
<ul>
<?php foreach ( $data['user_courses'] as $courseid => $course ) { ?>
  <form method="post" action="<?= $data['_config']['base_url'] ?>manage/user_courses.php">
  <input type="hidden" name="userid" value="<?= $data['user']['userid'] ?>">
  <input type="hidden" name="locationid" value="<?= $data['locationid'] ?>">
  <input type="hidden" name="courseid" value="<?= $courseid ?>">
  <li>
    <?= $data['courses'][$courseid]['course_name'] ?>
    <input class="uk-button" type="submit" name="op" id="op" value="Delete">
  </li>
  </form>
<?php } ?>
  <form method="post" action="<?= $data['_config']['base_url'] ?>manage/user_courses.php">
  <input type="hidden" name="userid" value="<?= $data['user']['userid'] ?>">
  <input type="hidden" name="locationid" value="<?= $data['locationid'] ?>">
  <li>
    <select name="courseid" id="courseid">
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
  </form>
</ul>
<?php } ?>

<a class="uk-button" href="users.php">Back</a>

	</div>
	<br>
	<?php include $data['_config']['base_dir'] .'/view/footer.php'; ?>
	</div>
    </body>
</html>
