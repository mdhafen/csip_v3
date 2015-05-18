<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );

authorize( 'manage_users' );

$locationid = input( 'locationid', INPUT_PINT );
$op = input( 'op', INPUT_STR );

$locations = all_locations();
$edit = 0;
$saved = 0;
$location = array();
$error = array();

if ( $locationid ) {
  foreach ( $locations as $loc ) {
    if ( $loc['locationid'] == $locationid ) {
      $location = $loc;
      break;
    }
  }

  if ( $location ) {
    $edit = 1;
  }
}

if ( $op == "Save" ) {  // Update/Add the location
  $newlocationid = input( 'new_locationid', INPUT_PINT );
  $name = input( 'name', INPUT_HTML_NONE );
  $mingrade = input( 'mingrade', INPUT_PINT );
  $maxgrade = input( 'maxgrade', INPUT_PINT );
  $loc_demo = input( 'loc_demo', INPUT_STR );
  $loc_demo = ( $loc_demo ) ? 1 : 0;

  if ( $mingrade < 1 ) { $error[] = "LOWMIN"; }
  if ( $maxgrade > 12 ) { $error[] = "HIGHMAX"; }
  if ( $mingrade > $maxgrade ) { $error[] = "MINABOVEMAX"; }
  if ( $newlocationid != $locationid ) {
    foreach ( $locations as $loc ) {
      if ( $loc['locationid'] == $newlocationid ) {
	$error[] = "LOCIDTAKEN";
	break;
      }
    }
  }

  if ( empty($error) ) {

    if ( !empty($location) ) {
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
      if ( $loc_demo != $location['loc_demo'] ) {
	$updated['loc_demo'] = $loc_demo;
      }
    } else {
      $updated = array(
	'locationid' => $newlocationid,
	'name' => $name,
	'mingrade' => $mingrade,
	'maxgrade' => $maxgrade,
	'loc_demo' => $loc_demo,
		       );
    }

    if ( $updated ) {
      $locationid = update_location( $locationid, $updated );
      $saved = 1;

      $locations = all_locations();
      foreach ( $locations as $loc ) {
	if ( $loc['locationid'] == $newlocationid ) {
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
