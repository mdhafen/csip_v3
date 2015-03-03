<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/csips.phpm' );

authorize( 'load_csip' );
$district = authorized( 'load_other_csip' );
$errors = array();
$locations = empty($_SESSION['loggedin_user']['locations']) ? array() : array_keys( $_SESSION['loggedin_user']['locations'] );
$csipid = input( 'csipid', INPUT_PINT );

$csip = array();
if ( empty($_SESSION['csip']) ) {
   if ( ! empty($csipid) ) {
      if ( !in_array( get_csip_locationid( $csipid ), $locations ) && ! $district ) {
         $errors[] = 'NOTYOURS';
      }
      else {
         $csip = load_csip( $csipid, $_SESSION['loggedin_user']['userid'] );
         if ( ! empty($csip) ) {
            $_SESSION['csip'] = $csip;
         }
      }
   }
}
else {
   $csip = $_SESSION['csip'];
   if ( ! empty($csip) ) {
      if ( ! empty($csipid) && $csip['csipid'] != $csipid ) {
         $csip = load_csip( $csipid, $_SESSION['loggedin_user']['userid'] );
         if ( ! empty($csip) ) {
            $_SESSION['csip'] = $csip;
         }
      }
   }
}

$csips = array();
if ( !empty( $_SESSION['loggedin_user']) ) {
	$locations = $_SESSION['loggedin_user']['locations'];
	$csips = get_csips( $locations, $district, 0 ); // 0 means load all years
}

$courseid = input( 'courseid', INPUT_PINT );

$output = array(
        'errors' => $errors,
        'csips' => $csips,
        'csip' => $csip,
        'courseid' => $courseid,
);
output( $output, 'index' );
?>
