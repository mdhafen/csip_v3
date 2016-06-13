<?php

include_once( '../../lib/config.phpm' );
include_once( '../../lib/data.phpm' );

$db_settings = $config['database']['core']['write'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM information_schema.columns WHERE table_schema = '$table' AND table_name = 'user' AND column_name = 'externalid'";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {

  $query = "ALTER TABLE user ADD COLUMN externalid VARCHAR(12) NOT NULL DEFAULT '' AFTER role";
  $dbh->exec( $query );

  $query = "ALTER TABLE location ADD COLUMN externalid VARCHAR(12) NOT NULL DEFAULT '' AFTER loc_demo";
  $dbh->exec( $query );

  $query = "ALTER TABLE course ADD COLUMN externalid VARCHAR(12) NOT NULL DEFAULT '' AFTER max_grade";
  $dbh->exec( $query );

  return "Add the columns necessary to link users, locations, and courses for external auth and sync";
}

?>
