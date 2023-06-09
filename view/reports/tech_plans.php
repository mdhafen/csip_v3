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
      <ul class="uk-breadcrumb"><li><a href="tech_plans.php">Archived Technology Plans Report</a></li>
<?php
      if ( !empty($data['run']) && $data['run'] == 'Finished' ) {
          print "<li><span href='#'>Results</span></li></ul>";
          if ( empty($data['plans']) ) {
              print "<div class='uk-alert uk-alert-warning' uk-alert><p>No technology plans found at those locations</p></div>";
          }

          print "<table class='uk-table'>\n";
          print "<thead><tr><th>Location</th><th>Plan</th></tr></thead>\n";
          print "<tbody>\n";

          foreach ( $data['plans'] as $location => $plan ) {
              print "<tr><td>$location</td><td><span class='prewrap'>$plan</span></td></tr>\n";
          }
          print "</tbody>\n";
          print "</table>\n";
      } else {
          print "<li><span href='#'>Select Year, and School(s)</span></li></ul>";
?>
          <h3>Select a Year, and School(s)</h3>
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
                  <option value="<?= $loc['locationid'] ?>"<?= empty($loc['selected'])?"":" selected"?>><?= $loc['name'] ?></option>
              <?php } ?>
              </select>
              </div>

              <input type="submit" class="uk-button" value="Next" name="run">
            </form>
<?php
      }
?>
<?php
include $data['_config']['base_dir'] .'/view/footer.php';
?>
        </div>

	</body>
</html>
