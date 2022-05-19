<?php

include_once( '../../lib/config.phpm' );
include_once( '../../lib/data.phpm' );

$db_settings = $config['database']['core']['write'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM question WHERE question like '%GVC%' and version > 7";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] > 0 ) {
  $dbh->exec( 'UPDATE question SET question = "<b>What do students NEED to know and be able to do?</b><br/>
With your team:<ol><li>Look at your standards, give priority, and come to consensus around key skills, concepts, behaviors, and dispositions.</li><li>identify/list the Essential Learnings that all students need to know.  These are your Essential Standards.</li>
<li>Once your team has identified each Essential Standard, share with the team above and below your specific grade level.</li>
<li>Share the Essential Standards with your students.</li></ol>" WHERE questionid = 45' );
  $dbh->exec( 'UPDATE question SET question = "<b>How will WE know if they LEARNED it?</b><br/>
A learning target is any achievement expectation for students <i>on the path</i> toward mastery of a standard. It clearly states what we want the students to learn and should be understood by teachers and students. Learning targets should be formatively assessed to monitor progress toward an Essential Standard.<br>
With your team:<ol><li>Break the Essential Standard into specific, measurable learning targets.</li><li>Identify a Common Formative Assessment(s) that your team will use to measure these learning targets.</li><li>Schedule, administer, and analyze the results of your CFA(s).</li></ol>" WHERE questionid = 48' );

  $dbh->exec( 'UPDATE course_question_links SET title = REPLACE(title,"GVC","ES") WHERE title LIKE "%GVC%"' );
  $dbh->exec( 'UPDATE course_question_links SET title = REPLACE(title,"Guaranteed Curriculum","Essential Standards") WHERE title LIKE "%Guaranteed Curriculum%"' );

  return "Change GVC to ES on v8 DCSIP form questions";
}

?>
