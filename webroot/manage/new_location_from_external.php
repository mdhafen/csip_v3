<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );

authorize( 'manage_users' );

global $config;
if ( empty($config['user_external_module']) ) {
	error( array('EXTERNAL_NOMODULE' => 'Can not create new location from external source when the user_external_module is not set.') );
}

$module = $config['base_dir'] .'/lib/'. $config['user_external_module'] .".phpm";
if ( !is_readable( $module ) ) {
	error(array('EXTERNAL_NOMODULE'=>$module));
}
include_once( $module );
$ex = new Authen_External();

$error = array();
$op = input( 'op', INPUT_STR );

$locations = all_locations();
global $assigned_externals;
$assigned_externals = array_filter(array_column($locations,'externalid'));
$externals = $ex->get_locations();
$externals = array_filter( $externals, function($var){global $assigned_externals; return !in_array($var['externalid'],$assigned_externals); } );
uasort( $externals, function($a,$b){ return strcasecmp($a['name'],$b['name']); } );

if ( $op == "Save" ) {  // Update/Add the location
  $newlocationid = input( 'new_locationid', INPUT_PINT );
  $name = input( 'name', INPUT_HTML_NONE );
  $mingrade = input( 'mingrade', INPUT_INT );
  $maxgrade = input( 'maxgrade', INPUT_INT );
  $externalid = input( 'externalid', INPUT_STR );
  $loc_demo = 0;

  if ( $mingrade < -1 ) { $error[] = "LOWMIN"; }
  if ( $maxgrade > 12 ) { $error[] = "HIGHMAX"; }
  if ( $mingrade > $maxgrade ) { $error[] = "MINABOVEMAX"; }

  foreach ( $locations as $loc ) {
    if ( $loc['locationid'] == $newlocationid ) {
      $error[] = "LOCIDTAKEN";
      break;
    }
  }

  if ( empty($error) ) {
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
    $locationid = update_location( 0, $updated );
    if ( $locationid ) {
      redirect( 'manage/edit_location.php?locationid='.$locationid );
      exit;
    }
    else {
      $error[] = "SAVEFAILED";
    }
  }
}

$output = array(
  'locations' => $externals,
  'error' => $error,
);
output( $output, 'manage/new_location_from_external.tmpl' );
?>
