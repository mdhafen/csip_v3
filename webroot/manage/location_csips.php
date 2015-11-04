<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );

include_once( '../../inc/site.phpm' );
include_once( '../../inc/course.phpm' );

authorize( 'manage_users' );

$op = input( 'op', INPUT_STR );
$locationid = input( 'locationid', INPUT_PINT );
$csipid = input( 'csipid', INPUT_PINT );
$yearid = input( 'yearid', INPUT_PINT );

$location = array();
$csips = array();
$years = get_years();
$saved = 0;

if ( !empty($locationid) ) {
  $locations = all_locations();
  foreach ( $locations as $loc ) {
    if ( $loc['locationid'] == $locationid ) {
      $location = $loc;
    }
  }
  if ( empty($location) ) {
    error( array('BADLOC' => 'Undefined Location') );
  }
  $csips = get_csips( array($locationid), false, 0 );
  foreach ( $csips as &$csip ) {
    $csip['num_answers'] = get_csip_num_answers( $csip['csipid'] );
  }

  if ( !empty($yearid) || !empty($csipid) ) {
    if ( $op == "Add" ) {
      if ( ! in_array( $yearid, array_columns($years,'yearid') ) ) {
        error( array('BADYR' => 'Undefined Year' ) );
      }
      new_csip( $yearid, $locationid );
    }
    else if ( $op == "Delete" ) {
      if ( in_array( $csipid, array_columns($csips,'csipid') ) && ! get_csip_num_answers($csipid) ) {
        delete_csip( $csipid );
      }
    }
  }
}

$output = array(
        'locationid' => $locationid,
        'location' => $location,
        'csips' => $csips,
        'years' => $years,
	'saved' => $saved,
);
output( $output, 'manage/location_csips.tmpl' );

?>
