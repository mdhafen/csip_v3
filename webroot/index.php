<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/csips.phpm' );
include_once( '../inc/site.phpm' );

authorize( 'load_csip' );
$district = authorized( 'load_other_csip' );
$reporter = authorized( 'view_reports' );
$can_edit = authorized( 'update_csip' );
$locations = empty($_SESSION['loggedin_user']['locations']) ? array() : array_keys( $_SESSION['loggedin_user']['locations'] );
$csipid = input( 'csipid', INPUT_PINT );
$categoryid = input( 'categoryid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );
$part = input( 'part', INPUT_INT );

$csip = array();
if ( ! empty($csipid) ) {
    if ( !in_array( get_csip_locationid( $csipid ), $locations ) && ! $district ) {
        error( array('NOTYOURS' => 'Access to CSIP at that location is denied.') );
    }
    else {
        $csip = load_csip( $csipid, $reporter, $_SESSION['loggedin_user']['userid'] );
    }
}

if ( !empty($csip) ) {
   $courses = get_user_courses( $_SESSION['loggedin_user']['userid'], $csip['locationid'] );
   if ( !empty($courseid) && !empty($courses) ) {
      if ( ! array_key_exists( $courseid, $courses ) ) {
         $can_edit = 0;
      }
   }
}

$csips = array();
if ( !empty( $_SESSION['loggedin_user']) ) {
	$csips = get_csips( $locations, $district, 0 ); // 0 means load all years
}

$output = array(
        'csips' => $csips,
        'csip' => $csip,
        'categoryid' => $categoryid,
        'courseid' => $courseid,
        'part' => $part,
        'can_edit' => $can_edit,
);
output( $output, 'index' );
?>
