-- Adminer 4.5.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `sdmp_assessment`;
CREATE TABLE `sdmp_assessment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_program` bigint(20) NOT NULL,
  `number` varchar(64) NOT NULL,
  `year` varchar(16) DEFAULT '',
  `position` varchar(125) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `room` varchar(16) NOT NULL,
  `type` varchar(16) NOT NULL,
  `status` varchar(16) NOT NULL DEFAULT '0',
  `id_moderator` bigint(20) NOT NULL,
  `datecreated` datetime NOT NULL,
  `datemodified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_assessment` (`id`, `id_program`, `number`, `year`, `position`, `date`, `time`, `room`, `type`, `status`, `id_moderator`, `datecreated`, `datemodified`) VALUES
(93,	51,	'nlgd1',	'2018',	'3',	'2018-02-26',	'17:55:00',	'w',	'1',	'2',	1,	'2018-02-06 17:54:01',	'2018-02-06 18:01:12'),
(94,	51,	'nwwc1',	'2018',	'3',	'2018-02-26',	'17:55:00',	'Rr',	'2',	'2',	1,	'2018-02-06 17:54:29',	'2018-02-06 18:04:37'),
(95,	51,	'nwwc1pr',	'2018',	'3',	'2018-02-20',	'17:55:00',	'rr',	'2',	'1',	1,	'2018-02-06 17:54:59',	'2018-02-06 18:00:39')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `id_program` = VALUES(`id_program`), `number` = VALUES(`number`), `year` = VALUES(`year`), `position` = VALUES(`position`), `date` = VALUES(`date`), `time` = VALUES(`time`), `room` = VALUES(`room`), `type` = VALUES(`type`), `status` = VALUES(`status`), `id_moderator` = VALUES(`id_moderator`), `datecreated` = VALUES(`datecreated`), `datemodified` = VALUES(`datemodified`);

DROP TABLE IF EXISTS `sdmp_assessment_data`;
CREATE TABLE `sdmp_assessment_data` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_assessment` bigint(20) NOT NULL,
  `id_registration` bigint(20) NOT NULL,
  `id_assessor` bigint(20) NOT NULL,
  `status` varchar(16) NOT NULL DEFAULT '0',
  `seat_number` varchar(16) NOT NULL,
  `datecreated` datetime NOT NULL,
  `datemodified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_assessment_data` (`id`, `id_assessment`, `id_registration`, `id_assessor`, `status`, `seat_number`, `datecreated`, `datemodified`) VALUES
(31,	93,	141,	1,	'2',	'1',	'2018-02-06 17:54:01',	'2018-02-06 18:04:37'),
(32,	93,	142,	2,	'2',	'2',	'2018-02-06 17:54:01',	'2018-02-06 18:04:37'),
(33,	94,	141,	1,	'2',	'1',	'2018-02-06 17:54:29',	'2018-02-06 18:04:37'),
(34,	94,	141,	2,	'2',	'1',	'2018-02-06 17:54:29',	'2018-02-06 18:04:37'),
(35,	95,	142,	1,	'2',	'1',	'2018-02-06 17:54:59',	'2018-02-06 18:04:37'),
(36,	95,	142,	2,	'2',	'1',	'2018-02-06 17:54:59',	'2018-02-06 18:04:37')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `id_assessment` = VALUES(`id_assessment`), `id_registration` = VALUES(`id_registration`), `id_assessor` = VALUES(`id_assessor`), `status` = VALUES(`status`), `seat_number` = VALUES(`seat_number`), `datecreated` = VALUES(`datecreated`), `datemodified` = VALUES(`datemodified`);

DROP TABLE IF EXISTS `sdmp_assessment_program`;
CREATE TABLE `sdmp_assessment_program` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(125) NOT NULL,
  `number` varchar(125) NOT NULL,
  `title` varchar(125) NOT NULL,
  `position` varchar(125) NOT NULL,
  `year` year(4) NOT NULL,
  `datestart` date NOT NULL,
  `dateend` date NOT NULL,
  `created_by` varchar(64) NOT NULL,
  `doc_upload` varchar(1) NOT NULL COMMENT '0=enable,1=disable',
  `uploadstart` date NOT NULL,
  `uploadend` date NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT '0',
  `tools` varchar(150) NOT NULL,
  `datecreated` datetime NOT NULL,
  `datemodified` datetime NOT NULL,
  `id_lead` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_assessment_program` (`id`, `type`, `number`, `title`, `position`, `year`, `datestart`, `dateend`, `created_by`, `doc_upload`, `uploadstart`, `uploadend`, `status`, `tools`, `datecreated`, `datemodified`, `id_lead`) VALUES
(51,	'',	'2222',	'programassessment',	'3',	'2018',	'2018-02-12',	'2018-02-12',	'admin1',	'0',	'2018-02-12',	'2018-02-12',	'0',	'',	'2018-02-06 17:53:22',	'2018-02-06 17:53:22',	1)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `type` = VALUES(`type`), `number` = VALUES(`number`), `title` = VALUES(`title`), `position` = VALUES(`position`), `year` = VALUES(`year`), `datestart` = VALUES(`datestart`), `dateend` = VALUES(`dateend`), `created_by` = VALUES(`created_by`), `doc_upload` = VALUES(`doc_upload`), `uploadstart` = VALUES(`uploadstart`), `uploadend` = VALUES(`uploadend`), `status` = VALUES(`status`), `tools` = VALUES(`tools`), `datecreated` = VALUES(`datecreated`), `datemodified` = VALUES(`datemodified`), `id_lead` = VALUES(`id_lead`);

