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

$list = get_category_list( $csip );
$principal = authorized( 'approve_school' );
$district = authorized( 'approve_district' );

$output = array(
	'csip' => $csip,
	'category_list' => $list,
	'principal' => $principal,
	'district' => $district,
);
output( $output, 'category_list.tmpl' );
?>
