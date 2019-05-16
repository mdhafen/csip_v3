<?php

include_once( '../../lib/config.phpm' );
include_once( '../../lib/data.phpm' );

$db_settings = $config['database']['core']['write'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM information_schema.columns WHERE table_schema = '$table' AND table_name = 'course' AND column_name = 'for_leadership'";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( empty($row['count']) ) {

  $query = "ALTER TABLE `course` ADD COLUMN `for_leadership` INT(1) UNSIGNED NOT NULL DEFAULT 0 AFTER `course_category`";
  $dbh->query($query);

  if ( $dbh->errorCode() != '00000' ) {
      print "Database error: ". $dbh->errorInfo()[2] ."\n";
  }

  $dbh->exec( 'UPDATE course SET for_leadership = 1 WHERE course_name = \'School Leadership\'' );

  return "Add for_leadership flag to courses table";
}

?>
