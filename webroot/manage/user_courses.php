<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );

include_once( '../../inc/site.phpm' );
include_once( '../../inc/course.phpm' );

authorize( 'manage_users' );

$userid = input( 'userid', INPUT_PINT );
$op = input( 'op', INPUT_STR );
$locationid = input( 'locationid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );

$courses = get_courses();
$course_by_cat = array();
$edit = 0;
$saved = 0;
$user = array();
$locations = array();
$loc_courses = array();
$user_courses = array();

foreach ( $courses as $course ) {
  $course_by_cat[ $course['category_name'] ][ $course['courseid'] ] = $course;
}

if ( $userid ) {
  $user = user_by_userid( $userid );
  if ( $user ) {
    $edit = 1;
    $locations = $user['locations'];
  } else {
    $edit = 0;
    $user = array();
  }

  if ( !empty($locationid) ) {
    if ( !in_array($locationid, array_column($locations,'locationid')) ) {
      error( array('BADLOC' => 'Undefined Location') );
    }
  }
  else {
    $user_courses = get_user_courses( $userid, $locationid );
    $loc_courses = get_location_courses( $locationid );

    if ( !empty($courseid) ) {
      if ( ! array_key_exists( $courseid, $courses ) ) {
         error( array('BADCRS' => 'Undefined Course' ) );
      }
      if ( ! in_array( $courseid, $loc_courses ) ) {
        error( array('BADCRS' => 'Course not availabe at that location') );
      }

      if ( $op == "Add" ) {  // Update/Add the user
        user_add_course( $userid, $locationid, $courseid );
      }
      else if ( $op == "Delete" ) {
        user_delete_course( $userid, $locationid, $courseid );
      }
    }
  }
}

$output = array(
	'user' => $user,
        'courses' => $courses,
        'course_by_cat' => $courses,
        'locationid' => $locationid,
	'edit' => $edit,
	'saved' => $saved,
	'locations' => $locations,
        'user_courses' => $user_courses,
        'location_courses' => $loc_courses,
);
output( $output, 'manage/user_courses.tmpl' );
?>
