<?php

include_once( '../lib/data.phpm' );
include_once( '../lib/config.phpm' );

$db_settings = $config['database'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM category WHERE version = 3 AND question_group <> 0";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {
  $query = "
UPDATE category
   SET question_group = 17
 WHERE version = 3
   AND question_group = 0
   AND category_name IN
       ( 'Language Arts 1', 'Language Arts 2', 'Math 1', 'Math 2', 'Fine Arts',
         'Foreign Language', 'Health / PE', 'Social Studies', 'Science 4',
         'Career and Technology', 'Special Education',
         'English Language Learners (ELL)' )
";
  $result = $dbh->exec( $query );
  if ( $result === FALSE ) {
    $error = $dbh->errorInfo();
    return "Error adding version 3 questions to categories: ". $error[2];
  }

  $query = "
UPDATE category
   SET question_group = 18
 WHERE version = 3
   AND question_group = 0
   AND category_name = 'Kindergarten Literacy'
";
  $result = $dbh->exec( $query );
  if ( $result === FALSE ) {
    $error = $dbh->errorInfo();
    return "Error adding version 3 questions to categories: ". $error[2];
  }

  $query = "
UPDATE category
   SET question_group = 19
 WHERE version = 3
   AND question_group = 0
   AND category_name = 'Kindergarten Math'
";
  $result = $dbh->exec( $query );
  if ( $result === FALSE ) {
    $error = $dbh->errorInfo();
    return "Error adding version 3 questions to categories: ". $error[2];
  }

  $query = "
UPDATE category
   SET question_group = 16
 WHERE version = 3
   AND question_group = 0
   AND ( category_name LIKE 'Language Arts%'
    OR category_name LIKE 'Math%'
    OR category_name LIKE '%Algebra%'
    OR category_name LIKE 'Geometry%'
    OR category_name LIKE 'Science%'
    OR category_name IN ( 'Earth Systems 9', 'Biology', 'Chemistry', 'Physics' ) )
";
  $result = $dbh->exec( $query );
  if ( $result !== FALSE ) {
    return "Adding version 3 questions: Linking questions to categories";
  } else {
    $error = $dbh->errorInfo();
    return "Error adding version 3 questions to categories: ". $error[2];
  }

}

?>
