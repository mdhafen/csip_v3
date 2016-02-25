<?php

include_once( '../../lib/config.phpm' );
include_once( '../../lib/data.phpm' );

$db_settings = $config['database']['core']['write'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM information_schema.tables WHERE table_schema = '$table' AND table_name = 'answer_group_sequence'";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {

  $query = "CREATE TABLE answer_group_sequence (
  csipid INT(10) UNSIGNED NOT NULL DEFAULT '0',
  courseid INT(10) UNSIGNED NOT NULL DEFAULT '0',
  part INT(4) NOT NULL DEFAULT '0',
  group_repeatableid INT(10) UNSIGNED NOT NULL DEFAULT '0',
  sequence_value INT(10) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (csipid,courseid,part,group_repeataableid)
) ENGINE MyISAM DEFAULT CHARSET=utf8";
  $dbh->exec( $query );

  $query = "ALTER TABLE question ADD COLUMN group_repeatableid INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER question_group";
  $dbh->exec( $query );

  $query = "UPDATE question SET group_repeatableid = 1 WHERE question_group = 3";
  $dbh->exec( $query );

  $query = "ALTER TABLE answer ADD COLUMN group_sequence INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER part";
  $dbh->exec( $query );

  $answerid = $count = $prev_csip = $prev_course = $prev_part = 0;
  $query = "SELECT answerid,csipid,courseid,part FROM answer WHERE questionid IN (30,31) ORDER BY csipid,courseid,part";
  $sth = $dbh->prepare( $query );
  $query = "UPDATE answer SET group_sequence = :count WHERE answerid = :answerid";
  $update_sth = $dbh->prepare( $query );
  $query = "INSERT INTO answer_group_sequence (sequence_value,csipid,courseid,part,group_repeatableid) VALUES (:count, :csipid, :courseid, :part, 1)";
  $record_sth = $dbh->prepare( $query );
  $count = $prev_csip = $prev_course = $prev_part = 0;
  $answers = $sth->fetchAll( PDO::FETCH_NUM );
  foreach ( $answers as $row ) {
    list($answerid,$csipid,$courseid,$part) = $row;
print "A: $answerid C: $csipid O: $courseid P: $part\n";
    if ( $csipid != $prev_csip || $courseid != $prev_course || $part != $prev_part ) {
      if ( $prev_csip !== 0 ) {
        $count--;
        $record_sth->bindValue( ':count', $count );
        $record_sth->bindValue( ':csipid', $prev_csip );
        $record_sth->bindValue( ':courseid', $prev_course );
        $record_sth->bindValue( ':part', $prev_part );
        $record_sth->execute();
      }

      $prev_csip = $csipid;
      $prev_course = $courseid;
      $prev_part = $part;
      $count = 0;
    }

    $update_sth->bindValue( ':count', $count );
    $update_sth->bindValue( ':answerid', $answerid );
    $update_sth->execute();
    $count++;
  }

  // record the sequence number of the last group
  if ( $count > 1 ) {
    $count--;
    $record_sth->bindValue( ':count', $count );
    $record_sth->bindValue( ':csipid', $prev_csip );
    $record_sth->bindValue( ':courseid', $prev_course );
    $record_sth->bindValue( ':part', $prev_part );
    $record_sth->execute();
  }

  return "Add sequences to differenciate answers in repeatable question groups.";
}

?>
