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
			<h2>Select Report</h2>

      <ul class="uk-list">
      <li class="uk-margin"><a class="uk-button" href="<?= $data['_config']['base_url'] ?>reports/GVCs.php">Essential Standards</a></li>
      <li class="uk-margin"><a class="uk-button" href="<?= $data['_config']['base_url'] ?>reports/Interventions.php">Interventions</a></li>
      <li class="uk-margin"><a class="uk-button" href="<?= $data['_config']['base_url'] ?>reports/PGPs.php">Schools Professional Growth Plans by course</a></li>
      <li class="uk-margin"><a class="uk-button" href="<?= $data['_config']['base_url'] ?>reports/leadership_plans.php">Archived Schools Leadership Growth Plans</a></li>
      <li class="uk-margin"><a class="uk-button" href="<?= $data['_config']['base_url'] ?>reports/tech_plans.php">Archived Schools Technology Plans</a></li>
      </ul>
<?php
include $data['_config']['base_dir'] .'/view/footer.php';
?>
        </div>

	</body>
</html>
