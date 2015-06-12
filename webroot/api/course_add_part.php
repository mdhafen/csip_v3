<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );

include_once( '../../inc/csips.phpm' );
include_once( '../../inc/course.phpm' );

authorize( 'update_csip' );

$errors = array();
$locations = empty($_SESSION['loggedin_user']['locations']) ? array() : array_keys( $_SESSION['loggedin_user']['locations'] );
$csipid = input( 'csipid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );
$part = input( 'part', INPUT_PINT );

$group = 3;
$title = 'GVC '. ($part - 2);

$csip = $_SESSION['csip'];
$courses = get_user_courses( $_SESSION['loggedin_user']['userid'], $csip['locationid'] );
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
   if ( !empty($courses) ) {
      if ( ! array_key_exists( $courseid, $courses ) ) {
         $errors[] = array('FLAG' => 'NOTYOURS', 'message' => 'Access to CSIP denied.' );
      }
   }
   if ( empty($csip['courses'][$courseid]) ) {
      $errors[] = array('FLAG' => 'NOTYOURS', 'message' => 'Access to course not allowed here.');
   }
   else if ( ! empty($csip['courses'][$courseid]['questions'][$part]) ) {
      $errors[] = array('FLAG' => 'NOTYOURS', 'message' => 'Course already has that tab.');
   }
}

if ( empty($errors) ) {
   $csip = course_add_extra_part( $courseid, $group, $part, $title, $csip );
   $_SESSION['csip'] = $csip;

   $questions = "";
   foreach ( $csip['courses'][$courseid]['questions'][$part] as $questionid => $answer ) {
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
      $err_string .= "<flag>". $e['FLAG'] ."</flag><message>". $e['message'] ."</message>";
   }
   output( '<?xml version="1.0"?><result><state>Error</state><errors><messages>'. $err_string .'</messages></errors></result>' );
}
?>