DROP TABLE IF EXISTS `sdmp_assessment_report`;
CREATE TABLE `sdmp_assessment_report` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_assessment_data` bigint(20) NOT NULL,
  `note_assesse` longtext NOT NULL,
  `note_assesse_other` longtext NOT NULL,
  `notes` longtext NOT NULL,
  `datecreated` datetime NOT NULL,
  `datemodified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_assessment_report` (`id`, `id_assessment_data`, `note_assesse`, `note_assesse_other`, `notes`, `datecreated`, `datemodified`) VALUES
(17,	18,	'note 1 untuk dari assessor 1 ',	'a:1:{i:2;s:28:\"note 1 untuk dari assessor 2\";}',	'',	'2018-02-05 11:18:34',	'2018-02-05 11:18:34'),
(18,	19,	'note 1 untuk dari assessor 2',	'a:1:{i:1;s:28:\"note 1 untuk dari assessor 2\";}',	'',	'2018-02-05 11:20:55',	'2018-02-05 11:20:55'),
(19,	20,	'',	'',	'ssafasfasfsafsa',	'2018-02-05 13:59:20',	'2018-02-05 13:59:20'),
(20,	21,	'',	'',	'fdsadfdsafafasdfasfasfsaf',	'2018-02-05 14:00:00',	'2018-02-05 14:00:00'),
(21,	25,	'note assesse 1 untuk assesornya Peserta 50386 note assesse 1 untuk assesornya Peserta 50386 note assesse 1 untuk assesornya Peserta 50386 note assesse 1 untuk assesornya Peserta 50386 note assesse 1 untuk assesornya Peserta 50386 note assesse 1 untuk assesornya Peserta 50386 ',	'a:1:{i:2;s:216:\"note assesse 1 untuk  Peserta 50378 note assesse 1 untuk  Peserta 50378 note assesse 1 untuk  Peserta 50378 note assesse 1 untuk  Peserta 50378 note assesse 1 untuk  Peserta 50378 note assesse 1 untuk  Peserta 50378 \";}',	'',	'2018-02-06 17:40:43',	'2018-02-06 17:40:43'),
(22,	29,	'',	'',	'note assesse 1 untuk  Peserta 38375 note assesse 1 untuk  Peserta 38375 note assesse 1 untuk  Peserta 38375 note assesse 1 untuk  Peserta 38375 note assesse 1 untuk  Peserta 38375 note assesse 1 untuk  Peserta 38375 note assesse 1 untuk  Peserta 38375 note assesse 1 untuk  Peserta 38375 note assesse 1 untuk  Peserta 38375 note assesse 1 untuk  Peserta 38375 note assesse 1 untuk  Peserta 38375 note assesse 1 untuk  Peserta 38375 ',	'2018-02-06 17:41:26',	'2018-02-06 17:41:26'),
(23,	27,	'',	'',	'note assesse 1 untuk  Peserta 38367note assesse 1 untuk  Peserta 38367note assesse 1 untuk  Peserta 38367note assesse 1 untuk  Peserta 38367',	'2018-02-06 17:42:08',	'2018-02-06 17:42:08'),
(24,	30,	'',	'',	'note assesse 2 untuk  Peserta 38375 note assesse 2 untuk  Peserta 38375 note assesse 2 untuk  Peserta 38375 note assesse 2 untuk  Peserta 38375 note assesse 2 untuk  Peserta 38375 note assesse 2 untuk  Peserta 38375 ',	'2018-02-06 17:42:53',	'2018-02-06 17:42:53'),
(25,	26,	'note assesse 2 untuk  Peserta 50378 ',	'a:1:{i:1;s:36:\"note assesse 2 untuk  Peserta 50378 \";}',	'',	'2018-02-06 17:43:31',	'2018-02-06 17:43:31'),
(26,	32,	'note assessor 2 Peserta 51354 note assessor 2 Peserta 51354 note assessor 2 Peserta 51354 note assessor 2 Peserta 51354 note assessor 2 Peserta 51354 note assessor 2 Peserta 51354 ',	'a:1:{i:1;s:180:\"note assessor 2 Peserta 51327 note assessor 2 Peserta 51327 note assessor 2 Peserta 51327 note assessor 2 Peserta 51327 note assessor 2 Peserta 51327 note assessor 2 Peserta 51327 \";}',	'',	'2018-02-06 17:57:15',	'2018-02-06 17:57:15'),
(27,	34,	'',	'',	'note assessor 2 PesertaPeserta 51327note assessor 2 note assessor 2 PesertaPeserta 51327note assessor 2 note assessor 2 PesertaPeserta 51327note assessor 2 ',	'2018-02-06 17:57:53',	'2018-02-06 17:57:53'),
(28,	36,	'',	'',	'note assessor 2 PesertaPeserta 51327note assessor 2 Peserta 51327',	'2018-02-06 17:58:18',	'2018-02-06 17:58:18'),
(29,	31,	'assessor 1 Peserta 51327',	'a:1:{i:2;s:24:\"assessor 1 Peserta 51327\";}',	'',	'2018-02-06 17:58:56',	'2018-02-06 17:58:56'),
(30,	33,	'',	'',	'assessor 1 Peserta 51327assessor 1 Peserta 51327',	'2018-02-06 17:59:52',	'2018-02-06 17:59:52'),
(31,	35,	'',	'',	'assessor 1 Peserta 51354',	'2018-02-06 18:00:39',	'2018-02-06 18:00:39')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `id_assessment_data` = VALUES(`id_assessment_data`), `note_assesse` = VALUES(`note_assesse`), `note_assesse_other` = VALUES(`note_assesse_other`), `notes` = VALUES(`notes`), `datecreated` = VALUES(`datecreated`), `datemodified` = VALUES(`datemodified`);

DROP TABLE IF EXISTS `sdmp_assessment_report_data`;
CREATE TABLE `sdmp_assessment_report_data` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_assessment` bigint(20) NOT NULL,
  `id_assessment_data` bigint(20) NOT NULL,
  `id_competence` bigint(20) NOT NULL,
  `level` bigint(20) NOT NULL,
  `evidence` longtext NOT NULL,
  `datecreated` datetime NOT NULL,
  `datemodified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_assessment_report_data` (`id`, `id_assessment`, `id_assessment_data`, `id_competence`, `level`, `evidence`, `datecreated`, `datemodified`) VALUES
(31,	86,	18,	1,	4,	'note 1 untuk dari assessor 1 ',	'2018-02-05 11:18:34',	'2018-02-05 11:18:34'),
(32,	86,	18,	4,	4,	'note 1 untuk dari assessor 1 ',	'2018-02-05 11:18:34',	'2018-02-05 11:18:34'),
(33,	86,	18,	17,	3,	'note 1 untuk dari assessor 1 ',	'2018-02-05 11:18:34',	'2018-02-05 11:18:34'),
(34,	86,	19,	1,	3,	'note 1 untuk dari assessor 2',	'2018-02-05 11:20:55',	'2018-02-05 11:20:55'),
(35,	86,	19,	4,	1,	'note 1 untuk dari assessor 2',	'2018-02-05 11:20:55',	'2018-02-05 11:20:55'),
(36,	86,	19,	17,	5,	'note 1 untuk dari assessor 2',	'2018-02-05 11:20:55',	'2018-02-05 11:20:55'),
(37,	87,	20,	1,	5,	'afafasfsasa',	'2018-02-05 13:59:20',	'2018-02-05 13:59:20'),
(38,	87,	20,	4,	5,	'afafasfsasaafafasfsasa',	'2018-02-05 13:59:20',	'2018-02-05 13:59:20'),
(39,	87,	20,	17,	5,	'afafasfsasa',	'2018-02-05 13:59:20',	'2018-02-05 13:59:20'),
(40,	87,	21,	1,	4,	'dsafafasfsasaafafasfsasaafafasfsasa',	'2018-02-05 14:00:00',	'2018-02-05 14:00:00'),
(41,	87,	21,	4,	4,	'afafasfsasaafafasfsasaafafasfsasa',	'2018-02-05 14:00:00',	'2018-02-05 14:00:00'),
(42,	87,	21,	17,	4,	'afafasfsasaafafasfsasaafafasfsasaafafasfsasa',	'2018-02-05 14:00:00',	'2018-02-05 14:00:00'),
(43,	90,	25,	1,	2,	'note assesse 1 untuk  Peserta 50378 ',	'2018-02-06 17:40:43',	'2018-02-06 17:40:43'),
(44,	90,	25,	4,	4,	'note assesse 1 untuk  Peserta 50378 ',	'2018-02-06 17:40:43',	'2018-02-06 17:40:43'),
(45,	90,	25,	17,	3,	'note assesse 1 untuk  Peserta 50378 ',	'2018-02-06 17:40:43',	'2018-02-06 17:40:43'),
(46,	92,	29,	1,	3,	'note assesse 1 untuk  Peserta 38375 ',	'2018-02-06 17:41:26',	'2018-02-06 17:41:26'),
(47,	92,	29,	4,	3,	'note assesse 1 untuk  Peserta 38375 ',	'2018-02-06 17:41:26',	'2018-02-06 17:41:26'),
(48,	92,	29,	17,	2,	'note assesse 1 untuk  Peserta 38375 ',	'2018-02-06 17:41:26',	'2018-02-06 17:41:26'),
(49,	91,	27,	1,	3,	'note assesse 1 untuk  Peserta 38367',	'2018-02-06 17:42:08',	'2018-02-06 17:42:08'),
(50,	91,	27,	4,	2,	'note assesse 1 untuk  Peserta 38367',	'2018-02-06 17:42:08',	'2018-02-06 17:42:08'),
(51,	91,	27,	17,	2,	'note assesse 1 untuk  Peserta 38367',	'2018-02-06 17:42:08',	'2018-02-06 17:42:08'),
(52,	92,	30,	1,	3,	'note assesse 2 untuk  Peserta 38375 ',	'2018-02-06 17:42:53',	'2018-02-06 17:42:53'),
(53,	92,	30,	4,	2,	'note assesse 2 untuk  Peserta 38375 ',	'2018-02-06 17:42:53',	'2018-02-06 17:42:53'),
(54,	92,	30,	17,	5,	'note assesse 2 untuk  Peserta 38375 ',	'2018-02-06 17:42:53',	'2018-02-06 17:42:53'),
(55,	90,	26,	1,	3,	'note assesse 2 untuk  Peserta 50378 ',	'2018-02-06 17:43:31',	'2018-02-06 17:43:31'),
(56,	90,	26,	4,	2,	'note assesse 2 untuk  Peserta 50378 ',	'2018-02-06 17:43:31',	'2018-02-06 17:43:31'),
(57,	90,	26,	17,	5,	'note assesse 2 untuk  Peserta 50378 ',	'2018-02-06 17:43:31',	'2018-02-06 17:43:31'),
(58,	93,	32,	1,	2,	'note assessor 2 Peserta 51354 note assessor 2',	'2018-02-06 17:57:15',	'2018-02-06 17:57:15'),
(59,	93,	32,	4,	2,	'note assessor 2 Peserta 51354 note assessor 2',	'2018-02-06 17:57:15',	'2018-02-06 17:57:15'),
(60,	93,	32,	17,	2,	'note assessor 2 Peserta 51354 note assessor 2',	'2018-02-06 17:57:15',	'2018-02-06 17:57:15'),
(61,	94,	34,	1,	2,	'note assessor 2 PesertaPeserta 51327note assessor 2 ',	'2018-02-06 17:57:53',	'2018-02-06 17:57:53'),
(62,	94,	34,	4,	2,	'note assessor 2 PesertaPeserta 51327note assessor 2 ',	'2018-02-06 17:57:53',	'2018-02-06 17:57:53'),
(63,	94,	34,	17,	2,	'note assessor 2 PesertaPeserta 51327note assessor 2 ',	'2018-02-06 17:57:53',	'2018-02-06 17:57:53'),
(64,	95,	36,	1,	3,	'Peserta 51327',	'2018-02-06 17:58:18',	'2018-02-06 17:58:18'),
(65,	95,	36,	4,	2,	'Peserta 51327',	'2018-02-06 17:58:18',	'2018-02-06 17:58:18'),
(66,	95,	36,	17,	2,	'Peserta 51327',	'2018-02-06 17:58:18',	'2018-02-06 17:58:18'),
(67,	93,	31,	1,	3,	'assessor 1 Peserta 51327',	'2018-02-06 17:58:56',	'2018-02-06 17:58:56'),
(68,	93,	31,	4,	2,	'assessor 1 Peserta 51327',	'2018-02-06 17:58:56',	'2018-02-06 17:58:56'),
(69,	93,	31,	17,	3,	'assessor 1 Peserta 51327',	'2018-02-06 17:58:56',	'2018-02-06 17:58:56'),
(70,	94,	33,	1,	4,	'assessor 1 Peserta 51327',	'2018-02-06 17:59:52',	'2018-02-06 17:59:52'),
(71,	94,	33,	4,	2,	'assessor 1 Peserta 51327',	'2018-02-06 17:59:52',	'2018-02-06 17:59:52'),
(72,	94,	33,	17,	4,	'assessor 1 Peserta 51327',	'2018-02-06 17:59:52',	'2018-02-06 17:59:52'),
(73,	95,	35,	1,	3,	'Peserta 51354',	'2018-02-06 18:00:39',	'2018-02-06 18:00:39'),
(74,	95,	35,	4,	1,	'Peserta 51354',	'2018-02-06 18:00:39',	'2018-02-06 18:00:39'),
(75,	95,	35,	17,	5,	'Peserta 51354',	'2018-02-06 18:00:39',	'2018-02-06 18:00:39')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `id_assessment` = VALUES(`id_assessment`), `id_assessment_data` = VALUES(`id_assessment_data`), `id_competence` = VALUES(`id_competence`), `level` = VALUES(`level`), `evidence` = VALUES(`evidence`), `datecreated` = VALUES(`datecreated`), `datemodified` = VALUES(`datemodified`);

