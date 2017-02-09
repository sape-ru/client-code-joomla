DROP TABLE IF EXISTS `#__saperu`;

CREATE TABLE `#__saperu` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`SAPE_USER` TEXT NOT NULL,
	`links` tinyint(1) NOT NULL DEFAULT '1',
	`context` tinyint(1) NOT NULL DEFAULT '0',
	`articles` tinyint(1) NOT NULL DEFAULT '0',
	`tizer` tinyint(1) NOT NULL DEFAULT '1',
	`tizerImage` tinyint(1) NOT NULL DEFAULT '1',
	`RTB` tinyint(1) NOT NULL DEFAULT '1',
	`force_show_code` tinyint(1) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
)
ENGINE =MyISAM
AUTO_INCREMENT =1
DEFAULT CHARSET =utf8;

INSERT INTO `#__saperu` VALUES
(1, '', 1,0,0,0,6,0,0);