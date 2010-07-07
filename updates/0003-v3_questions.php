<?php

include_once( '../lib/data.phpm' );
include_once( '../lib/config.phpm' );

$db_settings = $config['database'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM question WHERE version = 3";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {
  $query = "
INSERT INTO question (
 version, question_group, order_num, type, question
 )
VALUES 
 ( 3, 16, 1, 8, 'Overall [input_3]% of students were proficient on the [[SELECT category_name FROM category WHERE version = 3 AND course_group = [course_group] AND course_group_order = [course_group_order] -1]] CRT.  Students generally did well on the following standards &amp; objectives:
[input_1]
Students generally did not do as well on the following standards &amp; objectives:
[input_1]' ),
 ( 3, 16, 2, 8, 'Which subgroup(s), with 10 or more members, had less than [[SELECT [answer_0] FROM answer CROSS JOIN question USING (questionid) WHERE csipid = [csipid] AND categoryid = [categoryid] AND part = 1 AND version = 3 AND order_num = 1]]% proficient?
<table><tbody><tr><td>[input_7] Asian</td><td>[input_7] Hispanic</td><td>[input_7] SPED</td></tr><tr><td>[input_7] Black</td><td>[input_7] Indian</td><td>[input_7] ELL</td></tr><tr><td>[input_7] Caucasian</td><td>[input_7] Pacific Islander</td><td>[input_7] Low Income</td></tr></tbody></table>' ),
";
  $result = $dbh->exec( $query );
  if ( $result !== FALSE ) {
    return "Adding version 3 questions: questions";
  } else {
    $error = $dbh->errorInfo();
    return "Error adding version 3 questions: ". $error[2];
  }
}

?>
