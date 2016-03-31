<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/csips.phpm' );
include_once( '../inc/course.phpm' );

authorize( 'approve_csip' );

$district = authorized( 'load_other_csip' );
$locations = empty($_SESSION['loggedin_user']['locations']) ? array() : array_keys( $_SESSION['loggedin_user']['locations'] );
$csipid = input( 'csipid', INPUT_PINT );
$categoryid = input( 'categoryid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );
$op = input( 'op', INPUT_HTML_NONE );

$csip = array();
if ( ! empty($csipid) ) {
    if ( !in_array( get_csip_locationid( $csipid ), $locations ) && ! $district ) {
        error( array('NOTYOURS' => 'Access to CSIP at that location is denied.' ) );
    }
    else {
        $csip = load_csip( $csipid, False, $_SESSION['loggedin_user']['userid'] );
    }
}

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

if ( !in_array($op, array('ApproveCourse','UnApproveCourse','Comment')) ) {
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
else if ( $op == 'Comment' ) {
    $comment = input( 'comment', INPUT_HTML_NONE );
    if ( !is_null($comment) ) {
      course_principal_comment( $comment, $courseid, $csip );
    }
    $csip['courses'][$courseid]['principal_comment'] = $comment;
}

redirect( 'index.php?csipid='. $csip['csipid'] .'&categoryid='. $categoryid .'&courseid='. $courseid );

?>
