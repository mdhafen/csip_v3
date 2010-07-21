<div id="nav_anchor">
<menu id="nav">
<li id="nav_first">Main Menu</li>
<li><a href="<?= $data['_config']['base_url'] ?>">Home</a></li>
<?php if ( $data['_session']['CAN_load_csip'] || $data['_session']['CAN_load_other_csip'] ) { ?>
<li><a href="<?= $data['_config']['base_url'] ?>load_csip.php">Select CSIP</a></li>
<?php } ?>
<?php if ( $data['csip'] ) { ?>
<li><a href="<?= $data['_config']['base_url'] ?>category_list.php">Category Table</a></li>
<li><a href="<?= $data['_config']['base_url'] ?>report.php">Report</a></li>
<?php } ?>
<?php if ( $data['_session']['CAN_manage_users'] ) { ?>
<li>Site Management
 <menu>
  <li><a href="<?= $data['_config']['base_url'] ?>manage/users.php">Users</a></li>
  <li><a href="<?= $data['_config']['base_url'] ?>manage/locations.php">Locations</a></li>
  <li><a href="<?= $data['_config']['base_url'] ?>manage/new_year.php">New Year</a></li>
 </menu>
</li>
<?php } ?>
<?php if ( $data['_session']['username'] ) { ?>
<li><a href="<?= $data['_config']['base_url'] ?>?_logout=1">Logout</a></li>
<?php } ?>
</menu>
</div>
