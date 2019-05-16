<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );

include_once( '../../inc/site.phpm' );
include_once( '../../inc/csips.phpm' );
include_once( '../../inc/course.phpm' );

$can_edit = authorized( 'update_csip' );
$super = authorized( 'manage_users' );
$principal = authorized( 'approve_csip' );

$locations = empty($_SESSION['loggedin_user']['locations']) ? array() : array_keys( $_SESSION['loggedin_user']['locations'] );
$csipid = input( 'csipid', INPUT_PINT );
$categoryid = input( 'categoryid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );
$part = input( 'part', INPUT_PINT );
$questions = input( 'questions', INPUT_PINT );
$answers = input( 'answers', INPUT_HTML_NONE );
$answerids = input( 'answerids', INPUT_PINT );
$sequences = input( 'sequences', INPUT_PINT );
$questionid = input( 'questionid', INPUT_PINT );
$answer = input( 'answer', INPUT_HTML_NONE );
$answerid = input( 'answerid', INPUT_PINT );
( $sequence = input('sequence',INPUT_PINT) ) || ( $sequence = 0 );

$error = array();

$csip = array();
if ( !empty($csipid) ) {
  if ( !in_array( get_csip_locationid($csipid), $locations ) ) {
    $error[] = array('NOTYOURS'=>'Access to CSIP at that location is denied.');
  }
  else {
    $csip = load_csip( $csipid, $_SESSION['loggedin_user']['userid'], False );
  }
}

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
   if ( empty($csip['form'][$courseid][$part]) ) {
      $error[] = array('NOTYOURS' => 'Course does not have that tab.');
   }
   $can_edit = $can_edit || ( in_array($csip['locationid'],$locations) && $csip['courses'][$courseid]['for_leadership'] && $principal );
   if ( ! $can_edit ) {
      $error[] = array('NOTYOURS' => 'Access to CSIP denied.' );
   }
   $courses = get_user_courses( $_SESSION['loggedin_user']['userid'], $csip['locationid'] );
   if ( ! empty($questionid) ) {
      if ( ! in_array($questionid,array_column($csip['form'][$courseid][$part],'questionid')) ) {
         $error[] = array('NOTYOURS' => 'Tab does not have that question.');
      }
   }
   else if ( ! empty($questions) ) {
      foreach ( $questions as $questid ) {
	 if ( ! in_array($questid,array_column($csip['form'][$courseid][$part],'questionid')) ) {
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
    $new_seq = null;
    for ( $count = 0; $count < count($questions); $count++ ) {
      $questionid = $questions[ $count ];
      $answer = $answers[ $count ];
      $answerid = $answerids[ $count ];
      ( $sequence = $sequences[ $count ] ) || ( $sequence = 0 );
      if ( !empty($answer) || !empty($answerid) ) {
	if ( empty($sequence) && !empty($csip['questions'][$questionid]['group_repeatableid']) ) {
	  if ( is_null($new_seq) ) {
	    $new_seq = $sequence = part_get_next_sequence( $csipid, $courseid, $part, $questionid);
	  }
	  else {
	    $sequence = $new_seq;
	  }
	}
	$newanswerid = course_save_answers( $answerid, $answer, $courseid, $questionid, $sequence, $part, $csip );

	$answer_details .= "<answer_details><answerid>".(!empty($answerid)?$answerid:$newanswerid)."</answerid><questionid>$questionid</questionid><group_sequence>$sequence</group_sequence><part>$part</part><courseid>$courseid</courseid><csipid>".$csip['csipid']."</csipid></answer_details>";
      }
    }
  }
  else {
    if ( empty($answerid) && !empty($csip['questions'][$questionid]['group_repeatableid']) ) {
      $sequence = part_get_next_sequence( $csipid, $courseid, $part, $questionid);
    }
    $newanswerid = course_save_answers( $answerid, $answer, $courseid, $questionid, $sequence, $part, $csip );
    $answer_details .= "<answer_details><answerid>".(!empty($answerid)?$answerid:$newanswerid)."</answerid><questionid>$questionid</questionid><group_sequence>$sequence</group_sequence><part>$part</part><courseid>$courseid</courseid><csipid>".$csip['csipid']."</csipid></answer_details>";
  }

  if ( !empty($answer_details) ) { $answer_details = '<answerids>'. $answer_details .'</answerids>'; }
  output( '<?xml version="1.0"?><result><state>Success</state>'. $answer_details .'</result>' );
}
else {
   $err_string = '';
   foreach ( $error as $err ) {
      foreach ( $err as $flag => $message ) {
         $err_string .= "<error><flag>". $flag ."</flag><message>". $message ."</message></error>";
      }
   }
   output( '<?xml version="1.0"?><result><state>Error</state><errors>'. $err_string .'</errors></result>' );
}
?>
