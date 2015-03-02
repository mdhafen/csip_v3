<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );

include_once( '../../inc/manage_site.phpm' );

$dbh = db_connect();
$users = get_users( $dbh );
$locations = get_locations( $dbh );

$output = array(
	'users' => $users,
	'locations' => $locations,
);
output( $output, 'manage/index.tmpl' );
?>
