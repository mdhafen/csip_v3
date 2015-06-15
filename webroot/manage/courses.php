<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );
include_once( '../../inc/course.phpm' );

authorize( 'manage_users' );

$courses = get_courses();

$output = array(
	'courses' => $courses,
);
output( $output, 'manage/courses.tmpl' );
?>
