<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

authorize( 'load_csip' );

// May need to set a different content type before output here.
/*
if ( $output_type == 'xml' ) {
	$type = 'application/xml';
} else {
	$type = 'text/html';
}
header( "Content-type: $type" );
*/
// Or use output::output(), which will set it based on $output_type as above.

#include( '../htdocs/index.php' );
$output = array(
);
output( $output, 'index.tmpl' );
?>
