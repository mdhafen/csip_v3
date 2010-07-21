<?php include( $data['_config']['base_dir'] .'/htdocs/doc-open.php' ); ?>
<title>Site Management - New Year</title>
<?php
include( $data['_config']['base_dir'] .'/htdocs/doc-head-close.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-header-open.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-header-close.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-menu.php' );
?>
<h1>Site Management &raquo; New Year</h1>

<?php if ( $data['created'] ) { ?>
<div class="important">
Year created.<br>
<?= $data['new_csips'] ?> New CSIPS created.
</div>
<?php } ?>

<form method="post" action="<?= $data['_config']['base_url'] ?>manage/new_year.php">
<table>

<tr>
<td><label for="year_name">Year Name</label></td>
<td><input name="year_name" id="year_name" value="" ></td>
</tr>

<tr>
<td><label for="sap_due">SAP Due Date</label></td>
<td><input name="sap_due" id="sap_due" value="" > (YYYY-MM-DD)</td>
</tr>

<tr>
<td><label for="csip_due">CSIP Due Date</label></td>
<td><input name="csip_due" id="csip_due" value="" > (YYYY-MM-DD)</td>
</tr>

<tr>
<td><label for="board_due">Community Board Due Date</label></td>
<td><input name="board_due" id="board_due" value="" > (YYYY-MM-DD)</td>
</tr>

<tr>
<td><label for="district_due">School District Due Date</label></td>
<td><input name="district_due" id="district_due" value="" > (YYYY-MM-DD)</td>
</tr>

<tr>
<td><label for="version">Question Version</label></td>
<td><input name="version" id="version" value="3" readonly="readonly" ></td>
</tr>

</table>
<input type="submit" name="op" id="op" value="Save Year">
</form>

<?php include( $data['_config']['base_dir'] .'/htdocs/doc-close.php' ); ?>
