<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );

include_once( '../../inc/manage_site.phpm' );

authorize( 'manage_users' );

$userid = input( 'userid', INPUT_PINT );
$op = input( 'op', INPUT_STR );

if ( $userid ) {
  $user = get_user_by_userid( $userid );
  if ( ! $user ) {
    $error[] = 'BADUSER';
  } elseif ( $op == "Delete" ) {
    delete_user( $userid );
    $deleted = 1;
  }
}

$output = array(
	'user' => $user,
	'error' => $error,
	'deleted' => $deleted,
);
output( $output, 'manage/delete_user.tmpl' );
?>
