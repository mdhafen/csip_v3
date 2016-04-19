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

  $sth = $dbh->prepare("INSERT INTO question (questionid,version,question_group,type,order_num,question) VALUES (:qid,8,:group,:type,:order,:quest)");

  // type 1:text 2:select 3:sm-text 4:md-text 5:lg-text 7:check 8:multi 9:info
  $sth->bindValue(':qid','32');
  $sth->bindValue(':group','1');
  $sth->bindValue(':type','9');
  $sth->bindValue(':order','1');
  $sth->bindValue(':quest','<b>What is the GVC?</b><br/>
HIGHLY EFFECTIVE TEAMS teach ALL of the standards within their discipline but engage in the work of IDENTIFYING which of the standards/skills are so critical that EVERY student MUST know. TEAMS then work to ENSURE that every student will demonstrate proficiency in them. The <a class="uk-display-inline" target="_blank" href="http://prodev.washk12.org/site_file/prodev/files/Learning_Graphics/gvc.pdf">GVC</a> are the agreed upon essentials within the course or grade level that teams will commit to collectively address, commonly assess and persistently provide targeted interventions for students in need.');
  $sth->execute();

  $sth->bindValue(':qid','33');
  $sth->bindValue(':group','1');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','2');
  $sth->bindValue(':quest','<b>Team Professional Growth Plan</b><br/>
After identifying your GVC and individually self assessing with the <a class="uk-display-inline" target="_blank" href="http://www.uen.org/k12educator/uets/">Utah Effective Teaching Standards</a>, collectively determine the teaching practices you need to strengthen as a team, based on the learning needs of the students in your classroom this year.');
  $sth->execute();

  $sth->bindValue(':qid','34');
  $sth->bindValue(':group','1');
  $sth->bindValue(':type','4');
  $sth->bindValue(':order','3');
  $sth->bindValue(':quest','<b>Reflection Date</b><br/>Enter the date when your team will complete the Reflection process');
  $sth->execute();

  $sth->bindValue(':qid','35');
  $sth->bindValue(':group','1');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','4');
  $sth->bindValue(':quest','<b>Reflection Summary</b><br/>
<p>Has your team\'s GVC changed?  If so, which elements did your team adjust in preparation for next year?</p>');
  $sth->execute();

  $sth->bindValue(':qid','36');
  $sth->bindValue(':group','2');
  $sth->bindValue(':type','9');
  $sth->bindValue(':order','1');
  $sth->bindValue(':quest','<b>Essential Elements of Accreditation</b><br/>
For middle and high school only-Utilize the elements of this section to support the necessary accreditation expectations and highlight the work that your school is engaged in..');
  $sth->execute();

  $sth->bindValue(':qid','37');
  $sth->bindValue(':group','2');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','2');
  $sth->bindValue(':quest','Demographics');
  $sth->execute();

  $sth->bindValue(':qid','38');
  $sth->bindValue(':group','2');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','3');
  $sth->bindValue(':quest','Learning Data');
  $sth->execute();

  $sth->bindValue(':qid','39');
  $sth->bindValue(':group','2');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','4');
  $sth->bindValue(':quest','Survey Results');
  $sth->execute();

  $sth->bindValue(':qid','40');
  $sth->bindValue(':group','2');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','5');
  $sth->bindValue(':quest','IEQ-Index of Education Equality');
  $sth->execute();

  $sth->bindValue(':qid','41');
  $sth->bindValue(':group','2');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','6');
  $sth->bindValue(':quest','Learning Environment');
  $sth->execute();

  $sth->bindValue(':qid','42');
  $sth->bindValue(':group','2');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','7');
  $sth->bindValue(':quest','Other Information');
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
  $sth->bindValue(':quest','<b>Our Team\'s GVC</b><br/>
With your team, identify/list the critical standards/skills that all students need to know.<br>
Once your team has identified the skills, share with the team above and below your specific grade level.<br>
Share the guaranteed skills with your students that you have identified below.');
  $sth->execute();

  $sth->bindValue(':qid','46');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','2');
  $sth->bindValue(':quest','List your GVC here:');
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
EFFECTIVE TEAMS utilize COMMON FORMATIVE ASSESSMENTS (CFA) to diagnostically assess a student\'s learning, determine which students were proficient in the guaranteed skill, and those who need extra time and support.<br/>
TEAM ACTION STEPS: Identify a common formative assessment that your team will use to assess the GVC skill.');
  $sth->execute();

  $sth->bindValue(':qid','49');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','5');
  $sth->bindValue(':quest','List the Learning Targets that will be part of this standard');
  $sth->execute();

  $sth->bindValue(':qid','50');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','6');
  $sth->bindValue(':quest','How many students were assessed by our team?');
  $sth->execute();

  $sth->bindValue(':qid','51');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','7');
  $sth->bindValue(':quest','How many students were NOT proficient the first time?');
  $sth->execute();

  $sth->bindValue(':qid','52');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','8');
  $sth->bindValue(':quest','Enter any website links to online documents which support this assessment');
  $sth->execute();

  $sth->bindValue(':qid','53');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','9');
  $sth->bindValue(':quest','According to the results of this CFA and our team\'s collaboration, the following teaching practices/strategies were most effective in teaching this guaranteed skill(s):');
  $sth->execute();

  $sth->bindValue(':qid','54');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','9');
  $sth->bindValue(':order','10');
  $sth->bindValue(':quest','<h1>Intervention</h1>');
  $sth->execute();

  $sth->bindValue(':qid','55');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','9');
  $sth->bindValue(':order','11');
  $sth->bindValue(':quest','<b>How will WE respond to those who didn\'t get it?</b><br/>
EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn\'t get a concept, it might not be an intervention issue; the initial instruction should be re-examined.)');
  $sth->execute();

  $sth->bindValue(':qid','56');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','12');
  $sth->bindValue(':quest','List the SPECIFIC INTERVENTIONS your team responded with for students who WERE NOT proficient.');
  $sth->execute();

  $sth->bindValue(':qid','57');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','3');
  $sth->bindValue(':order','13');
  $sth->bindValue(':quest','Following your team\'s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?');
  $sth->execute();

  $sth->bindValue(':qid','58');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','14');
  $sth->bindValue(':quest','List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team\'s intervention. (Use hyperlinks in this section to link to an outside source if needed.)');
  $sth->execute();

  $sth->bindValue(':qid','59');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','15');
  $sth->bindValue(':quest','How did your TEAM respond to those who were still not proficient even after your team\'s interventions?');
  $sth->execute();

  $sth->bindValue(':qid','60');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','9');
  $sth->bindValue(':order','16');
  $sth->bindValue(':quest','<h1>Learning Extensions</h1>');
  $sth->execute();

  $sth->bindValue(':qid','61');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','9');
  $sth->bindValue(':order','17');
  $sth->bindValue(':quest','EFFECTIVE TEAMS provide extension activities for those students who already know a standard or skill.');
  $sth->execute();

  $sth->bindValue(':qid','62');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','18');
  $sth->bindValue(':quest','ACTION STEPS: As you review your GVC (from step #1), identify extension activities your team will use for those who already know it.');
  $sth->execute();

  $sth->bindValue(':qid','63');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','3');
  $sth->bindValue(':order','19');
  $sth->bindValue(':quest','End of Year Reflection Date');
  $sth->execute();

  $sth->bindValue(':qid','64');
  $sth->bindValue(':group','4');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','20');
  $sth->bindValue(':quest','<b>End of Year Reflection</b><br/>
Do our extension activities provide deeper learning for those students who already know it?  What adjustments can we make to provide for better extended learning opportunities?');
  $sth->execute();

  $dbh->exec( 'UPDATE question SET group_repeatableid = 1 WHERE questionid in (43,44)' );

  $dbh->exec( 'UPDATE question SET protect_answer = 1 WHERE questionid in (58)' );

  return "Add the v8 DCSIP form questions and year";
}

?>
