<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );

authorize( 'manage_users' );

global $config;
if ( empty($config['user_external_module']) ) {
	error( array('EXTERNAL_NOMODULE' => 'Can not create new user from external source when the user_external_module is not set.') );
}

$module = $config['base_dir'] .'/lib/'. $config['user_external_module'] .".phpm";
if ( !is_readable( $module ) ) {
	error(array('EXTERNAL_NOMODULE'=>$module));
}
include_once( $module );
$ex = new Authen_External();

$error = array();
$op = input( 'op', INPUT_STR );

$users = all_users();
global $assigned_externals;
$assigned_externals = array_filter(array_column($users,'externalid'));
$externals = $ex->get_users();
$externals = array_filter( $externals, function($var){global $assigned_externals; return !in_array($var['externalid'],$assigned_externals); } );
uasort( $externals, function($a,$b){ return strcasecmp($a['fullname'],$b['fullname']); } );

if ( $op == "Save" ) {  // Update/Add the user
  $username = input( 'username', INPUT_HTML_NONE );
  $name = input( 'fullname', INPUT_HTML_NONE );
  $email = input( 'email', INPUT_EMAIL );
  $role = input( 'role', INPUT_PINT );
  $externalid = input( 'externalid', INPUT_STR );

  foreach ( $users as $us ) {
    if ( $us['username'] == $username ) {
      $error[] = "USERNAMETAKEN";
      break;
    }
  }

  if ( empty($error) ) {
    $updated = array(
      'username' => $username,
      'fullname' => $name,
      'email' => $email,
      'role' => $role,
      'password' => '',
      'salt' => '',
      'externalid' => $externalid,
	);
  }

  if ( $updated ) {
    $userid = update_user( 0, $updated );
    if ( $userid ) {
      redirect( 'manage/edit_user.php?userid='.$userid );
      exit;
    }
    else {
      $error[] = "SAVEFAILED";
    }
  }
}

$output = array(
  'users' => $externals,
  'error' => $error,
);
output( $output, 'manage/new_user_from_external.tmpl' );
?>
