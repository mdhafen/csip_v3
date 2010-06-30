<?php

include_once( '../lib/data.phpm' );
include_once( '../lib/config.phpm' );

$db_settings = $config['database'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '$table' AND TABLE_NAME = 'category' AND COLUMN_NAME = 'category_group_order'";
$sth = $dbh->prepare( $query );
$sth->execute();

$row = $sth->fetch();
if ( $row['count'] == 0 ) {
  $query = "ALTER TABLE category ADD COLUMN category_group_order INT(10) UNSIGNED NOT NULL DEFAULT 0 AFTER category_group";
  $sth = $dbh->prepare( $query );
  $sth->execute();
  return "Added column to category table: category_group_order";
}

?>
