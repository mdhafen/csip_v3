<?php

include_once( '../lib/config.phpm' );
include_once( '../lib/data.phpm' );

$db_settings = $config['database'];
$table = $db_settings['schema'];
$return = "";

$dbh = db_connect();

$query = "SELECT COUNT(*) AS count FROM location WHERE locationid = 118";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {
  $query = "INSERT INTO location (
  locationid, name, mingrade, maxgrade, loc_category, loc_subcategory )
VALUES
  ( 118, 'Water Canyon, 1, 12, 'ELEM', 'HS' )";

  $result = $dbh->exec( $query );
  if ( $result !== FALSE ) {
    $return .= "Water Canyon School";
  } else {
    $error = $dbh->errorInfo();
    return "Error adding Water Canyon School: ". $error[2];
  }
}

$query = "SELECT COUNT(*) AS count FROM category WHERE version = 6";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {
  $query = "INSERT INTO category(
 category_name, category_class, category_type, type_target,
 category_group, course_group, course_group_order, category_note, version,
 question_group, gradelevel, loc_cat_subcat,
 needs_principal_approve, needs_community_approve, needs_district_approve,
 custom_goal_focus, parent_category )
VALUES
 ( 'Kindergarten Math', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'ELEM', 1, 0, 0, 0, 199),
 ( 'Kindergarten Literacy', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'ELEM', 1, 0, 0, 0, 200),
 ( 'Language Arts 1', 'OTHR', 0, '', 1, 1, 1, '', 6, 0, 1, 'NA', 1, 0, 0, 0, 201),
 ( 'Language Arts 2', 'OTHR', 0, '', 2, 1, 2, '', 6, 0, 2, 'NA', 1, 0, 0, 0, 202),
 ( 'Language Arts 3', 'OTHR', 0, '', 3, 1, 3, '', 6, 0, 3, 'NA', 1, 0, 0, 0, 203),
 ( 'Language Arts 4', 'OTHR', 0, '', 4, 1, 4, '', 6, 0, 4, 'NA', 1, 0, 0, 0, 204),
 ( 'Language Arts 5', 'OTHR', 0, '', 5, 1, 5, '', 6, 0, 5, 'NA', 1, 0, 0, 0, 205),
 ( 'Language Arts 6', 'OTHR', 0, '', 6, 1, 6, '', 6, 0, 6, 'NA', 1, 0, 0, 0, 206),
 ( 'Language Arts 7', 'OTHR', 0, '', 7, 1, 7, '', 6, 0, 7, 'NA', 1, 0, 0, 0, 207),
 ( 'Language Arts 8', 'OTHR', 0, '', 8, 1, 8, '', 6, 0, 8, 'NA', 1, 0, 0, 0, 208),
 ( 'Language Arts 9', 'OTHR', 0, '', 9, 1, 9, '', 6, 0, 9, 'NA', 1, 0, 0, 0, 209),
 ( 'Language Arts 10', 'OTHR', 0, '', 10, 1, 10, '', 6, 0, 10, 'NA', 1, 0, 0, 0, 210),
 ( 'Language Arts 11', 'OTHR', 0, '', 11, 1, 11, '', 6, 0, 11, 'NA', 1, 0, 0, 0, 211),
 ( 'Language Arts 12', 'OTHR', 0, '', 12, 1, 12, '', 6, 0, 12, 'NA', 1, 0, 0, 0, 211),
 ( 'Math 1', 'OTHR', 0, '', 1, 2, 1, '', 6, 0, 1, 'NA', 1, 0, 0, 0, 212),
 ( 'Math 2', 'OTHR', 0, '', 2, 2, 2, '', 6, 0, 2, 'NA', 1, 0, 0, 0, 213),
 ( 'Math 3', 'OTHR', 0, '', 3, 2, 3, '', 6, 0, 3, 'NA', 1, 0, 0, 0, 214),
 ( 'Math 4', 'OTHR', 0, '', 4, 2, 4, '', 6, 0, 4, 'NA', 1, 0, 0, 0, 215),
 ( 'Math 5', 'OTHR', 0, '', 5, 2, 5, '', 6, 0, 5, 'NA', 1, 0, 0, 0, 216),
 ( 'Mathematics 6', 'OTHR', 0, '', 6, 2, 6, '', 6, 0, 6, 'NA', 1, 0, 0, 0, 217),
 ( 'Mathematics 7', 'OTHR', 0, '', 7, 2, 7, '', 6, 0, 7, 'NA', 1, 0, 0, 0, 218),
 ( 'Mathematics 8', 'OTHR', 0, '', 0, 2, 8, '', 6, 0, 0, 'MID,INT', 1, 0, 0, 0, 219),
 ( 'Secondary Mathematics I', 'OTHR', 0, '', 0, 2, 9, '', 6, 0, 0, 'SEC', 1, 0, 0, 0, 220),
 ( 'Secondary Mathematics II', 'OTHR', 0, '', 0, 2, 10, '', 6, 0, 0, 'MID,HS,AH', 1, 0, 0, 0, 221),
 ( 'Secondary Mathematics III', 'OTHR', 0, '', 0, 2, 11, '', 6, 0, 0, 'MID,HS,AH', 1, 0, 0, 0, 249),
 ( 'Advanced Math', 'OTHR', 0, '', 0, 2, 12, '', 6, 0, 0, 'HS,AH', 1, 0, 0, 0, 249),
 ( 'Science 6', 'OTHR', 0, '', 6, 3, 6, '', 6, 0, 6, 'NA', 1, 0, 0, 0, 227),
 ( 'Science 7', 'OTHR', 0, '', 7, 3, 7, '', 6, 0, 7, 'NA', 1, 0, 0, 0, 228),
 ( 'Science 8', 'OTHR', 0, '', 8, 3, 8, '', 6, 0, 8, 'NA', 1, 0, 0, 0, 229),
 ( 'Earth Systems 9', 'OTHR', 0, '', 9, 3, 9, '', 6, 0, 9, 'MID,AH', 1, 0, 0, 0, 230),
 ( 'Biology', 'OTHR', 0, '', 10, 3, 10, '', 6, 0, 10, 'HS,AH', 1, 0, 0, 0, 231),
 ( 'Chemistry', 'OTHR', 0, '', 11, 3, 11, '', 6, 0, 11, 'HS', 1, 0, 0, 0, 232),
 ( 'Physics', 'OTHR', 0, '', 12, 3, 12, '', 6, 0, 12, 'HS', 1, 0, 0, 0, 233),
 ( 'Fine Arts', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 0, 234),
 ( 'Foreign Language', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 0, 235),
 ( 'Social Studies', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 0, 236),
 ( 'Health / PE', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 0, 237),
 ( 'Other', 'OTHR', 0, '', 0, 0, 0, '(Complete if applicable)', 6, 0, 0, 'NA', 1, 1, 1, 0, 240),
 ( 'Visual Arts', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 0, 234),
 ( 'Choir', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 0, 234),
 ( 'Band', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 0, 234),
 ( 'Theater', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 0, 234),
 ( 'Orchestra', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 0, 234),
 ( 'CTE-FACS', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 1, 238),
 ( 'CTE-Business', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 1, 238),
 ( 'CTE-Technology', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 1, 238),
 ( 'CTE-Agriculture', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 1, 238),
 ( 'CTE-Marketing', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 1, 238),
 ( 'CTE-Health Schiences', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 1, 238),
 ( 'CTE-POT', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 1, 238),
 ( 'CTE-IT', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 1, 238),
 ( 'CTE-Skilled and Technical', 'OTHR', 0, '', 0, 0, 0, '', 6, 0, 0, 'SEC', 1, 0, 0, 1, 238)";

  $result = $dbh->exec( $query );
  if ( $result !== FALSE ) {
    $return .= "Categories";
  } else {
    $error = $dbh->errorInfo();
    return "Error adding version 6 categories: ". $error[2];
  }
}

