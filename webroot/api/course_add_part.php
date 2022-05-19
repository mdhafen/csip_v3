<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );

include_once( '../../inc/site.phpm' );
include_once( '../../inc/csips.phpm' );
include_once( '../../inc/course.phpm' );

$can_edit = authorized( 'update_csip' );

$errors = array();
$locations = empty($_SESSION['loggedin_user']['locations']) ? array() : array_keys( $_SESSION['loggedin_user']['locations'] );
$csipid = input( 'csipid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );
$part = input( 'part', INPUT_PINT );

$group = 4;
$title = 'ES '. ($part - 2);

$csip = array();
if ( !empty($csipid) ) {
  if ( !in_array( get_csip_locationid($csipid), $locations ) ) {
    $errors[] = array('NOTYOUR' => 'Access to CSIP at that location is denied.');
  }
  else {
    $csip = load_csip( $csipid, $_SESSION['loggedin_user']['userid'], False );
  }
}

if ( empty($csip) ) {
   $errors[] = array('FLAG' => 'NOTYOURS', 'message' => 'No CSIP loaded.');
}
else {
   if ( ! empty($csipid) && $csip['csipid'] != $csipid ) {
      $errors[] = array('FLAG' => 'NOTYOURS', 'message' => 'Loading other CSIPs not allowed here.');
   }
   if ( !in_array( $csip['locationid'], $locations ) ) {
      $errors[] = array('FLAG' => 'NOTYOURS', 'message' => 'Access to CSIP denied.' );
   }
   if ( ! $can_edit ) {
      $errors[] = array('FLAG' => 'NOTYOURS', 'message' => 'Access to CSIP denied.' );
   }

   $courses = get_user_courses( $_SESSION['loggedin_user']['userid'], $csip['locationid'] );
   if ( !empty($courses) ) {
      if ( ! array_key_exists( $courseid, $courses ) ) {
         $errors[] = array('FLAG' => 'NOTYOURS', 'message' => 'Access to CSIP denied.' );
      }
   }
   if ( empty($csip['courses'][$courseid]) ) {
      $errors[] = array('FLAG' => 'NOTYOURS', 'message' => 'Access to course not allowed here.');
   }
   else if ( ! empty($csip['form'][$courseid][$part]) ) {
      $errors[] = array('FLAG' => 'NOTYOURS', 'message' => 'Course already has that tab.');
   }
}

if ( empty($errors) ) {
   $csip = course_add_extra_part( $courseid, $group, $part, $title, $csip );

   $questions = "";
   foreach ( $csip['form'][$courseid][$part] as $question ) {
      $questionid = $question['questionid'];
      $questions .= "<question>";
      $questions .= "<questionid>$questionid</questionid>";
      $questions .= "<questiontext>". htmlspecialchars($csip['questions'][$questionid]['question_clean'],ENT_QUOTES|ENT_XML1|ENT_SUBSTITUTE) ."</questiontext>";
      $questions .= "</question>";
   }

   output( '<?xml version="1.0"?><result><state>Success</state><questions>'. $questions .'</questions></result>' );
}
else {
   $err_string = '';
   foreach ( $errors as $e ) {
      $err_string .= "<error><flag>". $e['FLAG'] ."</flag><message>". $e['message'] ."</message></error>";
   }
   output( '<?xml version="1.0"?><result><state>Error</state><errors>'. $err_string .'</errors></result>' );
}
?>
