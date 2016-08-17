<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );

authorize( 'manage_users' );

global $config;
if ( empty($config['user_external_module']) ) {
	error( array('EXTERNAL_NOMODULE' => 'Can not link user to external source when the user_external_module is not set.') );
}

$module = $config['base_dir'] .'/lib/'. $config['user_external_module'] .".phpm";
if ( !is_readable( $module ) ) {
	error(array('EXTERNAL_NOMODULE'=>$module));
}
include_once( $module );
$ex = new Authen_External();

$error = array();
$userid = input( 'userid', INPUT_PINT );
$externalid = input( 'externalid', INPUT_STR );

$users = all_users();
global $assigned_externals;
$assigned_externals = array_filter(array_column($users,'externalid'));
$externals = $ex->get_users();
$externals = array_filter( $externals, function($var){global $assigned_externals; return !in_array($var['externalid'],$assigned_externals); } );
uasort( $externals, function($a,$b){ return strcasecmp($a['fullname'],$b['fullname']); } );

if ( $userid && $externalid ) {
  $updated = array(
    'externalid' => $externalid,
  );

  update_user( $userid, array('externalid'=>$externalid) );

  $locations = $ex->get_users_locations( $externalid );
  update_user_locations( $userid, array_column($locations,'locationid') );
  if ( !empty($locations) ) {
    delete_course_user_links( $userid );
    foreach ( $locations as $loc ) {
      if ( !empty($loc['externalid']) ) {
        $courses = $ex->get_users_location_courses( $externalid, $loc['externalid'] );
        foreach ( $courses as $crs ) {
          add_course_user_link( $crs['courseid'], $userid, $loc['locationid'] );
        }
      }
    }
  }

  redirect( 'manage/edit_user.php?userid='.$userid );
  exit;
}

$output = array(
  'userid' => $userid,
  'users' => $externals,
  'error' => $error,
);
output( $output, 'manage/link_user_to_external.tmpl' );
?>
