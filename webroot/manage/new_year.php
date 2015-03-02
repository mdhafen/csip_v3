<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );

include_once( '../../inc/csips.phpm' );
include_once( '../../inc/manage_site.phpm' );

authorize( 'manage_users' );

$op = input( 'op', INPUT_STR );

if ( $op == 'Save Year' ) {
  $year_name = input( 'year_name', INPUT_HTML_NONE );
  $version = input( 'version', INPUT_PINT );
  $sap_due_date = input( 'sap_due', INPUT_HTML_NONE );
  $csip_due_date = input( 'csip_due', INPUT_HTML_NONE );
  $board_due_date = input( 'board_due', INPUT_HTML_NONE );
  $district_due_date = input( 'district_due', INPUT_HTML_NONE );

  $new = array(
	       'year_name' => $year_name,
	       'version' => $version,
	       'sap_due_date' => $sap_due_date,
	       'csip_due_date' => $csip_due_date,
	       'board_due_date' => $board_due_date,
	       'district_due_date' => $district_due_date,
	       );

  $yearid = new_year( $new );
  if ( $yearid ) {
    $created = 1;

    // and create all the csips too
    $locations = get_locations();
    foreach ( $locations as $loc ) {
      $csipid = new_csip( $yearid, $loc['locationid'] );
      if ( $csipid ) {
	$new_csips++;
      }
    }
  }
}

$output = array(
		'created' => $created,
		'new_csips' => $new_csips,
);
output( $output, 'manage/new_year.tmpl' );
?>
