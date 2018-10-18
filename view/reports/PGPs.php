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
      <ul class="uk-breadcrumb"><li><a href="PGPs.php">PGPs Report</a></li>
<?php
      if ( !empty($data['run']) && $data['run'] == 'Finished' ) {
          print "<li><span href='#'>Results</span></li></ul>";
          if ( empty($data['plans']) ) {
              print "<div class='uk-alert uk-alert-warning' uk-alert><p>No plans found at those locations</p></div>";
          }
          print "<table class='uk-table'>\n";
          print "<thead><tr><th>Location</th><th>Course</th><th>Plan</th></tr></thead>\n";
          print "<tbody>\n";
          foreach ( $data['plans'] as $location => $courses ) {
              foreach ( $courses as $course_name => $answer ) {
                  print "<tr><td>$location</td><td>$course_name</td><td><span class='prewrap'>$answer</span></td></tr>\n";
              }
          }
          print "</tbody>\n";
          print "</table>\n";
      } else {
          if ( !empty($data['courses']) ) {
              print "<li><span href='#'>Select Course</span></li></ul>";
?>
            <h3>Select a Course</h3>
            <form class="uk-form-horizontal">
              <input type="hidden" name="yearid" value="<?= $data['yearid'] ?>">
              <?php foreach ( $data['locationids'] as $locid ) { ?>
              <input type="hidden" name="locations[]" value="<?= $locid ?>">
              <?php } ?>
              <div>Select a Course</div>
              <fieldset class="uk-form-controls">
              <?php foreach ( $data['courses'] as $course ) { ?>
              <label for="courseids_<?= $course['courseid'] ?>" class="uk-form-label"><input type="checkbox" id="courseids_<?= $course['courseid'] ?>" class="uk-radio" name="courseids[]" value="<?= $course['courseid'] ?>"><?= $course['course_name'] ?></label>
              <?php } ?>
              </fieldset>
              <input type="submit" class="uk-button" value="Run Report" name="run">
            </form>
<?php
          } else {
              print "<li><span href='#'>Select Year and School(s)</span></li></ul>";
?>
            <h3>Select a Year and School(s)</h3>
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
              <select name="locations[]" multiple size="10" class="uk-select">
              <?php foreach ( $data['locations'] as $loc ) { ?>
              <option value="<?= $loc['locationid'] ?>"<?= empty($loc['selected'])?"":" selected" ?>><?= $loc['name'] ?></option>
              <?php } ?>
              </select>
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
