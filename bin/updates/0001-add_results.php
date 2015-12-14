<?php

include_once( '../../lib/config.phpm' );
include_once( '../../lib/data.phpm' );

$db_settings = $config['database'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM question WHERE question_group = 3 AND version = 7 AND order_num = 1 AND question LIKE '<p>Teacher Name%'";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {

  $query = "update question set question_group = question_group + 1 where question_group >= 3";
  $dbh->exec( $query );

  $query = "insert into question ( version,question_group,type,order_num,question ) values ( 7, 3, 3, 1, '<p>Teacher Name[input]</p>' ), ( 7, 3, 1, 2, '<p>Reflect on your individual practices based on your stakeholder input [input]</p>' )";
  $dbh->exec( $query );

  $query = "update csip_extra_part_links set part = part + 1, question_group = question_group + 1 where part >= 3";
  $dbh->exec( $query );

  $query = "update course_question_links set part = part + 1, question_group = question_group + 1 where part >= 3";
  $dbh->exec( $query );

  $query = "insert into course_question_links (courseid,question_group,part,title) ( select courseid,3,3,'Stakeholder Input' from course)";
  $dbh->exec( $query );

  $query = "update answer set part = part + 1 where part >= 3 order by part desc";
  $dbh->exec( $query );

  $query = "alter table answer drop index `part`";
  $dbh->exec( $query );

  return "Add Survey Reflection part and feature for multiple answer to a question.";
}

?>
