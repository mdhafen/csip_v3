<?php
// To rebuild this:
//   Copy htdocs/cfa.php
//   Remove text input value's and contents of textarea's
//     Leave the hidden inputs alone!
//   Collapse if/else block around 'protected-content' to just the if block
//   Remove the if statements around the Delete button

include_once( '../lib/security.phpm' );
include_once( '../lib/input.phpm' );
include_once( '../inc/csips.phpm' );
include_once( '../inc/course.phpm' );
include_once( '../inc/site.phpm' );

$csipid = input( 'csipid', INPUT_PINT );
$categoryid = input( 'categoryid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );
$count = input( 'tab', INPUT_PINT );
$part = input( 'part', INPUT_PINT );

$can_edit = authorized( 'update_csip' );
$courses = get_user_courses( $_SESSION['loggedin_user']['userid'], get_csip_locationid($csipid) );
if ( !empty($courseid) && !empty($courses) ) {
   if ( ! array_key_exists( $courseid, $courses ) ) {
      $can_edit = 0;
   }
}

$reporter = authorized( 'view_reports' );
$csip = load_csip( $csipid, $reporter, $_SESSION['loggedin_user']['userid'] );

$data = array(
	'csip' => array( 'csipid' => $csipid ),
	'categoryid' => $categoryid,
	'courseid' => $courseid,
        'can_edit' => $can_edit,
);

if ( !empty($csip['version']) ) {
  switch ( $data['csip']['version'] ) {
    case 7:  include '../htdocs/v7/cfa_new.php'; break;
    case 8:  include '../htdocs/v8/cfa_new.php'; break;
    default: return '<h1>Alpha Code!  Form version '. $data['csip']['version'] .' has not been created yet!</h1>'; break;
  }
}
