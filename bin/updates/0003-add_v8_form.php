<?php

include_once( '../../lib/config.phpm' );
include_once( '../../lib/data.phpm' );

$db_settings = $config['database']['core']['write'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM question WHERE questionid > 31";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {

  $query = "ALTER TABLE course_approval ADD COLUMN principal_comment TEXT NULL AFTER principal_approved";
  $dbh->exec( $query );

  $query = "ALTER TABLE course_approval ADD COLUMN comment_date DATE NULL AFTER principal_comment";
  $dbh->exec( $query );

  $sth = $dbh->prepare("INSERT INTO question (questionid,version,question_group,type,order_num,question) VALUES (:qid,8,:group,:type,:order,:quest)");

  // type 1:text 2:select 3:sm-text 4:md-text 5:lg-text 7:check 8:multi 9:info
  $sth->bindValue(':qid','32');
  $sth->bindValue(':group','1');
  $sth->bindValue(':type','9');
  $sth->bindValue(':order','1');
  $sth->bindValue(':quest','<b>Team Professional Growth Plan:</b><br/>
After identifying your GVC and individually self assessing with the <a class="uk-display-inline" target="_blank" href="http://www.schools.utah.gov/CURR/educatoreffectiveness/Observation-Tools/Teaching/Chart.aspx">Utah Teaching Ovservation Tool (UTOT)</a>, collectively determine the Teaching Standard(s) you need to strengthen as a team, based on the learning needs of the students in your classroom this year (<a href="https://docs.google.com/document/d/1avnRg24z6hlyZccCJTKoFnTKzNXmPR4dqGACC-AOlyI/copy" class="uk-display-inline" target="_blank">click here for optional template</a>).');
  $sth->execute();

  $sth->bindValue(':qid','33');
  $sth->bindValue(':group','1');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','2');
  $sth->bindValue(':quest','Outline Team\'s Professional Growth Plan Here...');
  $sth->execute();

  $sth->bindValue(':qid','43');
  $sth->bindValue(':group','3');
  $sth->bindValue(':type','3');
  $sth->bindValue(':order','1');
  $sth->bindValue(':quest','Teacher Name');
  $sth->execute();

  $sth->bindValue(':qid','44');
  $sth->bindValue(':group','3');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','2');
  $sth->bindValue(':quest','Reflect on your individual practices based on your stakeholder input');
  $sth->execute();

  $sth->bindValue(':qid','45');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','9');
  $sth->bindValue(':order','1');
  $sth->bindValue(':quest','<b>What do students NEED to know and be able to do?</b><br/>
With your team:<ol><li>Look at your standards, give priority, and come to consensus around key skills, concepts, behaviors, and dispositions.</li><li>identify/list the Essential Learnings that all students need to know.  These are your GVC\'s.</li>
<li>Once your team has identified each GVC, share with the team above and below your specific grade level.</li>
<li>Share the GVC with your students.</li></ol>');
  $sth->execute();

  $sth->bindValue(':qid','46');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','2');
  $sth->bindValue(':quest','Enter the GVC:');
  $sth->execute();

  $sth->bindValue(':qid','47');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','9');
  $sth->bindValue(':order','3');
  $sth->bindValue(':quest','<h1>Learning Targets and Common Formative Assessments</h1>');
  $sth->execute();

  $sth->bindValue(':qid','48');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','9');
  $sth->bindValue(':order','4');
  $sth->bindValue(':quest','<b>How will WE know if they LEARNED it?</b><br/>
A learning target is any achievement expectation for students <i>on the path</i> toward mastery of a standard.  It clearly states what we want the students to learn and should be understood by teachers and students.  Learning targets should be formatively assessed to monitor progress toward a GVC.<br/>
With your team:<ol><li>Break the GVC into specific, measurable learning targets.</li><li>Identify a Common Formative Assessment(s) that your team will use to measure these learning targets.</li><li>Schedule, administer, and analyze the results of your CFA(s).</li></ol>');
  $sth->execute();

  $sth->bindValue(':qid','49');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','5');
  $sth->bindValue(':quest','List all Learning Targets that will lead to proficiency in this GVC');
  $sth->execute();

  $sth->bindValue(':qid','50');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','6');
  $sth->bindValue(':quest','CFA(s)');
  $sth->execute();

  $sth->bindValue(':qid','51');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','6');
  $sth->bindValue(':quest','# assessed');
  $sth->execute();

  $sth->bindValue(':qid','52');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','7');
  $sth->bindValue(':quest','# NOT proficient');
  $sth->execute();

  $sth->bindValue(':qid','53');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','8');
  $sth->bindValue(':quest','OPTIONAL: Enter links to online documents which support this assessment.');
  $sth->execute();

  $sth->bindValue(':qid','54');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','9');
  $sth->bindValue(':quest','According to the results of our CFA(s) and our team collaboration, the following teaching practices/strategies were most effective for this GVC.');
  $sth->execute();

  $sth->bindValue(':qid','55');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','9');
  $sth->bindValue(':order','10');
  $sth->bindValue(':quest','<h1>Intervention</h1>');
  $sth->execute();

  $sth->bindValue(':qid','56');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','9');
  $sth->bindValue(':order','11');
  $sth->bindValue(':quest','<b>How will WE respond to those who didn\'t get it?</b><br/>
EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn\'t get a concept, it might not be an intervention issue; the initial instruction should be re-examined.)');
  $sth->execute();

  $sth->bindValue(':qid','57');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','12');
  $sth->bindValue(':quest','List the SPECIFIC INTERVENTIONS your team responded with for students who WERE NOT proficient in this GVC.');
  $sth->execute();

  $sth->bindValue(':qid','58');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','3');
  $sth->bindValue(':order','13');
  $sth->bindValue(':quest','Following your team\'s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?');
  $sth->execute();

  $sth->bindValue(':qid','59');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','14');
  $sth->bindValue(':quest','List the FIRST NAMES of those students who were not proficient even after your team\'s intervention. (Or enter a link to an online document with the students names.)');
  $sth->execute();

  $sth->bindValue(':qid','60');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','15');
  $sth->bindValue(':quest','How did your TEAM respond to those who were still not proficient even after your team\'s interventions?');
  $sth->execute();

  $sth->bindValue(':qid','61');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','9');
  $sth->bindValue(':order','16');
  $sth->bindValue(':quest','<h1>Learning Extensions</h1>');
  $sth->execute();

  $sth->bindValue(':qid','62');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','9');
  $sth->bindValue(':order','17');
  $sth->bindValue(':quest','What will we do if they already know it?');
  $sth->execute();

  $sth->bindValue(':qid','63');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','18');
  $sth->bindValue(':quest','As you plan instruction for this GVC and the learning targets, identify extension activities your team will use for those who already know it.');
  $sth->execute();

  $sth->bindValue(':qid','64');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','3');
  $sth->bindValue(':order','19');
  $sth->bindValue(':quest','Once you have completed the process, reflect on...');
  $sth->execute();

  $sth->bindValue(':qid','65');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','3');
  $sth->bindValue(':order','19');
  $sth->bindValue(':quest','What we will keep for this GVC:');
  $sth->execute();

  $sth->bindValue(':qid','66');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','20');
  $sth->bindValue(':quest','What we will change for this GVC:');
  $sth->execute();

  $dbh->exec( 'UPDATE question SET group_repeatableid = 1 WHERE questionid in (43,44)' );

  $dbh->exec( 'UPDATE question SET protect_answer = 1 WHERE questionid in (59)' );

  return "Add the v8 DCSIP form questions and year";
}

?>