DROP TABLE IF EXISTS `sdmp_assessment_report_final`;
CREATE TABLE `sdmp_assessment_report_final` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_program` bigint(20) NOT NULL,
  `id_lead` bigint(20) NOT NULL,
  `id_registration` bigint(20) NOT NULL,
  `note_assesse` longtext NOT NULL,
  `note_assesse_other` longtext NOT NULL,
  `notes` longtext NOT NULL,
  `datecreated` datetime NOT NULL,
  `datemodified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_assessment_report_final` (`id`, `id_program`, `id_lead`, `id_registration`, `note_assesse`, `note_assesse_other`, `notes`, `datecreated`, `datemodified`) VALUES
(5,	38,	1,	63,	'',	'',	'',	'2018-02-05 16:01:16',	'2018-02-05 16:01:16'),
(6,	38,	1,	64,	'',	'',	'',	'2018-02-05 16:40:32',	'2018-02-05 16:40:32'),
(7,	51,	1,	141,	'',	'',	'',	'2018-02-06 18:06:40',	'2018-02-06 18:06:40'),
(8,	51,	1,	142,	'',	'',	'',	'2018-02-06 18:06:57',	'2018-02-06 18:06:57')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `id_program` = VALUES(`id_program`), `id_lead` = VALUES(`id_lead`), `id_registration` = VALUES(`id_registration`), `note_assesse` = VALUES(`note_assesse`), `note_assesse_other` = VALUES(`note_assesse_other`), `notes` = VALUES(`notes`), `datecreated` = VALUES(`datecreated`), `datemodified` = VALUES(`datemodified`);

DROP TABLE IF EXISTS `sdmp_assessment_report_final_data`;
CREATE TABLE `sdmp_assessment_report_final_data` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_report_final` bigint(20) NOT NULL,
  `id_competence` bigint(20) NOT NULL,
  `level` bigint(20) NOT NULL,
  `evidence` longtext NOT NULL,
  `datecreated` datetime NOT NULL,
  `datemodified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_assessment_report_final_data` (`id`, `id_report_final`, `id_competence`, `level`, `evidence`, `datecreated`, `datemodified`) VALUES
(4,	5,	1,	3,	'fsdfdsfsdf',	'2018-02-05 16:01:16',	'2018-02-05 16:01:16'),
(5,	5,	4,	3,	'sdfdsf',	'2018-02-05 16:01:16',	'2018-02-05 16:01:16'),
(6,	5,	17,	3,	'dsfdsfdsfds',	'2018-02-05 16:01:16',	'2018-02-05 16:01:16'),
(7,	6,	1,	4,	'cassadasd',	'2018-02-05 16:40:32',	'2018-02-05 16:40:32'),
(8,	6,	4,	1,	'sdsadas',	'2018-02-05 16:40:32',	'2018-02-05 16:40:32'),
(9,	6,	17,	4,	'sdsad',	'2018-02-05 16:40:32',	'2018-02-05 16:40:32'),
(10,	7,	1,	4,	'',	'2018-02-06 18:06:40',	'2018-02-06 18:06:40'),
(11,	7,	4,	4,	'',	'2018-02-06 18:06:40',	'2018-02-06 18:06:40'),
(12,	7,	17,	4,	'',	'2018-02-06 18:06:40',	'2018-02-06 18:06:40'),
(13,	8,	1,	4,	'',	'2018-02-06 18:06:57',	'2018-02-06 18:06:57'),
(14,	8,	4,	4,	'',	'2018-02-06 18:06:57',	'2018-02-06 18:06:57'),
(15,	8,	17,	3,	'',	'2018-02-06 18:06:57',	'2018-02-06 18:06:57')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `id_report_final` = VALUES(`id_report_final`), `id_competence` = VALUES(`id_competence`), `level` = VALUES(`level`), `evidence` = VALUES(`evidence`), `datecreated` = VALUES(`datecreated`), `datemodified` = VALUES(`datemodified`);

DROP TABLE IF EXISTS `sdmp_assessment_report_tool`;
CREATE TABLE `sdmp_assessment_report_tool` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_program` bigint(20) NOT NULL,
  `id_assessment` bigint(20) NOT NULL,
  `id_moderator` bigint(20) NOT NULL,
  `id_registration` bigint(20) NOT NULL,
  `id_assessment_data` bigint(20) DEFAULT NULL,
  `note_assesse` longtext NOT NULL,
  `note_assesse_other` longtext NOT NULL,
  `notes` longtext NOT NULL,
  `datecreated` datetime NOT NULL,
  `datemodified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_assessment_report_tool` (`id`, `id_program`, `id_assessment`, `id_moderator`, `id_registration`, `id_assessment_data`, `note_assesse`, `note_assesse_other`, `notes`, `datecreated`, `datemodified`) VALUES
(8,	38,	86,	1,	63,	NULL,	'',	's:0:\"\";',	'',	'2018-02-05 11:25:32',	'2018-02-05 11:25:32'),
(9,	38,	86,	1,	64,	NULL,	'',	's:0:\"\";',	'',	'2018-02-05 11:25:45',	'2018-02-05 11:25:45'),
(10,	38,	87,	1,	63,	NULL,	'',	'',	'',	'2018-02-05 14:02:27',	'2018-02-05 14:02:27'),
(11,	38,	92,	1,	64,	NULL,	'',	'',	'',	'2018-02-06 17:45:35',	'2018-02-06 17:45:35'),
(12,	51,	93,	1,	141,	NULL,	'',	's:0:\"\";',	'',	'2018-02-06 18:01:02',	'2018-02-06 18:01:02'),
(13,	51,	93,	1,	142,	NULL,	'',	's:0:\"\";',	'',	'2018-02-06 18:01:12',	'2018-02-06 18:01:12'),
(14,	51,	94,	1,	141,	NULL,	'',	'',	'',	'2018-02-06 18:04:37',	'2018-02-06 18:04:37')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `id_program` = VALUES(`id_program`), `id_assessment` = VALUES(`id_assessment`), `id_moderator` = VALUES(`id_moderator`), `id_registration` = VALUES(`id_registration`), `id_assessment_data` = VALUES(`id_assessment_data`), `note_assesse` = VALUES(`note_assesse`), `note_assesse_other` = VALUES(`note_assesse_other`), `notes` = VALUES(`notes`), `datecreated` = VALUES(`datecreated`), `datemodified` = VALUES(`datemodified`);

DROP TABLE IF EXISTS `sdmp_assessment_report_tool_data`;
CREATE TABLE `sdmp_assessment_report_tool_data` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_report_tool` bigint(20) NOT NULL,
  `id_assessment` bigint(20) NOT NULL,
  `id_assessment_data` bigint(20) DEFAULT NULL,
  `id_competence` bigint(20) NOT NULL,
  `level` bigint(20) NOT NULL,
  `evidence` longtext NOT NULL,
  `datecreated` datetime NOT NULL,
  `datemodified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_assessment_report_tool_data` (`id`, `id_report_tool`, `id_assessment`, `id_assessment_data`, `id_competence`, `level`, `evidence`, `datecreated`, `datemodified`) VALUES
