--
-- Table structure for table `message_templates`
--

DROP TABLE IF EXISTS `message_templates`;
CREATE TABLE `message_templates` (
  `template_id` INT NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `transport` ENUM('EMail','SMS','Print') NOT NULL DEFAULT 'EMail',
  `lang` varchar(5) NOT NULL,
  `subject` varchar(200),
  `body` mediumtext,
  PRIMARY KEY (`template_id`),
  UNIQUE KEY (`code`,`transport`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `message_queue`
--

DROP TABLE IF EXISTS `message_queue`;
CREATE TABLE `message_queue` (
  `queue_id` INT NOT NULL AUTO_INCREMENT,
  `to_uid` varchar(40) NOT NULL,
  `from_uid` varchar(40) NOT NULL,
  `template_id` INT,
  `status` ENUM('pending','failed','sent','cancelled') NOT NULL DEFAULT 'pending',
  `status_metadata` mediumtext,
  `subject` varchar(200),
  `body` mediumtext,
  PRIMARY KEY (`queue_id`),
  CONSTRAINT `template_id_fk` FOREIGN KEY (`template_id`) REFERENCES `message_templates` (`template_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `user_message_settings`
--

DROP TABLE IF EXISTS `user_message_settings`;
CREATE TABLE `user_message_settings` (
  `userid` varchar(40),
  `template_id` INT NOT NULL,
  UNIQUE KEY (`userid`,`template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user` (
	`userid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(16) NOT NULL DEFAULT '',
	`fullname` VARCHAR(128) NOT NULL DEFAULT '',
	`email` VARCHAR(128) NOT NULL DEFAULT '',
	`password` BLOB NOT NULL,
	`salt` BLOB NOT NULL,
	`password_mode` VARCHAR(32) NOT NULL DEFAULT '',
	`role` INT(4) NOT NULL DEFAULT 0,
	`externalid` VARCHAR(12) NOT NULL DEFAULT '',
	PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `location` (
	`locationid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`name` VARCHAR(128) NOT NULL DEFAULT '',
	`mingrade` INT(4) NOT NULL DEFAULT 1,
	`maxgrade` INT(4) NOT NULL DEFAULT 5,
	`loc_demo` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
	`externalid` VARCHAR(12) NOT NULL DEFAULT '',
	PRIMARY KEY (`locationid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `user_location_links` (
	`userid` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`locationid` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY (`userid`,`locationid`),
	KEY `ull_userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `year` (
	`yearid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`year_name` VARCHAR(64) NOT NULL DEFAULT '',
	`version` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`due_dates` TEXT NOT NULL,
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

CREATE TABLE `course` (
	`courseid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`course_name` VARCHAR(64) NOT NULL DEFAULT '',
	`course_category` INT(10) NOT NULL DEFAULT 0,
    `for_leadership` INT(1) UNSIGNED NOT NULL DEFAULT 0,
	`active` INT(1) UNSIGNED NOT NULL DEFAULT 1,
	`min_grade` INT(4) NOT NULL DEFAULT 1,
	`max_grade` INT(4) NOT NULL DEFAULT 12,
	PRIMARY KEY (`courseid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `user_course_links` (
	`userid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`locationid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`courseid` INT(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `location_course_links` (
	`locationid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`courseid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`locationid`,`courseid`),
	KEY (`locationid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `course_external_links` (
	`courseid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`externalid` VARCHAR(12) NOT NULL DEFAULT '',
	PRIMARY KEY (`courseid`,`externalid`),
	KEY (`externalid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `course_approval` (
	`courseid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`csipid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`principal_approved` DATE NULL DEFAULT NULL,
	`principal_comment` TEXT NULL DEFAULT NULL,
	`comment_date` DATE NULL DEFAULT NULL,
	PRIMARY KEY (`courseid`,`csipid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `course_categories` (
	`categoryid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`category_name` VARCHAR(64) NOT NULL DEFAULT '',
	PRIMARY KEY (`categoryid`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;

CREATE TABLE `question` (
	`questionid` INT(10) UNSIGNED NOT NULL,
	`question` TEXT NOT NULL,
	`question_group` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`group_repeatableid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`version` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`order_num` INT(10) NOT NULL DEFAULT 0,
	`type` INT(4) NOT NULL DEFAULT 0 COMMENT '1 for textarea, 2 for select, \
3 for small text, 4 for medium text, 5 for large text, 6 for password, 7 for checkbox, \
8 for multi-value, 9 for non-question (just text)',
	`protect_answer` INT(1) NOT NULL DEFAULT 0,
	`question_option_id` INT(4) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`questionid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `question_options` (
	`question_option_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`option_group` INT(10) UNSIGNED NOT NULL DEFAULT 1,
	`option_value` VARCHAR(64) NOT NULL DEFAULT '',
	`option_label` VARCHAR(128) NOT NULL DEFAULT '',
	PRIMARY KEY (`question_option_id`),
	KEY (`option_group`,`option_value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `course_question_links` (
	`courseid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`question_group` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`part` INT(4) NOT NULL DEFAULT 0,
	`title` VARCHAR(64) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `csip_extra_part_links` (
	`csipid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`courseid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`question_group` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`part` INT(4) NOT NULL DEFAULT 0,
	`title` VARCHAR(64) NOT NULL DEFAULT '',
	UNIQUE KEY `unique_parts` (csipid,courseid,part)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `answer_group_sequence` (
	`csipid` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`courseid` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`part` INT(4) NOT NULL DEFAULT '0',
	`group_repeatableid` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`sequence_value` INT(10) UNSIGNED NOT NULL DEFAULT '1',
	PRIMARY KEY (`csipid`,`courseid`,`part`,`group_repeatableid`)
) ENGINE MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `answer` (
	`answerid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`answer` TEXT NOT NULL,
	`csipid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`courseid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`questionid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	`part` INT(4) NOT NULL DEFAULT 0,
	`group_sequence` INT(10) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`answerid`),
	KEY (`csipid`),
	UNIQUE KEY `unique_answers` (csipid,courseid,part,questionid,group_sequence)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
