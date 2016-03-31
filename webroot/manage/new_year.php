<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );

include_once( '../../inc/csips.phpm' );

authorize( 'manage_users' );

$versions = get_versions();
$op = input( 'op', INPUT_STR );
$created = 0;
$new_csips = 0;

if ( $op == 'Save Year' ) {
  $year_name = input( 'year_name', INPUT_HTML_NONE );
  $version = input( 'version', INPUT_PINT );
  $due_dates = input( 'due_dates', INPUT_HTML_NONE );

  $new = array(
	       'year_name' => $year_name,
	       'version' => $version,
	       'due_dates' => $due_dates,
	       );

  $yearid = new_year( $new );
  if ( $yearid ) {
    $created = 1;

    // and create all the csips too
    $locations = all_locations();
    foreach ( $locations as $loc ) {
      $csipid = new_csip( $yearid, $loc['locationid'] );
      if ( $csipid ) {
	$new_csips++;
      }
    }
  }
}

$output = array(
		'versions' => $versions,
		'created' => $created,
		'new_csips' => $new_csips,
);
output( $output, 'manage/new_year.tmpl' );
?>
