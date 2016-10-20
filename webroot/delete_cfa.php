<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/site.phpm' );
include_once( '../inc/csips.phpm' );
include_once( '../inc/course.phpm' );

authorize( 'update_csip' );

$locations = empty($_SESSION['loggedin_user']['locations']) ? array() : array_keys( $_SESSION['loggedin_user']['locations'] );
$csipid = input( 'csipid', INPUT_PINT );
$categoryid = input( 'categoryid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );
$part = input( 'part', INPUT_PINT );
$op = input( 'op', INPUT_HTML_NONE );

$csip = array();
if ( !empty($csipid) ) {
  if ( !in_array( get_csip_locationid($csipid), $locations ) ) {
    error( array('NOTYOUR' => 'Access to CSIP at that location is denied.') );
  }
  else {
    $csip = load_csip( $csipid, $_SESSION['loggedin_user']['userid'], False );
  }
}

if ( empty($csip) ) {
   error( array('NOTYOURS' => 'No CSIP loaded.') );
}
else {
   $courses = get_user_courses( $_SESSION['loggedin_user']['userid'], $csip['locationid'] );
   if ( ! empty($csipid) && $csip['csipid'] != $csipid ) {
      error( array('NOTYOURS' => 'Loading other CSIPs not allowed here.') );
   }
   if ( !in_array( $csip['locationid'], $locations ) ) {
      error( array('NOTYOURS' => 'Access to CSIP denied.' ) );
   }
   if ( empty($csip['courses'][$courseid]) ) {
      error( array('NOTYOURS' => 'Access to course not allowed here.') );
   }
   if ( empty($csip['form'][$courseid][$part]) ) {
      error( array('NOTYOURS' => 'Course does not have that tab.') );
   }
   if ( !empty($courses) ) {
      if ( ! array_key_exists( $courseid, $courses ) ) {
         error( array('NOTYOURS' => 'Access to CSIP denied.' ) );
      }
   }
}

$num_answers = 0;
foreach ( $csip['form'][$courseid][$part] as $answer ) {
   if ( !empty($answer['answer']['answer']) ) {
      $num_answers++;
   }
   if ( !empty($answer['answers']) ) {
      foreach ( $answer['answers'] as $answer ) {
         if ( !empty($answer['answer']) ) {
            $num_answers++;
	 }
      }
   }
}
if ( $num_answers ) {
   error( array('BADOP' => 'Part still has answers') );
}

if ( $op != 'DeleteCFA' ) {
   error( array('BADOP' => 'Action not recognized.') );
}

course_delete_extra_part( $courseid, $part, $csip );

redirect( 'index.php?csipid='. $csip['csipid'] .'&categoryid='. $categoryid .'&courseid='. $courseid );
?>
