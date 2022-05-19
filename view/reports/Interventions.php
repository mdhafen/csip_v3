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
      <ul class="uk-breadcrumb"><li><a href="Interventions.php">Interventions Report</a></li>
<?php
      if ( !empty($data['run']) && $data['run'] == 'Finished' ) {
          print "<li><span href='#'>Results</span></li></ul>";
          if ( empty($data['gvcs']) ) {
              print "<div class='uk-alert uk-alert-warning' uk-alert><p>No answers found in that course</p></div>";
          }
          print "<div class='uk-text-bold'>Results for ".$data['course_name']."</div>";
          print "<table class='uk-table'>\n";
          print "<thead><tr><th>Location</th><th>Year</th><th>ES#</th><th>ES</th><th>Assessed</th><th>Not Proficient</th><th>Interventions</th><th>Still Not Proficient</th><th>Extensions</th></tr></thead>\n<tbody>\n";
          foreach ( $data['gvcs'] as $location => $years ) {
              foreach ( $years as $year_name => $parts ) {
                  foreach ( $parts as $tab => $questions ) {
                      print "<tr><td>$location</td><td>$year_name</td><td>ES #$tab</td>\n";
                      foreach ( $data['labels'] as $label ) {
                          $answer = $questions[$label];
                          print "<td><span class='prewrap'>$answer</span></td>\n";
                      }
                      print "</tr>\n";
                  }
              }
          }
          print "</tbody>\n</table>\n";
      } else {
          if ( !empty($data['courses']) ) {
              print "<li><span href='#'>Select Course</span></li></ul>";
?>
            <h3>Select a Course</h3>
            <form class="uk-form-horizontal">
              <input type="hidden" name="grade" value="<?= $data['grade'] ?>">
              <input type="hidden" name="yearid" value="<?= $data['yearid'] ?>">
              <?php foreach ( $data['locationids'] as $locid ) { ?>
              <input type="hidden" name="locations[]" value="<?= $locid ?>">
              <?php } ?>
              <div>Select a Course</div>
              <fieldset class="uk-form-controls">
              <?php foreach ( $data['courses'] as $course ) { ?>
              <label for="courseid_<?= $course['courseid'] ?>" class="uk-form-label"><input type="radio" id="courseid_<?= $course['courseid'] ?>" class="uk-radio" name="courseid" value="<?= $course['courseid'] ?>"><?= $course['course_name'] ?></label>
              <?php } ?>
              </fieldset>
              <input type="submit" class="uk-button" value="Run Report" name="run">
            </form>
<?php
          } else {
              print "<li><span href='#'>Select Year, Schools, and/or Grade</span></li></ul>";
?>
            <h3>Select a Year, and Schools and/or Grade Level</h3>
            <form class="uk-form-horizontal">
              <label class="uk-form-label">Select Year</label>
              <div class="uk-form-controls">
              <select name="yearid" class="uk-select">
              <?php foreach ( $data['years'] as $year ) { ?>
              <option value="<?= $year['yearid'] ?>"<?= ($year['yearid'] == $data['yearid']) ? " selected" : "" ?>><?= $year['year_name'] ?></option>
              <?php } ?>
              </select>
              </div>

              <label class="uk-form-label">Select School(s)</label>
              <div class="uk-form-controls">
              <select name="locations[]" multiple size="5" class="uk-select">
              <?php foreach ( $data['locations'] as $loc ) { ?>
              <option value="<?= $loc['locationid'] ?>"><?= $loc['name'] ?></option>
              <?php } ?>
              </select>
              </div>

              <div>And / Or</div>

              <label class="uk-form-label">Enter Grade</label>
              <div class="uk-form-controls">
              <input class="uk-input" type="number" min="1" max="12" name="grade"<?= !empty($data['grade'])?" value='".$data['grade']."'":"" ?>>
              </div>

              <input type="submit" class="uk-button" value="Next" name="run">
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
