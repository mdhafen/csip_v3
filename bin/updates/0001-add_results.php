<?php

include_once( '../../lib/config.phpm' );
include_once( '../../lib/data.phpm' );

$db_settings = $config['database'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '$table' AND TABLE_NAME = 'answer' AND COLUMN_NAME = 'order'";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {

  $query = "update question set question_group = question_group + 1 where question_group >= 3";
  $dbh->exec( $query );

  $query = "insert into question ( version,question_group,type,order_num,question ) values ( 7, 3, 3, 1, '<p>Teacher Name[input]</p>' ), ( 7, 3, 1, 2, '<p>Based on your stakeholder input, reflect on your individual practices regarding the elements of your CSIP. (You may add links, blogs, etc. to this section as evidence) [input]</p>' )";
  $dbh->exec( $query );

  $query = "update csip_extra_part_links set part = part + 1";
  $dbh->exec( $query );

  $query = "update course_question_links set part = part + 1, question_group = question_group + 1 where part >= 3";
  $dbh->exec( $query );

  $query = "insert into course_question_links (courseid,question_group,part,title) ( select courseid,3,3,'Stakeholder Input' from course)";
  $dbh->exec( $query );

  $query = "update answer set part = part + 1 where part >= 3 order by part desc";
  $dbh->exec( $query );

  return "Add Survey Reflection part and feature for multiple answer to a question.";
}

?>