(15,	8,	86,	18,	1,	1,	'id_program',	'2018-02-05 11:25:32',	'2018-02-05 11:25:32'),
(16,	8,	86,	18,	4,	1,	'id_program',	'2018-02-05 11:25:32',	'2018-02-05 11:25:32'),
(17,	8,	86,	18,	17,	1,	'id_program',	'2018-02-05 11:25:32',	'2018-02-05 11:25:32'),
(18,	9,	86,	19,	1,	3,	'id_program',	'2018-02-05 11:25:45',	'2018-02-05 11:25:45'),
(19,	9,	86,	19,	4,	4,	'id_program',	'2018-02-05 11:25:45',	'2018-02-05 11:25:45'),
(20,	9,	86,	19,	17,	3,	'id_program',	'2018-02-05 11:25:45',	'2018-02-05 11:25:45'),
(21,	10,	87,	20,	1,	3,	'dsafdsafasf',	'2018-02-05 14:02:27',	'2018-02-05 14:02:27'),
(22,	10,	87,	20,	4,	4,	'afasfasfdsaf',	'2018-02-05 14:02:27',	'2018-02-05 14:02:27'),
(23,	10,	87,	20,	17,	5,	'fsafsafsafsafs',	'2018-02-05 14:02:27',	'2018-02-05 14:02:27'),
(24,	11,	92,	29,	1,	3,	'',	'2018-02-06 17:45:35',	'2018-02-06 17:45:35'),
(25,	11,	92,	29,	4,	3,	'',	'2018-02-06 17:45:35',	'2018-02-06 17:45:35'),
(26,	11,	92,	29,	17,	4,	'',	'2018-02-06 17:45:35',	'2018-02-06 17:45:35'),
(27,	12,	93,	31,	1,	4,	'',	'2018-02-06 18:01:02',	'2018-02-06 18:01:02'),
(28,	12,	93,	31,	4,	5,	'',	'2018-02-06 18:01:02',	'2018-02-06 18:01:02'),
(29,	12,	93,	31,	17,	3,	'',	'2018-02-06 18:01:02',	'2018-02-06 18:01:02'),
(30,	13,	93,	32,	1,	2,	'',	'2018-02-06 18:01:12',	'2018-02-06 18:01:12'),
(31,	13,	93,	32,	4,	3,	'',	'2018-02-06 18:01:12',	'2018-02-06 18:01:12'),
(32,	13,	93,	32,	17,	3,	'',	'2018-02-06 18:01:12',	'2018-02-06 18:01:12'),
(33,	14,	94,	34,	1,	3,	'',	'2018-02-06 18:04:37',	'2018-02-06 18:04:37'),
(34,	14,	94,	34,	4,	4,	'',	'2018-02-06 18:04:37',	'2018-02-06 18:04:37'),
(35,	14,	94,	34,	17,	4,	'',	'2018-02-06 18:04:37',	'2018-02-06 18:04:37')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `id_report_tool` = VALUES(`id_report_tool`), `id_assessment` = VALUES(`id_assessment`), `id_assessment_data` = VALUES(`id_assessment_data`), `id_competence` = VALUES(`id_competence`), `level` = VALUES(`level`), `evidence` = VALUES(`evidence`), `datecreated` = VALUES(`datecreated`), `datemodified` = VALUES(`datemodified`);

DROP TABLE IF EXISTS `sdmp_assessment_type`;
CREATE TABLE `sdmp_assessment_type` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `shortname` varchar(16) NOT NULL,
  `form_type` varchar(16) NOT NULL,
  `max_participant` varchar(16) NOT NULL,
  `max_assessor` varchar(16) NOT NULL,
  `lead_assessor` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_assessment_type` (`id`, `name`, `shortname`, `form_type`, `max_participant`, `max_assessor`, `lead_assessor`) VALUES
(1,	'Leaderless Group Discussion',	'lgd',	'1',	'7',	'8',	'1'),
(2,	'Wawancara',	'wawancara',	'2',	'1',	'3',	'0'),
(3,	'Games',	'games',	'2',	'1',	'3',	'0'),
(4,	'Intray',	'intray',	'2',	'7',	'8',	'1'),
(5,	'Presentasi',	'presentasi',	'1',	'1',	'3',	'0'),
(6,	'Role Play',	'roleplay',	'1',	'1',	'3',	'0')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `shortname` = VALUES(`shortname`), `form_type` = VALUES(`form_type`), `max_participant` = VALUES(`max_participant`), `max_assessor` = VALUES(`max_assessor`), `lead_assessor` = VALUES(`lead_assessor`);

DROP TABLE IF EXISTS `sdmp_assessor`;
CREATE TABLE `sdmp_assessor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(125) NOT NULL,
  `rank` varchar(125) NOT NULL,
  `position` varchar(125) NOT NULL,
  `email` varchar(125) NOT NULL,
  `username` varchar(125) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_assessor` (`id`, `name`, `rank`, `position`, `email`, `username`) VALUES
(1,	'Assessor 1',	'pangkat1',	'jabatan1',	'admin@sdmpolri.virtueable.com',	'assessor1'),
(2,	'Assessor 2',	'pangkat2',	'jabatan2',	'posma.ferdinan@gmail.com',	'assessor2'),
(3,	'Assessor 3',	'pangkat3',	'jabatan3',	'assessor3@admin.com',	'assessor3'),
(4,	'Assessor 4',	'pangkat4',	'jabatan4',	'assessor4@admin.com',	'assessor4'),
(6,	'Assessor 5',	'pangkat5',	'jabatan5',	'assessor5@admin.com',	'assessor5'),
(7,	'Assessor 6',	'pangkat6',	'jabatan6',	'assessor6@admin.com',	'assessor6')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `rank` = VALUES(`rank`), `position` = VALUES(`position`), `email` = VALUES(`email`), `username` = VALUES(`username`);

DROP TABLE IF EXISTS `sdmp_competence`;
CREATE TABLE `sdmp_competence` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) NOT NULL,
  `name_short` varchar(64) NOT NULL,
  `definition` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_competence` (`id`, `name`, `name_short`, `definition`) VALUES
