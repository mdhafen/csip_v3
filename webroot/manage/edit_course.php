<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );
include_once( '../../inc/course.phpm' );

authorize( 'manage_users' );

$courseid = input( 'courseid', INPUT_PINT );
$op = input( 'op', INPUT_STR );

$externals = array();
$categories = get_course_categories();
$courses = get_courses(true);
$groups = get_question_groups();
$edit = 0;
$saved = 0;
$course = array();
$old_parts = array();
$parts = array();
$externalids = array();
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
		$externalids = get_course_external_links( $courseid );

		foreach ( $categories as &$cat ) {
			if ( $cat['categoryid'] == $course['course_category'] ) {
				$cat['selected'] = true;
			}
		}
	}
}

if ( !empty($config['user_external_module']) ) {
	$module = $config['base_dir'] .'/lib/'. $config['user_external_module'] .".phpm";
	if ( !is_readable( $module ) ) {
		$error[] = 'EXTERNAL_NOMODULE';
	}
	include_once( $module );
	$ex = new Authen_External();

	global $assigned_externals;
	$assigned_externals = array_column(get_course_external_links(),'externalid');
	$assigned_externals = array_diff( $assigned_externals, array_column($externalids,'externalid') );
	$externals = $ex->get_courses();
	$tmp_externals = array_filter( $externals, function($var){global $assigned_externals; return !in_array($var['externalid'],$assigned_externals); } );
	$externals = array();
	foreach ( $tmp_externals as $ext ) {
		$externals[ $ext['externalid'] ] = $ext;
	}
	uasort( $externals, function($a,$b){ return strcasecmp($a['course_name'],$b['course_name']); } );
}

if ( $op == "Save" ) {	// Update/Add the location
	$categoryid = input( 'categoryid', INPUT_PINT );
	$name = input( 'course_name', INPUT_HTML_NONE );
	$mingrade = input( 'min_grade', INPUT_INT );
	$maxgrade = input( 'max_grade', INPUT_INT );
	$for_leadership = input( 'for_leadership', INPUT_STR );
	$for_leadership = ( !empty($for_leadership) ) ? 1 : 0;
	$active = input( 'active', INPUT_STR );
	$active = ( !empty($active) ) ? 1 : 0;
	$question_parts = input( 'parts', INPUT_PINT );
	$question_titles = input( 'part_titles', INPUT_HTML_NONE );
	$question_groups = input( 'questions', INPUT_PINT );
	$new_externalids = input( 'externalids', INPUT_HTML_NONE );

	$parts = array();

	if ( $mingrade < -1 ) { $error[] = "LOWMIN"; }
	if ( $maxgrade > 13 ) { $error[] = "HIGHMAX"; }
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

		$updated = array();
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
			if ( $for_leadership != $course['for_leadership'] ) {
				$updated['for_leadership'] = $for_leadership;
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
							 'for_leadership' => $for_leadership,
							 'active' => $active,
							 );
		}

		if ( !empty($updated) ) {
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

		if ( !empty($externalids) || !empty($new_externalids) ) {
			$diff1 = array_diff( array_column($externalids,'externalid'), $new_externalids );
			$diff2 = array_diff( $new_externalids, array_column($externalids,'externalid') );
			if ( !empty($diff1) || !empty($diff2) ) {
				delete_course_external_link( $courseid );
				foreach ( $new_externalids as $externalid ) {
					update_course( $courseid, array( 'externalid' => $externalid ) );
				}
			}
			$externalids = get_course_external_links( $courseid );
		}
	}
}

$output = array(
				'edit' => $edit,
				'saved' => $saved,
				'course' => $course,
				'parts' => $old_parts,
				'externalids' => $externalids,
				'categories' => $categories,
				'externals' => $externals,
				'error' => $error,
				);
output( $output, 'manage/edit_course.tmpl' );
?>
