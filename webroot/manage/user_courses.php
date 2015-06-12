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
$saved = 0;
$user = array();
$locations = array();
$user_courses = array();

if ( $userid ) {
  $user = user_by_userid( $userid );
  if ( $user ) {
    $locations = $user['locations'];
  } else {
    $user = array();
  }

  if ( !empty($locationid) ) {
    if ( !in_array($locationid, array_column($locations,'locationid')) ) {
      error( array('BADLOC' => 'Undefined Location') );
    }

    $loc_courses = array();
    $user_courses = get_user_courses( $userid, $locationid );
    $loc_courses = get_location_courses( $locationid, $locations[$locationid]['mingrade'], $locations[$locationid]['maxgrade'] );
    foreach ( $loc_courses as $l_c_id ) {
      $course_by_cat[ $courses[$l_c_id]['category_name'] ][ $l_c_id ] = $courses[$l_c_id];
    }
    ksort( $course_by_cat, SORT_STRING | SORT_FLAG_CASE );
    foreach ( $course_by_cat as $cat => $cat_courses ) {
      uasort( $course_by_cat[$cat], 'cmp_course_name' );
    }

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
        'course_by_cat' => $course_by_cat,
        'locationid' => $locationid,
	'saved' => $saved,
	'locations' => $locations,
        'user_courses' => $user_courses,
);
output( $output, 'manage/user_courses.tmpl' );

function cmp_course_name( $a, $b ) {
  return strcasecmp( $a['course_name'], $b['course_name'] );
}
?>