(1,	'Berpikir Analitis',	'BA',	'Definisi<br>\r\nKemampuan berpikir secara sistematis yang dimulai dari mengenali, memilah unsur pembentuk kondisi dan melihat keterkaitan masing-masing unsur pembentuk kondisi tersebut, serta kemampuan melihat hubungan sebab-akibat dalam rangka mengenali unsur utama pembentuk kondisi.<br><br>Perilaku kunci:<br><ul><li>mengenali unsur-unsur pembentuk kondisi;</li><li>menentukan hubungan sebab akibat antar unsur; dan</li><li>menentukan unsur utama pembentuk kondisi.\r\n</li></ul>'),
(2,	'Berpikir Konseptual ',	'BK',	'<span>Definisi :<br></span>Kemampuan\r\nuntuk mengenali pola hubungan dari berbagai kondisi dengan cara melihat keterkaitan\r\nunsur pembentuk masing-masing kondisi tersebut menjadi sesuatu pola pandang\r\nbaru yang lebih mudah dipahami.<br><br><span>Perilaku kunci :<br></span><ul><li>mengenali pola hubungan yang jelas;</li><li>mengenali pola hubungan yang ambigius; dan</li><li>menciptakan pola pandang baru.</li></ul>'),
(3,	'Berpikir Strategik',	'BS',	'<span>Definisi :<br></span><span>Kemampuan melihat secara komprehensif peluang dan\r\nkendala di masa yang akan datang serta mampu merumuskan pemikiran tersebut ke\r\ndalam tujuan-tujuan yang merefleksikan kebutuhan organisasi di masa datang\r\nsecara jelas, terukur dan dapat diwujudkan (realistis).<br></span><br><span>Perilaku kunci :<br></span><ul><li><span><span>berpikir komprehensif identifikasi peluang dan hambatan;</span></span></li><li><span>menemukan ide-ide strategis; dan</span></li><li><span><span>mengembangkan tujuan/visi jangka panjang.</span></span></li></ul>'),
(4,	'Integritas',	'I',	'Definisi :<br>Kemampuan untuk bertindak dan bersikap secara terbuka dan transparan dengan tetap memegang rahasia sesuai dengan nilai-nilai dan etika kerja yang berlaku di dalam organisasi, tegas dalam menerapkan prinsip dan nilai yang berlaku sebagai bentuk sikap dan perilaku  yang konsisten  terhadap apa yang diyakini sesuai dengan nilai-nilai organisasi (walk the talk).<br><br>Perilaku kunci :<br><ul><li>bersikap terbuka terhadap apa yang diyakini benar sesuai dengan nilai-nilai positif di organisasi;</li><li>berani menyatakan secara terbuka dan tegas terhadap ketidaketisan terhadap pihak lain; dan</li><li>mendorong pihak lain untuk bersikap dan bertindak sesuai dengan etika organisasi.</li></ul>'),
(17,	'Komunikasi ',	'K',	'<span>Definisi :<br></span>Kemampuan menyampaikan pendapat/ide/informasi dengan\r\nmenggunakan cara yang mudah dimengerti. <br><br>P<span>erilaku kunci :<br></span><ul><li>Mampu berkomunikasi lisan yang mudah dimengerti</li></ul>')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `name_short` = VALUES(`name_short`), `definition` = VALUES(`definition`);

DROP TABLE IF EXISTS `sdmp_competence_level`;
CREATE TABLE `sdmp_competence_level` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_competence` bigint(20) NOT NULL,
  `level` int(20) NOT NULL,
  `title` text NOT NULL,
  `definition` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_competence_level` (`id`, `id_competence`, `level`, `title`, `definition`) VALUES
(1,	1,	1,	'Mengenali adanya abnormalitas dari sebuah kondisi.',	'<ul><li>Mengenali adanya sebuah kondisi (event) yang berbeda dari biasanya dengan cara membandingkan antara kondisi yang seharusnya dengan kenyataan yang terjadi.</li></ul>'),
(2,	1,	2,	'Mengenali unsur-unsur sebuah kondisi.',	'<ul><li>Mencari informasi dalam rangka mengenali abnormalitas lebih mendalam; dan&nbsp;</li><li>Melihat kondisi secara lebih detail sehingga mampu mengenali unsur pembentuk kondisi tersebut.\r\n</li></ul>'),
(3,	1,	3,	'Mengenali keterkaitan antar unsur pembentuk sebuah kondisi. ',	'<ul><li>Melihat keterkaitan dari masing-masing unsur pembentuk sebuah kondisi dan relevansinya dengan kondisi tersebut.</li></ul>'),
(4,	1,	4,	'Mengenali unsur pembentuk utama sebuah kondisi.',	'<ul><li>Mengidentifikasi berbagai penyebab secara luas dan rinci untuk menemukenali unsur utama pembentuk kondisi tersebut</li></ul>'),
(5,	1,	5,	'Menemukan penyebab munculnya unsur utama sebuah kondisi.',	'<ul><li>Mengidentifikasi beragam hal yang menjadi penyebab munculnya unsur utama pembentuk kondisi melalui beragam pola analisa.</li></ul>'),
(6,	4,	1,	'Mematuhi kode etik.',	'<ul><li>Mematuhi kode etik yang berlaku di organisasi ; dan</li><li>Tetap konsisten dan berpegang pada tata nilai organisasi yang berlaku tanpa terpengaruh oleh opini pihak lain yang tidak sesuai dengan prinsip dan nilai yang berlaku.\r\n</li></ul>'),
(7,	4,	2,	'Jujur dan tegas tanpa membedakan.',	'<ul><li>Bersikap terbuka dan transparan dalam berhubungan dengan rekan kerja / atasan / bawahan / pihak eksternal lainnya, dan memberlakukan hal tersebut tanpa pandang bulu (tidak membedakan); dan</li><li>Secara terbuka menyatakan pandangan tentang ketidaketisan meskipun hal itu akan menyakiti kolega/ teman dekat, bahkan akan merusak hubungannya dengan orang tersebut.\r\n</li></ul>'),
(8,	4,	3,	'Mendorong orang lain untuk bertindak.',	'<ul><li>Menyatakan dukungan secara terbuka kepada orang untuk bertindak sesuai dengan kode etik dan tata  nilai organisasi yang berlaku; dan</li><li>Mengajak orang lain untuk membangun kepercayaan dan bekerja dengan integritas sesuai dengan etika Organisasi yang berlaku.\r\n</li></ul>'),
(9,	4,	4,	'Membangun suasana integritas.',	'Membangun pola cara kerja atau iklim kerja yang kondusif dengan memberikan suasana yang dapat menumbuhkembangkan saling percaya antar satu karyawan dengan yang lain baik vertikal maupun horizontal.'),
(10,	4,	5,	'Menjadi contoh bagi orang lain.',	'Menjadi contoh bagi orang lain dalam hal bersikap jujur dalam bertindak / bekerja dan secara terbuka /    di depan umum mengakui, bila telah melakukan kesalahan.'),
(26,	2,	1,	'Mengenali hubungan antarkondisi. ',	'<ul><li><span><span><span><span><span>Mengenali hubungan sejumlah kondisi dengan cara\r\n  melihat perbedaan atau kesamaan kondisi terbatas pada hal-hal yang pernah\r\n  dialami.</span>&nbsp;</span></span></span></span></li></ul>'),
(27,	2,	2,	'Mengenali pola hubungan antarkondisi berdasarkan sintesa dari informasi yang ada.',	'<ul><li>Kemampuan untuk mengenali hubungan sejumlah kondisi melalui penyimpulan standar dari dari data-data yang berkaitan dengan kondisi tersebut.</li></ul>'),
(28,	2,	3,	'Melakukan sintesa terhadap beragam kondisi yang tidak jelas hubungannya.',	'<ul><li>Kemampuan untuk melakukan sintesa dalam rangka&nbsp; &nbsp;menemukan pola hubungan beragam kondisi yang dihadapi.</li></ul>'),
(29,	2,	4,	'Menyederhanakan struktur dari beragam kondisi.',	'<ul><li>Menemukenali kesetaraan dari beragam kondisi untuk memperoleh kesimpulan yang mudah dipahami.</li></ul>'),
(30,	2,	5,	'Menciptakan pola pandang baru dalam melihat  struktur dari beragam kondisi.',	'<ul><li>Mengenali keterkaitan dari beragam struktur kondisi yang ada termasuk yang bagi orang lain tidak jelas untuk menemukan pola pandang baru yang belum pernah ada sebelumnya.</li></ul>'),
(31,	3,	1,	'Berpikir jangka pendek.',	'<ul><li>Mengetahui\r\nadanya strategi organisasi tetapi masih berorientasi pada kondisi sekarang.<br></li></ul>'),
(32,	3,	2,	'Memahami strategi/visi organisasi.',	'<ul><li>Memahami tujuan dan strategi organisasi&nbsp; dan mampu memanfaatkannya saat memecahkan masalah.</li></ul>'),
(33,	3,	3,	'Mempertimbangkan aspek internal dan eksternal organisasi.',	'<ul><li>Menunjukkan kemampuan dalam mengidentifikasi kekuatan dan kelemahan&nbsp; intern dan ekstern&nbsp; organisasi yang&nbsp; mempengaruhi kesuksesan usaha.</li></ul>'),
(34,	3,	4,	'Menemukan ide-ide strategis.',	'<ul><li>Menunjukkan kemampuan menggabungkan berbagai permasalahan inti dengan mempertimbangkan kekuatan dan kelemahan organisasi sehingga dapat menghasilkan formula-formula baru serta memberikan gambaran mengenai kemungkinan lain yang dapat meningkatkan kinerja organisasi.<br></li></ul>'),
(35,	3,	5,	'Menjaga pemikiran tetap dalam kerangka bisnis jangka panjang.',	'<ul><li>Memiliki kerangka yang jelas akan visi dari area bisnisnya dan secara terus menerus mendiskusikan dan memonitor implikasi keputusan, permasalahan dan rencana jangka panjang sehingga mampu mengenali situasi dan kondisi di mana harus mengubah strategi; dan</li><li>Mampu mengembangkan visi organisasi melalui terobosan (<i>breakthrough</i>) atau&nbsp;<i>quantum leap</i>.</li></ul>'),
(36,	17,	1,	'Mendengarkan dan memberi tanggapan terbatas.',	'<ul><li><span>Menanggapi secara pasif kegiatan pembicaraan/diskusi; dan</span></li><li><span>Menjelaskan suatu hal/permasalahan kurang\r\nruntut/sistimatis.</span></li></ul>'),
(37,	17,	2,	'Mengangkap, memahami dan memberikan tanggapan secara sederhana.',	'<ul><li>Memberikan\r\ntanggapan atas pertanyaan orang lain dengan menggunakan kalimat sederhana<span>.</span></li></ul>'),
(38,	17,	3,	'Menyampaikan ide gagasan dan memberikan tanggapan secara sistematis. ',	'<ul><li><span>Mengungkapkan\r\npendapat/ide/informasi secara sistematis dan dimengerti orang lain.</span></li></ul>'),
(39,	17,	4,	'Memberikan tanggapan dan menggali informasi  secara rinci sebagai langkah pendalaman permasalahan.',	'<ul><li><span>Mengajukan\r\npertanyaan untuk menggali informasi dari orang lain.</span></li></ul>'),
(40,	17,	5,	'Memberikan penyampaian dan tanggapan yang efektif hingga berdampak ide dan gagasan diterima dan didukung pihak lain.',	'<ul><li><span>Menggunakan gaya bahasa yang dapat dimengerti orang\r\nlain secara sistematis kepada orang lain yang berbeda latar belakangnya; dan</span></li><li>Mengarahkan orang lain untuk memahami maksud\r\npembicaraan agar <span>mendukung idenya.</span></li></ul>')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `id_competence` = VALUES(`id_competence`), `level` = VALUES(`level`), `title` = VALUES(`title`), `definition` = VALUES(`definition`);

