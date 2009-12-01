<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );

include_once( '../../inc/manage_site.phpm' );

authorize( 'manage_users' );

$locationid = input( 'locationid', INPUT_PINT );
$op = input( 'op', INPUT_STR );

if ( $locationid ) {
  $locations = get_locations();
  foreach ( $locations as $loc ) {
    if ( $loc['locationid'] == $locationid ) {
      $location = $loc;
      break;
    }
  }
  $depends = get_location_num_dependants( $locationid );
  if ( ! $location ) {
    $error[] = 'BADLOC';
  } elseif ( $op == "Delete" ) {
    delete_location( $locationid );
    $deleted = 1;
  }
}

$output = array(
	'location' => $location,
	'dependants' => $depends,
	'error' => $error,
	'deleted' => $deleted,
);
output( $output, 'manage/delete_location.tmpl' );
?>
