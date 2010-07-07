<?php

include_once( '../lib/data.phpm' );
include_once( '../lib/config.phpm' );

$db_settings = $config['database'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT LOCATE( 'OTHR', COLUMN_TYPE ) AS OTHR FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '$table' AND TABLE_NAME = 'category' AND COLUMN_NAME = 'category_class'";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['OTHR'] == 0 ) {
  $query = "ALTER TABLE category MODIFY COLUMN category_class ENUM( 'SAP', 'CSIP', 'MAND', 'OPT', 'OTHR' ) NOT NULL DEFAULT 'OTHR'";
  $dbh->exec( $query );
  return "Added Other class to category table: category_class OTHR";
}

?>
