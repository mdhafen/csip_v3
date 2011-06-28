<?php

include_once( '../lib/data.phpm' );
include_once( '../lib/config.phpm' );

$db_settings = $config['database'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '$table' AND TABLE_NAME = 'year' AND COLUMN_NAME LIKE '%due_date' AND COLUMN_TYPE = 'date'";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 4 ) {
  $query = "ALTER TABLE year CHANGE COLUMN sap_due_date sap_due_date VARCHAR(64) DEFAULT NULL, CHANGE COLUMN csip_due_date csip_due_date VARCHAR(64) DEFAULT NULL, CHANGE COLUMN board_due_date board_due_date VARCHAR(64) DEFAULT NULL, CHANGE COLUMN district_due_date district_due_date VARCHAR(64) DEFAULT NULL";
  $result = $dbh->exec( $query );
  if ( $result !== FALSE ) {
    return "Changing yearly due dates from date type to character type";
  } else {
    $error = $dbh->errorInfo();
    return "Error changing yearly due date type: ". $error[2];
  }
}

?>
