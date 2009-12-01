<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/csips.phpm' );
include_once( '../inc/category.phpm' );

if ( ! authorized( 'load_csip' ) || ! authorized( 'load_other_csip' ) ) {
  authorize( 'load_csip' );
}

$csip = $_SESSION['csip'];

if ( ! $csip ) {
  $location = ( preg_match( '/^http/', $config['base_url'] ) ) ? $config['base_url'] : "http://". $_SERVER['HTTP_HOST'] . $config['base_url'];
  header( "Location: $location" );
  exit;
}

$op = input( 'op', INPUT_STR );
$categoryid = input( 'category', INPUT_PINT );
$level = input( 'level', INPUT_STR );
$errors = array();

switch ( $level ) {
 case 'principal':
 case 'community': $perm = 'approve_school'; break;
 case 'district' : $perm = 'approve_district'; break;
 default: $perm = ''; break;
}

if ( $op == 'N' && $perm && $categoryid ) {
  if ( authorized( $perm ) ) {
    cat_approve( $csip['csipid'], $categoryid, $level );
    $updated = 1;
    $csip = load_csip( $csip['csipid'] );
    $_SESSION['csip'] = $csip;
  } else {
    array_push( $errors, 'NOT_AUTHORIZED' );
  }
}

$output = array(
	'csip' => $csip,
	'updated' => $updated,
	'error' => $errors,
);
output( $output, 'approve.tmpl' );
?>
