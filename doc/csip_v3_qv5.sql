-- MySQL dump 10.13  Distrib 5.5.24, for debian-linux-gnu (x86_64)
--
-- Host: mysql    Database: csip_v3
-- ------------------------------------------------------
-- Server version	5.0.95-log
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Not dumping tablespaces as no INFORMATION_SCHEMA.FILES table on this server
--

--
-- Dumping data for table `question`
--
-- WHERE:  version=4
-- question_group 21 - 25 -> 26 - 30
-- questionid 325 - 343 -> 344 - 362

INSERT INTO `question` VALUES (344,'Last year\'s CRT scores for your current class(s) can be found on <a href=\"https://psa.washk12.org/teachers/\" target=\"_BLANK\">Power Teacher</a>:\n<ol><li style=\"padding: 0;\">From leftside menu select REPORTS.</li><li style=\"padding: 0;\">From list of WCSD Reports (bottom half of screen) select ASSESSMENT REPORTS</li><li style=\"padding: 0;\">Select current class.</li><li style=\"padding: 0;\">Choose a CRT and then choose ASSESSMENT SUMMARY > Submit.</li></ol>\n\nFrom this report you can:\n<ol style=\"list-style-type: upper-alpha;\"><li style=\"padding: 0;\">See all testing information for your current students.</li><li style=\"padding: 0;\">All CRT scale scores below 160 are highlighted in pink</li><li style=\"padding: 0;\">Click on the scale score to drill down to Standard score.  Then click on the Standard to see the Objective score.</li><li style=\"padding: 0;\">Click on a student\'s name to see an assessment summary.</li><li style=\"padding: 0;\">Subgroup information is summarized in the tables that follow the student list.  (Prof. is the number of Proficient students, Non. is the number of Non Proficient Students, Count is the total number of students in that subgroup.)</li><li style=\"padding: 0;\">To export to an Excel file click DOWNLOAD CSV DATA</li></ol>\n<b>Overall [input]% of students were proficient on the [[SELECT category_name FROM category WHERE version = 5 AND course_group = [course_group] AND course_group_order = [course_group_order] -1]] CRT.</b>\n<input type=\"submit\" name=\"op\" value=\"Save Answers\">',26,1,5,1,3,0);
INSERT INTO `question` VALUES (345,'<b>Subgroup(s), with 10 or more members, which had less than [[SELECT answer FROM answer CROSS JOIN question USING (questionid) WHERE csipid = [csipid] AND categoryid = [categoryid] AND part = 1 AND version = 5 AND order_num = 1]]% proficient</b>\n<table><tbody><tr><td>[input_7_Asian] Asian</td><td>[input_7_Hispanic] Hispanic</td><td>[input_7_SPED] SPED</td></tr><tr><td>[input_7_Black] Black</td><td>[input_7_Indian] Indian</td><td>[input_7_ELL] ELL</td></tr><tr><td>[input_7_Caucasian] Caucasian</td><td>[input_7_PacificIslander] Pacific Islander</td><td>[input_7_LowIncome] Low Income</td></tr></tbody></table>\n<input type=\"submit\" name=\"op\" value=\"Save Answers\">',26,1,5,2,8,0);
INSERT INTO `question` VALUES (346,'Additional data analysis can be conducted on the Utah State Office of Education <a href=\"https://cognos1.schools.utah.gov/ibmcognos/\" target=\"_BLANK\">Data Display</a>\n\n<ol style=\"list-style-type: upper-alpha;\"><li style=\"padding: 0;\">Userid = usoe\nPassword = data4u</li><li style=\"padding: 0;\">Use the drop-down menus to view CRT results for any district, school, or year.</li><li style=\"padding: 0;\">Use the drop-down menus to filter by demographic group and click SUBMIT.</li><li style=\"padding: 0;\">The graphs and tables are drill-down links.</li><li style=\"padding: 0;\">To see the numbers behind the percents click CRT BY NUMBER AND PERCENT at the bottom of the report.</li><li style=\"padding: 0;\">CRT BY TEACHER displays class results by teacher Cactus number.</li></ol>\nNote: DATA DISPLAY is for educational users only.  DATA DISPLAY will not report individual students results.\n\n<b>Below, enter any data analysis information the PLC found to be important (or as directed by the Principal)</b>\n[input]',26,1,5,3,1,0);
INSERT INTO `question` VALUES (347,'As you create target proficiency goals keep in mind the following Adequate Yearly Progress (AYP) targets:\n<table><tr><th>Subject / Grade</th><th>2011 &amp; 2012</th><th>2013</th><th>2014</th></tr><tbody><tr><td>Language Arts (3-8)</td><td class=\"text_center\">89%</td><td class=\"text_center\">95%</td><td class=\"text_center\">100%</td></tr><tr><td>Math (3-8)</td><td class=\"text_center\">63%</td><td class=\"text_center\">81%</td><td class=\"text_center\">100%</td></tr><tr><td>Language Arts (10)</td><td class=\"text_center\">88%</td><td class=\"text_center\">94%</td><td class=\"text_center\">100%</td></tr><tr><td>Math (10)</td><td class=\"text_center\">60%</td><td class=\"text_center\">80%</td><td class=\"text_center\">100%</td></tr></tbody></table>\nSafe Harbor Provision: AYP may also be met by reducing the number of students <u>not proficient</u> by 10% from the previous year.',26,-1,5,1,9,0);
INSERT INTO `question` VALUES (348,'At the beginning of the [year_name] we have\n[[SELECT answer FROM answer CROSS JOIN question USING (questionid) WHERE csipid = [csipid] AND categoryid = [categoryid] AND part = 1 AND version = 5 AND order_num = 1]]% students proficient\n[i_percent [[SELECT answer FROM answer CROSS JOIN question USING (questionid) WHERE csipid = [csipid] AND categoryid = [categoryid] AND part = 1 AND version = 5 AND order_num = 1]] ]% students not proficient\non the [year_name-1] [[SELECT category_name FROM category WHERE version = 5 AND course_group = [course_group] AND course_group_order = [course_group_order] -1]] CRT.\n<b>Our goal is to have [input_3]% of the students proficient on the [category_name] CRT at the end of the school year.</b>',26,-1,5,2,8,0);
INSERT INTO `question` VALUES (349,'<b>Describe how you will measure student proficiency:</b>\n[input]',27,1,5,1,1,0);
INSERT INTO `question` VALUES (350,'<b>How often will measurement of student proficiency be done:</b>\n[input]',27,1,5,2,1,0);
INSERT INTO `question` VALUES (351,'<b>[input]% of students will be proficient at the end of the school year.</b>',27,-1,5,1,3,0);
INSERT INTO `question` VALUES (352,'We have reviewed student results from the literacy sections of <em><strong>last year\'s K-post assessment</strong></em>. A majority of our students did well on the following concepts / skills:',28,1,5,1,1,0);
INSERT INTO `question` VALUES (353,'We have reviewed student results from the literacy sections of <em><strong>this year\'s K-pre assessment</strong></em>. A majority of our students will need instruction in the following concepts / skills:',28,1,5,2,1,0);
INSERT INTO `question` VALUES (354,'According to the results of the literacy sections of the K-pre test, our lowest performing subgroup is:',28,1,5,3,2,1);
INSERT INTO `question` VALUES (355,'We have reviewed student results from the math sections of <em><strong>last year\'s K-post assessment</strong></em>. A majority of our students did well on the following concepts / skills:',29,1,5,1,1,0);
INSERT INTO `question` VALUES (356,'We have reviewed student results from the math sections of <em><strong>this year\'s K-pre assessment</strong></em>. A majority of our students will need instruction in the following concepts / skills:',29,1,5,2,1,0);
INSERT INTO `question` VALUES (357,'According to the results of the math sections of the K-pre test, our lowest performing subgroup is:',29,1,5,3,2,1);
INSERT INTO `question` VALUES (358,'Last year\'s CRT scores for your current class(s) can be found on <a href=\"https://psa.washk12.org/teachers/\" target=\"_BLANK\">Power Teacher</a>:\n<ol><li style=\"padding: 0;\">From leftside menu select REPORTS.</li><li style=\"padding: 0;\">From list of WCSD Reports (bottom half of screen) select ASSESSMENT REPORTS</li><li style=\"padding: 0;\">Select current class.</li><li style=\"padding: 0;\">Choose a CRT and then choose ASSESSMENT SUMMARY > Submit.</li></ol>\n\nFrom this report you can:\n<ol style=\"list-style-type: upper-alpha;\"><li style=\"padding: 0;\">See all testing information for your current students.</li><li style=\"padding: 0;\">All CRT scale scores below 160 are highlighted in pink</li><li style=\"padding: 0;\">Click on the scale score to drill down to Standard score.  Then click on the Standard to see the Objective score.</li><li style=\"padding: 0;\">Click on a student\'s name to see an assessment summary.</li><li style=\"padding: 0;\">Subgroup information is summarized in the tables that follow the student list.  (Prof. is the number of Proficient students, Non. is the number of Non Proficient Students, Count is the total number of students in that subgroup.)</li><li style=\"padding: 0;\">To export to an Excel file click DOWNLOAD CSV DATA</li></ol>\n<b>Overall [input]% of students were proficient on the Math 7 CRT.</b>\n<input type=\"submit\" name=\"op\" value=\"Save Answers\">',30,1,5,1,3,0);
INSERT INTO `question` VALUES (359,'<b>Subgroup(s), with 10 or more members, which had less than [[SELECT answer FROM answer CROSS JOIN question USING (questionid) WHERE csipid = [csipid] AND categoryid = [categoryid] AND part = 1 AND version = 5 AND order_num = 1]]% proficient</b>\n<table><tbody><tr><td>[input_7_Asian] Asian</td><td>[input_7_Hispanic] Hispanic</td><td>[input_7_SPED] SPED</td></tr><tr><td>[input_7_Black] Black</td><td>[input_7_Indian] Indian</td><td>[input_7_ELL] ELL</td></tr><tr><td>[input_7_Caucasian] Caucasian</td><td>[input_7_PacificIslander] Pacific Islander</td><td>[input_7_LowIncome] Low Income</td></tr></tbody></table>\n<input type=\"submit\" name=\"op\" value=\"Save Answers\">',30,1,5,2,8,0);
INSERT INTO `question` VALUES (360,'Additional data analysis can be conducted on the Utah State Office of Education <a href=\"https://cognos1.schools.utah.gov/ibmcognos/\" target=\"_BLANK\">Data Display</a>\n\n<ol style=\"list-style-type: upper-alpha;\"><li style=\"padding: 0;\">Userid = usoe\nPassword = data4u</li><li style=\"padding: 0;\">Use the drop-down menus to view CRT results for any district, school, or year.</li><li style=\"padding: 0;\">Use the drop-down menus to filter by demographic group and click SUBMIT.</li><li style=\"padding: 0;\">The graphs and tables are drill-down links.</li><li style=\"padding: 0;\">To see the numbers behind the percents click CRT BY NUMBER AND PERCENT at the bottom of the report.</li><li style=\"padding: 0;\">CRT BY TEACHER displays class results by teacher Cactus number.</li></ol>\nNote: DATA DISPLAY is for educational users only.  DATA DISPLAY will not report individual students results.\n\n<b>Below, enter any data analysis information the PLC found to be important (or as directed by the Principal)</b>\n[input]',30,1,5,3,1,0);
INSERT INTO `question` VALUES (361,'As you create target proficiency goals keep in mind the following Adequate Yearly Progress (AYP) targets:\n<table><tr><th>Subject / Grade</th><th>2011 &amp; 2012</th><th>2013</th><th>2014</th></tr><tbody><tr><td>Language Arts (3-8)</td><td class=\"text_center\">89%</td><td class=\"text_center\">95%</td><td class=\"text_center\">100%</td></tr><tr><td>Math (3-8)</td><td class=\"text_center\">63%</td><td class=\"text_center\">81%</td><td class=\"text_center\">100%</td></tr><tr><td>Language Arts (10)</td><td class=\"text_center\">88%</td><td class=\"text_center\">94%</td><td class=\"text_center\">100%</td></tr><tr><td>Math (10)</td><td class=\"text_center\">60%</td><td class=\"text_center\">80%</td><td class=\"text_center\">100%</td></tr></tbody></table>\nSafe Harbor Provision: AYP may also be met by reducing the number of students <u>not proficient</u> by 10% from the previous year.',30,-1,5,1,9,0);
INSERT INTO `question` VALUES (362,'At the beginning of the [year_name] we have\n[[SELECT answer FROM answer CROSS JOIN question USING (questionid) WHERE csipid = [csipid] AND categoryid = [categoryid] AND part = 1 AND version = 5 AND order_num = 1]]% students proficient\n[i_percent [[SELECT answer FROM answer CROSS JOIN question USING (questionid) WHERE csipid = [csipid] AND categoryid = [categoryid] AND part = 1 AND version = 5 AND order_num = 1]] ]% students not proficient\non the [year_name-1] Math 7 CRT.\n<b>Our goal is to have [input_3]% of the students proficient on the [category_name] CRT at the end of the school year.</b>',30,-1,5,2,8,0);

