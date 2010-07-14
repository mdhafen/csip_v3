<?php

include_once( '../lib/data.phpm' );
include_once( '../lib/config.phpm' );

$db_settings = $config['database'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '$table' AND TABLE_NAME = 'category' AND COLUMN_NAME = 'custom_goal'";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {
  $query = "ALTER TABLE category ADD COLUMN custom_goal TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 AFTER needs_district_approve";
  $dbh->exec( $query );

  $query = "UPDATE category SET custom_goal = 1 WHERE version < 3";
  $dbh->exec( $query );

  $query = "UPDATE category SET custom_goal = 1 WHERE version = 3 AND category_name IN ( 'Kindergarten Math', 'Kindergarten Literacy' )";
  $dbh->exec( $query );
  return "Added column to category table: custom_goal";
}

?>
