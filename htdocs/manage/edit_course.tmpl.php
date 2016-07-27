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
<input type="hidden" name="courseid" id="courseid" value="<?= (!empty($data['course']['courseid'])) ? $data['course']['courseid'] : "" ?>">
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
<td><input name="course_name" id="course_name" value="<?= (!empty($data['course']['course_name'])) ? $data['course']['course_name'] : "" ?>" ></td>
</tr>

<tr>
<td><label for="min_grade">First Grade</label></td>
<td><input name="min_grade" id="min_grade" value="<?= (isset($data['course']['min_grade'])) ? $data['course']['min_grade'] : "" ?>" > <span class="uk-form-help-inline">Enter 0 for Kindergarten</span></td>
</tr>

<tr>
<td><label for="max_grade">Last Grade</label></td>
<td><input name="max_grade" id="max_grade" value="<?= (isset($data['course']['max_grade'])) ? $data['course']['max_grade'] : "" ?>" ></td>
</tr>

<tr>
<td><label for="active">Course is active</label></td>
<td><input type="checkbox" name="active" id="active"<?= ( empty($data['course']) || !empty($data['course']['active']) ) ? " checked='checked'" : "" ?>></td>
</tr>

<tr>
<td><label for="externalid">External IDs</label></td>
<td><input type="text" name="externalid" id="externalid" disabled value="<?= !empty($data['externalids']) ? implode( ',', array_column($data['externalids'],'externalid') ) : "" ?>" ></td>
</tr>

<tr>
<td><label>Course Parts and Questions</label></td>
<td>
<?php if ( !empty($data['parts']) ) { $count = 0; ?>
<?php   foreach ( $data['parts'] as $part ) { $count++; ?>
<div class="uk-form-row">
<div class="uk-form-controls uk-grid uk-grid-collapse"><label class="uk-width-4-10" for="part<?= $count ?>">Part:</label><input class="uk-width-6-10" id="part<?= $count ?>" name="parts[]" type="text" value="<?= $part['part'] ?>"></div>
<div class="uk-form-controls uk-grid uk-grid-collapse"><label class="uk-width-4-10" for="group<?= $count ?>">Question Group:</label><input class="uk-width-6-10" id="group<?= $count ?>" name="questions[]" type="text" value="<?= $part['question_group'] ?>"></div>
<div class="uk-form-controls uk-grid uk-grid-collapse"><label class="uk-width-4-10" for="title<?= $count ?>">Part Title:</label><input class="uk-width-6-10" id="title<?= $count ?>" name="part_titles[]" type="text" value="<?= $part['title'] ?>"></div>
</div>
<?php   } ?>
<?php } else { ?>
<div class="uk-form-row">
<div class="uk-form-controls uk-grid uk-grid-collapse"><label class="uk-width-4-10" for="part1">Part:</label><input class="uk-width-6-10" id="part1" name="parts[]" type="text" value="1"></div>
<div class="uk-form-controls uk-grid uk-grid-collapse"><label class="uk-width-4-10" for="group1">Question Group:</label><input class="uk-width-6-10" id="group1" name="questions[]" type="text" value="1"></div>
<div class="uk-form-controls uk-grid uk-grid-collapse"><label class="uk-width-4-10" for="title1">Part Title:</label><input class="uk-width-6-10" id="title1" name="part_titles[]" type="text" value="Guaranteed Curriculum"></div>
</div>

<div class="uk-form-row">
<div class="uk-form-controls uk-grid uk-grid-collapse"><label class="uk-width-4-10" for="part2">Part:</label><input class="uk-width-6-10" id="part2" name="parts[]" type="text" value="2"></div>
<div class="uk-form-controls uk-grid uk-grid-collapse"><label class="uk-width-4-10" for="group2">Question Group:</label><input class="uk-width-6-10" id="group2" name="questions[]" type="text" value="2"></div>
<div class="uk-form-controls uk-grid uk-grid-collapse"><label class="uk-width-4-10" for="title2">Part Title:</label><input class="uk-width-6-10" id="title2" name="part_titles[]" type="text" value="Accreditation"></div>
</div>

<div class="uk-form-row">
<div class="uk-form-controls uk-grid uk-grid-collapse"><label class="uk-width-4-10" for="part3">Part:</label><input class="uk-width-6-10" id="part3" name="parts[]" type="text" value="3"></div>
<div class="uk-form-controls uk-grid uk-grid-collapse"><label class="uk-width-4-10" for="group3">Question Group:</label><input class="uk-width-6-10" id="group3" name="questions[]" type="text" value="3"></div>
<div class="uk-form-controls uk-grid uk-grid-collapse"><label class="uk-width-4-10" for="title3">Part Title:</label><input class="uk-width-6-10" id="title3" name="part_titles[]" type="text" value="Stakeholder Input"></div>
</div>

<div class="uk-form-row">
<div class="uk-form-controls uk-grid uk-grid-collapse"><label class="uk-width-4-10" for="part4">Part:</label><input class="uk-width-6-10" id="part4" name="parts[]" type="text" value="4"></div>
<div class="uk-form-controls uk-grid uk-grid-collapse"><label class="uk-width-4-10" for="group4">Question Group:</label><input class="uk-width-6-10" id="group4" name="questions[]" type="text" value="4"></div>
<div class="uk-form-controls uk-grid uk-grid-collapse"><label class="uk-width-4-10" for="title4">Part Title:</label><input class="uk-width-6-10" id="title4" name="part_titles[]" type="text" value="GVC 1"></div>
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
