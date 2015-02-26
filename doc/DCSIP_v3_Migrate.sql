-- @OLD_DB='csip_v3', @NEW_DB='csip_v5';

INSERT INTO csip_v5.course (courseid,course_name,active,min_grade,max_grade) (SELECT  categoryid,category_name,1,IF(gradelevel,gradelevel, CASE loc_cat_subcat WHEN 'ELEM' THEN 0 WHEN 'ELEM,INT,MID' THEN 0 WHEN 'INT' THEN 6 WHEN 'INT,MID,HS' THEN 6 WHEN 'SEC' THEN 6 WHEN 'MID' THEN 8 WHEN 'MID,INT' THEN 8 WHEN 'MID,HS,AH' THEN 8 WHEN 'MID,AH' THEN 8 WHEN 'HS' THEN 10 WHEN 'HS,AH' THEN 10 ELSE 0 END),IF(gradelevel,gradelevel, CASE loc_cat_subcat WHEN 'ELEM' THEN 5 WHEN 'ELEM,INT,MID' THEN 9 WHEN 'INT' THEN 7 WHEN 'INT,MID,HS' THEN 12 WHEN 'SEC' THEN 12 WHEN 'MID' THEN 9 WHEN 'MID,INT' THEN 9 WHEN 'MID,HS,AH' THEN 12 WHEN 'MID,AH' THEN 12 WHEN 'HS' THEN 12 WHEN 'HS,AH' THEN 12 ELSE 12 END) FROM csip_v3.category WHERE version = 6);

INSERT INTO csip_v5.course_question_links (courseid,question_group,part,title) (SELECT courseid,1,1,'Guaranteed Curriculum' FROM csip_v5.course);
INSERT INTO csip_v5.course_question_links (courseid,question_group,part,title) (SELECT courseid,2,2,'Accreditation' FROM csip_v5.course);
INSERT INTO csip_v5.course_question_links (courseid,question_group,part,title) (SELECT courseid,2,2,'GVC 1' FROM csip_v5.course);

INSERT INTO csip_v5.user (userid,username,fullname,email,password,salt,role) (SELECT userid,username,fullname,email,password,salt,role FROM csip_v3.user);

INSERT INTO csip_v5.location (locationid,name,mingrade,maxgrade,loc_demo) (SELECT locationid,name,mingrade,maxgrade,loc_demo FROM csip_v3.location);

INSERT INTO csip_v5.user_location_links (userid,locationid) (SELECT userid,locationid FROM csip_v3.user);
