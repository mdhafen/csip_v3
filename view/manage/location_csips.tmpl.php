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
<h3>List CSIPs for <?= $data['location']['name'] ?></h3>

<?php if ( $data['saved'] ) { ?>
<div class="uk-alert uk-alert-success">
Changes saved.
</div>
<?php } ?>

<?php if ( !empty($data['locationid']) ) { ?>
<div class="uk-grid">
<div class="uk-width-1-2">
CSIPs:
<ul>
<?php foreach ( $data['csips'] as $csip ) { ?>
  <li>
<?php if ( empty($csip['num_answers']) ) { ?>
    <form method="post" action="<?= $data['_config']['base_url'] ?>manage/location_csips.php">
    <input type="hidden" name="locationid" value="<?= $data['locationid'] ?>">
    <input type="hidden" name="csipid" value="<?= $csip['csipid'] ?>">
<?php } ?>
    <?= $csip['year_name'] ?>
<?php if ( empty($csip['num_answers']) ) { ?>
    <input class="uk-button" type="submit" name="op" id="op" value="Delete">
    </form>
<?php } ?>
  </li>
<?php } ?>
  <li>
  <form method="post" action="<?= $data['_config']['base_url'] ?>manage/location_csips.php">
  <input type="hidden" name="locationid" value="<?= $data['locationid'] ?>">
    <select name="yearid" id="yearid">
      <option value="">Add a CSIP</option>
<?php foreach ( $data['years'] as $year ) { ?>
 <?php   if ( in_array( $year['yearid'], array_column($data['csips'],'yearid') ) ) { continue; } ?>
      <option value="<?= $year['yearid'] ?>"><?= $year['year_name'] ?></option>
<?php } ?>
    </select>
    <input class="uk-button" type="submit" name="op" id="op" value="Add">
  </form>
  </li>
</ul>
</div>


<?php } ?>
</div>
<a class="uk-button" href="locations.php">Back</a>

	</div>
	<br>
	<?php include $data['_config']['base_dir'] .'/view/footer.php'; ?>
	</div>
    </body>
</html>
