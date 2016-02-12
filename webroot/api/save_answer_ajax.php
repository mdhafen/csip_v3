<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );

include_once( '../../inc/site.phpm' );
include_once( '../../inc/csips.phpm' );
include_once( '../../inc/course.phpm' );

authorize( 'update_csip' );
$super = authorized( 'manage_users' );

$locations = empty($_SESSION['loggedin_user']['locations']) ? array() : array_keys( $_SESSION['loggedin_user']['locations'] );
$csipid = input( 'csipid', INPUT_PINT );
$categoryid = input( 'categoryid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );
$part = input( 'part', INPUT_PINT );
$questions = input( 'questions', INPUT_PINT );
$answers = input( 'answers', INPUT_HTML_NONE );
$answerids = input( 'answerids', INPUT_PINT );
$questionid = input( 'questionid', INPUT_PINT );
$answer = input( 'answer', INPUT_HTML_NONE );
$answerid = input( 'answerid', INPUT_PINT );

$error = array();

$csip = $_SESSION['csip'];
if ( empty($csip) ) {
   $error[] = array('NOTYOURS' => 'No CSIP loaded.');
}
else {
   if ( ! empty($csipid) && $csip['csipid'] != $csipid ) {
      $error[] = array('NOTYOURS' => 'Loading other CSIPs not allowed here.');
   }
   if ( !in_array( $csip['locationid'], $locations ) && ! $super ) {
      $error[] = array('NOTYOURS' => 'Access to CSIP denied.' );
   }
   if ( empty($csip['courses'][$courseid]) ) {
      $error[] = array('NOTYOURS' => 'Access to course not allowed here.');
   }
   if ( empty($csip['courses'][$courseid]['questions'][$part]) ) {
      $error[] = array('NOTYOURS' => 'Course does not have that tab.');
   }
   $courses = get_user_courses( $_SESSION['loggedin_user']['userid'], $csip['locationid'] );
   if ( ! empty($questionid) ) {
      if ( !isset($csip['courses'][$courseid]['questions'][$part][$questionid]) ) {
         $error[] = array('NOTYOURS' => 'Tab does not have that question.');
      }
   }
   else if ( ! empty($questions) ) {
      foreach ( $questions as $questid ) {
         if ( !isset($csip['courses'][$courseid]['questions'][$part][$questid]) ) {
	   $error[] = array('NOTYOURS' => 'Tab does not have that question.');
         }
      }
   }
   else if ( !empty($courses) ) {
      if ( ! array_key_exists( $courseid, $courses ) ) {
         $error[] = array('NOTYOURS' => 'Access to CSIP denied.' );
      }
   }
   else {
         $error[] = array('NOTYOURS' => 'No questions in submission.');
   }
}

if ( empty($error) ) {
  $answer_details = '';
  if ( !empty($answers) ) {
    $count = 0;
    for ( $count = 0; $count < count($questions); $count++ ) {
      $questionid = $questions[ $count ];
      $answer = $answers[ $count ];
      $answerid = $answerids[ $count ];
      if ( !empty($answer) || !empty($answerid) ) {
	$newanswerid = course_save_answers( $answerid, $answer, $courseid, $questionid, $part, $csip );
        if ( empty($answerid) && !empty($newanswerid) ) {
          $answer_details .= "<answer_details><answerid>$newanswerid</answerid><questionid>$questionid</questionid><part>$part</part><courseid>$courseid</courseid><csipid>".$csip['csipid']."</csipid></answer_details>";
        }
      }
    }
  }
  else {
    course_save_answers( $answerid, $answer, $courseid, $questionid, $part, $csip );
  }

  $csip = course_reload_answers( $csip, $courseid, $part );
  $_SESSION['csip'] = $csip;

  if ( !empty($answer_details) ) { $answer_details = '<answerids>'. $answer_details .'</answerids>'; }
  output( '<?xml version="1.0"?><result><state>Success</state>'. $answer_details .'</result>' );
}
else {
   $err_string = '';
   foreach ( $errors as $e ) {
      $err_string .= "<flag>". $e['FLAG'] ."</flag><message>". $e['message'] ."</message>";
   }
   output( '<?xml version="1.0"?><result><state>Error</state><errors><messages>'. $err_string .'</messages></errors></result>' );
}
?>
