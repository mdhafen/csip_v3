<?php include( $data['_config']['base_dir'] .'/htdocs/doc-open.php' ); ?>
<title>Site Management - Locations - <?= ($data['edit'])?"Edit":"New" ?> Location</title>
<?php
include( $data['_config']['base_dir'] .'/htdocs/doc-head-close.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-header-open.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-header-close.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-menu.php' );
?>
<h1>Site Management &raquo; Locations &raquo; <?= ($data['edit'])?"Edit":"New" ?> Location</h1>

<?php if ( $data['saved'] ) { ?>
<div class="important">
Changes saved.
</div>
<?php } ?>

<form method="post" action="<?= $data['_config']['base_url'] ?>manage/edit_location.php">
<input type="hidden" name="locationid" id="locationid" value="<?= $data['location']['locationid'] ?>">
<?php if ( $data['error'] ) { ?>
<div>
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
<td><label for="new_locationid">Location Number</label></td>
<td><input name="new_locationid" id="new_locationid" value="<?= $data['location']['locationid'] ?>" ></td>
</tr>

<tr>
<td><label for="name">Name</label></td>
<td><input name="name" id="name" value="<?= $data['location']['name'] ?>" ></td>
</tr>

<tr>
<td><label for="mingrade">First Grade</label></td>
<td><input name="mingrade" id="mingrade" value="<?= $data['location']['mingrade'] ?>" ></td>
</tr>

<tr>
<td><label for="maxgrade">Last Grade</label></td>
<td><input name="maxgrade" id="maxgrade" value="<?= $data['location']['maxgrade'] ?>" ></td>
</tr>

<tr>
<td><label for="loc_cat">Location Category</label></td>
<td>
<select name="loc_cat" id="loc_cat">
  <option value="NA"<?= ( $data['location']['loc_category'] == "NA" ) ? "selected='selected'" : "" ?>>Not Applicable</option>
  <option value="ELEM"<?= ( $data['location']['loc_category'] == "ELEM" ) ? "selected='selected'" : "" ?>>Elementary</option>
  <option value="SEC"<?= ( $data['location']['loc_category'] == "SEC" ) ? "selected='selected'" : "" ?>>Secondary</option>
  <option value="ALL"<?= ( $data['location']['loc_category'] == "ALL" ) ? "selected='selected'" : "" ?>>All</option>
</select>
</td>
</tr>

<tr>
<td><label for="loc_subcat">Location Sub-Category</label></td>
<td>
<select name="loc_subcat" id="loc_subcat">
<option value="NA"<?= ( $data['location']['loc_subcategory'] == "NA" ) ? "selected='selected'" : "" ?>>Not Applicable</option>
  <option value="ELEM"<?= ( $data['location']['loc_subcategory'] == "ELEM" ) ? "selected='selected'" : "" ?>>Elementary</option>
  <option value="INT"<?= ( $data['location']['loc_subcategory'] == "INT" ) ? "selected='selected'" : "" ?>>Intermediate</option>
  <option value="MID"<?= ( $data['location']['loc_subcategory'] == "MID" ) ? "selected='selected'" : "" ?>>Middle</option>
  <option value="HS"<?= ( $data['location']['loc_subcategory'] == "HS" ) ? "selected='selected'" : "" ?>>High</option>
  <option value="AH"<?= ( $data['location']['loc_subcategory'] == "AH" ) ? "selected='selected'" : "" ?>>After High</option>
</select>
</td>
</tr>

<tr>
<td><label for="loc_demo">Location is Demo</label></td>
<td><input type="checkbox" name="loc_demo" id="loc_demo" <?= ( $data['location']['loc_demo'] ) ? "checked='checked'" : "" ?> ></td>
</tr>

</table>
<input type="submit" name="op" id="op" value="Save">
</form>

<?php include( $data['_config']['base_dir'] .'/htdocs/doc-close.php' ); ?>
