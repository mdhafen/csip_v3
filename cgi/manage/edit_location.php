<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );

include_once( '../../inc/manage_site.phpm' );

authorize( 'manage_users' );

$locationid = input( 'locationid', INPUT_PINT );
$op = input( 'op', INPUT_STR );

$locations = get_locations();

if ( $locationid ) {
  foreach ( $locations as $loc ) {
    if ( $loc['locationid'] == $locationid ) {
      $location = $loc;
      break;
    }
  }

  if ( $location ) {
    $edit = 1;
  } else {
    $edit = 0;
    $location = array();
  }
}

if ( $op == "Save" ) {  // Update/Add the user
  $newlocationid = input( 'new_locationid', INPUT_PINT );
  $name = input( 'name', INPUT_STR );
  $mingrade = input( 'mingrade', INPUT_PINT );
  $maxgrade = input( 'maxgrade', INPUT_PINT );
  $loc_cat = input( 'loc_cat', INPUT_STR );
  $loc_subcat = input( 'loc_subcat', INPUT_STR );
  $loc_demo = input( 'loc_demo', INPUT_RAW );
  $loc_demo = ( $loc_demo ) ? 1 : 0;

  $error = array();
  if ( $mingrade < 1 ) { $error[] = "LOWMIN"; }
  if ( $maxgrade > 12 ) { $error[] = "HIGHMAX"; }
  if ( $mingrade > $maxgrade ) { $error[] = "MINABOVEMAX"; }
  if ( ! in_array( $loc_cat, array('ELEM','SEC','ALL','NA') ) ) { $error[] = "BADCAT"; }
  if ( ! in_array( $loc_subcat, array('AH','HS','MID','INT','ELEM','NA') ) ) { $error[] = "BADSUBCAT"; }
  if ( $newlocationid != $locationid ) {
    foreach ( $locations as $loc ) {
      if ( $loc['locationid'] == $newlocationid ) {
	$error[] = "LOCIDTAKEN";
	break;
      }
    }
  }

  if ( ! $error ) {

    if ( $location ) {
      if ( $newlocationid != $location['locationid'] ) {
	$updated['locationid'] = $newlocationid;
      }
      if ( $name != $location['name'] ) {
	$updated['name'] = $name;
      }
      if ( $mingrade != $location['mingrade'] ) {
	$updated['mingrade'] = $mingrade;
      }
      if ( $maxgrade != $location['maxgrade'] ) {
	$updated['maxgrade'] = $maxgrade;
      }
      if ( $loc_cat != $location['loc_category'] ) {
	$updated['loc_category'] = $loc_cat;
      }
      if ( $loc_subcat != $location['loc_subcategory'] ) {
	$updated['loc_subcategory'] = $loc_subcat;
      }
      if ( $loc_demo != $location['loc_demo'] ) {
	$updated['loc_demo'] = $loc_demo;
      }
    } else {
      $updated = array(
	'locationid' => $newlocationid,
	'name' => $name,
	'mingrade' => $mingrade,
	'maxgrade' => $maxgrade,
	'loc_category' => $loc_cat,
	'loc_subcategory' => $loc_subcat,
	'loc_demo' => $loc_demo,
		       );
    }

    if ( $updated ) {
      $locationid = update_location_fields( $locationid, $updated );
      $saved = 1;

      $locations = get_locations();
      foreach ( $locations as $loc ) {
	if ( $loc['locationid'] == $locationid ) {
	  $location = $loc;
	  $edit = 1;
	  break;
	}
      }
    }
  }
}

$output = array(
	'edit' => $edit,
	'saved' => $saved,
	'location' => $location,
	'error' => $error,
);
output( $output, 'manage/edit_location.tmpl' );
?>
