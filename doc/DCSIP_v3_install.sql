INSERT INTO category ( category_name, category_class, category_type, category_note, version, gradelevel, loc_cat_subcat, needs_principal_approve, needs_community_approve, needs_district_approve, custom_goal_focus, parent_category ) ( SELECT category_name, IF( category_class = 'OPT', 'CSIP', 'SAP' ), category_type, category_note, 2, gradelevel, loc_cat_subcat, 1, 0, 0, IF( category_class = 'OPT', 1, 0 ), categoryid FROM category WHERE version = 1 );

UPDATE category SET category_name = 'Kindergarten Math' WHERE category_name = 'Kindergarten' AND version = 2;

INSERT INTO category ( category_name, category_class, category_type, category_note, version, gradelevel, loc_cat_subcat, needs_principal_approve, needs_community_approve, needs_district_approve, custom_goal_focus, parent_category ) ( SELECT 'Kindergarten Literacy', category_class, category_type, category_note, version, gradelevel, loc_cat_subcat, needs_principal_approve, needs_community_approve, needs_district_approve, custom_goal_focus, parent_category FROM category WHERE category_name = 'Kindergarten Math' AND version = 2 );

UPDATE category SET category_class = 'CSIP', custom_goal_focus = 1 WHERE version = 2 AND category_name LIKE '%School Wide';

UPDATE category SET loc_cat_subcat = 'ELEM,INT,MID' WHERE version = 2 AND ( category_name = 'Language Arts - School Wide' OR category_name = 'Math - School Wide' );

INSERT INTO category ( category_name, category_class, category_type, category_note, version, gradelevel, loc_cat_subcat, needs_principal_approve, needs_community_approve, needs_district_approve, custom_goal_focus, parent_category ) ( SELECT category_name, category_class, category_type, category_note, version, gradelevel, 'HS', needs_principal_approve, needs_community_approve, needs_district_approve, custom_goal_focus, parent_category FROM category WHERE version = 2 AND ( category_name = 'Language Arts - School Wide' OR category_name = 'Math - School Wide' ) );

UPDATE category SET category_class = 'SAP', needs_community_approve = 0, needs_district_approve = 0, custom_goal_focus = 0 WHERE version = 2 AND ( category_name = 'Math 1' OR category_name = 'Language Arts 1' OR category_name LIKE 'Kindergarten%' );

UPDATE category SET needs_community_approve = 1, needs_district_approve = 1 WHERE version = 2 AND category_class = 'CSIP';

UPDATE category SET category_type = 1, needs_principal_approve = 0, needs_community_approve = 0, needs_district_approve = 0 WHERE version = 2 AND ( category_name = 'Title One' OR category_name = 'Trust Lands' );
UPDATE category SET type_target = 'http://www.schoollandtrust.org/' WHERE version = 2 AND category_name = 'Trust Lands';
UPDATE category SET type_target = 'http://www.schools.utah.gov/TitleI/', loc_cat_subcat = 'ELEM' WHERE version = 2 AND category_name = 'Title One';

UPDATE category SET category_note = '(Complete if applicable)' WHERE version = 2 AND ( category_name = 'Citizenship' OR category_name = 'Safety Plan' );

DELETE FROM category WHERE version = 2 AND ( loc_cat_subcat = 'ELEM' OR loc_cat_subcat = 'NA' ) AND category_name IN ( 'Fine Arts', 'Health / PE', 'Social Studies', 'Reading Achievement / Intervention Plan' );

UPDATE category SET category_class = 'CSIP' WHERE version = 2 AND category_name = 'Basic Skills Competency Test (BSCT)';

UPDATE category SET category_name = 'Earth Systems 9', loc_cat_subcat = 'MID,AH' WHERE version = 2 AND category_name = 'Earth Systems';

UPDATE category SET gradelevel = 0, loc_cat_subcat = 'HS' WHERE version = 2 AND category_name = 'Biology';

UPDATE category SET category_name = 'Algebra II' WHERE version = 2 AND category_name = 'Intermediate Algebra';

