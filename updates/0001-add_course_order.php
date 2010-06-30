<?php

include_once( '../lib/data.phpm' );
include_once( '../lib/config.phpm' );

$db_settings = $config['database'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '$table' AND TABLE_NAME = 'category' AND COLUMN_NAME = 'category_group_order'";
$row = $dbh->query( $query );
if ( $row['count'] == 0 ) {
  $query = "ALTER TABLE category ADD COLUMN course_group INT(10) UNSIGNED NOT NULL DEFAULT 0 AFTER category_group";
  $dbh->exec( $query );

  $query = "ALTER TABLE category ADD COLUMN course_group_order INT(10) UNSIGNED NOT NULL DEFAULT 0 AFTER course_group";
  $dbh->exec( $query );
  return "Added columns to category table: course_group, course_group_order";
}

?>
