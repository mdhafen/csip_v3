insert into csip_v3.year ( yearid, year_name, version, sap_due_date, csip_due_date, board_due_date, district_due_date ) ( select _sys_period - 1154476079 ,name,1,NULL,NULL,NULL,NULL from csip.period );

insert into csip_v3.csip ( csipid, locationid, yearid ) ( select csipid, locationid, periodID - 1154476079 from csip.csip );

insert into csip_v3.category ( categoryid, category_name, category_class, category_note, version, question_group, gradelevel, loc_cat_subcat, custom_goal_focus ) ( select categoryid, name, IF( mandatory = 1 ,'MAND', 'OPT' ), '', 1, questionGroupID, gradeLevel, schoolType, 1 from csip.csip_category );

insert into csip_v3.question ( questionid, question, question_group, part, version, order_num, type, question_option_group ) ( select questionid, question, groupID, 1, 1, orderNum, boxTypeID, optionGroupID from csip.csip_question_p1 );

insert into csip_v3.question ( questionid, question, question_group, part, version, order_num, type, question_option_group ) ( select questionid + 95, question, groupID, 2, 1, orderNum, boxTypeID, optionGroupID from csip.csip_question_p2 );

insert into csip_v3.question ( questionid, question, question_group, part, version, order_num, type, question_option_group ) ( select questionid + 183, question, groupID, -1, 1, orderNum, boxTypeID, optionGroupID from csip.csip_goal_question );

update csip_v3.question set question = concat(
  substr( question, 1, locate( 'questionID=', question ) + 10 ),
  substr( question, @num1 := locate( 'questionID=', question ) + 11, 2 ) + 95,
  ' ',
  IF(
    locate( 'questionID=', @str1 := substr( question, @num1 + 2 ) ),
    concat(
      substr( @str1, 1, locate( 'questionID=', @str1 ) + 10 ),
      substr( @str1, @num2 := locate( 'questionID=', @str1 ) + 11, 2 ) + 95,
      ' ',
      IF(
        locate( 'questionID=', @str2 := substr( @str1, @num2 + 2 ) ),
        concat(
          substr( @str2, 1, locate( 'questionID=', @str2 ) + 10 ),
          substr( @str2, locate( 'questionID=', @str2 ) + 11, 2 ) + 95,
          ' ',
          substr( @str2, locate( 'questionID=', @str2 ) + 13 )
        ),
        substr( question, @num2 + 2 )
      )
    ),
    substr( question, @num1 + 2 )
  )
)
where part = -1 and question like '%[[%questionID=%';

update csip_v3.question set question = replace( question, 'csip_answer_p2', 'answer' ) where part = -1;
update csip_v3.question set question = replace( question, 'periodID=[periodID] and', '' ) where part = -1;
update csip_v3.question set question = replace( question, 'locationID=[locationID] and ', '' ) where part = -1;
update csip_v3.question set question = replace( question, 'categoryID=[categoryID]', 'categoryid=[categoryid]' ) where part = -1;
update csip_v3.question set question = replace( question, '[category]', '[category_name]' );
update csip_v3.question set question = replace( question, '[periodName]', '[year_name]' );
update csip_v3.question set question = replace( question, '[periodName-1]', '[year_name-1]' );
update csip_v3.question set question = replace( question, '[csipID]', '[csipid]' );

insert into csip_v3.question_options ( question_option_id, question_option_group, option_value, option_label ) ( select optionID, optionGroupID, optionValue, `option` from csip.csip_question_option );

insert into csip_v3.question_options ( question_option_id, question_option_group, option_value, option_label ) ( select focusID + 14, -1, name, name from csip.csip_goal_focus );
update csip_v3.question_options set option_value = 'Curriculum/Instruction', option_label = 'Curriculum/Instruction' where option_value = 'Life Skills';

insert into csip_v3.answer ( answer, questionid, categoryid, csipid ) ( select answer, questionID, categoryID, csipID from csip.csip_answer_p1 group by questionID,categoryID,csipID);

insert into csip_v3.answer ( answer, questionid, categoryid, csipid ) ( select answer, questionID + 95, categoryID, csipID from csip.csip_answer_p2 group by questionID,categoryID,csipID );

insert into csip_v3.answer ( answer, questionid, categoryid, csipid ) ( select answer, questionID + 183, categoryID, csipID from csip.csip_goal_answer group by questionID,categoryID,csipID );

insert into csip_v3.goal ( goalid, goal, goal_email, csipid, categoryid ) ( select goalID, goal, email, csipID, categoryID from csip.csip_goal );

insert into csip_v3.activity ( activityid, activity, focus, progress, report, completed, forwarded, complete_date, goalid ) ( select cga.activityID, cga.description, cgfocus.name, cga.progress, cga.report, cgt.completed, IF(cgf.activityID,1,0), from_unixtime(cgt.date), cga.goalID from csip.csip_goal_activity cga cross join csip.csip_goal ccg using (goalID) cross join csip.csip_goal_focus cgfocus using (focusID) left join csip.csip_goal_timeline cgt on cga.activityID = cgt.activityID and cga.goalID = cgt.goalID and cgt.description = 'Complete Activity' left join ( csip.csip_goal_activity cgf cross join csip.csip_goal cgfg using (goalID) ) on cga.description = cgf.description and cga.focusID = cgf.focusID and ccg.periodID - 1 = cgfg.periodID and ccg.locationID = cgfg.locationID and ccg.categoryID = cgfg.categoryID and ccg.email = cgfg.email and ccg.goal = cgfg.goal group by cga.activityID );

insert into csip_v3.activity_people ( fullname, people_email, activityid ) ( select concat_ws( ' ', fname, lname ), email, activityID from csip.csip_goal_person );

