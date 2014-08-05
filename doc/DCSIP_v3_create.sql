CREATE TABLE `user` (
	`userid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(16) NOT NULL DEFAULT '',
	`fullname` VARCHAR(128) NOT NULL DEFAULT '',
	`email` VARCHAR(128) NOT NULL DEFAULT '',
	`password` BLOB NOT NULL,
	`salt` VARCHAR(16) NOT NULL DEFAULT 'DEADBEEF',
	`role` INT(4) UNSIGNED NOT NULL DEFAULT 0,
	`locationid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`userid`),
	KEY (`locationid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `location` (
	`locationid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`name` VARCHAR(128) NOT NULL DEFAULT '',
	`mingrade` INT(4) UNSIGNED NOT NULL DEFAULT 1,
	`maxgrade` INT(4) UNSIGNED NOT NULL DEFAULT 5,
	`loc_category` ENUM( 'ELEM', 'SEC', 'ALL', 'NA' ) NOT NULL DEFAULT 'ELEM',
	`loc_subcategory` ENUM( 'AH', 'HS', 'MID', 'INT', 'ELEM', 'NA' ) NOT NULL DEFAULT 'ELEM',
	`loc_demo` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`locationid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `year` (
	`yearid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`year_name` VARCHAR(64) NOT NULL DEFAULT '',
	`version` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`sap_due_date` VARCHAR(64) NULL DEFAULT NULL,
	`csip_due_date` VARCHAR(64) NULL DEFAULT NULL,
	`board_due_date` VARCHAR(64) NULL DEFAULT NULL,
	`district_due_date` VARCHAR(64) NULL DEFAULT NULL,
	PRIMARY KEY (`yearid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `csip` (
	`csipid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`locationid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`yearid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`csipid`),
	KEY (`locationid`),
	KEY (`yearid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `category` (
	`categoryid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`category_name` VARCHAR(64) NOT NULL DEFAULT '',
	`category_class` ENUM( 'SAP', 'CSIP', 'MAND', 'OPT', 'OTHR' ) NOT NULL DEFAULT 'OTHR',
	`category_type` INT(4) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 for Standard, 1 for Link',
	`type_target` VARCHAR(128) NOT NULL DEFAULT '',
	`category_group` INT(4) UNSIGNED NOT NULL DEFAULT 0,
	`course_group` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`course_group_order` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`category_note` TEXT NOT NULL,
	`version` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`question_group` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`gradelevel` INT(4) UNSIGNED NOT NULL DEFAULT 1,
	`loc_cat_subcat` VARCHAR(16) NOT NULL DEFAULT '',
	`needs_principal_approve` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
	`needs_community_approve` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
	`needs_district_approve` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
	`custom_goal` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
	`custom_goal_focus` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
	`parent_category` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Need this to build Previous Year Report across versions',
	PRIMARY KEY (`categoryid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `category_specifics` (
	`principal_approved` DATE NULL DEFAULT NULL,
	`community_approved` DATE NULL DEFAULT NULL,
	`district_approved` DATE NULL DEFAULT NULL,
	`categoryid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`csipid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`categoryid`,`csipid`),
	KEY (`categoryid`),
	KEY (`csipid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `location_category_links` (
       `locationid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
       `categoryid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
       PRIMARY KEY (`locationid`,`categoryid`),
       KEY (`locationid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `question` (
	`questionid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`question` TEXT NOT NULL,
	`question_group` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`part` INT(4) SIGNED NOT NULL DEFAULT 1 COMMENT 'part -1 is for goals',
	`version` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`order_num` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`type` INT(4) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1 for textarea, 2 for select, \
3 for small text, 4 for medium text, 5 for large text, 6 for password, 7 for checkbox, \
8 for multi-value, 9 for non-question (just text)',
	`question_option_group` INT(4) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`questionid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `question_options` (
	`question_option_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`question_option_group` INT(4) SIGNED NOT NULL DEFAULT 0 COMMENT 'option group -1 is for goals',
	`option_value` VARCHAR(64) NOT NULL DEFAULT '',
	`option_label` VARCHAR(128) NOT NULL DEFAULT '',
	PRIMARY KEY (`question_option_id`),
	KEY (`question_option_group`,`option_value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `answer` (
	`answerid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`answer` TEXT NOT NULL,
	`questionid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`categoryid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`csipid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`answerid`),
	KEY (`csipid`),
	UNIQUE KEY (`questionid`,`categoryid`,`csipid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `goal` (
	`goalid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`goal` TEXT NOT NULL,
	`goal_email` VARCHAR(128) NOT NULL DEFAULT '',
	`progress` TEXT NOT NULL,
	`report` TEXT NOT NULL,
	`csipid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`categoryid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`goalid`),
	KEY (`csipid`),
	KEY (`categoryid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `activity` (
	`activityid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`activity` TEXT NOT NULL,
	`focus` VARCHAR(64) NOT NULL DEFAULT '',
	`progress` TEXT NOT NULL,
	`report` TEXT NOT NULL,
	`completed` TINYINT(1) DEFAULT NULL,
	`forwarded` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`complete_date`	DATE NULL DEFAULT NULL,
	`goalid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`activityid`),
	KEY (`completed`),
	KEY (`goalid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `activity_people` (
	`activity_people_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`fullname` VARCHAR(128) NOT NULL DEFAULT '',
	`people_email` VARCHAR(128) NOT NULL DEFAULT '',
	`activityid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`activity_people_id`),
	KEY (`activityid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

