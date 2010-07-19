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
 ( 3, 16, 1, 1, 9, 0, 'Last year''s CRT scores for your current class(s) can be found on <a href=\"https://psa.washk12.org/teachers/\" target=\"_BLANK\">Power Teacher</a>:
<ol><li style=\"padding: 0;\">From leftside menu select REPORTS.</li><li style=\"padding: 0;\">From list of WCSD Reports (bottom half of screen) select ASSESSMENT REPORTS</li><li style=\"padding: 0;\">Select current class.</li><li style=\"padding: 0;\">Choose a CRT and then choose ASSESSMENT SUMMART > Submit.</li></ol>

From this report you can:
<ol style=\"list-style-type: upper-alpha;\"><li style=\"padding: 0;\">See all testing information for your current students.</li><li style=\"padding: 0;\">All CRT scale scores below 160 are highlighted in pink</li><li style=\"padding: 0;\">Click on the scale score to drill down to Standard score.  Then click on the Standard to see the Objective score.</li><li style=\"padding: 0;\">Click on a student''s name to see an assessment summary.</li><li style=\"padding: 0;\">Subgroup information is summarized in the tables that follow the student list.  (Prof. is the number of Proficient students, Non. is the number of Non Proficient Students, Count is the total number of students in that subgroup.</li><li style=\"padding: 0;\">To export to an Excel file click DOWNLOAD CSV DATA</li></ol>' ),
 ( 3, 16, 1, 2, 8, 0, 'Overall [input_3]% of students were proficient on the [[SELECT category_name FROM category WHERE version = 3 AND course_group = [course_group] AND course_group_order = [course_group_order] -1]] CRT.  Students generally did well on the following standards &amp; objectives:
[input_1]
Students generally did not do as well on the following standards &amp; objectives:
[input_1]
<input type=\"submit\" name=\"op\" value=\"Save Answers\">' ),
 ( 3, 16, 1, 3, 8, 0, 'Which subgroup(s), with 10 or more members, had less than [[SELECT [answer_0] FROM answer CROSS JOIN question USING (questionid) WHERE csipid = [csipid] AND categoryid = [categoryid] AND part = 1 AND version = 3 AND order_num = 2]]% proficient?
<table><tbody><tr><td>[input_7] Asian</td><td>[input_7] Hispanic</td><td>[input_7] SPED</td></tr><tr><td>[input_7] Black</td><td>[input_7] Indian</td><td>[input_7] ELL</td></tr><tr><td>[input_7] Caucasian</td><td>[input_7] Pacific Islander</td><td>[input_7] Low Income</td></tr></tbody></table>' ),
 ( 3, 16, -1, 1, 9, 0, 'As you create target proficiency goals keep in mind the following Adequate Yearly Progress (AYP) targets:
<table><tr><th>Subject / Grade</th><th>2011 &amp; 2012</th><th>2013</th><th>2014</th></tr><tbody><tr><td>Language Arts (3-8)</td><td class="text_center">89%</td><td class="text_center">95%</td><td class="text_center">100%</td></tr><tr><td>Math (3-8)</td><td class="text_center">63%</td><td class="text_center">81%</td><td class="text_center">100%</td></tr><tr><td>Language Arts (10)</td><td class="text_center">88%</td><td class="text_center">94%</td><td class="text_center">100%</td></tr><tr><td>Math (10-12)</td><td class="text_center">60%</td><td class="text_center">80%</td><td class="text_center">100%</td></tr></tbody></table>' ),
 ( 3, 16, -1, 2, 8, 0, 'At the beginning of the [year_name] we have
[[SELECT [answer_0] FROM answer CROSS JOIN question USING (questionid) WHERE csipid = [csipid] AND categoryid = [categoryid] AND part = 1 AND version = 3 AND order_num = 2]]% students proficient
[i_percent [[SELECT [answer_0] FROM answer CROSS JOIN question USING (questionid) WHERE csipid = [csipid] AND categoryid = [categoryid] AND part = 1 AND version = 3 AND order_num = 2]] ]% students not proficient
on the [year_name-1] [[SELECT category_name FROM category WHERE version = 3 AND course_group = [course_group] AND course_group_order = [course_group_order] -1]] CRT.
Our goal is to have [input_3]% of the students proficient on the [category_name] CRT at the end of the school year.' ),
 ( 3, 17, 1, 1, 1, 0, 'Describe how you will measure student proficiency:
[input]' ),
 ( 3, 17, 1, 2, 1, 0, 'How often will measurement of student proficiency be done:
[input]' ),
 ( 3, 17, -1, 1, 3, 0, '[input]% of students will be proficient at the end of the school year.' ),
 ( 3, 18, 1, 1, 1, 0, 'We have reviewed student results from the literacy sections of <em><strong>last year''s K-post assessment</strong></em>. A majority of our students did well on the following concepts / skills:' ),
 ( 3, 18, 1, 2, 1, 0, 'We have reviewed student results from the literacy sections of <em><strong>this year''s K-pre assessment</strong></em>. A majority of our students will need instruction in the following concepts / skills:' ),
 ( 3, 18, 1, 3, 2, 1, 'According to the results of the literacy sections of the K-pre test, our lowest performing subgroup is:' ),
 ( 3, 19, 1, 1, 1, 0, 'We have reviewed student results from the math sections of <em><strong>last year''s K-post assessment</strong></em>. A majority of our students did well on the following concepts / skills:' ),
 ( 3, 19, 1, 2, 1, 0, 'We have reviewed student results from the math sections of <em><strong>this year''s K-pre assessment</strong></em>. A majority of our students will need instruction in the following concepts / skills:' ),
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
