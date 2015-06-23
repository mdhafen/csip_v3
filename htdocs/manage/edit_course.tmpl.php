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
<h3><?= ($data['edit'])?"Edit":"New" ?> Course</h3>

<?php if ( $data['saved'] ) { ?>
<div class="uk-alert uk-alert-success">
Changes saved.
</div>
<?php } ?>

<form method="post" action="<?= $data['_config']['base_url'] ?>manage/edit_course.php">
<input type="hidden" name="courseid" id="courseid" value="<?= $data['course']['courseid'] ?>">
<?php if ( $data['error'] ) { ?>
<div class="uk-alert uk-alert-warning">
There was an error
<?php
foreach ( (array) $data['error'] as $err ) {
    print "<div>$err</div>\n";
}
?>
</div>
<?php } ?>
<table>

<tr>
<td><label for="categoryid">Category</label></td>
<td>
  <select id="categoryid" name="categoryid">
    <option value="">Pick one</option>
<?php foreach ( $data['categories'] as $categoryid => $category ) { ?>
<option value="<?= $categoryid ?>"<?= ( !empty($category['selected']) ) ? " selected" : "" ?>><?= $category['category_name'] ?></option>
<?php } ?>
  </select>
</td>
</tr>

<tr>
<td><label for="course_name">Name</label></td>
<td><input name="course_name" id="course_name" value="<?= $data['course']['course_name'] ?>" ></td>
</tr>

<tr>
<td><label for="min_grade">First Grade</label></td>
<td><input name="min_grade" id="min_grade" value="<?= $data['course']['min_grade'] ?>" > <span class="uk-form-help-inline">Enter 0 for Kindergarten</span></td>
</tr>

<tr>
<td><label for="max_grade">Last Grade</label></td>
<td><input name="max_grade" id="max_grade" value="<?= $data['course']['max_grade'] ?>" ></td>
</tr>

<tr>
<td><label for="active">Course is active</label></td>
<td><input type="checkbox" name="active" id="active"<?= ( empty($data['course']) || !empty($data['course']['active']) ) ? " checked='checked'" : "" ?>></td>
</tr>

<tr>
<td><label for="parts1">Course Parts and Questions</label></td>
<td>
<?php if ( !empty($data['parts']) ) { ?>
<?php   foreach ( $data['parts'] as $part ) { ?>
<div class="uk-form-row">
<div class="uk-form-controls"><input name="parts[]" type="text" value="<?= $part['part'] ?>"></div>
<div class="uk-form-controls"><input name="questions[]" type="text" value="<?= $part['question_group'] ?>"></div>
<div class="uk-form-controls"><input name="part_titles[]" type="text" value="<?= $part['title'] ?>"></div>
</div>
<?php   } ?>
<?php } else { ?>
<div class="uk-form-row">
<div class="uk-form-controls"><input name="parts[]" type="text" value="1"></div>
<div class="uk-form-controls"><input name="questions[]" type="text" value="1"></div>
<div class="uk-form-controls"><input name="part_titles[]" type="text" value="Guaranteed Curriculum"></div>
</div>

<div class="uk-form-row">
<div class="uk-form-controls"><input name="parts[]" type="text" value="2"></div>
<div class="uk-form-controls"><input name="questions[]" type="text" value="2"></div>
<div class="uk-form-controls"><input name="part_titles[]" type="text" value="Accreditation"></div>
</div>

<div class="uk-form-row">
<div class="uk-form-controls"><input name="parts[]" type="text" value="3"></div>
<div class="uk-form-controls"><input name="questions[]" type="text" value="3"></div>
<div class="uk-form-controls"><input name="part_titles[]" type="text" value="GVC 1"></div>
</div>
<?php } ?>
</td>
</tr>

</table>
<input class="uk-button" type="submit" name="op" id="op" value="Save">

<a class="uk-button" href="courses.php">Back</a>

</form>

	</div>
	<br>
	<?php include $data['_config']['base_dir'] .'/htdocs/footer.php'; ?>
	</div>
    </body>
</html>
