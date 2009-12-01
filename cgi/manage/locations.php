<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );

include_once( '../../inc/manage_site.phpm' );

authorize( 'manage_users' );

$locations = get_locations();

$output = array(
	'locations' => $locations,
);
output( $output, 'manage/locations.tmpl' );
?>
