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
$courses = get_courses(true);
$groups = get_question_groups();
$edit = 0;
$saved = 0;
$course = array();
$old_parts = array();
$parts = array();
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
    $old_parts = get_course_question_groups( $courseid );

    foreach ( $categories as &$cat ) {
      if ( $cat['categoryid'] == $course['course_category'] ) {
        $cat['selected'] = true;
      }
    }
  }
}

if ( $op == "Save" ) {  // Update/Add the location
  $categoryid = input( 'categoryid', INPUT_PINT );
  $name = input( 'course_name', INPUT_HTML_NONE );
  $mingrade = input( 'min_grade', INPUT_INT );
  $maxgrade = input( 'max_grade', INPUT_INT );
  $active = input( 'active', INPUT_STR );
  $active = ( !empty($active) ) ? 1 : 0;
  $question_parts = input( 'parts', INPUT_PINT );
  $question_titles = input( 'part_titles', INPUT_HTML_NONE );
  $question_groups = input( 'questions', INPUT_PINT );
  $parts = array();

  if ( $mingrade < 0 ) { $error[] = "LOWMIN"; }
  if ( $maxgrade > 12 ) { $error[] = "HIGHMAX"; }
  if ( $mingrade > $maxgrade ) { $error[] = "MINABOVEMAX"; }

  if ( empty($error) ) {
    foreach ( array_keys($question_parts) as $count ) {
      $part = $question_parts[ $count ];
      $title = $question_titles[ $count ];
      $group = $question_groups[ $count ];

      if ( !empty($part) && !empty($title) && !empty($group) && !empty($groups[$group]) ) {
        $parts[] = array( 'part' => $part, 'title' => $title, 'question_group' => $group );
      }
    }

    if ( !empty($course) ) {
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
      if ( !empty($parts) ) {
        $oldp = $newp = array();
        foreach ( $old_parts as $part ) {
          $oldp[ $part['part'] .'_'. $part['question_group'] .'_'. $part['title'] ] = 1;
        }
        foreach ( $parts as $part ) {
          $newp[ $part['part'] .'_'. $part['question_group'] .'_'. $part['title'] ] = 1;
        }
        foreach ( $oldp as $key => $val ) {
          if ( empty($newp[$key]) ) {
            $updated['course_name'] = $name;
          }
        }
        foreach ( $newp as $key => $val ) {
          if ( empty($oldp[$key]) ) {
            $updated['course_name'] = $name;
          }
        }
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
      $courseid = update_course( $courseid, $updated, $parts );
      $saved = 1;

      $courses = get_courses(true);
      $old_parts = get_course_question_groups( $courseid );
      foreach ( $courses as $crs ) {
	if ( $crs['courseid'] == $courseid ) {
	  $course = $crs;
	  $edit = 1;
          foreach ( $categories as &$cat ) {
            if ( $cat['categoryid'] == $course['course_category'] ) {
              $cat['selected'] = true;
            }
            else {
              unset( $cat['selected'] );
            }
          }
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
        'parts' => $old_parts,
        'categories' => $categories,
	'error' => $error,
);
output( $output, 'manage/edit_course.tmpl' );
?>
