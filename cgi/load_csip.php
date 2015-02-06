<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/csips.phpm' );

if ( ! authorized( 'load_csip' ) || ! authorized( 'load_other_csip' ) ) {
  authorize( 'load_csip' );
}

$csipid = input( 'csipid', INPUT_PINT );

$loaded = 0;
$csip = array();
$csips = array();
$error = array();
if ( $csipid ) {
  if ( get_csip_locationid( $csipid ) != $_SESSION['loggedin_user']['locationid'] && ! authorized( 'load_other_csip' ) ) {
    $error[] = 'NOTYOURS';
  } else {
    $csip = load_csip( $csipid );
    if ( $csip ) {
      $_SESSION['csip'] = $csip;
      $loaded = 1;
    }
  }
} else {
  $district = authorized( 'load_other_csip' );
  $locationid = $_SESSION['loggedin_user']['locationid'];
  $csips = get_csips( $locationid, $district, 0 );
  // 0 is history depth, or load all csips
}

$output = array(
	'loaded' => $loaded,
	'csip' => $csip,
	'csips' => $csips,
	'errors' => $error,
);
output( $output, 'load_csip.tmpl' );
?>
