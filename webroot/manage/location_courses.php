<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );

include_once( '../../inc/site.phpm' );
include_once( '../../inc/course.phpm' );

authorize( 'manage_users' );

$op = input( 'op', INPUT_STR );
$locationid = input( 'locationid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );

$courses = get_courses();
$course_by_cat = array();
$loc_course_by_cat = array();
$saved = 0;
$locations = all_locations();
$loc_courses = array();
$loc_links = array();

if ( !empty($locationid) ) {
  if ( !in_array($locationid, array_column($locations,'locationid')) ) {
    error( array('BADLOC' => 'Undefined Location') );
  }

  $loc_links = get_location_course_links( $locationid );

  $loc_courses = get_location_courses( $locationid, $locations[$locationid]['mingrade'], $locations[$locationid]['maxgrade'] );
  foreach ( $loc_courses as $l_c_id ) {
    $loc_course_by_cat[ $courses[$l_c_id]['category_name'] ][ $l_c_id ] = $courses[$l_c_id];
  }
  ksort( $loc_course_by_cat, SORT_STRING | SORT_FLAG_CASE );
  foreach ( $loc_course_by_cat as $cat => $cat_courses ) {
    uasort( $loc_course_by_cat[$cat], 'cmp_course_name' );
  }

  foreach ( $courses as $c_id => $crs ) {
    $course_by_cat[ $courses[$c_id]['category_name'] ][ $c_id ] = $courses[$c_id];
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
      location_add_course( $locationid, $courseid );
    }
    else if ( $op == "Delete" ) {
      location_delete_course( $locationid, $courseid );
    }
    $loc_links = get_location_course_links( $locationid );
    $loc_courses = get_location_courses( $locationid, $locations[$locationid]['mingrade'], $locations[$locationid]['maxgrade'] );
    foreach ( $loc_courses as $l_c_id ) {
      $loc_course_by_cat[ $courses[$l_c_id]['category_name'] ][ $l_c_id ] = $courses[$l_c_id];
    }
    ksort( $loc_course_by_cat, SORT_STRING | SORT_FLAG_CASE );
    foreach ( $loc_course_by_cat as $cat => $cat_courses ) {
      uasort( $loc_course_by_cat[$cat], 'cmp_course_name' );
    }
  }
}

$output = array(
        'courses' => $courses,
        'course_by_cat' => $course_by_cat,
        'locationid' => $locationid,
	'saved' => $saved,
	'locations' => $locations,
        'loc_courses' => $loc_courses,
        'loc_course_by_cat' => $course_by_cat,
        'loc_links' => $loc_links,
);
output( $output, 'manage/location_courses.tmpl' );

function cmp_course_name( $a, $b ) {
  return strcasecmp( $a['course_name'], $b['course_name'] );
}
?>
