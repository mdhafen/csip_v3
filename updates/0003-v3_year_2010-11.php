<?php

include_once( '../lib/data.phpm' );
include_once( '../lib/config.phpm' );

$db_settings = $config['database'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM year WHERE version = 3";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {
  $query = "
INSERT INTO year ( year_name, version, sap_due_date, csip_due_date, board_due_date, district_due_date )
VALUES ( '2010-2011', 3, NULL, NULL, NULL, NULL ),
";
  $result = $dbh->exec( $query );
  if ( $result == 1 ) {
    return "Adding version 3 questions: 2010-2011 year";
  }
}

$error = $dbh->errorInfo();
return "Adding version 3 year: ". $error[2];

?>
