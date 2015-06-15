<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );
include_once( '../../inc/course.phpm' );

authorize( 'manage_users' );

$courseid = input( 'courseid', INPUT_PINT );
$op = input( 'op', INPUT_STR );

$categories = get_course_categories();
$courses = get_courses();
$edit = 0;
$saved = 0;
$course = array();
$error = array();

if ( $courseid ) {
  foreach ( $courses as $crs ) {
    if ( $crs['courseid'] == $courseid ) {
      $course = $crs;
      break;
    }
  }

  if ( $course ) {
    $edit = 1;
  }
}

if ( $op == "Save" ) {  // Update/Add the location
  $categoryid = input( 'categoryid', INPUT_PINT );
  $name = input( 'course_name', INPUT_HTML_NONE );
  $mingrade = input( 'min_grade', INPUT_PINT );
  $maxgrade = input( 'max_grade', INPUT_PINT );
  $active = input( 'active', INPUT_STR );
  $active = ( $active ) ? 1 : 0;

  if ( $mingrade < 1 ) { $error[] = "LOWMIN"; }
  if ( $maxgrade > 12 ) { $error[] = "HIGHMAX"; }
  if ( $mingrade > $maxgrade ) { $error[] = "MINABOVEMAX"; }

  if ( empty($error) ) {

    if ( !empty($location) ) {
      if ( $categoryid != $course['course_category'] ) {
	$updated['course_category'] = $categoryid;
      }
      if ( $name != $course['course_name'] ) {
	$updated['course_name'] = $name;
      }
      if ( $mingrade != $course['min_grade'] ) {
	$updated['min_grade'] = $mingrade;
      }
      if ( $maxgrade != $course['max_grade'] ) {
	$updated['max_grade'] = $maxgrade;
      }
      if ( $active != $course['active'] ) {
	$updated['active'] = $active;
      }
    } else {
      $updated = array(
	'course_category' => $categoryid,
	'course_name' => $name,
	'min_grade' => $mingrade,
	'max_grade' => $maxgrade,
	'active' => $active,
		       );
    }

    if ( $updated ) {
      $courseid = update_course( $courseid, $updated );
      $saved = 1;

      $courses = get_courses();
      foreach ( $courses as $crs ) {
	if ( $crs['courseid'] == $courseid ) {
	  $course = $crs;
	  $edit = 1;
	  break;
	}
      }
    }
  }
}

$output = array(
	'edit' => $edit,
	'saved' => $saved,
	'course' => $course,
        'categories' => $categories,
	'error' => $error,
);
output( $output, 'manage/edit_course.tmpl' );
?>
