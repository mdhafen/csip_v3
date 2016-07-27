<?php

$updates = array(
  '0001-add_results',
  '0002-add_answer_group_sequence',
  '0003-add_v8_form',
  '0004-add_external_auth',
);
$results = array();

foreach ( $updates as $file ) {
  if ( is_readable( $file .".php" ) ) {
    $result = include( $file .".php" );
    if ( strlen($result) > 1 ) { $results[] = $result; }
  }
}

foreach ( $results as $msg ) {
  print $msg ."\n";
}

?>
