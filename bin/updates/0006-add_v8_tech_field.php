<?php

include_once( '../../lib/config.phpm' );
include_once( '../../lib/data.phpm' );

$db_settings = $config['database']['core']['write'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM question WHERE question_group = 5";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {

  $sth = $dbh->prepare("INSERT INTO question (questionid,version,question_group,type,order_num,question) VALUES (:qid,8,5,:type,:order,:quest)");

  // type 1:text 2:select 3:sm-text 4:md-text 5:lg-text 7:check 8:multi 9:info
  $sth->bindValue(':qid','67');
  $sth->bindValue(':type','9');
  $sth->bindValue(':order','1');
  $sth->bindValue(':quest','<p><strong>Team Professional Growth Plan:</strong></p><hr>
<p>After identifying your GVC and individually self assessing with the <a class="uk-display-inline custom-anchor" target="_blank" href="[utot_url]">[utot_label]</a>, collectively determine the Teaching Standard(s) you need to strengthen as a team, based on the learning needs of the students in your classroom this year (<a href="https://docs.google.com/document/d/1avnRg24z6hlyZccCJTKoFnTKzNXmPR4dqGACC-AOlyI/copy" class="uk-display-inline custom-anchor" target="_blank">click here for optional template</a>).</p>');
  $sth->execute();

  $sth->bindValue(':qid','68');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','2');
  $sth->bindValue(':quest','Outline Team\'s Professional Growth Plan Here...');
  $sth->execute();

  $sth->bindValue(':qid','69');
  $sth->bindValue(':type','9');
  $sth->bindValue(':order','3');
  $sth->bindValue(':quest','<p><strong>Outline the Technology Plan:</stong></p>');
  $sth->execute();

  $sth->bindValue(':qid','70');
  $sth->bindValue(':type','1');
  $sth->bindValue(':order','4');
  $sth->bindValue(':quest','Technology Plan...');
  $sth->execute();

  $dbh->exec( 'UPDATE course_question_links CROSS JOIN course USING (courseid) SET question_group = 5 WHERE part = 1 AND course_name = \'School Leadership\'' );

  $dbh->exec( 'UPDATE question SET question = \'<p><strong>Team Professional Growth Plan:</strong></p><hr>
<p>After identifying your GVC and individually self assessing with the <a class="uk-display-inline custom-anchor" target="_blank" href="[utot_url]">[utot_label]</a>, collectively determine the Teaching Standard(s) you need to strengthen as a team, based on the learning needs of the students in your classroom this year (<a href="https://docs.google.com/document/d/1avnRg24z6hlyZccCJTKoFnTKzNXmPR4dqGACC-AOlyI/copy" class="uk-display-inline custom-anchor" target="_blank">click here for optional template</a>).</p>\' WHERE questionid = 32' );

  return "Add the technology plan to the v8 DCSIP form for the leadership course";
}

?>
