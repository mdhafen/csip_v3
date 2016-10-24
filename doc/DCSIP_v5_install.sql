INSERT INTO `course_categories` (categoryid,category_name) VALUES
 ( 1, 'Language Arts' ),
 ( 2, 'Math' ),
 ( 3, 'Science' ),
 ( 4, 'CTE' ),
 ( 5, 'Fine Arts' ),
 ( 6, 'World Language' ),
 ( 7, 'Social Science' ),
 ( 8, 'Health Ed.' ),
 ( 9, 'Other' );

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

INSERT INTO course_question_links (courseid,question_group,part,title) (SELECT courseid,1,1,'Team Professional Growth Plan' from course);
INSERT INTO course_question_links (courseid,question_group,part,title) (SELECT courseid,2,2,'Accreditation' from course);
INSERT INTO course_question_links (courseid,question_group,part,title) (SELECT courseid,3,3,'Stakeholder Input' from course);
INSERT INTO course_question_links (courseid,question_group,part,title) (SELECT courseid,4,4,'GVC 1' from course);

INSERT INTO question (questionid,version,question_group,type,order_num,question) VALUES
(32,8,1,9,1,'<b>Team Professional Growth Plan:</b><br/>
After identifying your GVC and individually self assessing with the <a class="uk-display-inline" target="_blank" href="http://www.schools.utah.gov/CURR/educatoreffectiveness/Observation-Tools/Teaching/Chart.aspx">Utah Teaching Ovservation Tool (UTOT)</a>, collectively determine the Teaching Standard(s) you need to strengthen as a team, based on the learning needs of the students in your classroom this year (<a href="https://docs.google.com/document/d/1avnRg24z6hlyZccCJTKoFnTKzNXmPR4dqGACC-AOlyI/copy" class="uk-display-inline" target="_blank">click here for optional template</a>).'),
(33,8,1,1,2,'Outline Team''s Professional Growth Plan Here...'),
(43,8,3,3,1,'Teacher Name'),
(44,8,3,1,2,'Reflect on your individual practices based on your stakeholder input'),
(45,8,4,9,1,'<b>What do students NEED to know and be able to do?</b><br/>
With your team:<ol><li>Look at your standards, give priority, and come to consensus around key skills, concepts, behaviors, and dispositions.</li><li>identify/list the Essential Learnings that all students need to know.  These are your GVC''s.</li>
<li>Once your team has identified each GVC, share with the team above and below your specific grade level.</li>
<li>Share the GVC with your students.</li></ol>'),
(46,8,4,1,2,'Enter the GVC:'),
(47,8,4,9,3,'<h1>Learning Targets and Common Formative Assessments</h1>'),
(48,8,4,9,4,'<b>How will WE know if they LEARNED it?</b><br/>
A learning target is any achievement expectation for students <i>on the path</i> toward mastery of a standard. It clearly states what we want the students to learn and should be understood by teachers and students. Learning targets should be formatively assessed to monitor progress toward a GVC.<br>
With your team:<ol><li>Break the GVC into specific, measurable learning targets.</li><li>Identify a Common Formative Assessment(s) that your team will use to measure these learning targets.</li><li>Schedule, administer, and analyze the results of your CFA(s).</li></ol>'),
(49,8,4,1,5,'List all Learning Targets that will lead to proficiency in this GVC'),
(50,8,4,1,6,'CFA(s)'),
(51,8,4,1,7,'# assessed'),
(52,8,4,1,8,'# NOT proficient'),
(53,8,4,1,9,'OPTIONAL: Enter links to online documents which support this assessment.'),
(54,8,4,1,10,'According to the results of our CFA(s) and our team collaboration, the following teaching practices/strategies were most effective for this GVC.'),
(55,8,4,9,11,'<h1>Intervention</h1>'),
(56,8,4,9,12,'<b>How will WE respond to those who didn''t get it?</b><br/>
EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn''t get a concept, it might not be an intervention issue; the initial instruction should be re-examined.)'),
(57,8,4,1,13,'List the SPECIFIC INTERVENTIONS your team responded with for students who WERE NOT proficient in this GVC.'),
(58,8,4,3,14,'Following your team''s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?'),
(59,8,4,1,15,'List the FIRST NAMES of those students who were not proficient even after your team''s intervention. (Or enter a link to an online document with the students names.)'),
(60,8,4,1,16,'How did your TEAM respond to those who were still not proficient even after your team''s interventions?'),
(61,8,4,9,17,'<h1>Learning Extensions</h1>'),
(62,8,4,9,18,'What will we do if they already know it?'),
(63,8,4,1,19,'As you plan instruction for this GVC and the learning targets, identify extension activities your team will use for those who already know it.'),
(64,8,4,9,18,'Once you have completed the process, reflect on...'),
(65,8,4,1,20,'What we will keep for this GVC:'),
(66,8,4,1,21,'What we will change for this GVC:');

UPDATE question SET group_repeatableid = 1 WHERE questionid in (43,44);

UPDATE question SET protect_answer = 1 WHERE questionid in (59);
