-- @OLD_DB='csip_v3', @NEW_DB='csip_v5';

INSERT INTO csip_v5.course_categories ( categoryid, category_name ) VALUES (1,'Language Arts'),(2,'Math'),(3,'Science'),(4,'CTE'),(5,'Fine Arts'),(6,'Foreign Language'),(7,'Social Science'),(8,'Health Ed.'),(9,'Electives');

INSERT INTO csip_v5.course (courseid,course_name,course_category,active,min_grade,max_grade) (SELECT  categoryid,category_name,course_group,1,IF(gradelevel,gradelevel, CASE loc_cat_subcat WHEN 'ELEM' THEN 0 WHEN 'ELEM,INT,MID' THEN 0 WHEN 'INT' THEN 6 WHEN 'INT,MID,HS' THEN 6 WHEN 'SEC' THEN 6 WHEN 'MID' THEN 8 WHEN 'MID,INT' THEN 8 WHEN 'MID,HS,AH' THEN 8 WHEN 'MID,AH' THEN 8 WHEN 'HS' THEN 10 WHEN 'HS,AH' THEN 10 ELSE 0 END),IF(gradelevel,gradelevel, CASE loc_cat_subcat WHEN 'ELEM' THEN 5 WHEN 'ELEM,INT,MID' THEN 9 WHEN 'INT' THEN 7 WHEN 'INT,MID,HS' THEN 12 WHEN 'SEC' THEN 12 WHEN 'MID' THEN 9 WHEN 'MID,INT' THEN 9 WHEN 'MID,HS,AH' THEN 12 WHEN 'MID,AH' THEN 12 WHEN 'HS' THEN 12 WHEN 'HS,AH' THEN 12 ELSE 12 END) FROM csip_v3.category WHERE version = 6);

UPDATE csip_v5.course SET course_category = 3 WHERE course_name IN ('Geography');
UPDATE csip_v5.course SET course_category = 4 WHERE course_name LIKE 'CTE%';
UPDATE csip_v5.course SET course_category = 5 WHERE course_name IN ('Fine Arts','Choir','Band','Theater','Visual Arts','Orchestra','Photography','Guitar','Ceramics');
UPDATE csip_v5.course SET course_category = 6 WHERE course_name IN ('American Sign Language','Foreign Language','AP World Language') OR course_name LIKE 'World Language%';
UPDATE csip_v5.course SET course_category = 7 WHERE course_name IN ('World Civilization','US History','US Government','Psycology') OR course_name LIKE 'Social Studies%';
UPDATE csip_v5.course SET course_category = 8 WHERE course_name IN ('Health','PE','Dance');
UPDATE csip_v5.course SET course_category = 9 WHERE course_category = 0;

INSERT INTO csip_v5.course_question_links (courseid,question_group,part,title) (SELECT courseid,1,1,'Guaranteed Curriculum' FROM csip_v5.course);
INSERT INTO csip_v5.course_question_links (courseid,question_group,part,title) (SELECT courseid,2,2,'Accreditation' FROM csip_v5.course);
INSERT INTO csip_v5.course_question_links (courseid,question_group,part,title) (SELECT courseid,3,3,'GVC 1' FROM csip_v5.course);

INSERT INTO csip_v5.user (userid,username,fullname,email,password,salt,role) (SELECT userid,username,fullname,email,password,salt,role FROM csip_v3.user);

INSERT INTO csip_v5.location (locationid,name,mingrade,maxgrade,loc_demo) (SELECT locationid,name,mingrade,maxgrade,loc_demo FROM csip_v3.location);

INSERT INTO csip_v5.user_location_links (userid,locationid) (SELECT userid,locationid FROM csip_v3.user);
