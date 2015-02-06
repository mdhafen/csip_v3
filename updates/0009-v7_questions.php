<?php

include_once( '../lib/config.phpm' );
include_once( '../lib/data.phpm' );

$db_settings = $config['database'];
$table = $db_settings['schema'];
$return = "";

$dbh = db_connect();

$query = "SELECT COUNT(*) AS count FROM category WHERE version = 7";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {
  $query = "INSERT INTO category (
 category_name, category_class, category_type, type_target,
 category_group, course_group, course_group_order, category_note, version,
 question_group, gradelevel, loc_cat_subcat,
 needs_principal_approve, needs_community_approve, needs_district_approve,
 custom_goal_focus, parent_category )
VALUES
 ( 'Kindergarten Math', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'ELEM', 1, 0, 0, 0, 250),
 ( 'Kindergarten Literacy', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'ELEM', 1, 0, 0, 0, 251),
 ( 'Language Arts 1', 'OTHR', 0, '', 1, 1, 1, '', 7, 0, 1, 'NA', 1, 0, 0, 0, 252),
 ( 'Language Arts 2', 'OTHR', 0, '', 2, 1, 2, '', 7, 0, 2, 'NA', 1, 0, 0, 0, 253),
 ( 'Language Arts 3', 'OTHR', 0, '', 3, 1, 3, '', 7, 0, 3, 'NA', 1, 0, 0, 0, 254),
 ( 'Language Arts 4', 'OTHR', 0, '', 4, 1, 4, '', 7, 0, 4, 'NA', 1, 0, 0, 0, 255),
 ( 'Language Arts 5', 'OTHR', 0, '', 5, 1, 5, '', 7, 0, 5, 'NA', 1, 0, 0, 0, 256),
 ( 'Language Arts 6', 'OTHR', 0, '', 6, 1, 6, '', 7, 0, 6, 'NA', 1, 0, 0, 0, 257),
 ( 'Language Arts 7', 'OTHR', 0, '', 7, 1, 7, '', 7, 0, 7, 'NA', 1, 0, 0, 0, 258),
 ( 'Language Arts 8', 'OTHR', 0, '', 8, 1, 8, '', 7, 0, 8, 'NA', 1, 0, 0, 0, 259),
 ( 'Language Arts 9', 'OTHR', 0, '', 9, 1, 9, '', 7, 0, 9, 'NA', 1, 0, 0, 0, 260),
 ( 'Language Arts 10', 'OTHR', 0, '', 10, 1, 10, '', 7, 0, 10, 'NA', 1, 0, 0, 0, 261),
 ( 'Language Arts 11', 'OTHR', 0, '', 11, 1, 11, '', 7, 0, 11, 'NA', 1, 0, 0, 0, 262),
 ( 'Language Arts 12', 'OTHR', 0, '', 12, 1, 12, '', 7, 0, 12, 'NA', 1, 0, 0, 0, 263),
 ( 'Math 1', 'OTHR', 0, '', 1, 2, 1, '', 7, 0, 1, 'NA', 1, 0, 0, 0, 264),
 ( 'Math 2', 'OTHR', 0, '', 2, 2, 2, '', 7, 0, 2, 'NA', 1, 0, 0, 0, 265),
 ( 'Math 3', 'OTHR', 0, '', 3, 2, 3, '', 7, 0, 3, 'NA', 1, 0, 0, 0, 266),
 ( 'Math 4', 'OTHR', 0, '', 4, 2, 4, '', 7, 0, 4, 'NA', 1, 0, 0, 0, 267),
 ( 'Math 5', 'OTHR', 0, '', 5, 2, 5, '', 7, 0, 5, 'NA', 1, 0, 0, 0, 268),
 ( 'Mathematics 6', 'OTHR', 0, '', 6, 2, 6, '', 7, 0, 6, 'NA', 1, 0, 0, 0, 269),
 ( 'Mathematics 7', 'OTHR', 0, '', 7, 2, 7, '', 7, 0, 7, 'NA', 1, 0, 0, 0, 270),
 ( 'Mathematics 8', 'OTHR', 0, '', 8, 2, 8, '', 7, 0, 8, 'MID', 1, 0, 0, 0, 271),
 ( 'Secondary Mathematics I', 'OTHR', 0, '', 9, 2, 9, '', 7, 0, 9, 'MID', 1, 0, 0, 0, 272),
 ( 'Secondary Mathematics II', 'OTHR', 0, '', 10, 2, 10, '', 7, 0, 10, 'HS,AH', 1, 0, 0, 0, 273),
 ( 'Secondary Mathematics III', 'OTHR', 0, '', 11, 2, 11, '', 7, 0, 11, 'HS,AH', 1, 0, 0, 0, 274),
 ( 'Advanced Math', 'OTHR', 0, '', 12, 2, 12, '', 7, 0, 12, 'HS,AH', 1, 0, 0, 0, 275),
 ( 'Science 6', 'OTHR', 0, '', 6, 3, 6, '', 7, 0, 6, 'NA', 1, 0, 0, 0, 276),
 ( 'Science 7', 'OTHR', 0, '', 7, 3, 7, '', 7, 0, 7, 'NA', 1, 0, 0, 0, 277),
 ( 'Science 8', 'OTHR', 0, '', 8, 3, 8, '', 7, 0, 8, 'NA', 1, 0, 0, 0, 278),
 ( 'Earth Systems 9', 'OTHR', 0, '', 9, 3, 9, '', 7, 0, 9, 'MID,AH', 1, 0, 0, 0, 279),
 ( 'Biology', 'OTHR', 0, '', 10, 3, 10, '', 7, 0, 10, 'HS,AH', 1, 0, 0, 0, 280),
 ( 'Chemistry', 'OTHR', 0, '', 11, 3, 11, '', 7, 0, 11, 'HS', 1, 0, 0, 0, 281),
 ( 'Physics', 'OTHR', 0, '', 12, 3, 12, '', 7, 0, 12, 'HS', 1, 0, 0, 0, 282),
 ( 'Fine Arts', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'SEC', 1, 0, 0, 0, 283),
 ( 'Foreign Language', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'SEC', 1, 0, 0, 0, 284),
 ( 'World Language 1', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 0, 306),
 ( 'World Language 2', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 0, 307),
 ( 'World Language 3', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 0, 308),
 ( 'AP World Language', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'HS,AH', 1, 0, 0, 0, 309),
 ( 'American Sign Language', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'HS,AH', 1, 0, 0, 0, 342),
 ( 'Social Studies 6', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 6, 'INT', 1, 0, 0, 0, 304),
 ( 'Social Studies 7', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 7, 'INT', 1, 0, 0, 0, 305),
 ( 'Social Studies', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 0, 285),
 ( 'World Civilization', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'HS,AH', 1, 0, 0, 0, 310),
 ( 'US History', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 0, 311),
 ( 'US Government', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'HS,AH', 1, 0, 0, 0, 313),
 ( 'Psychology', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'HS,AH', 1, 0, 0, 0, 312),
 ( 'Health', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'SEC', 1, 0, 0, 0, 286),
 ( 'PE', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'SEC', 1, 0, 0, 0, 303),
 ( 'Other', 'OTHR', 0, '', 0, 0, 0, '(Complete if applicable)', 7, 0, 0, 'NA', 1, 1, 1, 0, 287),
 ( 'Visual Arts', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'SEC', 1, 0, 0, 0, 288),
 ( 'Choir', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'SEC', 1, 0, 0, 0, 289),
 ( 'Band', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'SEC', 1, 0, 0, 0, 290),
 ( 'Theater', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'SEC', 1, 0, 0, 0, 291),
 ( 'Orchestra', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'SEC', 1, 0, 0, 0, 292),
 ( 'CTE-Intro', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'INT', 1, 0, 0, 1, 293),
 ( 'CTE-FACS', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 1, 294),
 ( 'CTE-Business', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 1, 295),
 ( 'CTE-Technology', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 1, 296),
 ( 'CTE-Agriculture', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 1, 297),
 ( 'CTE-Marketing', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 1, 298),
 ( 'CTE-Health Sciences', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 1, 299),
 ( 'CTE-POT', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 1, 300),
 ( 'CTE-IT', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 1, 301),
 ( 'CTE-Skilled and Technical', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 1, 302),
 ( 'CTE-Teen Living', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID', 1, 0, 0, 1, 314),
 ( 'CTE-Foods and Nutrition', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 1, 315),
 ( 'CTE-Clothing/Sewing', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 1, 316),
 ( 'CTE-Graphics', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'HS,AH', 1, 0, 0, 1, 317),
 ( 'CTE-Automotive', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'HS,AH', 1, 0, 0, 1, 318),
 ( 'CTE-Cabinet Making', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'HS,AH', 1, 0, 0, 1, 319),
 ( 'CTE-Welding', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'HS,AH', 1, 0, 0, 1, 320),
 ( 'CTE-Digital Literacy', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID', 1, 0, 0, 1, 322),
 ( 'CTE-Technology and Engineering', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'INT', 1, 0, 0, 1, 324),
 ( 'CTE-Digital Photography', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'HS,AH', 1, 0, 0, 1, 325),
 ( 'Photography', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'HS,AH', 1, 0, 0, 1, 326),
 ( 'Keyboarding', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'INT', 1, 0, 0, 1, 327),
 ( 'Ceramics', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'HS,AH', 1, 0, 0, 1, 335),
 ( 'Dance', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'HS,AH', 1, 0, 0, 1, 323),
 ( 'Guitar', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'MID,HS,AH', 1, 0, 0, 1, 328),
 ( 'Financial Literacy', 'OTHR', 0, '', 0, 0, 0, '', 7, 0, 0, 'HS,AH', 1, 0, 0, 1, 321),
 ( 'Dual Immersion K', 'OTHR', 0, '', 0, 4, 0, '', 7, 0, 0, 'ELEM', 1, 0, 0, 1, 329),
 ( 'Dual Immersion 1', 'OTHR', 0, '', 1, 4, 1, '', 7, 0, 1, 'ELEM', 1, 0, 0, 1, 330),
 ( 'Dual Immersion 2', 'OTHR', 0, '', 2, 4, 2, '', 7, 0, 2, 'ELEM', 1, 0, 0, 1, 331),
 ( 'Dual Immersion 3', 'OTHR', 0, '', 3, 4, 3, '', 7, 0, 3, 'ELEM', 1, 0, 0, 1, 332),
 ( 'Dual Immersion 4', 'OTHR', 0, '', 4, 4, 4, '', 7, 0, 4, 'ELEM', 1, 0, 0, 1, 333),
 ( 'Dual Immersion 5', 'OTHR', 0, '', 5, 4, 5, '', 7, 0, 5, 'ELEM', 1, 0, 0, 1, 334)
";

  $result = $dbh->exec( $query );
  if ( $result !== FALSE ) {
    if ( $return ) {
      $return .= ", ";
    }
    $return .= "Categories";
  } else {
    $error = $dbh->errorInfo();
    return "Error adding version 7 categories: ". $error[2];
  }
}

$query = "SELECT COUNT(*) AS count FROM question WHERE version = 7";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {
  $query = "INSERT INTO question (
  version, question_group, part, order_num, type, question_option_group, question )
 VALUES
  ( 7, 34, 1, 1, 9, 0, '<b>What is the GVC?</b><br>
<p>HIGHLY EFFECTIVE TEAMS teach ALL of the standards within their discipline but engage in the work of IDENTIFYING which of the standards/skills are so critical that EVERY student MUST know. TEAMS then work to ENSURE that every student will demonstrate proficiency in them. The guaranteed and viable curriculum (GVC) are those skills deemed by the team to be the absolute critical skills that ALL students must demonstrate proficiency in order to be successful in the grade level or course.</p>'),
  ( 7, 34, 1, 2, 1, 0, '<b>Our Team''s GVC</b><br>
<p>With your team, identify/list the critical standards/skills that all students need to know.</p>
<p>Once your team has identified the skills, share with the team above and below your specific grade level.</p>
<p>Share the guaranteed skills with your students that you have identified below</p>
[input]'),
  ( 7, 34, 1, 3, 4, 0, '<b>Reflection Date</b><br>
[input]'),
  ( 7, 34, 1, 4, 1, 0, '<b>Reflection Summary</b><br>
<p>Has your team''s GVC changed?  If so, which elements did your team adjust in preparation for next year?</p>
[input]'),
  ( 7, 34, 2, 1, 9, 0, '<h1>Common Formative Assessment</h1>'),
  ( 7, 34, 2, 2, 9, 0, '<b>How will WE know if they LEARNED it?</b><br>
EFFECTIVE TEAMS utilize COMMON FORMATIVE ASSESSMENTS (CFA) to diagnostically assess a student''s learning and determine which students were proficient in the guaranteed skill and those who weren''t.<br>
TEAM ACTION STEPS: Identify a common formative assessment that your team will use to assess the GVC skill.'),
  ( 7, 34, 2, 3, 1, 0, '<p>List the common formative assessment AND the guaranteed standard it aligns with (Example: Unit 1 - Fractions). FOR ELEMENTARY: Identify which questions on your existing instructional program assessments align with your GVC.
[input]</p>'),
  ( 7, 34, 2, 4, 3, 0, '<p>How many students were assessed by our team?
[input]</p>'),
  ( 7, 34, 2, 5, 3, 0, '<p>How many were not proficient the first time?
[input]</p>'),
  ( 7, 34, 2, 6, 1, 0, '<p>According to the results of this CFA and our team''s collaboration, the following teaching practices/strategies were most effective in teaching this guaranteed skill(s):
[input]</p>'),
  ( 7, 34, 2, 7, 9, 0, '<h1>Intervention</h1>'),
  ( 7, 34, 2, 8, 9, 0, '<b>How will WE RESPOND to those who didn''t get it?</b><br>
EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn''t get a concept, it''s not an intervention problem; the initial instruction needs to be examined.)'),
  ( 7, 34, 2, 9, 1, 0, '<p>List the SPECIFIC INTERVENTIONS that your team responded with for those students who WERE NOT proficient.
[input]</p>'),
  ( 7, 34, 2, 10, 3, 0, '<p>Following your team''s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?
[input]</p>'),
  ( 7, 34, 2, 11, 1, 0, '<p>List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team''s intervention.</p>
<p>(To indicate growth, include how much the student grew from the first to second assessment).</p>
[input]'),
  ( 7, 34, 2, 12, 1, 0, '<p>How did your TEAM respond to those who were still not proficient even after your team''s interventions?
[input]</p>'),
  ( 7, 34, 2, 13, 9, 0, '<h1>Learning Extension</h1>'),
  ( 7, 34, 2, 14, 9, 0, '<p>EFFECTIVE TEAMS provide extension activities for those students who already know a standard or skill.</p>'),
  ( 7, 34, 2, 15, 1, 0, '<p>As you review your GVC (from step #1), identify extension activities your team will use for those who already know it.
[input]</p>'),
  ( 7, 34, 2, 16, 3, 0, 'End of Year Reflection Date<br>
[input]'),
  ( 7, 34, 2, 17, 1, 0, '<b>End of Year Reflection</b><br>
<p>Do our extension activities provide deeper learning for those students who already know it?  What adjustments can we make to provide for better extended learning opportunities?</p>
[input]'),
  ( 7, 34, 3, 1, 9, 0, '<h1>Common Formative Assessment</h1>'),
  ( 7, 34, 3, 2, 9, 0, '<b>How will WE know if they LEARNED it?</b><br>
EFFECTIVE TEAMS utilize COMMON FORMATIVE ASSESSMENTS (CFA) to diagnostically assess a student''s learning and determine which students were proficient in the guaranteed skill and those who weren''t.<br>
TEAM ACTION STEPS: Identify a common formative assessment that your team will use to assess the GVC skill.'),
  ( 7, 34, 3, 3, 1, 0, '<p>List the common formative assessment AND the guaranteed standard it aligns with (Example: Unit 1 - Fractions). FOR ELEMENTARY: Identify which questions on your existing instructional program assessments align with your GVC.
[input]</p>'),
  ( 7, 34, 3, 4, 3, 0, '<p>How many students were assessed by our team?
[input]</p>'),
  ( 7, 34, 3, 5, 3, 0, '<p>How many were not proficient the first time?
[input]</p>'),
  ( 7, 34, 3, 6, 1, 0, '<p>According to the results of this CFA and our team''s collaboration, the following teaching practices/strategies were most effective in teaching this guaranteed skill(s):
[input]</p>'),
  ( 7, 34, 3, 7, 9, 0, '<h1>Intervention</h1>'),
  ( 7, 34, 3, 8, 9, 0, '<b>How will WE RESPOND to those who didn''t get it?</b><br>
EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn''t get a concept, it''s not an intervention problem; the initial instruction needs to be examined.)'),
  ( 7, 34, 3, 9, 1, 0, '<p>List the SPECIFIC INTERVENTIONS that your team responded with for those students who WERE NOT proficient.
[input]</p>'),
  ( 7, 34, 3, 10, 3, 0, '<p>Following your team''s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?
[input]</p>'),
  ( 7, 34, 3, 11, 1, 0, '<p>List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team''s intervention.</p>
<p>(To indicate growth, include how much the student grew from the first to second assessment).</p>
[input]'),
  ( 7, 34, 3, 12, 1, 0, '<p>How did your TEAM respond to those who were still not proficient even after your team''s interventions?
[input]</p>'),
  ( 7, 34, 3, 13, 9, 0, '<h1>Learning Extension</h1>'),
  ( 7, 34, 3, 14, 9, 0, '<p>EFFECTIVE TEAMS provide extension activities for those students who already know a standard or skill.</p>'),
  ( 7, 34, 3, 15, 1, 0, '<p>As you review your GVC (from step #1), identify extension activities your team will use for those who already know it.
[input]</p>'),
  ( 7, 34, 3, 16, 3, 0, 'End of Year Reflection Date<br>
[input]'),
  ( 7, 34, 3, 17, 1, 0, '<b>End of Year Reflection</b><br>
<p>Do our extension activities provide deeper learning for those students who already know it?  What adjustments can we make to provide for better extended learning opportunities?</p>
[input]'),
  ( 7, 34, 4, 1, 9, 0, '<h1>Common Formative Assessment</h1>'),
  ( 7, 34, 4, 2, 9, 0, '<b>How will WE know if they LEARNED it?</b><br>
EFFECTIVE TEAMS utilize COMMON FORMATIVE ASSESSMENTS (CFA) to diagnostically assess a student''s learning and determine which students were proficient in the guaranteed skill and those who weren''t.<br>
TEAM ACTION STEPS: Identify a common formative assessment that your team will use to assess the GVC skill.'),
  ( 7, 34, 4, 3, 1, 0, '<p>List the common formative assessment AND the guaranteed standard it aligns with (Example: Unit 1 - Fractions). FOR ELEMENTARY: Identify which questions on your existing instructional program assessments align with your GVC.
[input]</p>'),
  ( 7, 34, 4, 4, 3, 0, '<p>How many students were assessed by our team?
[input]</p>'),
  ( 7, 34, 4, 5, 3, 0, '<p>How many were not proficient the first time?
[input]</p>'),
  ( 7, 34, 4, 6, 1, 0, '<p>According to the results of this CFA and our team''s collaboration, the following teaching practices/strategies were most effective in teaching this guaranteed skill(s):
[input]</p>'),
  ( 7, 34, 4, 7, 9, 0, '<h1>Intervention</h1>'),
  ( 7, 34, 4, 8, 9, 0, '<b>How will WE RESPOND to those who didn''t get it?</b><br>
EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn''t get a concept, it''s not an intervention problem; the initial instruction needs to be examined.)'),
  ( 7, 34, 4, 9, 1, 0, '<p>List the SPECIFIC INTERVENTIONS that your team responded with for those students who WERE NOT proficient.
[input]</p>'),
  ( 7, 34, 4, 10, 3, 0, '<p>Following your team''s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?
[input]</p>'),
  ( 7, 34, 4, 11, 1, 0, '<p>List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team''s intervention.</p>
<p>(To indicate growth, include how much the student grew from the first to second assessment).</p>
[input]'),
  ( 7, 34, 4, 12, 1, 0, '<p>How did your TEAM respond to those who were still not proficient even after your team''s interventions?
[input]</p>'),
  ( 7, 34, 4, 13, 9, 0, '<h1>Learning Extension</h1>'),
  ( 7, 34, 4, 14, 9, 0, '<p>EFFECTIVE TEAMS provide extension activities for those students who already know a standard or skill.</p>'),
  ( 7, 34, 4, 15, 1, 0, '<p>As you review your GVC (from step #1), identify extension activities your team will use for those who already know it.
[input]</p>'),
  ( 7, 34, 4, 16, 3, 0, 'End of Year Reflection Date<br>
[input]'),
  ( 7, 34, 4, 17, 1, 0, '<b>End of Year Reflection</b><br>
<p>Do our extension activities provide deeper learning for those students who already know it?  What adjustments can we make to provide for better extended learning opportunities?</p>
[input]'),
  ( 7, 34, 5, 1, 9, 0, '<h1>Common Formative Assessment</h1>'),
  ( 7, 34, 5, 2, 9, 0, '<b>How will WE know if they LEARNED it?</b><br>
EFFECTIVE TEAMS utilize COMMON FORMATIVE ASSESSMENTS (CFA) to diagnostically assess a student''s learning and determine which students were proficient in the guaranteed skill and those who weren''t.<br>
TEAM ACTION STEPS: Identify a common formative assessment that your team will use to assess the GVC skill.'),
  ( 7, 34, 5, 3, 1, 0, '<p>List the common formative assessment AND the guaranteed standard it aligns with (Example: Unit 1 - Fractions). FOR ELEMENTARY: Identify which questions on your existing instructional program assessments align with your GVC.
[input]</p>'),
  ( 7, 34, 5, 4, 3, 0, '<p>How many students were assessed by our team?
[input]</p>'),
  ( 7, 34, 5, 5, 3, 0, '<p>How many were not proficient the first time?
[input]</p>'),
  ( 7, 34, 5, 6, 1, 0, '<p>According to the results of this CFA and our team''s collaboration, the following teaching practices/strategies were most effective in teaching this guaranteed skill(s):
[input]</p>'),
  ( 7, 34, 5, 7, 9, 0, '<h1>Intervention</h1>'),
  ( 7, 34, 5, 8, 9, 0, '<b>How will WE RESPOND to those who didn''t get it?</b><br>
EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn''t get a concept, it''s not an intervention problem; the initial instruction needs to be examined.)'),
  ( 7, 34, 5, 9, 1, 0, '<p>List the SPECIFIC INTERVENTIONS that your team responded with for those students who WERE NOT proficient.
[input]</p>'),
  ( 7, 34, 5, 10, 3, 0, '<p>Following your team''s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?
[input]</p>'),
  ( 7, 34, 5, 11, 1, 0, '<p>List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team''s intervention.</p>
<p>(To indicate growth, include how much the student grew from the first to second assessment).</p>
[input]'),
  ( 7, 34, 5, 12, 1, 0, '<p>How did your TEAM respond to those who were still not proficient even after your team''s interventions?
[input]</p>'),
  ( 7, 34, 5, 13, 9, 0, '<h1>Learning Extension</h1>'),
  ( 7, 34, 5, 14, 9, 0, '<p>EFFECTIVE TEAMS provide extension activities for those students who already know a standard or skill.</p>'),
  ( 7, 34, 5, 15, 1, 0, '<p>As you review your GVC (from step #1), identify extension activities your team will use for those who already know it.
[input]</p>'),
  ( 7, 34, 5, 16, 3, 0, 'End of Year Reflection Date<br>
[input]'),
  ( 7, 34, 5, 17, 1, 0, '<b>End of Year Reflection</b><br>
<p>Do our extension activities provide deeper learning for those students who already know it?  What adjustments can we make to provide for better extended learning opportunities?</p>
[input]'),
  ( 7, 34, 6, 1, 9, 0, '<h1>Common Formative Assessment</h1>'),
  ( 7, 34, 6, 2, 9, 0, '<b>How will WE know if they LEARNED it?</b><br>
EFFECTIVE TEAMS utilize COMMON FORMATIVE ASSESSMENTS (CFA) to diagnostically assess a student''s learning and determine which students were proficient in the guaranteed skill and those who weren''t.<br>
TEAM ACTION STEPS: Identify a common formative assessment that your team will use to assess the GVC skill.'),
  ( 7, 34, 6, 3, 1, 0, '<p>List the common formative assessment AND the guaranteed standard it aligns with (Example: Unit 1 - Fractions). FOR ELEMENTARY: Identify which questions on your existing instructional program assessments align with your GVC.
[input]</p>'),
  ( 7, 34, 6, 4, 3, 0, '<p>How many students were assessed by our team?
[input]</p>'),
  ( 7, 34, 6, 5, 3, 0, '<p>How many were not proficient the first time?
[input]</p>'),
  ( 7, 34, 6, 6, 1, 0, '<p>According to the results of this CFA and our team''s collaboration, the following teaching practices/strategies were most effective in teaching this guaranteed skill(s):
[input]</p>'),
  ( 7, 34, 6, 7, 9, 0, '<h1>Intervention</h1>'),
  ( 7, 34, 6, 8, 9, 0, '<b>How will WE RESPOND to those who didn''t get it?</b><br>
EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn''t get a concept, it''s not an intervention problem; the initial instruction needs to be examined.)'),
  ( 7, 34, 6, 9, 1, 0, '<p>List the SPECIFIC INTERVENTIONS that your team responded with for those students who WERE NOT proficient.
[input]</p>'),
  ( 7, 34, 6, 10, 3, 0, '<p>Following your team''s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?
[input]</p>'),
  ( 7, 34, 6, 11, 1, 0, '<p>List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team''s intervention.</p>
<p>(To indicate growth, include how much the student grew from the first to second assessment).</p>
[input]'),
  ( 7, 34, 6, 12, 1, 0, '<p>How did your TEAM respond to those who were still not proficient even after your team''s interventions?
[input]</p>'),
  ( 7, 34, 6, 13, 9, 0, '<h1>Learning Extension</h1>'),
  ( 7, 34, 6, 14, 9, 0, '<p>EFFECTIVE TEAMS provide extension activities for those students who already know a standard or skill.</p>'),
  ( 7, 34, 6, 15, 1, 0, '<p>As you review your GVC (from step #1), identify extension activities your team will use for those who already know it.
[input]</p>'),
  ( 7, 34, 6, 16, 3, 0, 'End of Year Reflection Date<br>
[input]'),
  ( 7, 34, 6, 17, 1, 0, '<b>End of Year Reflection</b><br>
<p>Do our extension activities provide deeper learning for those students who already know it?  What adjustments can we make to provide for better extended learning opportunities?</p>
[input]'),
  ( 7, 34, 7, 1, 9, 0, '<h1>Common Formative Assessment</h1>'),
  ( 7, 34, 7, 2, 9, 0, '<b>How will WE know if they LEARNED it?</b><br>
EFFECTIVE TEAMS utilize COMMON FORMATIVE ASSESSMENTS (CFA) to diagnostically assess a student''s learning and determine which students were proficient in the guaranteed skill and those who weren''t.<br>
TEAM ACTION STEPS: Identify a common formative assessment that your team will use to assess the GVC skill.'),
  ( 7, 34, 7, 3, 1, 0, '<p>List the common formative assessment AND the guaranteed standard it aligns with (Example: Unit 1 - Fractions). FOR ELEMENTARY: Identify which questions on your existing instructional program assessments align with your GVC.
[input]</p>'),
  ( 7, 34, 7, 4, 3, 0, '<p>How many students were assessed by our team?
[input]</p>'),
  ( 7, 34, 7, 5, 3, 0, '<p>How many were not proficient the first time?
[input]</p>'),
  ( 7, 34, 7, 6, 1, 0, '<p>According to the results of this CFA and our team''s collaboration, the following teaching practices/strategies were most effective in teaching this guaranteed skill(s):
[input]</p>'),
  ( 7, 34, 7, 7, 9, 0, '<h1>Intervention</h1>'),
  ( 7, 34, 7, 8, 9, 0, '<b>How will WE RESPOND to those who didn''t get it?</b><br>
EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn''t get a concept, it''s not an intervention problem; the initial instruction needs to be examined.)'),
  ( 7, 34, 7, 9, 1, 0, '<p>List the SPECIFIC INTERVENTIONS that your team responded with for those students who WERE NOT proficient.
[input]</p>'),
  ( 7, 34, 7, 10, 3, 0, '<p>Following your team''s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?
[input]</p>'),
  ( 7, 34, 7, 11, 1, 0, '<p>List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team''s intervention.</p>
<p>(To indicate growth, include how much the student grew from the first to second assessment).</p>
[input]'),
  ( 7, 34, 7, 12, 1, 0, '<p>How did your TEAM respond to those who were still not proficient even after your team''s interventions?
[input]</p>'),
  ( 7, 34, 7, 13, 9, 0, '<h1>Learning Extension</h1>'),
  ( 7, 34, 7, 14, 9, 0, '<p>EFFECTIVE TEAMS provide extension activities for those students who already know a standard or skill.</p>'),
  ( 7, 34, 7, 15, 1, 0, '<p>As you review your GVC (from step #1), identify extension activities your team will use for those who already know it.
[input]</p>'),
  ( 7, 34, 7, 16, 3, 0, 'End of Year Reflection Date<br>
[input]'),
  ( 7, 34, 7, 17, 1, 0, '<b>End of Year Reflection</b><br>
<p>Do our extension activities provide deeper learning for those students who already know it?  What adjustments can we make to provide for better extended learning opportunities?</p>
[input]'),
  ( 7, 34, 8, 1, 9, 0, '<b>Essential Elements of Accreditation</b><br>
We will put something more when we know what we want this part to say.'),
  ( 7, 34, 8, 2, 1, 0, '<p>Demographics
[input]</p>'),
  ( 7, 34, 8, 2, 1, 0, '<p>Learning Data
[input]</p>'),
  ( 7, 34, 8, 2, 1, 0, '<p>Survey Results
[input]</p>'),
  ( 7, 34, 8, 2, 1, 0, '<p>IEQ-Index of Education Equality
[input]</p>'),
  ( 7, 34, 8, 2, 1, 0, '<p>Learning Environment
[input]</p>'),
  ( 7, 34, 8, 2, 1, 0, '<p>Other Information
[input]</p>')
";

  $result = $dbh->exec( $query );
  if ( $result !== FALSE ) {
    if ( $return ) {
      $return .= ", ";
    }
    $return .= "Questions";
  } else {
    $error = $dbh->errorInfo();
    return "Error adding version 7 questions: ". $error[2];
  }
}

$query = "SELECT COUNT(*) AS count FROM category WHERE version = 7 AND question_group <> 0";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {
  $query = "UPDATE category
   SET question_group = 34
 WHERE version = 7
   AND question_group = 0";

  $result = $dbh->exec( $query );
  if ( $result !== FALSE ) {
    if ( $return ) {
      $return .= ", ";
    }
    $return .= "question to category links";
  } else {
    $error = $dbh->errorInfo();
    return "Error adding version 7 questions to categories: ". $error[2];
  }
}

if ( $return ) {
  return "Adding version 7 ". $return;
}
?>
