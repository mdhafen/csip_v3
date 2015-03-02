<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/goal.phpm' );
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

$categoryid = input( 'categoryid', INPUT_PINT );
$goalid = input( 'goalid', INPUT_PINT );
$op = input( 'op', INPUT_STR );

if ( $op == 'Delete' ) {
  delete_goal( $goalid );
  $deleted = 1;
  $csip = load_csip( $csip['csipid'] );
  $_SESSION['csip'] = $csip;
} else {
  $goal = $csip['category'][ $categoryid ]['goal'][ $goalid ];
  if ( ! $goal ) {
    $error[] = "BADGOAL";
  } else {
    $depends = get_goal_num_dependants( $goalid );
  }
}

$output = array(
	'csip' => $csip,
	'categoryid' => $categoryid,
	'goal' => $goal,
	'dependants' => $depends,
	'error' => $error,
	'deleted' => $deleted,
		);

output( $output, 'goal_delete.tmpl' );
?>
