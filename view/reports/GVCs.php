<!DOCTYPE html>
<html>
	<head>
	<?php include $data['_config']['base_dir'] .'/view/head.php';?>
	</head>
	<body>
		<?php include $data['_config']['base_dir'] .'/view/menu.php'; ?>

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
      <ul class="uk-breadcrumb"><li><a href="GVCs.php">GVCs Report</a></li>
<?php
      if ( !empty($data['run']) && $data['run'] == 'Finished' ) {
          print "<li><span href='#'>Results</span></li></ul>";
          if ( empty($data['gvcs']) ) {
              print "<div class='uk-alert uk-alert-warning' uk-alert><p>No answers found in that course</p></div>";
          }
          print "<div class='uk-text-bold'>Results". ( empty($data['all_courses']) ? " for ".$data['course_names'][ $data['courseid'] ] : "" ) ."</div>";
          foreach ( $data['gvcs'] as $location => $courses ) {
              print "<table class='uk-table'>\n";
              if ( !empty($data['all_courses']) ) {
                  print "<thead><tr><th colspan='3'>$location</th></tr></thead>\n";
                  print "<thead><tr><th>Course</th><th>GVCs</td><th>Answers</th></tr></thead>\n<tbody>\n";
                  foreach ( $courses as $course_name => $parts ) {
                      $gvcs = 0;
                      $answers = 0;
                      foreach ( $parts as $tab => $questions ) {
                          foreach ( $questions as $label => $answer ) {
                              $answers += $answer;
                              if ( $answer ) { $gvcs++; }
                          }
                      }
                      print "<tr><td>$course_name</td><td>$gvcs</td><td>$answers</td></tr>\n";
                  }
                  print "</tbody>\n";
              }
              else {
                  print "<thead><tr><th colspan='2'>$location</th></tr></thead>\n";
                  foreach ( $courses as $course_name => $parts ) {
                      foreach ( $parts as $tab => $questions ) {
                          print "<thead><tr><th colspan='2'>GVC #$tab</th></tr></thead>\n";
                          print "<tbody>\n";
                          foreach ( $questions as $label => $answer ) {
                              print "<tr><td>$label</td><td><span class='prewrap'>$answer</span></td></tr>\n";
                          }
                          print "</tbody>\n";
                      }
                  }
              }
              print "</table>\n";
          }
      } else {
          if ( !empty($data['courses']) ) {
              print "<li><span href='#'>Select Course</span></li></ul>";
?>
            <h3>Select Questions and Course(s)</h3>
            <form class="uk-form-horizontal">
              <input type="hidden" name="grade" value="<?= $data['grade'] ?>">
              <input type="hidden" name="yearid" value="<?= $data['yearid'] ?>">
              <?php foreach ( $data['locationids'] as $locid ) { ?>
              <input type="hidden" name="locations[]" value="<?= $locid ?>">
              <?php } ?>

              <fieldset>
              <div class="uk-form-row uk-form-controls">
              <label for="CFAs">
              <input type="checkbox" checked value="1" name="CFAs" id="CFAs" class="uk-checkbox"> Also show Learning Targets and CFAs if available
              </label>
              </div>
              </fieldset>

              <fieldset>

              <div class="uk-form-row uk-form-controls">
              <label for="all_courses">
              <input type="checkbox" value="1" name="all_courses" id="all_courses" class="uk-checkbox"> Show brief list of all courses
              </label>
              </div>

              <div>And / Or Select a Course</div>
              <fieldset class="uk-form-controls">
              <label for="courseid_0" class="uk-form-label"><input type="radio" id="courseid_0" class="uk-radio" name="courseid" value="">All courses</label>
              <?php foreach ( $data['courses'] as $course ) { ?>
              <label for="courseid_<?= $course['courseid'] ?>" class="uk-form-label"><input type="radio" id="courseid_<?= $course['courseid'] ?>" class="uk-radio" name="courseid" value="<?= $course['courseid'] ?>"><?= $course['course_name'] ?></label>
              <?php } ?>
              </fieldset>

              </fieldset>

              <input type="submit" class="uk-button" value="Run Report" name="run">
            </form>
<?php
          } else {
              print "<li><span href='#'>Select Year, Schools, and/or Grade</span></li></ul>";
?>
            <h3>Select a Year, and Schools and/or Grade Level</h3>
            <form class="uk-form-horizontal">
              <fieldset>
              <div class="uk-form-row">
              <label class="uk-form-label">Select Year</label>
              <div class="uk-form-controls">
              <select name="yearid" class="uk-select">
              <?php foreach ( $data['years'] as $year ) { ?>
              <option value="<?= $year['yearid'] ?>"<?= ($year['yearid'] == $data['yearid']) ? " selected" : "" ?>><?= $year['year_name'] ?></option>
              <?php } ?>
              </select>
              </div>
              </div>
              </fieldset>

              <fieldset>

              <div class="uk-form-row">
              <label class="uk-form-label">Select School(s)</label>
              <div class="uk-form-controls">
              <select name="locations[]" multiple size="5" class="uk-select">
              <?php foreach ( $data['locations'] as $loc ) { ?>
              <option value="<?= $loc['locationid'] ?>"><?= $loc['name'] ?></option>
              <?php } ?>
              </select>
              </div>
              </div>

              <h3>And / Or</h3>

              <div class="uk-form-row">
              <label class="uk-form-label">Enter Grade</label>
              <div class="uk-form-controls">
              <input class="uk-input" type="number" min="1" max="12" name="grade"<?= !empty($data['grade'])?" value='".$data['grade']."'":"" ?>>
              </div>
              </div>

              </fieldset>

              <div class="uk-form-row">
              <input type="submit" class="uk-button" value="Next" name="run">
              </div>
            </form>
<?php
          }
      }
?>
<?php
include $data['_config']['base_dir'] .'/view/footer.php';
?>
        </div>

	</body>
</html>
