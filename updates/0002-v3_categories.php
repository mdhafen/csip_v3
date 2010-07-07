<?php

include_once( '../lib/data.phpm' );
include_once( '../lib/config.phpm' );

$db_settings = $config['database'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM category WHERE version = 3";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {
  $query = "
INSERT INTO category (
 category_name, category_class, category_type, type_target,
 category_group, course_group, course_group_order, category_note, version,
 question_group, gradelevel, loc_cat_subcat,
 needs_principal_approve, needs_community_approve, needs_district_approve,
 custom_goal_focus, parent_category )
VALUES
 ( 'Kindergarten Math', 'MAND', 0, '', 0, 0, 0, '', 3, 0, 0, 'ELEM', 1, 0, 0, 0, 97 ),
 ( 'Kindergarten Literacy', 'MAND', 0, '', 0, 0, 0, '', 3, 0, 0, 'ELEM', 1, 0, 0, 0, 101 ),
 ( 'Language Arts 1', 'MAND', 0, '', 1, 1, 1, '', 3, 0, 1, 'NA', 1, 0, 0, 0, 51 ),
 ( 'Language Arts 2', 'MAND', 0, '', 2, 1, 2, '', 3, 0, 2, 'NA', 1, 0, 0, 0, 52 ),
 ( 'Language Arts 3', 'MAND', 0, '', 3, 1, 3, '', 3, 0, 3, 'NA', 1, 0, 0, 0, 53 ),
 ( 'Language Arts 4', 'MAND', 0, '', 4, 1, 4, '', 3, 0, 4, 'NA', 1, 0, 0, 0, 54 ),
 ( 'Language Arts 5', 'MAND', 0, '', 5, 1, 5, '', 3, 0, 5, 'NA', 1, 0, 0, 0, 55 ),
 ( 'Language Arts 6', 'MAND', 0, '', 6, 1, 6, '', 3, 0, 6, 'NA', 1, 0, 0, 0, 56 ),
 ( 'Language Arts 7', 'MAND', 0, '', 7, 1, 7, '', 3, 0, 7, 'NA', 1, 0, 0, 0, 57 ),
 ( 'Language Arts 8', 'MAND', 0, '', 8, 1, 8, '', 3, 0, 8, 'NA', 1, 0, 0, 0, 58 ),
 ( 'Language Arts 9', 'MAND', 0, '', 9, 1, 9, '', 3, 0, 9, 'NA', 1, 0, 0, 0, 59 ),
 ( 'Language Arts 10', 'MAND', 0, '', 10, 1, 10, '', 3, 0, 10, 'NA', 1, 0, 0, 0, 60 ),
 ( 'Language Arts 11', 'MAND', 0, '', 11, 1, 11, '', 3, 0, 11, 'NA', 1, 0, 0, 0, 61 ),
 ( 'Math 1', 'MAND', 0, '', 1, 2, 1, '', 3, 0, 1, 'NA', 1, 0, 0, 0, 62 ),
 ( 'Math 2', 'MAND', 0, '', 2, 2, 2, '', 3, 0, 2, 'NA', 1, 0, 0, 0, 63 ),
 ( 'Math 3', 'MAND', 0, '', 3, 2, 3, '', 3, 0, 3, 'NA', 1, 0, 0, 0, 64 ),
 ( 'Math 4', 'MAND', 0, '', 4, 2, 4, '', 3, 0, 4, 'NA', 1, 0, 0, 0, 65 ),
 ( 'Math 5', 'MAND', 0, '', 5, 2, 5, '', 3, 0, 5, 'NA', 1, 0, 0, 0, 66 ),
 ( 'Math 6', 'MAND', 0, '', 6, 2, 6, '', 3, 0, 6, 'NA', 1, 0, 0, 0, 67 ),
 ( 'Math 7', 'MAND', 0, '', 7, 2, 7, '', 3, 0, 7, 'NA', 1, 0, 0, 0, 68 ),
 ( 'Pre-Algebra', 'MAND', 0, '', 0, 2, 8, '', 3, 0, 0, 'MID,INT', 1, 0, 0, 0, 69 ),
 ( 'Algebra', 'MAND', 0, '', 0, 2, 9, '', 3, 0, 0, 'SEC', 1, 0, 0, 0, 70 ),
 ( 'Geometry', 'MAND', 0, '', 0, 2, 10, '', 3, 0, 0, 'MID,HS,AH', 1, 0, 0, 0, 71 ),
 ( 'Algebra II', 'MAND', 0, '', 0, 2, 11, '', 3, 0, 0, 'MID,HS,AH', 1, 0, 0, 0, 72 ),
 ( 'Science 4', 'MAND', 0, '', 4, 3, 4, '', 3, 0, 4, 'NA', 1, 0, 0, 0, 73 ),
 ( 'Science 5', 'MAND', 0, '', 5, 3, 5, '', 3, 0, 5, 'NA', 1, 0, 0, 0, 74 ),
 ( 'Science 6', 'MAND', 0, '', 6, 3, 6, '', 3, 0, 6, 'NA', 1, 0, 0, 0, 75 ),
 ( 'Science 7', 'MAND', 0, '', 7, 3, 7, '', 3, 0, 7, 'NA', 1, 0, 0, 0, 76 ),
 ( 'Science 8', 'MAND', 0, '', 8, 3, 8, '', 3, 0, 8, 'NA', 1, 0, 0, 0, 77 ),
 ( 'Earth Systems 9', 'MAND', 0, '', 9, 3, 9, '', 3, 0, 9, 'MID,AH', 1, 0, 0, 0, 78 ),
 ( 'Biology', 'MAND', 0, '', 0, 3, 10, '', 3, 0, 0, 'HS,AH', 1, 0, 0, 0, 79 ),
 ( 'Chemistry', 'MAND', 0, '', 0, 3, 11, '', 3, 0, 0, 'HS', 1, 0, 0, 0, 80 ),
 ( 'Physics', 'MAND', 0, '', 0, 3, 12, '', 3, 0, 0, 'HS', 1, 0, 0, 0, 81 ),
 ( 'Fine Arts', 'MAND', 0, '', 0, 0, 0, '', 3, 0, 0, 'SEC', 1, 0, 0, 1, 82 ),
 ( 'Foreign Language', 'MAND', 0, '', 0, 0, 0, '', 3, 0, 0, 'INT,MID,HS', 1, 0, 0, 1, 83 ),
 ( 'Social Studies', 'MAND', 0, '', 0, 0, 0, '', 3, 0, 0, 'SEC', 1, 0, 0, 1, 84 ),
 ( 'Health / PE', 'MAND', 0, '', 0, 0, 0, '', 3, 0, 0, 'SEC', 1, 0, 0, 1, 85 ),
 ( 'Career and Technology', 'MAND', 0, '', 0, 0, 0, '', 3, 0, 0, 'SEC', 1, 0, 0, 1, 86 ),
 ( 'Citizenship', 'OPT', 0, '', 0, 0, 0, '(Complete if applicable)', 3, 0, 0, 'NA', 1, 1, 1, 1, 88 ),
 ( 'Other', 'OPT', 0, '', 0, 0, 0, '(Complete if applicable)', 3, 0, 0, 'NA', 1, 1, 1, 1, 89 ),
 ( 'Title One', 'OPT', 1, 'http://www.schools.utah.gov/TitleI/', 0, 0, 0, '', 3, 0, 0, 'ELEM', 0, 0, 0, 1, 90 ),
 ( 'Trust Lands', 'OPT', 1, 'http://www.schoollandtrust.org/', 0, 0, 0, '', 3, 0, 0, 'NA', 0, 0, 0, 1, 91 ),
 ( 'Safety Plan', 'OPT', 0, '', 0, 0, 0, '(Complete if applicable)', 3, 0, 0, 'NA', 1, 1, 1, 1, 92 ),
 ( 'Special Education', 'OPT', 0, '', 0, 0, 0, '', 3, 0, 0, 'NA', 1, 1, 1, 1, 0 ),
 ( 'English Language Learners (ELL)', 'OPT', 0, '', 0, 0, 0, '', 3, 0, 0, 'NA', 1, 1, 1, 1, 0 )
";
  $result = $dbh->exec( $query );
  if ( $result !== FALSE ) {
    return "Adding version 3 questions: categories";
  } else {
    $error = $dbh->errorInfo();
    return "Error adding version 3 categories: ". $error[2];
  }
}

?>
