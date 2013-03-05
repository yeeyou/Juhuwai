-- phpMyAdmin SQL Dump
-- version 2.11.2.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 03 月 04 日 15:29
-- 服务器版本: 5.0.45
-- PHP 版本: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `news`
--

-- --------------------------------------------------------

--
-- 表的结构 `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) collate utf8_bin NOT NULL default '0',
  `ip_address` varchar(16) collate utf8_bin NOT NULL default '0',
  `user_agent` varchar(150) collate utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL default '0',
  `user_data` text collate utf8_bin NOT NULL,
  PRIMARY KEY  (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 导出表中的数据 `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('cbf77f8d99aa9f694233655f3c54bc6d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 5.1; rv:19.0) Gecko/20100101 Firefox/19.0', 1362410588, 0x613a31303a7b733a393a22757365725f64617461223b733a303a22223b733a31303a2244585f757365725f6964223b733a313a2239223b733a31313a2244585f757365726e616d65223b733a31353a22776569626f31333133383833303133223b733a31303a2244585f726f6c655f6964223b733a313a2231223b733a31323a2244585f726f6c655f6e616d65223b733a343a2255736572223b733a31383a2244585f706172656e745f726f6c65735f6964223b613a303a7b7d733a32303a2244585f706172656e745f726f6c65735f6e616d65223b613a303a7b7d733a31333a2244585f7065726d697373696f6e223b613a303a7b7d733a32313a2244585f706172656e745f7065726d697373696f6e73223b613a303a7b7d733a31323a2244585f6c6f676765645f696e223b623a313b7d);

-- --------------------------------------------------------

--
-- 表的结构 `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL auto_increment,
  `ip_address` varchar(40) collate utf8_bin NOT NULL,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `login_attempts`
--


-- --------------------------------------------------------

--
-- 表的结构 `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL auto_increment,
  `role_id` int(11) NOT NULL,
  `data` text collate utf8_bin,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `permissions`
--


-- --------------------------------------------------------

--
-- 表的结构 `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL default '0',
  `name` varchar(30) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `roles`
--

INSERT INTO `roles` (`id`, `parent_id`, `name`) VALUES
(1, 0, 'User'),
(2, 0, 'Admin');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `weibo_id` int(10) NOT NULL,
  `role_id` int(11) NOT NULL default '1',
  `username` varchar(25) collate utf8_bin NOT NULL,
  `password` varchar(34) collate utf8_bin NOT NULL,
  `email` varchar(100) collate utf8_bin NOT NULL,
  `banned` tinyint(1) NOT NULL default '0',
  `ban_reason` varchar(255) collate utf8_bin default NULL,
  `newpass` varchar(34) collate utf8_bin default NULL,
  `newpass_key` varchar(32) collate utf8_bin default NULL,
  `newpass_time` datetime default NULL,
  `last_ip` varchar(40) collate utf8_bin NOT NULL,
  `last_login` datetime NOT NULL default '0000-00-00 00:00:00',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- 导出表中的数据 `users`
--

INSERT INTO `users` (`id`, `weibo_id`, `role_id`, `username`, `password`, `email`, `banned`, `ban_reason`, `newpass`, `newpass_key`, `newpass_time`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(9, 1313883013, 1, 'weibo1313883013', '$1$Dh/.Q94.$zuzTB4tpIuNBI6Oyvfh1I.', '', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '2013-03-04 15:13:46', '2013-03-04 15:13:46', '2013-03-04 23:13:46');

-- --------------------------------------------------------

--
-- 表的结构 `user_autologin`
--

CREATE TABLE `user_autologin` (
  `key_id` char(32) collate utf8_bin NOT NULL,
  `user_id` mediumint(8) NOT NULL default '0',
  `user_agent` varchar(150) collate utf8_bin NOT NULL,
  `last_ip` varchar(40) collate utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 导出表中的数据 `user_autologin`
--

INSERT INTO `user_autologin` (`key_id`, `user_id`, `user_agent`, `last_ip`, `last_login`) VALUES
('172a2eba7edc9086d268454429f6c5d9', 9, 'Mozilla/5.0 (Windows NT 5.1; rv:19.0) Gecko/20100101 Firefox/19.0', '127.0.0.1', '2013-03-04 23:13:46'),
('9758565c40b751ea3dde9195a8174514', 3, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.32 Safari/537.17', '127.0.1.1', '2012-12-28 23:27:09');

-- --------------------------------------------------------

--
-- 表的结构 `user_info`
--

CREATE TABLE `user_info` (
  `id` int(10) NOT NULL auto_increment,
  `weibo_id` int(10) NOT NULL,
  `screen_name` varchar(50) collate utf8_bin NOT NULL,
  `name` varchar(50) collate utf8_bin NOT NULL,
  `location` varchar(50) collate utf8_bin NOT NULL,
  `gender` varchar(10) collate utf8_bin NOT NULL,
  `avatar_large` varchar(200) collate utf8_bin NOT NULL,
  `profile_url` varchar(200) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- 导出表中的数据 `user_info`
--

INSERT INTO `user_info` (`id`, `weibo_id`, `screen_name`, `name`, `location`, `gender`, `avatar_large`, `profile_url`) VALUES
(4, 1313883013, '墙脚', '墙脚', '其他', 'm', 'http://tp2.sinaimg.cn/1313883013/180/5639128015/1', 'footyee'),
(5, 1903837793, '为了目田', '为了目田', '北京 朝阳区', 'm', 'http://tp2.sinaimg.cn/1903837793/180/5646039648/1', 'zhen0128'),
(6, 1665251145, '冬天没有太阳', '冬天没有太阳', '湖北 武汉', 'm', 'http://tp2.sinaimg.cn/1665251145/180/1259637956/1', 'winteroutofsunshine'),
(7, 1313883013, '墙脚', '墙脚', '其他', 'm', 'http://tp2.sinaimg.cn/1313883013/180/5639128015/1', 'footyee');

-- --------------------------------------------------------

--
-- 表的结构 `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) collate utf8_bin default NULL,
  `website` varchar(255) collate utf8_bin default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `country`, `website`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user_temp`
--

CREATE TABLE `user_temp` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) collate utf8_bin NOT NULL,
  `password` varchar(34) collate utf8_bin NOT NULL,
  `email` varchar(100) collate utf8_bin NOT NULL,
  `activation_key` varchar(50) collate utf8_bin NOT NULL,
  `last_ip` varchar(40) collate utf8_bin NOT NULL,
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `user_temp`
--

