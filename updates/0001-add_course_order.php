<?php

include_once( '../lib/data.phpm' );
include_once( '../lib/config.phpm' );

$db_settings = $config['database'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '$table' AND TABLE_NAME = 'category' AND COLUMN_NAME = 'category_group_order'";
$sth = $dbh->prepare( $query );
$sth->execute();

$row = $sth->fetch();
if ( ! count( $row ) ) {
  $query = "ALTER TABLE category ADD COLUMN category_group_order INT(10) UNSIGNED AFTER category_group";
  return "Added table: category_group_order";
}

?>
