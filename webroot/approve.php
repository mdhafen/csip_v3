<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/csips.phpm' );
include_once( '../inc/course.phpm' );

authorize( 'approve_csip' );

$csip = $_SESSION['csip'];
$district = authorized( 'load_other_csip' );
$locations = empty($_SESSION['loggedin_user']['locations']) ? array() : array_keys( $_SESSION['loggedin_user']['locations'] );
$csipid = input( 'csipid', INPUT_PINT );
$categoryid = input( 'categoryid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );
$op = input( 'op', INPUT_HTML_NONE );

if ( empty($csip) ) {
   error( array('NOTYOURS' => 'No CSIP loaded.') );
}
else {
   if ( ! empty($csipid) && $csip['csipid'] != $csipid ) {
      error( array('NOTYOURS' => 'Loading other CSIPs not allowed here.') );
   }
   if ( !in_array( $csip['locationid'], $locations ) && ! $district ) {
      error( array('NOTYOURS' => 'Access to CSIP denied.' ) );
   }
   if ( empty($csip['courses'][$courseid]) ) {
      error( array('NOTYOURS' => 'Access to course not allowed here.') );
   }
}

if ( !in_array($op, array('ApproveCourse','UnApproveCourse')) ) {
   error( array('BADOP' => 'Action not recognized.') );
}

if ( $op == 'ApproveCourse' ) {
    course_approve( $courseid, $csip );
    $csip['courses'][$courseid]['principal_approved'] = date('Y-m-d');
}
else if ( $op == 'UnApproveCourse' ) {
    course_unapprove( $courseid, $csip );
    $csip['courses'][$courseid]['principal_approved'] = null;
}

$_SESSION['csip'] = $csip;

redirect( 'index.php?csipid='. $csip['csipid'] .'&categoryid='. $categoryid .'&courseid='. $courseid );

?>
