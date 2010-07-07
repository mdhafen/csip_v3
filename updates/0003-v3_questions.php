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
 version, question_group, part, order_num, type, question_option_group, question
 )
VALUES 
 ( 3, 16, 1, 1, 8, 0, 'Overall [input_3]% of students were proficient on the [[SELECT category_name FROM category WHERE version = 3 AND course_group = [course_group] AND course_group_order = [course_group_order] -1]] CRT.  Students generally did well on the following standards &amp; objectives:
[input_1]
Students generally did not do as well on the following standards &amp; objectives:
[input_1]' ),
 ( 3, 16, 1, 2, 8, 0, 'Which subgroup(s), with 10 or more members, had less than [[SELECT [answer_0] FROM answer CROSS JOIN question USING (questionid) WHERE csipid = [csipid] AND categoryid = [categoryid] AND part = 1 AND version = 3 AND order_num = 1]]% proficient?
<table><tbody><tr><td>[input_7] Asian</td><td>[input_7] Hispanic</td><td>[input_7] SPED</td></tr><tr><td>[input_7] Black</td><td>[input_7] Indian</td><td>[input_7] ELL</td></tr><tr><td>[input_7] Caucasian</td><td>[input_7] Pacific Islander</td><td>[input_7] Low Income</td></tr></tbody></table>' ),
 ( 3, 16, 1, 3, 9, 0, '( Insert here instructions to view reports on:
PowerSchool
D.D.' ),
 ( 3, 16, -1, 1, 8, 0, 'At the beginning of the [year_name] we have
[input_3]% students proficient
[input_3]% students not proficient
on the [year_name-1] CRT.
Our goal is to have [input_3]% of the students proficient on the [category_name] CRT at the end of the school year.' ),
 ( 3, 17, 1, 1, 1, 0, 'Describe how you will measure student proficiency:
[input]' ),
 ( 3, 17, 1, 2, 1, 0, 'How often will measurement of student proficiency be done:
[input]' ),
 ( 3, 17, -1, 1, 3, 0, '[input]% of students will be proficient at the end of the school year.' ),
 ( 3, 18, 1, 1, 1, 0, 'We have reviewed student results from the literacy sections of last year''s K-post assessment. A majority of our students did well on the following concepts / skills:' ),
 ( 3, 18, 1, 2, 1, 0, 'We have reviewed student results from the literacy sections of last year''s K-pre assessment. A majority of our students will need instruction in the following concepts / skills:' ),
 ( 3, 18, 1, 3, 2, 1, 'According to the results of the literacy sections of the K-pre test, our lowest performing subgroup is:' ),
 ( 3, 19, 1, 1, 1, 0, 'We have reviewed student results from the math sections of last year''s K-post assessment. A majority of our students did well on the following concepts / skills:' ),
 ( 3, 19, 1, 2, 1, 0, 'We have reviewed student results from the math sections of last year''s K-pre assessment. A majority of our students will need instruction in the following concepts / skills:' ),
 ( 3, 19, 1, 3, 2, 1, 'According to the results of the math sections of the K-pre test, our lowest performing subgroup is:' )
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
