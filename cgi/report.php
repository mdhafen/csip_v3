<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/csips.phpm' );

if ( ! authorized( 'load_csip' ) || ! authorized( 'load_other_csip' ) ) {
  authorize( 'load_csip' );
}
if ( ! authorized( 'view_reports' ) ) {
  authorize( 'view_reports' );
}

$csip = $_SESSION['csip'];
$list = get_report_list( $csip );

if ( ! $csip ) {
  $location = ( preg_match( '/^http/', $config['base_url'] ) ) ? $config['base_url'] : "http://". $_SERVER['HTTP_HOST'] . $config['base_url'];
  header( "Location: $location" );
  exit;
}

$output = array(
	'csip' => $csip,
	'category_list' => $list,
);
output( $output, 'report.tmpl' );
?>
