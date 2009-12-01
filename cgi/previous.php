<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/csips.phpm' );

if ( ! authorized( 'load_csip' ) || ! authorized( 'load_other_csip' ) ) {
  authorize( 'load_csip' );
}

$csip = $_SESSION['csip'];

if ( ! $csip ) {
  $location = ( preg_match( '/^http/', $config['base_url'] ) ) ? $config['base_url'] : "http://". $_SERVER['HTTP_HOST'] . $config['base_url'];
  header( "Location: $location" );
  exit;
}

$categoryid = input( 'category', INPUT_PINT );
$op = input( 'op', INPUT_STR );

if ( $op == 'Save This Report' ) {
  $activityid = input( 'activityid', INPUT_PINT );
  $completed = input( "{$activityid}_complete", INPUT_STR );
  $forward = input( "{$activityid}_forward", INPUT_STR );
  $update = array();

  if ( $completed ) {
    $completed = ( $completed == 'yes' ) ? 1 : 0;
    $update['completed'] = $completed;
    $activityid = update_activity_fields( $activityid, $update );
    $updated = 1;
  }

  if ( $forward ) {
    forward_activity( $activityid, $csip['csipid'], $categoryid );
    $updated = 1;
  }

  if ( $updated ) {
    $csip = load_csip( $csip['csipid'] );
    $_SESSION['csip'] = $csip;
  }
}

$previous = cat_get_previous( $categoryid, $csip['csipid'] );

$output = array(
	'csip' => $csip,
	'categoryid' => $categoryid,
	'previous' => $previous,
	'updated' => $updated,
);
output( $output, 'previous.tmpl' );
?>
