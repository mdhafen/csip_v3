<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );

include_once( '../../inc/site.phpm' );

authorize( 'manage_users' );

$userid = input( 'userid', INPUT_PINT );
$op = input( 'op', INPUT_STR );

if ( $userid ) {
  $user = user_by_userid( $userid );
  if ( ! $user ) {
    error( array('BADUSER'=>1) );
  } elseif ( $op == "Delete" ) {
    delete_user_dependants( $userid );
    delete_user( $userid );
    $deleted = 1;
  }
}

$output = array(
	'user' => $user,
	'deleted' => $deleted,
);
output( $output, 'manage/delete_user.tmpl' );
?>
