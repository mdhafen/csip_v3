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
<h3>Change Special Location Course Assignments for <?= $data['locations'][ [$data['locationid'] ]['name'] ?></h3>

<?php if ( $data['saved'] ) { ?>
<div class="uk-alert uk-alert-success">
Changes saved.
</div>
<?php } ?>

<?php if ( !empty($data['locationid']) ) { ?>
<div class="uk-grid">
<div class="uk-width-1-2">
Courses:
<ul>
<?php foreach ( $data['loc_links'] as $courseid ) { ?>
  <form method="post" action="<?= $data['_config']['base_url'] ?>manage/location_courses.php">
  <input type="hidden" name="locationid" value="<?= $data['locationid'] ?>">
  <input type="hidden" name="courseid" value="<?= $courseid ?>">
  <li>
    <?= $data['courses'][$courseid]['course_name'] ?>
    <input class="uk-button" type="submit" name="op" id="op" value="Delete">
  </li>
  </form>
<?php } ?>
  <form method="post" action="<?= $data['_config']['base_url'] ?>manage/location_courses.php">
  <input type="hidden" name="locationid" value="<?= $data['locationid'] ?>">
  <li>
    <select name="courseid" id="courseid">
      <option value="">Add a Course</option>
<?php foreach ( $data['course_by_cat'] as $category => $courses ) { ?>
      <optgroup label="<?= $category ?>">
<?php   foreach ( $courses as $course ) { ?>
<?php     if ( in_array( $course['courseid'], $data['loc_courses'] ) ) { continue; } ?>
        <option value="<?= $course['courseid'] ?>"><?= $course['course_name'] ?></option>
<?php   } ?>
      </optgroup>
<?php } ?>
    </select>
    <input class="uk-button" type="submit" name="op" id="op" value="Add">
  </li>
  </form>
</ul>
</div>

<div class="uk-width-1-2">
Location already has:
<ul>
<?php foreach ( $data['loc_course_by_cat'] as $category => $courses ) { ?>
  <li>
    <?= $category ?>
    <ul>
<?php   foreach ( $courses as $course ) { ?>
      <li>
        <?= $course['course_name'] ?>
      </li>
<?php   } ?>
    </ul>
  </li>
<?php } ?>
</ul>
</div>

<?php } ?>
</div>
<a class="uk-button" href="users.php">Back</a>

	</div>
	<br>
	<?php include $data['_config']['base_dir'] .'/htdocs/footer.php'; ?>
	</div>
    </body>
</html>
