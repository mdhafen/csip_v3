<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );
global $config;

authorize( 'manage_users' );

$locationid = input( 'locationid', INPUT_PINT );
$op = input( 'op', INPUT_STR );

$locations = all_locations();
$externals = array();
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

if ( !empty($config['user_external_module']) ) {
	$module = $config['base_dir'] .'/lib/'. $config['user_external_module'] .".phpm";
	if ( !is_readable( $module ) ) {
		$error[] = 'EXTERNAL_NOMODULE';
	}
	include_once( $module );
	$ex = new Authen_External();

	global $assigned_externals;
	$assigned_externals = array_filter(array_column($locations,'externalid'));
	$externals = $ex->get_locations();
	$externals = array_filter( $externals, function($var){global $assigned_externals; return !in_array($var['externalid'],$assigned_externals); } );
	uasort( $externals, function($a,$b){ return strcasecmp($a['name'],$b['name']); } );
}

if ( $op == "Save" ) {  // Update/Add the location
  $newlocationid = input( 'new_locationid', INPUT_PINT );
  $name = input( 'name', INPUT_HTML_NONE );
  $mingrade = input( 'mingrade', INPUT_INT );
  $maxgrade = input( 'maxgrade', INPUT_INT );
  $loc_demo = input( 'loc_demo', INPUT_STR );
  $loc_demo = ( $loc_demo ) ? 1 : 0;
  $externalid = input( 'externalid', INPUT_HTML_NONE );

  if ( $mingrade < -1 ) { $error[] = "LOWMIN"; }
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
      if ( $externalid != $location['externalid'] ) {
	$updated['externalid'] = $externalid;
      }
    } else {
      $updated = array(
	'locationid' => $newlocationid,
	'name' => $name,
	'mingrade' => $mingrade,
	'maxgrade' => $maxgrade,
	'loc_demo' => $loc_demo,
        'externalid' => $externalid,
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
	'externals' => $externals,
	'error' => $error,
);
output( $output, 'manage/edit_location.tmpl' );
?>
