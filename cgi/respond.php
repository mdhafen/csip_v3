<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/csips.phpm' );
include_once( '../inc/activity.phpm' );

authorize( 'load_csip' );

$activityid = input( 'activity', INPUT_PINT );
$response = input( 'response', INPUT_STR );
$op = input( 'op', INPUT_STR );

$progress = input( 'progress', INPUT_STR );
$report = input( 'report', INPUT_STR );
$complete = input( 'complete', INPUT_STR );
if ( $complete ) { $complete = ( $complete == 'yes' ) ? 1 : 0; }

$response = ( $response == 'yes' ) ? 1 : ( ( $response == 'no' ) ? 0 : NULL );

$csip = $_SESSION['csip'];
if ( $csip && $csip['csipid'] != $csipid ) {
  $csip = load_csip( $csipid );
  $_SESSION['csip'] = $csip;
}

$activity = $csip['category'][ $categoryid ]['goal'][ $goalid ]['activity'][ $activityid ];

if ( $op == 'Save' ) {
  if ( $complete != $activity['completed'] ) {
    $update['completed'] = $complete;
  }
  if ( $progress != $activity['progress'] ) {
    $update['progress'] = $progress;
  }
  if ( $report != $activity['report'] ) {
    $update['report'] = $report;
  }
  if ( $update ) {
    $activityid = update_activity_fields( $activityid, $update );
    $updated = 1;
  }
}

$output = array(
		'activityid' => $activityid,
		'goalid' => $goalid,
		'categoryid' => $categoryid,
		'csipid' => $csipid,
		'response' => $response,
		'updated' => $updated,
		'activity' => $activity,
);
output( $output, 'respond.tmpl' );
?>
