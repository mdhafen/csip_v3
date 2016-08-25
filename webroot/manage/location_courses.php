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

$location = array();
$loc_links = array();
$loc_courses = array();
$loc_course_by_cat = array();
$courses = get_courses(TRUE);
$course_by_cat = array();
$saved = 0;

if ( !empty($locationid) ) {
  $locations = all_locations();
  foreach ( $locations as $loc ) {
    if ( $loc['locationid'] == $locationid ) {
      $location = $loc;
    }
  }
  if ( empty($location) ) {
    error( array('BADLOC' => 'Undefined Location') );
  }

  $loc_links = get_location_course_links( $locationid );

  $loc_courses = get_location_courses( $locationid, $location['mingrade'], $location['maxgrade'] );
  foreach ( $loc_courses as $l_c_id ) {
    $loc_course_by_cat[ $courses[$l_c_id]['category_name'] ][ $l_c_id ] = $courses[$l_c_id];
  }

  foreach ( $courses as $c_id => $crs ) {
    $course_by_cat[ $courses[$c_id]['category_name'] ][ $c_id ] = $courses[$c_id];
  }

  if ( !empty($courseid) ) {
    if ( ! array_key_exists( $courseid, $courses ) ) {
      error( array('BADCRS' => 'Undefined Course' ) );
    }

    if ( $op == "Add" ) {  // Update/Add the user
      location_add_course( $locationid, $courseid );
    }
    else if ( $op == "Delete" ) {
      location_delete_course( $locationid, $courseid );
    }
    $loc_course_by_cat = array();
    $loc_links = get_location_course_links( $locationid );
    $loc_courses = get_location_courses( $locationid, $location['mingrade'], $location['maxgrade'] );
    foreach ( $loc_courses as $l_c_id ) {
      $loc_course_by_cat[ $courses[$l_c_id]['category_name'] ][ $l_c_id ] = $courses[$l_c_id];
    }
  }
}

if ( !empty($course_by_cat) ) {
  ksort( $course_by_cat, SORT_STRING | SORT_FLAG_CASE );
  foreach ( $course_by_cat as $cat => $cat_courses ) {
    uasort( $course_by_cat[$cat], 'cmp_course_name' );
  }
}
if ( !empty($loc_course_by_cat) ) {
  ksort( $loc_course_by_cat, SORT_STRING | SORT_FLAG_CASE );
  foreach ( $loc_course_by_cat as $cat => $cat_courses ) {
    uasort( $loc_course_by_cat[$cat], 'cmp_course_name' );
  }
}
if ( !empty($loc_links) ) {
  uasort( $loc_links, function ($a,$b) use ($courses) { return strcasecmp($courses[$a]['course_name'],$courses[$b]['course_name']); } );
}

$output = array(
	'locationid' => $locationid,
	'location' => $location,
	'loc_links' => $loc_links,
	'loc_courses' => $loc_courses,
	'loc_course_by_cat' => $loc_course_by_cat,
	'courses' => $courses,
	'course_by_cat' => $course_by_cat,
	'saved' => $saved,
);
output( $output, 'manage/location_courses.tmpl' );

function cmp_course_name( $a, $b ) {
  return strcasecmp( $a['course_name'], $b['course_name'] );
}
?>
