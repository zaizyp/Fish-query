-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-03-22 17:23:00
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fish_query`
--

-- --------------------------------------------------------

--
-- 表的结构 `fq_admin`
--

CREATE TABLE `fq_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_general_mysql500_ci NOT NULL COMMENT '管理员id',
  `password` varchar(50) COLLATE utf8_general_mysql500_ci NOT NULL COMMENT '管理员密码'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci COMMENT=' 管理员信息';

--
-- 转存表中的数据 `fq_admin`
--

INSERT INTO `fq_admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '123456'),
(4, 'user', '123456'),
(5, 'test', '123456'),
(6, 'test1', '123456');

-- --------------------------------------------------------

--
-- 表的结构 `fq_fish`
--

CREATE TABLE `fq_fish` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` varchar(50) COLLATE utf8_general_mysql500_ci NOT NULL COMMENT '名称',
  `class` varchar(50) COLLATE utf8_general_mysql500_ci NOT NULL COMMENT '种类',
  `shijiefenbu` varchar(50) COLLATE utf8_general_mysql500_ci NOT NULL COMMENT '世界分布',
  `dilifenbu` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL COMMENT '地理分布',
  `qixihuanjing` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL COMMENT '栖息环境',
  `xingtaitezheng` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL COMMENT '形态特征',
  `picture` varchar(50) COLLATE utf8_general_mysql500_ci NOT NULL COMMENT '图片'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci COMMENT='鱼类信息';

--
-- 转存表中的数据 `fq_fish`
--

INSERT INTO `fq_fish` (`id`, `name`, `class`, `shijiefenbu`, `dilifenbu`, `qixihuanjing`, `xingtaitezheng`, `picture`) VALUES
(1, '双斑钝', '种类1', '世界分布1', '地理分布1', '栖息环境1', '形态特征1', '双斑钝.jpg'),
(2, '斑金', '种类1', '世界分布2', '地理分布2', '栖息环境2', '形态特征2', '斑金.jpg'),
(21, 'dasd', 'sad', 'dsa', 'dsa', 'dsa', 'das', 'dsa'),
(11, '短鼻银鲛鱼', '种类2', '', '', '', 'swde', '短鼻银鲛鱼.jpg'),
(12, '喉须鲛', '3', '', '', 'sad', '', '喉须鲛.jpg'),
(13, '虎鲛', '3', '', '', '', '', '虎鲛.jpg'),
(14, '鲸鲛', '3', '', '', '', '', '鲸鲛.jpg'),
(15, '盲鳗鱼', '3', '', '', '', '', '盲鳗鱼.jpg'),
(16, '锈须鲛', '3', '', '', '', '', '锈须鲛.jpg'),
(17, '须鲛', '4', '', '', '', '', '须鲛.jpg'),
(18, '异齿鲛', '4', '', '', '', '', '异齿鲛.jpg'),
(19, '长鼻银鲛鱼', '4', '', '', '', '', '长鼻银鲛鱼.jpg'),
(20, '竹鲛', '4', '', '', '', '', '竹鲛.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fq_admin`
--
ALTER TABLE `fq_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin-id` (`name`);

--
-- Indexes for table `fq_fish`
--
ALTER TABLE `fq_fish`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `fq_admin`
--
ALTER TABLE `fq_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `fq_fish`
--
ALTER TABLE `fq_fish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
