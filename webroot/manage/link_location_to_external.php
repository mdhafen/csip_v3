<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );

authorize( 'manage_users' );

global $config;
if ( empty($config['user_external_module']) ) {
	error( array('EXTERNAL_NOMODULE' => 'Can not link location to external source when the user_external_module is not set.') );
}

$module = $config['base_dir'] .'/lib/'. $config['user_external_module'] .".phpm";
if ( !is_readable( $module ) ) {
	error(array('EXTERNAL_NOMODULE'=>$module));
}
include_once( $module );
$ex = new Authen_External();

$error = array();
$locationid = input( 'locationid', INPUT_PINT );
$externalid = input( 'externalid', INPUT_STR );

$locations = all_locations();
global $assigned_externals;
$assigned_externals = array_filter(array_column($locations,'externalid'));
$externals = $ex->get_locations();
$externals = array_filter( $externals, function($var){global $assigned_externals; return !in_array($var['externalid'],$assigned_externals); } );
uasort( $externals, function($a,$b){ return strcasecmp($a['name'],$b['name']); } );

if ( $locationid && $externalid ) {
  $updated = array(
    'externalid' => $externalid,
  );

  update_location( $locationid, array('externalid'=>$externalid) );

  redirect( 'manage/edit_location.php?locationid='.$locationid );
  exit;
}

$output = array(
  'locationid' => $locationid,
  'locations' => $externals,
  'error' => $error,
);
output( $output, 'manage/link_location_to_external.tmpl' );
?>
