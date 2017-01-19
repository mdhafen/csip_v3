<?php

include_once( '../../lib/config.phpm' );
include_once( '../../lib/data.phpm' );

$db_settings = $config['database']['core']['write'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT CHARACTER_MAXIMUM_LENGTH AS count FROM information_schema.columns WHERE table_schema = '$table' AND table_name = 'user' AND column_name = 'username'";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 16 ) {

  $query = "ALTER TABLE user CHANGE COLUMN username username VARCHAR(92) NOT NULL DEFAULT ''";
  $dbh->exec( $query );

  return "Expand the username column of the user table to allow up to 92 characters";
}

?>