UPDATE category SET category_group = 1 WHERE gradelevel = 1 AND version = 2;
UPDATE category SET category_group = 2 WHERE gradelevel = 2 AND version = 2;
UPDATE category SET category_group = 3 WHERE gradelevel = 3 AND version = 2;
UPDATE category SET category_group = 4 WHERE gradelevel = 4 AND version = 2;
UPDATE category SET category_group = 5 WHERE gradelevel = 5 AND version = 2;
UPDATE category SET category_group = 6 WHERE gradelevel = 6 AND version = 2;
UPDATE category SET category_group = 7 WHERE gradelevel = 7 AND version = 2;
UPDATE category SET category_group = 8 WHERE gradelevel = 8 AND version = 2;
UPDATE category SET category_group = 9 WHERE gradelevel = 9 AND version = 2;
UPDATE category SET category_group = 10 WHERE gradelevel = 10 AND version = 2;
UPDATE category SET category_group = 11 WHERE gradelevel = 11 AND version = 2;

INSERT INTO question ( question_group, part, version, order_num, type, question_option_group, question ) VALUES ( 1, 1, 2, 1, 2, 2, 'Our CRT outcomes will compare performance
<table class="example"><tr><th>Example</th><th>Prior Year</th><th>This Year</th></tr><tbody>
<tr><td>This subject/grade</td><td>Math 3</td><td>Math 3</td></tr>
<tr><td>Of students</td><td>Math 2</td><td>Math 3</td></tr></tbody></table>' ),
( 1, 1, 2, 2, 8, 0, 'Overall [input_3] of students, or [input_3]% were proficient on the [category_name] CRT.  The concepts and objectives on which our students preformed well were: 
[input_1]' ),
( 1, 1, 2, 3, 8, 0, '[input_3] of "Asian" students, or [input_3]% were proficient on the [category_name] CRT.  The concepts and objectives on which "Asian" students did not preform well were: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 1, 1, 2, 4, 8, 0, '[input_3] of "Black" students, or [input_3]% were proficient on the [category_name] CRT.  The concepts and objectives on which "Black" students did not preform well were: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 1, 1, 2, 5, 8, 0, '[input_3] of "Hispanic" students, or [input_3]% were proficient on the [category_name] CRT.  The concepts and objectives on which "Hispanic" students did not preform well were: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 1, 1, 2, 6, 8, 0, '[input_3] of "Indian" students, or [input_3]% were proficient on the [category_name] CRT.  The concepts and objectives on which "Indian" students did not preform well were: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 1, 1, 2, 7, 8, 0, '[input_3] of "Pacific Islander" students, or [input_3]% were proficient on the [category_name] CRT.  The concepts and objectives on which "Pacific Islander" students did not preform well were: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 1, 1, 2, 8, 8, 0, '[input_3] of "Low Income" students, or [input_3]% were proficient on the [category_name] CRT.  The concepts and objectives on which "Low Income" students did not preform well were: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 1, 1, 2, 9, 8, 0, '[input_3] of "L.E.P." students, or [input_3]% were proficient on the [category_name] CRT.  The concepts and objectives on which "L.E.P." students did not preform well were: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 1, 1, 2, 10, 8, 0, '[input_3] of students with disabilities, or [input_3]% were proficient on the [category_name] CRT.  The concepts and objectives on which students with disabilities did not preform well were: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 1, -1, 2, 1, 3, 0, 'Last year the overall number of students proficient on the [category_name] CRT was [[ select [answer_0] from answer cross join question using (questionid) where csipid = [csipid] and categoryid = [categoryid] and part = 1 and version = 2 and order_num = 2 ]] or [[ select [answer_1] from answer cross join question using (questionid) where csipid = [csipid] and categoryid = [categoryid] and part = 1 and version = 2 and order_num = 2 ]]%.  Our overall proficiency goal for [year_name] is: ' ),
( 1, -1, 2, 2, 3, 0, 'Last year [[ select [answer_0] from answer cross join question using (questionid) where csipid = [csipid] and categoryid = [categoryid] and part = 1 and version = 2 and order_num = 3 ]] "Asian" students were proficient on the [category_name] CRT.  Our goal is to increase the number of proficient "Asian" students to: ' ),
( 1, -1, 2, 3, 3, 0, 'Last year [[ select [answer_0] from answer cross join question using (questionid) where csipid = [csipid] and categoryid = [categoryid] and part = 1 and version = 2 and order_num = 4 ]] "Black" students were proficient on the [category_name] CRT.  Our goal is to increase the number of proficient "Black" students to: ' ),
( 1, -1, 2, 4, 3, 0, 'Last year [[ select [answer_0] from answer cross join question using (questionid) where csipid = [csipid] and categoryid = [categoryid] and part = 1 and version = 2 and order_num = 5 ]] "Hispanic" students were proficient on the [category_name] CRT.  Our goal is to increase the number of proficient "Hispanic" students to: ' ),
( 1, -1, 2, 5, 3, 0, 'Last year [[ select [answer_0] from answer cross join question using (questionid) where csipid = [csipid] and categoryid = [categoryid] and part = 1 and version = 2 and order_num = 6 ]] "Indian" students were proficient on the [category_name] CRT.  Our goal is to increase the number of proficient "Indian" students to: ' ),
( 1, -1, 2, 6, 3, 0, 'Last year [[ select [answer_0] from answer cross join question using (questionid) where csipid = [csipid] and categoryid = [categoryid] and part = 1 and version = 2 and order_num = 7 ]] "Pacific Islander" students were proficient on the [category_name] CRT.  Our goal is to increase the number of proficient "Pacific Islander" students to: ' ),
( 1, -1, 2, 7, 3, 0, 'Last year [[ select [answer_0] from answer cross join question using (questionid) where csipid = [csipid] and categoryid = [categoryid] and part = 1 and version = 2 and order_num = 8 ]] "Low Income" students were proficient on the [category_name] CRT.  Our goal is to increase the number of proficient "Low Income" students to: ' ),
( 1, -1, 2, 8, 3, 0, 'Last year [[ select [answer_0] from answer cross join question using (questionid) where csipid = [csipid] and categoryid = [categoryid] and part = 1 and version = 2 and order_num = 9 ]] "L.E.P." students were proficient on the [category_name] CRT.  Our goal is to increase the number of proficient "L.E.P." students to: ' ),
( 1, -1, 2, 9, 3, 0, 'Last year [[ select [answer_0] from answer cross join question using (questionid) where csipid = [csipid] and categoryid = [categoryid] and part = 1 and version = 2 and order_num = 10 ]] students with disabilities were proficient on the [category_name] CRT.  Our goal is to increase the number of proficient students with disabilities to: ' );

UPDATE category SET question_group = 1 WHERE version = 2 AND category_class = 'SAP' AND ( gradelevel < 6 AND ( gradelevel > 0 OR loc_cat_subcat = 'ELEM' ) );

UPDATE category SET question_group = 0 WHERE version = 2 AND category_class = 'SAP' AND ( category_name = 'Math 1' );

INSERT INTO question ( question_group, part, version, order_num, type, question_option_group, question ) VALUES ( 2, 1, 2, 1, 8, 0, 'Overall [input_3] of students, which represents [input_3]% were proficient in [category_name].  The concepts and objectives on which our students preformed well were: 
[input_1]' ),
( 2, 1, 2, 2, 8, 0, '[input_3]% of our students are "Asian".  [input_3] number or  [input_3]% of "Asian" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 2, 1, 2, 3, 8, 0, '[input_3]% of our students are "Black".  [input_3] number or  [input_3]% of "Black" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 2, 1, 2, 4, 8, 0, '[input_3]% of our students are "Hispanic".  [input_3] number or  [input_3]% of "Hispanic" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 2, 1, 2, 5, 8, 0, '[input_3]% of our students are "Indian".  [input_3] number or  [input_3]% of "Indian" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 2, 1, 2, 6, 8, 0, '[input_3]% of our students are "Pacific Islander".  [input_3] number or  [input_3]% of "Pacific Islander" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 2, 1, 2, 7, 8, 0, '[input_3]% of our students are "Low Income".  [input_3] number or  [input_3]% of "Low Income" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 2, 1, 2, 8, 8, 0, '[input_3]% of our students are "L.E.P.".  [input_3] number or  [input_3]% of "L.E.P." students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 2, 1, 2, 9, 8, 0, '[input_3]% of our students are students with disabilities.  [input_3] number or  [input_3]% of students with disabilities students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 2, -1, 2, 1, 9, 0, 'The AYP Proficiency Goal for Language Arts (Grades 3-8) is 83%.

To accomplish the AYP Proficiency Goals the following subgoals will be achieved:' );

UPDATE category SET question_group = 2 WHERE version = 2 AND category_class = 'CSIP' AND category_name = 'Language Arts - School Wide' AND loc_cat_subcat = 'ELEM,INT,MID';

INSERT INTO question ( question_group, part, version, order_num, type, question_option_group, question ) VALUES ( 3, 1, 2, 1, 8, 0, 'Overall [input_3] of students, which represents [input_3]% were proficient in [category_name].  The concepts and objectives on which our students preformed well were: 
[input_1]' ),
( 3, 1, 2, 2, 8, 0, '[input_3]% of our students are "Asian".  [input_3] number or  [input_3]% of "Asian" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 3, 1, 2, 3, 8, 0, '[input_3]% of our students are "Black".  [input_3] number or  [input_3]% of "Black" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 3, 1, 2, 4, 8, 0, '[input_3]% of our students are "Hispanic".  [input_3] number or  [input_3]% of "Hispanic" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 3, 1, 2, 5, 8, 0, '[input_3]% of our students are "Indian".  [input_3] number or  [input_3]% of "Indian" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 3, 1, 2, 6, 8, 0, '[input_3]% of our students are "Pacific Islander".  [input_3] number or  [input_3]% of "Pacific Islander" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 3, 1, 2, 7, 8, 0, '[input_3]% of our students are "Low Income".  [input_3] number or  [input_3]% of "Low Income" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 3, 1, 2, 8, 8, 0, '[input_3]% of our students are "L.E.P.".  [input_3] number or  [input_3]% of "L.E.P." students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 3, 1, 2, 9, 8, 0, '[input_3]% of our students are students with disabilities.  [input_3] number or  [input_3]% of students with disabilities students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 3, -1, 2, 1, 9, 0, 'The AYP Proficiency Goal for Math (Grades 3-8) is 78%.

To accomplish the AYP Proficiency Goals the following subgoals will be achieved:' );

UPDATE category SET question_group = 3 WHERE version = 2 AND category_class = 'CSIP' AND category_name = 'Math - School Wide' AND loc_cat_subcat = 'ELEM,INT,MID';

INSERT INTO question ( question_group, part, version, order_num, type, question_option_group, question ) VALUES ( 4, 1, 2, 1, 8, 0, 'Overall [input_3] of students, which represents [input_3]% were proficient in [category_name].  The concepts and objectives on which our students preformed well were: 
[input_1]' ),
( 4, 1, 2, 2, 8, 0, '[input_3]% of our students are "Asian".  [input_3] number or  [input_3]% of "Asian" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 4, 1, 2, 3, 8, 0, '[input_3]% of our students are "Black".  [input_3] number or  [input_3]% of "Black" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 4, 1, 2, 4, 8, 0, '[input_3]% of our students are "Hispanic".  [input_3] number or  [input_3]% of "Hispanic" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 4, 1, 2, 5, 8, 0, '[input_3]% of our students are "Indian".  [input_3] number or  [input_3]% of "Indian" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 4, 1, 2, 6, 8, 0, '[input_3]% of our students are "Pacific Islander".  [input_3] number or  [input_3]% of "Pacific Islander" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 4, 1, 2, 7, 8, 0, '[input_3]% of our students are "Low Income".  [input_3] number or  [input_3]% of "Low Income" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 4, 1, 2, 8, 8, 0, '[input_3]% of our students are "L.E.P.".  [input_3] number or  [input_3]% of "L.E.P." students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 4, 1, 2, 9, 8, 0, '[input_3]% of our students are students with disabilities.  [input_3] number or  [input_3]% of students with disabilities students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 4, -1, 2, 1, 3, 0, 'Last year [[ select [answer_0] from answer cross join question using (questionid) where csipid = [csipid] and categoryid = [categoryid] and part = 1 and version = 2 and order_num = 1 ]] of our students or [[ select [answer_1] from answer cross join question using (questionid) where csipid = [csipid] and categoryid = [categoryid] and part = 1 and version = 2 and order_num = 1 ]]% were proficient on the Science CRT.  Our goal is to increase the number of proficient students to: ' );

UPDATE category SET question_group = 4 WHERE version = 2 AND category_class = 'CSIP' AND category_name = 'Science - School Wide';

INSERT INTO question ( question_group, part, version, order_num, type, question_option_group, question ) VALUES ( 5, 1, 2, 1, 8, 0, 'Overall [input_3] of students, which represents [input_3]% were proficient in [category_name].  The concepts and objectives on which our students preformed well were: 
[input_1]' ),
( 5, 1, 2, 2, 8, 0, '[input_3]% of our students are "Asian".  [input_3] number or  [input_3]% of "Asian" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 5, 1, 2, 3, 8, 0, '[input_3]% of our students are "Black".  [input_3] number or  [input_3]% of "Black" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 5, 1, 2, 4, 8, 0, '[input_3]% of our students are "Hispanic".  [input_3] number or  [input_3]% of "Hispanic" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 5, 1, 2, 5, 8, 0, '[input_3]% of our students are "Indian".  [input_3] number or  [input_3]% of "Indian" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 5, 1, 2, 6, 8, 0, '[input_3]% of our students are "Pacific Islander".  [input_3] number or  [input_3]% of "Pacific Islander" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 5, 1, 2, 7, 8, 0, '[input_3]% of our students are "Low Income".  [input_3] number or  [input_3]% of "Low Income" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 5, 1, 2, 8, 8, 0, '[input_3]% of our students are "L.E.P.".  [input_3] number or  [input_3]% of "L.E.P." students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 5, 1, 2, 9, 8, 0, '[input_3]% of our students are students with disabilities.  [input_3] number or  [input_3]% of students with disabilities students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 5, -1, 2, 1, 9, 0, 'The AYP Proficiency Goal for Language Arts (Grade 10) is 82%.

To accomplish the AYP Proficiency Goals the following subgoals will be achieved:' );

UPDATE category SET question_group = 5 WHERE version = 2 AND category_class = 'CSIP' AND category_name = 'Language Arts - School Wide' AND loc_cat_subcat = 'HS';

INSERT INTO question ( question_group, part, version, order_num, type, question_option_group, question ) VALUES ( 6, 1, 2, 1, 8, 0, 'Overall [input_3] of students, which represents [input_3]% were proficient in [category_name].  The concepts and objectives on which our students preformed well were: 
[input_1]' ),
( 6, 1, 2, 2, 8, 0, '[input_3]% of our students are "Asian".  [input_3] number or  [input_3]% of "Asian" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 6, 1, 2, 3, 8, 0, '[input_3]% of our students are "Black".  [input_3] number or  [input_3]% of "Black" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 6, 1, 2, 4, 8, 0, '[input_3]% of our students are "Hispanic".  [input_3] number or  [input_3]% of "Hispanic" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 6, 1, 2, 5, 8, 0, '[input_3]% of our students are "Indian".  [input_3] number or  [input_3]% of "Indian" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 6, 1, 2, 6, 8, 0, '[input_3]% of our students are "Pacific Islander".  [input_3] number or  [input_3]% of "Pacific Islander" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 6, 1, 2, 7, 8, 0, '[input_3]% of our students are "Low Income".  [input_3] number or  [input_3]% of "Low Income" students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 6, 1, 2, 8, 8, 0, '[input_3]% of our students are "L.E.P.".  [input_3] number or  [input_3]% of "L.E.P." students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 6, 1, 2, 9, 8, 0, '[input_3]% of our students are students with disabilities.  [input_3] number or  [input_3]% of students with disabilities students were not proficient in [category_name].  These students did not preform well on the following concepts / objectives: 
(Type NA in # &amp; % boxes if there are no members of the subgroup)
[input_1]' ),
( 6, -1, 2, 1, 9, 0, 'The AYP Proficiency Goal for Math (Grades 10-12) is 72%.

To accomplish the AYP Proficiency Goals the following subgoals will be achieved:' );

UPDATE category SET question_group = 6 WHERE version = 2 AND category_class = 'CSIP' AND category_name = 'Math - School Wide' AND loc_cat_subcat = 'HS';

INSERT INTO question ( question_group, part, version, order_num, type, question_option_group, question ) VALUES ( 7, 1, 2, 1, 1, 0, 'We have reviewed student results from the literacy sections of last year''s K-post assessment.  A majority of our students did well on the following concepts / skills: ' ),
( 7, 1, 2, 2, 1, 0, 'We have reviewed student results from the literacy sections of last year''s K-pre assessment.  A majority of our students will need instruction in the following concepts / skills: ' ),
( 7, 1, 2, 3, 2, 1, 'According to the results of the literacy sections of the K-pre test, our lowest performing subgroup is: ' ),
( 7, -1, 2, 1, 9, 0, 'Our goal is to have each student score 100% on the literacy sections of the K-post test next spring.
To accomplish this we have set the following sub-goals: ' );

UPDATE category SET question_group = 7 WHERE version = 2 AND category_class = 'SAP' AND category_name = 'Kindergarten Literacy';

INSERT INTO question ( question_group, part, version, order_num, type, question_option_group, question ) VALUES ( 8, 1, 2, 1, 1, 0, 'We have reviewed student results from the math sections of last year''s K-post assessment.  A majority of our students did well on the following concepts / skills: ' ),
( 8, 1, 2, 2, 1, 0, 'We have reviewed student results from the math sections of last year''s K-pre assessment.  A majority of our students will need instruction in the following concepts / skills: ' ),
( 8, 1, 2, 3, 2, 1, 'According to the results of the math sections of the K-pre test, our lowest performing subgroup is: ' ),
( 8, -1, 2, 1, 9, 0, 'Our goal is to have each student score 100% on the math sections of the K-post test next spring.
To accomplish this we have set the following sub-goals: ' );

UPDATE category SET question_group = 8 WHERE version = 2 AND category_class = 'SAP' AND category_name = 'Kindergarten Math';

INSERT INTO question ( question_group, part, version, order_num, type, question_option_group, question ) VALUES ( 9, 1, 2, 1, 8, 0, 'According to the DRA assessments done at the first of the year (or end of last year) [input_3] number, or [input_3]% of 1st graders are reading on or above grade level.  The disaggregated results are as follows:
(Type NA in # &amp; % boxes if there are no members of the subgroup)
<table><tr><th>Subgroup</th><th># on or above</th><th>%</th></tr><tbody><tr><td>Asian</td><td>[input_3]</td><td>[input_3]%</td></tr><tr><td>Black</td><td>[input_3]</td><td>[input_3]%</td></tr><tr><td>Hispanic</td><td>[input_3]</td><td>[input_3]%</td></tr><tr><td>Indian</td><td>[input_3]</td><td>[input_3]%</td></tr><tr><td>Pacific Islander</td><td>[input_3]</td><td>[input_3]%</td></tr><tr><td>L.E.P.</td><td>[input_3]</td><td>[input_3]%</td></tr><tr><td>Low Income</td><td>[input_3]</td><td>[input_3]%</td></tr><tr><td>SPED</td><td>[input_3]</td><td>[input_3]%</td></tr></tbody></table>
Note: 1 or less enter N/A' ),
( 9, -1, 2, 1, 8, 0, 'At the end of the year [input_3] number of students, or [input_3]%, will read on or above level according to the DRA.' );

UPDATE category SET question_group = 9 WHERE version = 2 AND category_class = 'SAP' AND category_name = 'Language Arts 1';

UPDATE category SET question_group = 1 WHERE version = 2 AND category_class = 'SAP' AND ( gradelevel >= 6 OR loc_cat_subcat LIKE '%HS%' OR loc_cat_subcat LIKE '%AH%' OR loc_cat_subcat LIKE '%MID%' OR loc_cat_subcat LIKE '%INT%' OR loc_cat_subcat LIKE '%SEC%' );

UPDATE category SET question_group = 0 WHERE version = 2 AND category_name = 'Algebra II';

UPDATE category SET category_class = 'SAP', needs_community_approve = 0, needs_district_approve = 0 WHERE version = 2 AND loc_cat_subcat = 'SEC' AND category_name IN ( 'Career and Technology', 'Health / PE', 'Social Studies', 'Foreign Language', 'Fine Arts' );

