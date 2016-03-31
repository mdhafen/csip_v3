INSERT INTO `question_options` (option_group,option_value,option_label) VALUES
 (1, 'yes', 'Yes'),
 (1, 'no', 'No');

INSERT INTO `question` (questionid,version,question_group,order_num,type,question) VALUES
  ( 1, 7, 1, 1, 9, '<b>What is the GVC?</b><br/>
<p>HIGHLY EFFECTIVE TEAMS teach ALL of the standards within their discipline but engage in the work of IDENTIFYING which of the standards/skills are so critical that EVERY student MUST know. TEAMS then work to ENSURE that every student will demonstrate proficiency in them. The <a href="http://prodev.washk12.org/site_file/prodev/files/Learning_Graphics/gvc.pdf">GVC</a> are the agreed upon essentials within the course or grade level that teams will commit to collectively address, commonly assess and persistently provide targeted interventions for students in need.</p>'),
  ( 2, 7, 1, 2, 1, '<b>Our Team''s GVC</b><br/>
<p>With your team, come to consensus on the essential skills (GVC) that all students need to know. (If you are a "singleton", collaborate with other teachers who teach the same subject as you.)</p>
<p>Once your team has identified the essential skills (GVC), share these with the team above and below your specific grade level.</p>
<p>Write your essential skills in "student-friendly" language and share with your students.  If your team chooses, encourage students to monitor their own progress toward proficiency in these skills.</p>
[input]'),
  ( 3, 7, 1, 3, 1, '<b>Teaching Practices</b><br/>
<p>After identifying your GVC and individually self assessing with the Utah Effective Teaching Standards, collectively determine the teaching practices you need to strengthen as a team, based on the learning needs of the students in your classroom this year.</p>
[input]'),
  ( 4, 7, 1, 4, 4, '<b>Reflection Date</b><br/>
[input]'),
  ( 5, 7, 1, 5, 1, '<b>Reflection Summary</b><br/>
<p>Has your team''s GVC changed?  If so, which elements did your team adjust in preparation for next year?</p>
[input]'),
  ( 6, 7, 2, 1, 9, '<b>Essential Elements of Accreditation</b><br/>
For middle and high school only-Utilize the elements of this section to support the necessary accreditation expectations and highlight the work that your school is engaged in..'),
  ( 7, 7, 2, 2, 1, '<p>Demographics
[input]</p>'),
  ( 8, 7, 2, 3, 1, '<p>Learning Data
[input]</p>'),
  ( 9, 7, 2, 4, 1, '<p>Survey Results
[input]</p>'),
  ( 10, 7, 2, 5, 1, '<p>IEQ-Index of Education Equality
[input]</p>'),
  ( 11, 7, 2, 6, 1, '<p>Learning Environment
[input]</p>'),
  ( 12, 7, 2, 7, 1, '<p>Other Information
[input]</p>'),
  ( 30, 7, 3, 1, 3, '<p>Teacher Name[input]</p>'),
  ( 31, 7, 3, 2, 1, '<p>Reflect on your individual practices based on your stakeholder input [input]</p>'),
  ( 13, 7, 4, 1, 9, '<h1>Common Formative Assessment</h1>'),
  ( 14, 7, 4, 2, 9, '<b>How will WE know if they LEARNED it?</b><br/>
EFFECTIVE TEAMS utilize COMMON FORMATIVE ASSESSMENTS (CFA) to diagnostically assess a student''s learning, determine which students were proficient in the guaranteed skill, and those who need extra time and support.<br/>
TEAM ACTION STEPS: Identify a common formative assessment that your team will use to assess the GVC skill.'),
  ( 15, 7, 4, 3, 1, '<p>List the common formative assessment AND the guaranteed standard it aligns with (Example: Unit 1 - Fractions). FOR ELEMENTARY: Identify which questions on your existing instructional program assessments align with your GVC.
[input]</p>'),
  ( 16, 7, 4, 4, 3, '<p>How many students were assessed by our team?
[input]</p>'),
  ( 17, 7, 4, 5, 3, '<p>How many students were NOT proficient the first time?
[input]</p>'),
  ( 18, 7, 4, 6, 1, '<p>According to the results of this CFA and our team''s collaboration, the following teaching practices/strategies were most effective in teaching this guaranteed skill(s):
[input]</p>'),
  ( 19, 7, 4, 7, 9, '<h1>Intervention</h1>'),
  ( 20, 7, 4, 8, 9, '<b>How will WE respond to those who didn''t get it?</b><br/>
EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn''t get a concept, it might not be an intervention issue; the initial instruction should be re-examined.)'),
  ( 21, 7, 4, 9, 1, '<p>List the SPECIFIC INTERVENTIONS that your team responded with for those students who WERE NOT proficient.
[input]</p>'),
  ( 22, 7, 4, 10, 3, '<p>Following your team''s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?
[input]</p>'),
  ( 23, 7, 4, 11, 1, '<p>List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team''s intervention.</p>
<p>(Use hyperlinks in this section to link to an outside source if needed.)</p>
[input]'),
  ( 24, 7, 4, 12, 1, '<p>How did your TEAM respond to those who were still not proficient even after your team''s interventions?
[input]</p>'),
  ( 25, 7, 4, 13, 9, '<h1>Learning Extension</h1>'),
  ( 26, 7, 4, 14, 9, '<p>EFFECTIVE TEAMS provide extension activities for those students who already know a standard or skill.</p>'),
  ( 27, 7, 4, 15, 1, '<p>As you review your GVC (from step #1), identify extension activities your team will use for those who already know it.
[input]</p>'),
  ( 28, 7, 4, 16, 3, 'End of Year Reflection Date<br/>
[input]'),
  ( 29, 7, 4, 17, 1, '<b>End of Year Reflection</b><br/>
<p>Do our extension activities provide deeper learning for those students who already know it?  What adjustments can we make to provide for better extended learning opportunities?</p>
[input]');

UPDATE `question` SET protect_answer = 1 WHERE questionid IN (23);

UPDATE `question` SET group_repeatableid = 1 WHERE questionid IN (30,31);

INSERT INTO course_question_links (courseid,question_group,part,title) (SELECT courseid,1,1,'Guaranteed Curriculum' from course)
INSERT INTO course_question_links (courseid,question_group,part,title) (SELECT courseid,2,2,'Accreditation' from course)
INSERT INTO course_question_links (courseid,question_group,part,title) (SELECT courseid,3,3,'Stakeholder Input' from course)
INSERT INTO course_question_links (courseid,question_group,part,title) (SELECT courseid,4,4,'GVC 1' from course)

INSERT INTO question (questionid,version,question_group,type,order_num,question) VALUES
(32,8,1,9,1,'<b>What is the GVC?</b><br/>
HIGHLY EFFECTIVE TEAMS teach ALL of the standards within their discipline but engage in the work of IDENTIFYING which of the standards/skills are so critical that EVERY student MUST know. TEAMS then work to ENSURE that every student will demonstrate proficiency in them. The <a class="uk-display-inline" target="_blank" href="http://prodev.washk12.org/site_file/prodev/files/Learning_Graphics/gvc.pdf">GVC</a> are the agreed upon essentials within the course or grade level that teams will commit to collectively address, commonly assess and persistently provide targeted interventions for students in need.'),
(33,8,1,1,2,'<b>Team Professional Growth Plan</b><br/>
After identifying your GVC and individually self assessing with the <a class="uk-display-inline" target="_blank" href="http://www.uen.org/k12educator/uets/">Utah Effective Teaching Standards</a>, collectively determine the teaching practices you need to strengthen as a team, based on the learning needs of the students in your classroom this year.'),
(34,8,1,4,3,'<b>Reflection Date</b><br/>enter the date when your team will complete the Reflection process'),
(35,8,1,1,4,'<b>Reflection Summary</b><br/>
Has your team''s GVC changed?  If so, which elements did your team adjust in preparation for next year?'),
(36,8,2,9,1,'<b>Essential Elements of Accreditation</b><br/>
For middle and high school only-Utilize the elements of this section to support the necessary accreditation expectations and highlight the work that your school is engaged in..'),
(37,8,2,1,2,'Demographics'),
(38,8,2,1,3,'Learning Data'),
(39,8,2,1,4,'Survey Results'),
(40,8,2,1,5,'IEQ-Index of Education Equality'),
(41,8,2,1,6,'Learning Environment'),
(42,8,6,1,7,'Other Information'),
(43,8,3,3,1,'Teacher Name'),
(44,8,3,1,2,'Reflect on your individual practices based on your stakeholder input'),
(45,8,4,1,1,'List the common formative assessment AND the guaranteed skill/learning target it aligns with. FOR ELEMENTARY: Identify which questions on your existing instructional program assessments align with your GVC.'),
(46,8,4,9,2,'<h1>Learning Targets and Common Formative Assessments</h1>'),
(47,8,4,9,3,'<b>How will WE know if they LEARNED it?</b><br/>
EFFECTIVE TEAMS utilize COMMON FORMATIVE ASSESSMENTS (CFA) to diagnostically assess a student''s learning, determine which students were proficient in the guaranteed skill, and those who need extra time and support.<br/>
TEAM ACTION STEPS: Identify a common formative assessment that your team will use to assess the GVC skill.'),
(48,8,4,1,4,'List the Learning Targets that will be part of this standard'),
(49,8,4,1,5,'How many students were assessed by our team?'),
(50,8,4,1,6,'How many students were NOT proficient the first time?'),
(51,8,4,1,7,'Enter any website links to online documents which support this assessment'),
(52,8,4,1,8,'According to the results of this CFA and our team''s collaboration, the following teaching practices/strategies were most effective in teaching this guaranteed skill(s):'),
(53,8,4,9,9,'<h1>Intervention</h1>'),
(54,8,4,9,10,'<b>How will WE respond to those who didn''t get it?</b><br/>
EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn''t get a concept, it might not be an intervention issue; the initial instruction should be re-examined.)'),
(55,8,4,1,11,'List the SPECIFIC INTERVENTIONS that your team responded with for those students who WERE NOT proficient.'),
(56,8,4,3,12,'Following your team''s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?'),
(57,8,4,1,13,'List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team''s intervention. (Use hyperlinks in this section to link to an outside source if needed.)'),
(58,8,4,1,14,'How did your TEAM respond to those who were still not proficient even after your team''s interventions?'),
(59,8,4,9,15,'<h1>Learning Extensions</h1>'),
(60,8,4,9,16,'EFFECTIVE TEAMS provide extension activities for those students who already know a standard or skill.'),
(61,8,4,1,17,'ACTION STEPS: As you review your GVC (from step #1), identify extension activities your team will use for those who already know it.'),
(62,8,4,3,18,'End of Year Reflection Date'),
(63,8,4,1,19,'<b>End of Year Reflection</b><br/>
Do our extension activities provide deeper learning for those students who already know it?  What adjustments can we make to provide for better extended learning opportunities?');

UPDATE question SET group_repeatableid = 1 WHERE questionid in (43,44);

UPDATE question SET protect_answer = 1 WHERE questionid in (57);
