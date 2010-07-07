<?php

$updates = array(
  '0001-add_course_order',
  '0002-v3_categories',
  '0003-v3_questions',
  '0004-v3_link_category_questions',
  '0005-custom_goal_option',
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
