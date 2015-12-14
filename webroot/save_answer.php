<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/site.phpm' );
include_once( '../inc/csips.phpm' );
include_once( '../inc/course.phpm' );

authorize( 'update_csip' );
$super = authorized( 'manage_users' );

$locations = empty($_SESSION['loggedin_user']['locations']) ? array() : array_keys( $_SESSION['loggedin_user']['locations'] );
$csipid = input( 'csipid', INPUT_PINT );
$categoryid = input( 'categoryid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );
$part = input( 'part', INPUT_PINT );
$op = input( 'op', INPUT_HTML_NONE );
$questions = input( 'questions', INPUT_PINT );
$answers = input( 'answers', INPUT_HTML_NONE );
$answerids = input( 'answerids', INPUT_PINT );
$questionid = input( 'questionid', INPUT_PINT );
$answer = input( 'answer', INPUT_HTML_NONE );
$answerid = input( 'answerid', INPUT_PINT );

$csip = $_SESSION['csip'];
if ( empty($csip) ) {
   error( array('NOTYOURS' => 'No CSIP loaded.') );
}
else {
   if ( ! empty($csipid) && $csip['csipid'] != $csipid ) {
      error( array('NOTYOURS' => 'Loading other CSIPs not allowed here.') );
   }
   if ( !in_array( $csip['locationid'], $locations ) && ! $super ) {
      error( array('NOTYOURS' => 'Access to CSIP denied.' ) );
   }
   if ( empty($csip['courses'][$courseid]) ) {
      error( array('NOTYOURS' => 'Access to course not allowed here.') );
   }
   if ( empty($csip['courses'][$courseid]['questions'][$part]) ) {
      error( array('NOTYOURS' => 'Course does not have that tab.') );
   }
   $courses = get_user_courses( $_SESSION['loggedin_user']['userid'], $csip['locationid'] );
   if ( ! empty($questionid) ) {
      if ( !isset($csip['courses'][$courseid]['questions'][$part][$questionid]) ) {
         error( array('NOTYOURS' => 'Tab does not have that question.') );
      }
   }
   else if ( ! empty($questions) ) {
      foreach ( $questions as $questid ) {
         if ( !isset($csip['courses'][$courseid]['questions'][$part][$questid]) ) {
	   error( array('NOTYOURS' => 'Tab does not have that question.') );
         }
      }
   }
   else if ( !empty($courses) ) {
      if ( ! array_key_exists( $courseid, $courses ) ) {
         error( array('NOTYOURS' => 'Access to CSIP denied.' ) );
      }
   }
   else {
         error( array('NOTYOURS' => 'No questions in submission.') );
   }
}

if ( $op == 'SaveAnswer' ) {
   if ( !empty($answers) ) {
      $count = 0;
      for ( $count = 0; $count < count($questions); $count++ ) {
         $questionid = $questions[ $count ];
         $answer = $answers[ $count ];
         $answerid = $answerids[ $count ];
         if ( !empty($answer) || !empty($answerid) ) {
            course_save_answers( $answerid, $answer, $courseid, $questionid, $part, $csip );
         }
      }
   }
   else {
      course_save_answers( $answerid, $answer, $courseid, $questionid, $part, $csip );
   }
}
else if ( $op == 'DeleteAnswer' ) {
   if ( !empty($answerid) && !empty($questionid) ) {
      $answerids = array($answerid);
      $questions = array($questionid);
   }

   $count = 0;
   for ( $count = 0; $count < count($answerids); $count++ ) {
      $questionid = $questions[ $count ];
      $answerid = $answerids[ $count ];
      $found = 0;
      foreach ( $csip['courses'][$courseid]['questions'][$part][$questionid] as $ans ) {
         if ( $answerid == $ans['answerid'] ) {
            $found = $ans;
         }
      }
      if ( !empty($found) ) {
         course_delete_answer( $answerid );
      }
   }
}
else {
   error( array('BADOP' => 'Action not recognized.') );
}


$csip = course_reload_answers( $csip, $courseid, $part );
$_SESSION['csip'] = $csip;

redirect( 'index.php?csipid='. $csip['csipid'] .'&categoryid='. $categoryid .'&courseid='. $courseid .'&part='. $part );
?>