$query = "SELECT COUNT(*) AS count FROM question WHERE version = 6";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {
  $query = "INSERT INTO question (
  version, question_group, part, order_num, type, question_option_group, question )
 VALUES
  ( 6, 32, 1, 1, 1, 0, '<b>What do we want OUR students to KNOW?</b><br>
<p>HIGHLY EFFECTIVE TEAMS teach ALL of the standards within their discipline but engage in the work of IDENTIFYING which of the standards and skills are so critical that EVERY student MUST know. TEAMS then work to GUARANTEE that every student will demonstrate proficiency in them. The guaranteed and viable curriculum (GVC) are those standards deemed by the team to be the absolute critical skills the student must demonstrate proficiency in order to be successful in the grade level or course.</p>
<b>ACTION STEPS</b>: With your team, identify and list which STANDARDS AND SKILLS are absolutely CRITICAL for the student to be successful in the grade level or course AND that your team will work to guarantee that EVERY student will know.<br>
[input]'),
  ( 6, 32, 1, 2, 4, 0, '<b>GUARANTEED AND VIABLE:</b><br>
End of Year Reflection Date<br>
[input]'),
  ( 6, 32, 1, 3, 1, 0, '<b>GUARANTEED AND VIABLE:</b><br>
End of Year Reflection<br>
[input]'),
  ( 6, 32, 2, 1, 9, 0, '<b>How will WE know if they LEARNED it?</b><br>
EFFECTIVE TEAMS utilize COMMON FORMATIVE ASSESSMENTS (CFA) to diagnostically assess a student''s learning and determine which students were proficient in the guaranteed skill and those who weren''t.<br>
TEAM ACTION STEPS: Identify at least FOUR (4) common formative assessments that your team will commit to collectively give throughout the year.  FOR ELEMENTARY SCHOOLS, if your common formative assessments are part of an existing instructional program (e.g. Treasures, My Math, etc.), determine which questions on those assessments align with your GVC.'),
  ( 6, 32, 2, 2, 8, 0, '<b>Common Formative Assessment #1</b><br>
<p>List the common formative assessment AND the guaranteed standard it aligns with (Example: Unit 1 - Fractions). FOR ELEMENTARY: Identify which questions on your existing instructional program assessments align with your GVC.
[input_1]</p>

<p><b>How many students were assessed by our team?</b>
[input_3]</p>

<p><b>How many were not proficient the first time?</b>
[input_3]</p>
'),
  ( 6, 32, 2, 3, 8, 0, '<b>Common Formative Assessment #2</b><br>
<p>List the common formative assessment AND the guaranteed standard it aligns with. FOR ELEMENTARY: Identify which questions on your existing instructional program assessments align with your GVC.
[input_1]</p>

<p><b>How many students were assessed by our team?</b>
[input_3]</p>

<p><b>How many were not proficient the first time?</b>
[input_3]</p>
'),
  ( 6, 32, 2, 4, 8, 0, '<b>Common Formative Assessment #3</b><br>
<p>List the common formative assessment AND the guaranteed standard it aligns with. FOR ELEMENTARY: Identify which questions on your existing instructional program assessments align with your GVC.
[input_1]</p>

<p><b>How many students were assessed by our team?</b>
[input_3]</p>

<p><b>How many were not proficient the first time?</b>
[input_3]</p>
'),
  ( 6, 32, 2, 5, 8, 0, '<b>Common Formative Assessment #4</b><br>
<p>List the common formative assessment AND the guaranteed standard it aligns with. FOR ELEMENTARY: Identify which questions on your existing instructional program assessments align with your GVC.
[input_1]</p>

<p><b>How many students were assessed by our team?</b>
[input_3]</p>

<p><b>How many were not proficient the first time?</b>
[input_3]</p>
'),
  ( 6, 32, 2, 6, 4, 0, '<b>ASSESSMENT:</b><br>
End of Year Reflection Date<br>
[input]'),
  ( 6, 32, 2, 7, 1, 0, '<b>ASSESSMENT:</b><br>
End of Year Reflection<br>
[input]'),
  ( 6, 32, 3, 1, 9, 0, '<b>How will WE RESPOND to those who didn''t get it?</b><br>
EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn''t get a concept, it''s not an intervention problem; the initial instruction needs to be examined.)'),
  ( 6, 32, 3, 2, 8, 0, '<b>TEAM ACTION STEPS FOR CFA #1</b><br>
<p>List the NUMBER of students not proficient on CFA #1.<br>
[input_3]</p>
<p>List the SPECIFIC INTERVENTIONS that your team responded with for those students who weren''t proficient.<br>
[input_1]</p>
<p>Following your team''s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?<br>
[input_3]</p>
<p>List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team''s intervention.<br>
[input_1]</p>
<p>How did your TEAM respond to those who were still not proficient even after your team''s interventions?<br>
[input_1]</p>'),
  ( 6, 32, 3, 3, 8, 0, '<b>TEAM ACTION STEPS FOR CFA #2</b><br>
<p>List the NUMBER of students not proficient on CFA #2.<br>
[input_3]</p>
<p>List the SPECIFIC INTERVENTIONS that your team responded with for those students who weren''t proficient.<br>
[input_1]</p>
<p>Following your team''s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?<br>
[input_3]</p>
<p>List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team''s intervention.<br>
[input_1]</p>
<p>How did your TEAM respond to those who were still not proficient even after your team''s interventions?<br>
[input_1]</p>'),
  ( 6, 32, 3, 4, 8, 0, '<b>TEAM ACTION STEPS FOR CFA #3</b><br>
<p>List the NUMBER of students not proficient on CFA #3.<br>
[input_3]</p>
<p>List the SPECIFIC INTERVENTIONS that your team responded with for those students who weren''t proficient.<br>
[input_1]</p>
<p>Following your team''s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?<br>
[input_3]</p>
<p>List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team''s intervention.<br>
[input_1]</p>
<p>How did your TEAM respond to those who were still not proficient even after your team''s interventions?<br>
[input_1]</p>'),
  ( 6, 32, 3, 5, 8, 0, '<b>TEAM ACTION STEPS FOR CFA #4</b><br>
<p>List the NUMBER of students not proficient on CFA #4.<br>
[input_3]</p>
<p>List the SPECIFIC INTERVENTIONS that your team responded with for those students who weren''t proficient.<br>
[input_1]</p>
<p>Following your team''s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?<br>
[input_3]</p>
<p>List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team''s intervention.<br>
[input_1]</p>
<p>How did your TEAM respond to those who were still not proficient even after your team''s interventions?<br>
[input_1]</p>'),
  ( 6, 32, 3, 6, 4, 0, '<b>INTERVENTION:</b><br>
End of Year Reflection Date<br>
[input]'),
  ( 6, 32, 3, 7, 1, 0, '<b>INTERVENTION:</b><br>
End of Year Reflection<br>
[input]'),
  ( 6, 32, 4, 1, 1, 0, '<b>EFFECTIVE TEAMS provide extension activities for those students who already know a standard or skill.</b><br>
ACTION STEPS: As you review you GVC from (step #1), identify extension activities your team will use for those who already know it.<br>
[input]'),
  ( 6, 32, 4, 2, 4, 0, '<b>EXTENSION:</b><br>
End of Year Reflection Date<br>
[input]'),
  ( 6, 32, 4, 3, 1, 0, '<b>EXTENSION:</b><br>
End of Year Reflection<br>
[input]')
";

  $result = $dbh->exec( $query );
  if ( $result !== FALSE ) {
    if ( $return ) {
      $return .= ", ";
    }
    $return .= "Questions";
  } else {
    $error = $dbh->errorInfo();
    return "Error adding version 6 questions: ". $error[2];
  }
}

$query = "SELECT COUNT(*) AS count FROM category WHERE version = 6 AND question_group <> 0";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {
  $query = "UPDATE category
   SET question_group = 32
 WHERE version = 6
   AND question_group = 0";

  $result = $dbh->exec( $query );
  if ( $result !== FALSE ) {
    if ( $return ) {
      $return .= ", ";
    }
    $return .= "question to category links";
  } else {
    $error = $dbh->errorInfo();
    return "Error adding version 6 questions to categories: ". $error[2];
  }
}

$query = "SELECT COUNT(*) AS count FROM information_schema.tables WHERE table_schema = '$table' AND table_name = 'location_category_links'";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {
   $query = "CREATE TABLE location_category_links (
      locationid INT(10) UNSIGNED NOT NULL DEFAULT 0,
      categoryid INT(10) UNSIGNED NOT NULL DEFAULT 0,
      PRIMARY KEY (locationid,categoryid),
      KEY (locationid)
   ) ENGINE=MyISAM DEFAULT CHARSET=utf8";

  $result = $dbh->exec( $query );
  if ( $result === FALSE ) {
    $error = $dbh->errorInfo();
    return "Error adding version 6 location_category_links table: ". $error[2];
  }

  $query = "INSERT INTO location_category_links (
  locationid, categoryid )
  SELECT 118, categoryid FROM category
    WHERE version = 6 AND gradelevel = 0 and loc_cat_subcat NOT LIKE '%ELEM%'
    and loc_cat_subcat NOT LIKE '%HS%'";

  $result = $dbh->exec( $query );
  if ( $result !== FALSE ) {
    if ( $return ) {
      $return .= ", and ";
    }
    $return .= "special links.";
  } else {
    $error = $dbh->errorInfo();
    return "Error adding version 6 questions to categories for Water Canyon: ". $error[2];
  }
}

if ( $return ) {
  return "Adding version 6 ". $return;
}
?>
