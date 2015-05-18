<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );

$dbh = db_connect();
$users = all_users( $dbh );
$locations = all_locations( $dbh );

$output = array(
	'users' => $users,
	'locations' => $locations,
);
output( $output, 'manage/index.tmpl' );
?>
