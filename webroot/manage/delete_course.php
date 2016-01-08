<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );
include_once( '../../inc/course.phpm' );

authorize( 'manage_users' );

$courseid = input( 'courseid', INPUT_PINT );
$op = input( 'op', INPUT_STR );

$courses = get_courses(true);
$deleted = 0;
$saved = 0;
$course = array();
$depends = 0;
$error = array();

if ( $courseid ) {
  foreach ( $courses as $crs ) {
    if ( $crs['courseid'] == $courseid ) {
      $course = $crs;
      break;
    }
  }
}

$depends = get_course_num_dependants( $courseid );
if ( ! $course ) {
  $error[] = 'BADCRS';
} elseif ( $op == "Delete" || $depends['answers'] == 0 ) {
  delete_course_dependants( $courseid );
  delete_course( $courseid );
  $deleted = 1;
}

$output = array(
	'course' => $course,
	'dependants' => $depends,
	'error' => $error,
	'deleted' => $deleted,
);
output( $output, 'manage/delete_course.tmpl' );
