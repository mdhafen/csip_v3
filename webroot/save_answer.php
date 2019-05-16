<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/site.phpm' );
include_once( '../inc/csips.phpm' );
include_once( '../inc/course.phpm' );

authorize( 'load_csip' );

$can_edit = authorized( 'update_csip' );
$super = authorized( 'manage_users' );
$principal = authorized( 'approve_csip' );

$locations = empty($_SESSION['loggedin_user']['locations']) ? array() : array_keys( $_SESSION['loggedin_user']['locations'] );
$csipid = input( 'csipid', INPUT_PINT );
$categoryid = input( 'categoryid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );
$part = input( 'part', INPUT_PINT );
$op = input( 'op', INPUT_HTML_NONE );
$questions = input( 'questions', INPUT_PINT );
$answers = input( 'answers', INPUT_HTML_NONE );
$answerids = input( 'answerids', INPUT_PINT );
$sequences = input( 'sequences', INPUT_PINT );
$questionid = input( 'questionid', INPUT_PINT );
$answer = input( 'answer', INPUT_HTML_NONE );
$answerid = input( 'answerid', INPUT_PINT );
$sequence = input( 'sequence', INPUT_PINT ) || 0;

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
   if ( ! empty($csipid) && $csip['csipid'] != $csipid ) {
      error( array('NOTYOURS' => 'Loading other CSIPs not allowed here.') );
   }
   if ( !in_array( $csip['locationid'], $locations ) && ! $super ) {
      error( array('NOTYOURS' => 'Access to CSIP denied.' ) );
   }
   if ( empty($csip['courses'][$courseid]) ) {
      error( array('NOTYOURS' => 'Access to course not allowed here.') );
   }
   if ( empty($csip['form'][$courseid][$part]) ) {
      error( array('NOTYOURS' => 'Course does not have that tab.') );
   }
   $can_edit = $can_edit || ( in_array($csip['locationid'],$locations) && $csip['courses'][$courseid]['for_leadership'] && $principal );
   if ( ! $can_edit ) {
      $error[] = array('NOTYOURS' => 'Access to CSIP denied.' );
   }
   $courses = get_user_courses( $_SESSION['loggedin_user']['userid'], $csip['locationid'] );
   if ( ! empty($questionid) ) {
      if ( ! in_array( $questionid, array_column($csip['form'][$courseid][$part],'questionid') ) ) {
         error( array('NOTYOURS' => 'Tab does not have that question.') );
      }
   }
   else if ( ! empty($questions) ) {
      foreach ( $questions as $questid ) {
         if ( ! in_array( $questid, array_column($csip['form'][$courseid][$part],'questionid') ) ) {
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
      $new_seq = null;
      for ( $count = 0; $count < count($questions); $count++ ) {
         $questionid = $questions[ $count ];
         $answer = $answers[ $count ];
         $answerid = $answerids[ $count ];
         $sequence = $sequences[ $count ];
         if ( !empty($answer) || !empty($answerid) ) {
            if ( empty($sequence) && !empty($csip['questions'][$questionid]['group_repeatableid']) ) {
               if ( is_null($new_seq) ) {
                  $new_seq = $sequence = part_get_next_sequence( $csipid, $courseid, $part, $questionid);
               }
               else {
                  $sequence = $new_seq;
               }
            }
            course_save_answers( $answerid, $answer, $courseid, $questionid, $sequence, $part, $csip );
         }
      }
   }
   else {
      if ( empty($answerid) && !empty($csip['questions'][$questionid]['group_repeatableid']) ) {
         $sequence = part_get_next_sequence( $csipid, $courseid, $part, $questionid);
      }
      course_save_answers( $answerid, $answer, $courseid, $questionid, $sequence, $part, $csip );
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
      foreach ( $csip['form'][$courseid][$part] as $question ) {
         if ( $question['questionid'] != $questionid ) { continue; }
         foreach ( $question['answers'] as $answer ) {
	    if ( $answerid == $answer['answerid'] ) {
               $found = $answer;
            }
         }
      }
      if ( !empty($found) ) {
         course_delete_answer( $answerid, $csip );
      }
   }
}
else {
   error( array('BADOP' => 'Action not recognized.') );
}


redirect( 'index.php?csipid='. $csip['csipid'] .'&categoryid='. $categoryid .'&courseid='. $courseid .'&part='. $part );
?>