--
-- Dumping data for table `category`
--
-- WHERE:  version=4

INSERT INTO `category` VALUES (199,'Kindergarten Math','OTHR',0,'',0,0,0,'',5,29,0,'ELEM',1,0,0,1,0,104);
INSERT INTO `category` VALUES (200,'Kindergarten Literacy','OTHR',0,'',0,0,0,'',5,28,0,'ELEM',1,0,0,1,0,105);
INSERT INTO `category` VALUES (201,'Language Arts 1','OTHR',0,'',1,1,1,'',5,27,1,'NA',1,0,0,0,0,106);
INSERT INTO `category` VALUES (202,'Language Arts 2','OTHR',0,'',2,1,2,'',5,27,2,'NA',1,0,0,0,0,107);
INSERT INTO `category` VALUES (203,'Language Arts 3','OTHR',0,'',3,1,3,'',5,27,3,'NA',1,0,0,0,0,108);
INSERT INTO `category` VALUES (204,'Language Arts 4','OTHR',0,'',4,1,4,'',5,26,4,'NA',1,0,0,0,0,109);
INSERT INTO `category` VALUES (205,'Language Arts 5','OTHR',0,'',5,1,5,'',5,26,5,'NA',1,0,0,0,0,110);
INSERT INTO `category` VALUES (206,'Language Arts 6','OTHR',0,'',6,1,6,'',5,26,6,'NA',1,0,0,0,0,111);
INSERT INTO `category` VALUES (207,'Language Arts 7','OTHR',0,'',7,1,7,'',5,26,7,'NA',1,0,0,0,0,112);
INSERT INTO `category` VALUES (208,'Language Arts 8','OTHR',0,'',8,1,8,'',5,26,8,'NA',1,0,0,0,0,113);
INSERT INTO `category` VALUES (209,'Language Arts 9','OTHR',0,'',9,1,9,'',5,26,9,'NA',1,0,0,0,0,114);
INSERT INTO `category` VALUES (210,'Language Arts 10','OTHR',0,'',10,1,10,'',5,26,10,'NA',1,0,0,0,0,115);
INSERT INTO `category` VALUES (211,'Language Arts 11','OTHR',0,'',11,1,11,'',5,26,11,'NA',1,0,0,0,0,116);
INSERT INTO `category` VALUES (212,'Math 1','OTHR',0,'',1,2,1,'',5,27,1,'NA',1,0,0,0,0,117);
INSERT INTO `category` VALUES (213,'Math 2','OTHR',0,'',2,2,2,'',5,27,2,'NA',1,0,0,0,0,118);
INSERT INTO `category` VALUES (214,'Math 3','OTHR',0,'',3,2,3,'',5,27,3,'NA',1,0,0,0,0,119);
INSERT INTO `category` VALUES (215,'Math 4','OTHR',0,'',4,2,4,'',5,26,4,'NA',1,0,0,0,0,120);
INSERT INTO `category` VALUES (216,'Math 5','OTHR',0,'',5,2,5,'',5,26,5,'NA',1,0,0,0,0,121);
INSERT INTO `category` VALUES (217,'Mathematics 6','OTHR',0,'',6,2,6,'',5,26,6,'NA',1,0,0,0,0,122);
INSERT INTO `category` VALUES (218,'Mathematics 7','OTHR',0,'',7,2,7,'',5,26,7,'NA',1,0,0,0,0,123);
INSERT INTO `category` VALUES (219,'Mathematics 8','OTHR',0,'',0,2,8,'',5,30,0,'MID',1,0,0,0,0,124);
INSERT INTO `category` VALUES (220,'Secondary Mathematics I','OTHR',0,'',0,2,9,'',5,27,0,'MID',1,0,0,0,0,125);
INSERT INTO `category` VALUES (221,'Secondary Mathematics II','OTHR',0,'',0,2,10,'',5,26,0,'HS,AH',1,0,0,0,0,0);
INSERT INTO `category` VALUES (222,'Geometry','OTHR',0,'',0,2,11,'',5,26,0,'HS,AH',1,0,0,0,0,126);
INSERT INTO `category` VALUES (223,'Algebra','OTHR',0,'',0,2,12,'',5,26,0,'HS,AH',1,0,0,0,0,125);
INSERT INTO `category` VALUES (224,'Algebra II','OTHR',0,'',0,2,13,'',5,26,0,'MID,HS,AH',1,0,0,0,0,127);
INSERT INTO `category` VALUES (225,'Science 4','OTHR',0,'',4,3,4,'',5,27,4,'NA',1,0,0,0,0,128);
INSERT INTO `category` VALUES (226,'Science 5','OTHR',0,'',5,3,5,'',5,26,5,'NA',1,0,0,0,0,129);
INSERT INTO `category` VALUES (227,'Science 6','OTHR',0,'',6,3,6,'',5,26,6,'NA',1,0,0,0,0,130);
INSERT INTO `category` VALUES (228,'Science 7','OTHR',0,'',7,3,7,'',5,26,7,'NA',1,0,0,0,0,131);
INSERT INTO `category` VALUES (229,'Science 8','OTHR',0,'',8,3,8,'',5,26,8,'NA',1,0,0,0,0,132);
INSERT INTO `category` VALUES (230,'Earth Systems 9','OTHR',0,'',9,3,9,'',5,26,9,'MID,AH',1,0,0,0,0,133);
INSERT INTO `category` VALUES (231,'Biology','OTHR',0,'',0,3,10,'',5,26,0,'HS,AH',1,0,0,0,0,134);
INSERT INTO `category` VALUES (232,'Chemistry','OTHR',0,'',0,3,11,'',5,27,0,'HS',1,0,0,0,0,135);
INSERT INTO `category` VALUES (233,'Physics','OTHR',0,'',0,3,12,'',5,27,0,'HS',1,0,0,0,0,136);
INSERT INTO `category` VALUES (234,'Fine Arts','OTHR',0,'',0,0,0,'',5,27,0,'SEC',1,0,0,0,0,137);
INSERT INTO `category` VALUES (235,'Foreign Language','OTHR',0,'',0,0,0,'',5,27,0,'INT,MID,HS',1,0,0,0,0,138);
INSERT INTO `category` VALUES (236,'Social Studies','OTHR',0,'',0,0,0,'',5,27,0,'SEC',1,0,0,0,0,139);
INSERT INTO `category` VALUES (237,'Health / PE','OTHR',0,'',0,0,0,'',5,27,0,'SEC',1,0,0,0,0,140);
INSERT INTO `category` VALUES (238,'Career and Technology','OTHR',0,'',0,0,0,'',5,27,0,'SEC',1,0,0,0,1,141);
INSERT INTO `category` VALUES (239,'Citizenship','OTHR',0,'',0,0,0,'(Complete if applicable)',5,5,0,'NA',1,1,1,0,0,142);
INSERT INTO `category` VALUES (240,'Other','OTHR',0,'',0,0,0,'(Complete if applicable)',5,5,0,'NA',1,1,1,0,0,143);
INSERT INTO `category` VALUES (241,'Title I Plan Checklist','OTHR',1,'https://csip.washk12.org/docs/Title I Plan Checklist.pdf',0,0,0,'',5,5,0,'ELEM',0,0,0,0,1,144);
INSERT INTO `category` VALUES (242,'Trust Lands','OTHR',1,'http://www.schoollandtrust.org/',0,0,0,'',5,5,0,'NA',0,0,0,0,1,145);
INSERT INTO `category` VALUES (243,'Safety Plan','OTHR',0,'',0,0,0,'(Complete if applicable)',5,5,0,'NA',1,1,1,0,0,146);
INSERT INTO `category` VALUES (244,'Special Education','OTHR',0,'',0,0,0,'',5,27,0,'NA',1,1,1,0,0,147);
INSERT INTO `category` VALUES (245,'English Language Learners (ELL)','OTHR',0,'',0,0,0,'',5,27,0,'NA',1,1,1,0,0,148);
INSERT INTO `category` VALUES (246,'Information Literacy','OTHR',0,'',0,0,0,'',5,27,0,'704',1,0,0,0,0,149);
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-06-27 16:41:52