DROP TABLE IF EXISTS `sdmp_competence_profile_template`;
CREATE TABLE `sdmp_competence_profile_template` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_position` bigint(20) NOT NULL,
  `competences` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_competence_profile_template` (`id`, `id_position`, `competences`) VALUES
(2,	2,	'1'),
(3,	3,	'1,4,17'),
(4,	4,	'1')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `id_position` = VALUES(`id_position`), `competences` = VALUES(`competences`);

DROP TABLE IF EXISTS `sdmp_doc_template`;
CREATE TABLE `sdmp_doc_template` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_template` bigint(20) NOT NULL,
  `code` int(100) NOT NULL,
  `field_text` varchar(150) NOT NULL,
  `field_name` varchar(150) NOT NULL,
  `datecreated` datetime NOT NULL,
  `datemodified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_doc_template` (`id`, `id_template`, `code`, `field_text`, `field_name`, `datecreated`, `datemodified`) VALUES
(28,	37,	1,	'CV',	'cv',	'2018-02-03 17:53:18',	'2018-02-03 17:53:18'),
(29,	37,	2,	'Akta',	'akta',	'2018-02-03 17:53:18',	'2018-02-03 17:53:18'),
(30,	38,	1,	'CV',	'cv',	'2018-02-05 11:11:00',	'2018-02-05 11:11:00'),
(31,	38,	2,	'Sertifikat',	'sertifikat',	'2018-02-05 11:11:00',	'2018-02-05 11:11:00'),
(32,	39,	1,	'CV',	'cv',	'2018-02-06 11:05:36',	'2018-02-06 11:05:36'),
(33,	39,	2,	'Sertifikat',	'sertifikat',	'2018-02-06 11:05:36',	'2018-02-06 11:05:36'),
(34,	40,	1,	'cv',	'cv',	'2018-02-06 11:11:47',	'2018-02-06 11:11:47'),
(35,	40,	2,	'cv',	'cv',	'2018-02-06 11:11:47',	'2018-02-06 11:11:47'),
(36,	41,	1,	'asa',	'asa',	'2018-02-06 11:41:59',	'2018-02-06 11:41:59'),
(37,	41,	2,	'asfas',	'asfas',	'2018-02-06 11:41:59',	'2018-02-06 11:41:59'),
(38,	41,	3,	'rer',	'rer',	'2018-02-06 11:41:59',	'2018-02-06 11:41:59'),
(39,	42,	1,	'Cv',	'cv',	'2018-02-06 11:45:07',	'2018-02-06 11:45:07'),
(40,	42,	2,	'cv2',	'cv2',	'2018-02-06 11:45:07',	'2018-02-06 11:45:07'),
(41,	43,	1,	'cv',	'cv',	'2018-02-06 11:48:32',	'2018-02-06 11:48:32'),
(42,	43,	2,	'cv2',	'cv2',	'2018-02-06 11:48:32',	'2018-02-06 11:48:32'),
(43,	44,	1,	'cv',	'cv',	'2018-02-06 11:49:40',	'2018-02-06 11:49:40'),
(44,	44,	2,	'cv2',	'cv2',	'2018-02-06 11:49:40',	'2018-02-06 11:49:40'),
(45,	45,	1,	'Cv',	'cv',	'2018-02-06 11:52:59',	'2018-02-06 11:52:59'),
(46,	45,	2,	'cv',	'cv',	'2018-02-06 11:52:59',	'2018-02-06 11:52:59'),
(47,	46,	1,	'e',	'e',	'2018-02-06 11:54:16',	'2018-02-06 11:54:16'),
(48,	46,	2,	'rer',	'rer',	'2018-02-06 11:54:16',	'2018-02-06 11:54:16'),
(49,	47,	1,	'e',	'e',	'2018-02-06 11:55:15',	'2018-02-06 11:55:15'),
(50,	47,	2,	'f',	'f',	'2018-02-06 11:55:15',	'2018-02-06 11:55:15'),
(51,	48,	1,	'e',	'e',	'2018-02-06 11:57:08',	'2018-02-06 11:57:08'),
(52,	48,	2,	'e',	'e',	'2018-02-06 11:57:08',	'2018-02-06 11:57:08'),
(53,	49,	1,	'w',	'w',	'2018-02-06 11:59:22',	'2018-02-06 11:59:22'),
(54,	50,	1,	'CV',	'cv',	'2018-02-06 17:36:50',	'2018-02-06 17:36:50'),
(55,	50,	2,	'Sertifikat',	'sertifikat',	'2018-02-06 17:36:50',	'2018-02-06 17:36:50'),
(56,	51,	1,	'CV',	'cv',	'2018-02-06 17:53:22',	'2018-02-06 17:53:22'),
(57,	51,	2,	'Sertifikat',	'sertifikat',	'2018-02-06 17:53:22',	'2018-02-06 17:53:22')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `id_template` = VALUES(`id_template`), `code` = VALUES(`code`), `field_text` = VALUES(`field_text`), `field_name` = VALUES(`field_name`), `datecreated` = VALUES(`datecreated`), `datemodified` = VALUES(`datemodified`);

DROP TABLE IF EXISTS `sdmp_files`;
CREATE TABLE `sdmp_files` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_member` bigint(20) NOT NULL,
  `id_registration` bigint(20) NOT NULL,
  `file_name` varchar(125) NOT NULL,
  `file_location` varchar(125) NOT NULL,
  `type` varchar(125) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `datemodified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `sdmp_position`;
CREATE TABLE `sdmp_position` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_position` (`id`, `name`) VALUES
(1,	'Eselon I'),
(2,	'Eselon II'),
(3,	'Wakapolda'),
(4,	'Irwasda'),
(5,	'Karorena Polda')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`);

DROP TABLE IF EXISTS `sdmp_registration`;
CREATE TABLE `sdmp_registration` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `id_assessment_program` bigint(10) NOT NULL,
  `number` varchar(125) NOT NULL,
  `username` varchar(125) NOT NULL,
  `password` varchar(125) NOT NULL,
  `name` varchar(125) NOT NULL,
  `email` varchar(125) NOT NULL,
  `phone` varchar(125) NOT NULL,
  `email_feedback` varchar(125) NOT NULL DEFAULT '',
  `position` varchar(64) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0' COMMENT '1 = registered, 2 = approved, 3 = assesment, 4 = done',
  `document` varchar(1) NOT NULL DEFAULT '0' COMMENT '1=competed',
  `engagement` varchar(1) NOT NULL DEFAULT '0' COMMENT '1=completed',
  `datecreated` datetime NOT NULL,
  `datemodified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_registration` (`id`, `id_assessment_program`, `number`, `username`, `password`, `name`, `email`, `phone`, `email_feedback`, `position`, `status`, `document`, `engagement`, `datecreated`, `datemodified`) VALUES
(2,	23,	'200',	'peserta7',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 7',	'whayrohman@gmail.com',	'',	'0',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(3,	23,	'201',	'peserta1',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 1',	'peserta1@admin.com',	'',	'0',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(4,	23,	'202',	'peserta2',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 2',	'peserta2@admin.com',	'',	'wahyurohman95@gmail.com',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(5,	23,	'203',	'peserta3',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 3',	'peserta3@admin.com',	'',	'0',	'4',	'0',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(6,	23,	'204',	'peserta4',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 4',	'peserta4@admin.com',	'',	'0',	'4',	'0',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(7,	24,	'205',	'peserta5',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 5',	'peserta5@admin.com',	'',	'0',	'4',	'0',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(8,	24,	'206',	'peserta6',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 6',	'wahyurohman95@gmail.com',	'',	'0',	'4',	'0',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(63,	38,	'3867',	'peserta38367',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 38367',	'peserta38367@admin.com',	'',	'',	'3',	'4',	'0',	'0',	'0000-00-00 00:00:00',	'2018-02-05 16:01:16'),
(64,	38,	'3875',	'peserta38375',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 38375',	'peserta38375@admin.com',	'',	'',	'3',	'4',	'0',	'0',	'0000-00-00 00:00:00',	'2018-02-05 16:40:32'),
(65,	38,	'3839',	'peserta38339',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 38339',	'peserta38339@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(66,	38,	'3897',	'peserta38397',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 38397',	'peserta38397@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(67,	38,	'3880',	'peserta38380',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 38380',	'peserta38380@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(68,	38,	'3831',	'peserta38331',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 38331',	'peserta38331@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(69,	39,	'3982',	'peserta39182',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 39182',	'peserta39182@admin.com',	'',	'',	'1',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(70,	39,	'3991',	'peserta39191',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 39191',	'peserta39191@admin.com',	'',	'',	'1',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(71,	39,	'3987',	'peserta39187',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 39187',	'peserta39187@admin.com',	'',	'',	'1',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(72,	39,	'3959',	'peserta39159',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 39159',	'peserta39159@admin.com',	'',	'',	'1',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(73,	39,	'3968',	'peserta39168',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 39168',	'peserta39168@admin.com',	'',	'',	'1',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(74,	39,	'3972',	'peserta39172',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 39172',	'peserta39172@admin.com',	'',	'',	'1',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(75,	40,	'4013',	'peserta40313',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 40313',	'peserta40313@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(76,	40,	'4097',	'peserta40397',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 40397',	'peserta40397@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(77,	40,	'4037',	'peserta40337',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 40337',	'peserta40337@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(78,	40,	'4020',	'peserta40320',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 40320',	'peserta40320@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(79,	40,	'4073',	'peserta40373',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 40373',	'peserta40373@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(80,	40,	'4041',	'peserta40341',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 40341',	'peserta40341@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(81,	41,	'4167',	'peserta41367',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 41367',	'peserta41367@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(82,	41,	'4179',	'peserta41379',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 41379',	'peserta41379@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(83,	41,	'4162',	'peserta41362',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 41362',	'peserta41362@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(84,	41,	'414',	'peserta4134',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 4134',	'peserta4134@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(85,	41,	'4138',	'peserta41338',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 41338',	'peserta41338@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(86,	41,	'4185',	'peserta41385',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 41385',	'peserta41385@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(87,	42,	'4295',	'peserta42395',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 42395',	'peserta42395@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(88,	42,	'4277',	'peserta42377',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 42377',	'peserta42377@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(89,	42,	'4291',	'peserta42391',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 42391',	'peserta42391@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(90,	42,	'4210',	'peserta42310',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 42310',	'peserta42310@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(91,	42,	'4220',	'peserta42320',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 42320',	'peserta42320@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(92,	42,	'4262',	'peserta42362',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 42362',	'peserta42362@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(93,	43,	'4388',	'peserta43388',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 43388',	'peserta43388@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(94,	43,	'4399',	'peserta43399',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 43399',	'peserta43399@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(95,	43,	'436',	'peserta4336',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 4336',	'peserta4336@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(96,	43,	'4394',	'peserta43394',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 43394',	'peserta43394@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(97,	43,	'4330',	'peserta43330',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 43330',	'peserta43330@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(98,	43,	'4318',	'peserta43318',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 43318',	'peserta43318@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(99,	44,	'4416',	'peserta44316',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 44316',	'peserta44316@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(100,	44,	'4434',	'peserta44334',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 44334',	'peserta44334@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(101,	44,	'4494',	'peserta44394',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 44394',	'peserta44394@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(102,	44,	'4432',	'peserta44332',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 44332',	'peserta44332@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(103,	44,	'4439',	'peserta44339',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 44339',	'peserta44339@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(104,	44,	'4415',	'peserta44315',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 44315',	'peserta44315@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(105,	45,	'4565',	'peserta45365',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 45365',	'peserta45365@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(106,	45,	'4511',	'peserta45311',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 45311',	'peserta45311@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(107,	45,	'45100',	'peserta453100',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 453100',	'peserta453100@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(108,	45,	'4571',	'peserta45371',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 45371',	'peserta45371@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(109,	45,	'4524',	'peserta45324',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 45324',	'peserta45324@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(110,	45,	'4542',	'peserta45342',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 45342',	'peserta45342@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(111,	46,	'4653',	'peserta46153',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 46153',	'peserta46153@admin.com',	'',	'',	'1',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(112,	46,	'4616',	'peserta46116',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 46116',	'peserta46116@admin.com',	'',	'',	'1',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(113,	46,	'4620',	'peserta46120',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 46120',	'peserta46120@admin.com',	'',	'',	'1',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(114,	46,	'4668',	'peserta46168',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 46168',	'peserta46168@admin.com',	'',	'',	'1',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(115,	46,	'4659',	'peserta46159',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 46159',	'peserta46159@admin.com',	'',	'',	'1',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(116,	46,	'4631',	'peserta46131',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 46131',	'peserta46131@admin.com',	'',	'',	'1',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(117,	47,	'4786',	'peserta47386',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 47386',	'peserta47386@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(118,	47,	'4728',	'peserta47328',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 47328',	'peserta47328@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(119,	47,	'4773',	'peserta47373',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 47373',	'peserta47373@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(120,	47,	'475',	'peserta4735',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 4735',	'peserta4735@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(121,	47,	'4730',	'peserta47330',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 47330',	'peserta47330@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(122,	47,	'4760',	'peserta47360',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 47360',	'peserta47360@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(123,	48,	'4849',	'peserta48349',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 48349',	'peserta48349@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(124,	48,	'4873',	'peserta48373',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 48373',	'peserta48373@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(125,	48,	'4820',	'peserta48320',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 48320',	'peserta48320@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(126,	48,	'4848',	'peserta48348',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 48348',	'peserta48348@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(127,	48,	'4818',	'peserta48318',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 48318',	'peserta48318@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(128,	48,	'4824',	'peserta48324',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 48324',	'peserta48324@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(129,	49,	'4958',	'peserta49358',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 49358',	'peserta49358@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(130,	49,	'4991',	'peserta49391',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 49391',	'peserta49391@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(131,	49,	'4974',	'peserta49374',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 49374',	'peserta49374@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(132,	49,	'4922',	'peserta49322',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 49322',	'peserta49322@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(133,	49,	'4999',	'peserta49399',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 49399',	'peserta49399@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(134,	49,	'4952',	'peserta49352',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 49352',	'peserta49352@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(135,	50,	'5086',	'peserta50386',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 50386',	'peserta50386@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(136,	50,	'5078',	'peserta50378',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 50378',	'peserta50378@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(137,	50,	'5048',	'peserta50348',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 50348',	'peserta50348@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(138,	50,	'508',	'peserta5038',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 5038',	'peserta5038@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(139,	50,	'5060',	'peserta50360',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 50360',	'peserta50360@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(140,	50,	'502',	'peserta5032',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 5032',	'peserta5032@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(141,	51,	'5127',	'peserta51327',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 51327',	'peserta51327@admin.com',	'',	'',	'3',	'4',	'0',	'0',	'0000-00-00 00:00:00',	'2018-02-06 18:06:40'),
(142,	51,	'5154',	'peserta51354',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 51354',	'peserta51354@admin.com',	'',	'',	'3',	'4',	'0',	'0',	'0000-00-00 00:00:00',	'2018-02-06 18:06:57'),
(143,	51,	'5197',	'peserta51397',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 51397',	'peserta51397@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(144,	51,	'5180',	'peserta51380',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 51380',	'peserta51380@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(145,	51,	'510',	'peserta5130',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 5130',	'peserta5130@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(146,	51,	'5113',	'peserta51313',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 51313',	'peserta51313@admin.com',	'',	'',	'3',	'1',	'0',	'0',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `id_assessment_program` = VALUES(`id_assessment_program`), `number` = VALUES(`number`), `username` = VALUES(`username`), `password` = VALUES(`password`), `name` = VALUES(`name`), `email` = VALUES(`email`), `phone` = VALUES(`phone`), `email_feedback` = VALUES(`email_feedback`), `position` = VALUES(`position`), `status` = VALUES(`status`), `document` = VALUES(`document`), `engagement` = VALUES(`engagement`), `datecreated` = VALUES(`datecreated`), `datemodified` = VALUES(`datemodified`);

DROP TABLE IF EXISTS `sdmp_tools_template`;
CREATE TABLE `sdmp_tools_template` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_position` bigint(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `tools` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_tools_template` (`id`, `id_position`, `name`, `tools`) VALUES
(1,	3,	'',	'1,2,3'),
(2,	4,	'',	'1,2,4,5')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `id_position` = VALUES(`id_position`), `name` = VALUES(`name`), `tools` = VALUES(`tools`);

DROP TABLE IF EXISTS `sdmp_user`;
CREATE TABLE `sdmp_user` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(125) NOT NULL,
  `password` varchar(125) NOT NULL,
  `name` varchar(125) NOT NULL,
  `email` varchar(125) NOT NULL,
  `email_feedback` varchar(125) NOT NULL,
  `type` varchar(16) NOT NULL COMMENT ' 0 = admin, 1 = register, 2 = assessor',
  `status` varchar(16) NOT NULL DEFAULT '0' COMMENT '1 = active, 2 = approved, 3 = assesment, 4 = done',
  `data_id` varchar(16) NOT NULL,
  `datecreated` datetime NOT NULL,
  `datemodified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sdmp_user` (`id`, `username`, `password`, `name`, `email`, `email_feedback`, `type`, `status`, `data_id`, `datecreated`, `datemodified`) VALUES
(1,	'admin',	'e10adc3949ba59abbe56e057f20f883e',	'Admin',	'admin@admin.com',	'',	'0',	'1',	'1',	'2018-01-21 20:42:28',	'2018-01-21 20:42:28'),
(2,	'admin1',	'e10adc3949ba59abbe56e057f20f883e',	'Admin 1',	'admin1@admin.com',	'',	'0',	'1',	'2',	'2018-01-21 20:42:28',	'0000-00-00 00:00:00'),
(3,	'peserta1',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 1',	'peserta1@admin.com',	'wahyurohman95@gmail.com',	'1',	'1',	'3',	'2018-01-21 20:42:28',	'2018-01-21 20:42:28'),
(4,	'peserta2',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 2',	'peserta2@admin.com',	'',	'1',	'1',	'4',	'2018-01-21 20:42:28',	'2018-01-21 20:42:28'),
(5,	'peserta3',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 3',	'peserta3@admin.com',	'',	'1',	'1',	'5',	'2018-01-21 20:42:28',	'2018-01-21 20:42:28'),
(6,	'assessor1',	'e10adc3949ba59abbe56e057f20f883e',	'Assessor 1',	'assessor1@admin.com',	'wahyurohman95@gmail.com',	'2',	'1',	'1',	'2018-01-21 20:42:28',	'2018-01-21 20:42:28'),
(7,	'assessor2',	'e10adc3949ba59abbe56e057f20f883e',	'Assessor 2',	'assessor2@admin.com',	'',	'2',	'1',	'2',	'2018-01-21 20:42:28',	'2018-01-21 20:42:28'),
(8,	'assessor3',	'e10adc3949ba59abbe56e057f20f883e',	'Assessor 3',	'assessor3@admin.com',	'',	'2',	'1',	'3',	'2018-01-21 20:42:28',	'2018-01-21 20:42:28'),
(9,	'assessor4',	'e10adc3949ba59abbe56e057f20f883e',	'Assessor 4',	'assessor4@admin.com',	'',	'2',	'1',	'4',	'2018-01-21 20:42:28',	'2018-01-21 20:42:28'),
(10,	'assessor5',	'e10adc3949ba59abbe56e057f20f883e',	'Assessor 4',	'assessor5@admin.com',	'',	'2',	'1',	'6',	'2018-01-21 20:42:28',	'2018-01-21 20:42:28'),
(11,	'assessor6',	'e10adc3949ba59abbe56e057f20f883e',	'Assessor 4',	'assessor6@admin.com',	'',	'2',	'1',	'7',	'2018-01-21 20:42:28',	'2018-01-21 20:42:28'),
(12,	'peserta4',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 4',	'peserta4@admin.com',	'',	'1',	'1',	'6',	'2018-01-21 20:42:28',	'2018-01-21 20:42:28'),
(13,	'peserta5',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 5',	'peserta5@admin.com',	'',	'1',	'1',	'7',	'2018-01-21 20:42:28',	'2018-01-21 20:42:28'),
(14,	'peserta6',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 6',	'peserta6@admin.com',	'',	'1',	'1',	'8',	'2018-01-21 20:42:28',	'2018-01-21 20:42:28'),
(15,	'pimpinan1',	'e10adc3949ba59abbe56e057f20f883e',	'Pimipinan 1',	'pimpinan1@admin.com',	'',	'3',	'1',	'15',	'2018-01-21 20:42:28',	'2018-01-21 20:42:28'),
(142,	'superadmin1',	'e10adc3949ba59abbe56e057f20f883e',	'Super Admin 1',	'superadmin1@admin.com',	'',	'4',	'1',	'142',	'2018-01-21 20:42:28',	'2018-01-21 20:42:28'),
(143,	'peserta50386',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 50386',	'peserta50386@admin.com',	'0',	'1',	'1',	'135',	'2018-02-06 17:36:50',	'2018-02-06 17:36:50'),
(144,	'peserta50378',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 50378',	'peserta50378@admin.com',	'0',	'1',	'1',	'136',	'2018-02-06 17:36:50',	'2018-02-06 17:36:50'),
(145,	'peserta50348',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 50348',	'peserta50348@admin.com',	'0',	'1',	'1',	'137',	'2018-02-06 17:36:50',	'2018-02-06 17:36:50'),
(146,	'peserta5038',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 5038',	'peserta5038@admin.com',	'0',	'1',	'1',	'138',	'2018-02-06 17:36:50',	'2018-02-06 17:36:50'),
(147,	'peserta50360',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 50360',	'peserta50360@admin.com',	'0',	'1',	'1',	'139',	'2018-02-06 17:36:50',	'2018-02-06 17:36:50'),
(148,	'peserta5032',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 5032',	'peserta5032@admin.com',	'0',	'1',	'1',	'140',	'2018-02-06 17:36:50',	'2018-02-06 17:36:50'),
(149,	'peserta51327',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 51327',	'peserta51327@admin.com',	'0',	'1',	'1',	'141',	'2018-02-06 17:53:22',	'2018-02-06 17:53:22'),
(150,	'peserta51354',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 51354',	'peserta51354@admin.com',	'0',	'1',	'1',	'142',	'2018-02-06 17:53:22',	'2018-02-06 17:53:22'),
(151,	'peserta51397',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 51397',	'peserta51397@admin.com',	'0',	'1',	'1',	'143',	'2018-02-06 17:53:22',	'2018-02-06 17:53:22'),
(152,	'peserta51380',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 51380',	'peserta51380@admin.com',	'0',	'1',	'1',	'144',	'2018-02-06 17:53:22',	'2018-02-06 17:53:22'),
(153,	'peserta5130',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 5130',	'peserta5130@admin.com',	'0',	'1',	'1',	'145',	'2018-02-06 17:53:22',	'2018-02-06 17:53:22'),
(154,	'peserta51313',	'e10adc3949ba59abbe56e057f20f883e',	'Peserta 51313',	'peserta51313@admin.com',	'0',	'1',	'1',	'146',	'2018-02-06 17:53:22',	'2018-02-06 17:53:22')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `username` = VALUES(`username`), `password` = VALUES(`password`), `name` = VALUES(`name`), `email` = VALUES(`email`), `email_feedback` = VALUES(`email_feedback`), `type` = VALUES(`type`), `status` = VALUES(`status`), `data_id` = VALUES(`data_id`), `datecreated` = VALUES(`datecreated`), `datemodified` = VALUES(`datemodified`);

-- 2018-02-06 23:49:41
