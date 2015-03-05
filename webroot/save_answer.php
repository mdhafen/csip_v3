<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/csips.phpm' );

authorize( 'update_csip' );

$locations = empty($_SESSION['loggedin_user']['locations']) ? array() : array_keys( $_SESSION['loggedin_user']['locations'] );
$csipid = input( 'csipid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );
$part = input( 'part', INPUT_PINT );
$op = input( 'op', INPUT_HTML_NONE );
$questions = input( 'questions', INPUT_PINT );
$answers = input( 'answers', INPUT_HTML_NONE );
$questionid = input( 'questionid, INPUT_PINT );
$answer = input( 'answer, INPUT_HTML_NONE );

$csip = $_SESSION['csip'];
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
   if ( empty($csip['courses'][$courseid]['questions'][$part]) ) {
      error( array('NOTYOURS' => 'Course does not have that tab.') );
   }
   if ( empty($csip['courses'][$courseid]['questions'][$part][$questionid]) ) {
      error( array('NOTYOURS' => 'Tab does not have that question.') );
   }
}

if ( $op != 'SaveAnswer' ) {
   error( array('BADOP' => 'Action not recognized.') );
}

if ( !empty($answers) ) {
   $count = 0;
   foreach ( $questions as $this_questionid ) {
      course_save_answer( $answers[ $count ], $courseid, $this_questionid, $part, $csip );
      $count++;
   }
}
else {
     course_save_answer( $answer, $courseid, $questionid, $part, $csip );
}

$csip = course_reload_answers( $csip, $courseid, $part );
$_SESSION['csip'] = $csip;

redirect( 'index.php?csipid='. $csip['csipid'] .'&courseid='. $courseid .'&part='. $part );
?>
