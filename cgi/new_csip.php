<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/csips.phpm' );

authorize( 'load_csip' );

$locationid = $_SESSION['loggedin_user']['locationid'];
$years = get_years_no_csip( $locationid );

$op = input( 'op', INPUT_STR );

if ( $op == 'Create CSIP' ) {
  $year = input( 'year', INPUT_PINT );
  $csipid = new_csip( $year, $locationid );
  if ( $csipid ) {
    $created = 1;
    $csip = load_csip( $csipid );
    $_SESSION['csip'] = $csip;
  }
}

$output = array(
		'years' => $years,
		'created' => $created,
		'csip' => $csip,
);
output( $output, 'new_csip.tmpl' );
?>
