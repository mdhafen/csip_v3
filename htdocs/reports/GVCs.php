<!DOCTYPE html>
<html>
	<head>
	<?php include $data['_config']['base_dir'] .'/htdocs/head.php';?>
	</head>
	<body>
		<?php include $data['_config']['base_dir'] .'/htdocs/menu.php'; ?>

        <div class="uk-container uk-container-center uk-animation-fade">
<br>
            <span class="uk-align-right">
						<?php
							foreach( $data['_config']['header_logos'] as $logo ) {
								echo '<img src="' . $logo . '" class="uk-margin-left" style="max-height: 30px">';
							}
						?>
						<br>
						<a href="https://prodev.washk12.org/support/csip" style="float: right;" class="uk-button uk-button-primary" target="_BLANK">Go here for help</a>
            </span>
			<h2>GVCs Report</h2>
<?php
      if ( $data['run'] ) {
          foreach ( $data['gvcs'] as $location => $parts ) {
              print "<table>\n";
              print "<thead><tr><th colspan='2'>$location</th></tr></thead>\n";
              foreach ( $parts as $tab => $questions ) {
                  print "<thead><tr><th colspan='2'>GVC #$tab</th></tr></thead>\n";
                  print "<tbody>\n";
                  foreach ( $questions as $label => $answer ) {
                      print "<tr><td>$label</td><td>$answer</td></tr>\n";
                  }
                  print "</tbody>\n";
              }
              print "</table>\n";
          }
      } else {
          if ( !empty($data['courses']) ) {
?>
            <h3>Select a Course</h3>
            <form class="uk-form-horizontal">
              <input type="hidden" name="grade" value="<?= $data['grade'] ?>">
              <input type="hidden" name="yearid" value="<?= $data['yearid'] ?>">
              <?php foreach ( $data['locationids'] as $locid ) { ?>
              <input type="hidden" name="locations[]" value="<?= $locid ?>">
              <?php } ?>
              <?php foreach ( $data['courses'] as $course ) { ?>
              <label class="uk-form-label"><input type="radio" class="uk-radio" name="courseid" value="<?= $course['courseid'] ?>"><?= $course['course_name'] ?></label>
              <?php } ?>
              <input type="submit" class="uk-button" value="Run Report" name="run">
            </form>
<?php
          } else {
?>
            <h3>Select a Year, and Schools and/or Grade Level</h3>
            <form class="uk-form-horizontal">
              <label class="uk-form-label">Select Year</label><select name="yearid" class="uk-form-controls">
              <?php foreach ( $data['years'] as $year ) { ?>
              <option value="<?= $year['yearid'] ?>"<?= ($year['yearid'] == $data['yearid']) ? " selected" : ""><?= $year['year_name'] ?></option>
              <?php } ?>
              </select>

              <div class="uk-form-controls">
              <?php foreach ( $data['locations'] as $loc ) { ?>
              <label class="uk-form-label"><input type="checkbox" class="uk-checkbox" name="locations[]" value="<?= $loc['locationid'] ?>"><?= $loc['name'] ?></label>
              <?php } ?>
              </div>

              <label class="uk-form-label">Enter Grade</label><input class="uk-input" type="number" min="1" max="12" name="grade"<?= !empty($data['grade'])?" value='".$data['grade']."'":"" ?>>

              <input type="submit" class="uk-button" value="Next" name="run">
            </form>
<?php
          }
      }
?>
<?php
include $data['_config']['base_dir'] .'/htdocs/footer.php';
?>
        </div>

	</body>
</html>
