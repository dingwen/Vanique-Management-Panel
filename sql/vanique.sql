-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 30, 2010 at 06:20 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vanique`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `main_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(250) NOT NULL DEFAULT '',
  `code` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `main_id`, `name`, `code`) VALUES
(1, 0, '珠寶', 'J'),
(2, 0, '電子產品', 'E'),
(3, 1, '耳環', 'ER'),
(4, 1, '戒指', 'RG'),
(5, 1, '手環', 'BR'),
(6, 2, '耳機', 'EP'),
(7, 1, '項鍊', 'NL');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
CREATE TABLE IF NOT EXISTS `colors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `color` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `colors`
--


-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL DEFAULT '',
  `last_name` varchar(45) NOT NULL DEFAULT '',
  `title` varchar(45) NOT NULL DEFAULT '員工',
  `role` varchar(5) NOT NULL DEFAULT 'user',
  `password` varchar(40) NOT NULL DEFAULT '',
  `username` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `title`, `role`, `password`, `username`) VALUES
(1, '鼎文', '陳', '執行秘書', 'admin', '231c78085f7014471296ff682683ea8737d36aed', 'dingwen'),
(2, '家鳳', '沙', '行銷經理', 'admin', '8cb2237d0679ca88db6464eac60da96345513964', 'sha'),
(3, '文洲', '廖', '行銷經理', 'admin', '8cb2237d0679ca88db6464eac60da96345513964', 'paul'),
(4, 'Amy', '蘇', '董事長', 'admin', '8cb2237d0679ca88db6464eac60da96345513964', 'amy');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
CREATE TABLE IF NOT EXISTS `material` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `material` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `material`
--


-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(40) NOT NULL DEFAULT '',
  `name` varchar(250) NOT NULL DEFAULT '',
  `product_num` int(10) unsigned NOT NULL DEFAULT '0',
  `supplier_id` int(10) unsigned NOT NULL DEFAULT '0',
  `main_category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sub_category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `material` varchar(250) NOT NULL DEFAULT '',
  `description` text,
  `color` varchar(250) NOT NULL DEFAULT '',
  `dimension` varchar(250) NOT NULL DEFAULT '',
  `weight` int(10) unsigned NOT NULL DEFAULT '0',
  `price_rmb` decimal(10,2) NOT NULL DEFAULT '0.00',
  `china_shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `international_shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tariff` decimal(3,2) NOT NULL DEFAULT '0.00',
  `sell_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `note` text,
  `image_path` varchar(250) NOT NULL DEFAULT '',
  `fill_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fill_staff` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `products`
--


-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `code` varchar(5) NOT NULL DEFAULT '',
  `contact` varchar(20) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `fax` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(250) NOT NULL DEFAULT '',
  `qq_account` varchar(20) NOT NULL DEFAULT '',
  `ali_wangwang` varchar(20) NOT NULL DEFAULT '',
  `taobao` varchar(20) NOT NULL DEFAULT '',
  `msn_account` varchar(250) NOT NULL DEFAULT '',
  `address` varchar(250) NOT NULL DEFAULT '',
  `village` varchar(250) NOT NULL DEFAULT '',
  `district` varchar(250) NOT NULL DEFAULT '',
  `township` varchar(250) NOT NULL DEFAULT '',
  `city` varchar(250) NOT NULL DEFAULT '',
  `region` varchar(250) NOT NULL DEFAULT '',
  `country` varchar(250) NOT NULL DEFAULT '',
  `postcode` varchar(10) NOT NULL DEFAULT '',
  `note` text,
  `fill_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cell` varchar(20) NOT NULL DEFAULT '',
  `website` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `code`, `contact`, `phone`, `fax`, `email`, `qq_account`, `ali_wangwang`, `taobao`, `msn_account`, `address`, `village`, `district`, `township`, `city`, `region`, `country`, `postcode`, `note`, `fill_date`, `cell`, `website`) VALUES
(6, '清風首飾包裝/洪文寶', 'Q01', 'Mr.洪', '86-0579-8529-2906', '', 'piaoyang968@hotmail.com', '', '', '', '', '大塘下新村17幢3號302', '', '', '', '義烏市', '浙江省', '中國', '322000', 'Cell: 13989446819\nEmail有問題', '2010-07-07 00:00:00', '', ''),
(5, '1925飾品網/義烏商導飾品商行', 'S01', '無特定窗口/均線上客服', '00-0000-0000-0000', '', '1925kf@163.com', '', '', '', 'weiqi01@hotmail.com', '長春五街29號4樓', '', '', '', '義烏市', '浙江省', '中國', '322000', '電話有問題\n客服：客服一號QQ：546767541 財務QQ：190538620', '2010-07-07 00:00:00', '', ''),
(3, '阿勇時尚飾品/阿勇文化發展有限公司', 'A01', '無特定窗口/均線上客服', '00-0000-0000-0000', '', 'qq424753887@hotmail.com', 'QQ在線顧問:424753887, 32', '', '', '', '廣渠門內領行國際3樓2門10層1005室', '', '崇文區', '', '', '北京', '中國', '100061', '電話有問題', '2010-07-07 00:00:00', '', ''),
(4, '品秀飾品網/廣州品臻貿易有限公司', 'P01', '無特定窗口/均線上客服', '00-0000-0000-0000', '', 'buysp_218@163.com', 'QQ:610782882', '', '', '', '黃埔大道中144號海景商務中心西塔17D-E室', '', '天河區', '', '廣州市', '廣東', '中國', '', 'QQ:610782882(負責：普通諮詢/發貨查詢),377385889(負責：普通諮詢/技術支持)\n電話有問題', '2010-07-07 00:00:00', '', ''),
(2, '深圳市美聯茗典科技有限公司', 'M01', '陳小姐 Lisa or 曹麗女士', '86-0755-8327-3960', '86-0755-8364-7553', 'mdd-china@hotmail.com', '', '', '', '', '黃強北電子科技大廈中店數碼市場5019室', '', '', '', '深圳市', '廣東省', '中國', '518033', '暫停往來業務', '2010-07-07 00:00:00', '', ''),
(1, '義烏嬌滴滴韓國明星飾品廠', 'J01', '江水小姐', '86-0579-8155-0156', '86-0579-8155-0156', 'jiaodidishipin@163.com', '360674942', 'jiangshui0525', '嬌滴滴飾品', 'jiaodidishipin@hotmail.com', '', '', '', '', '', '', '', '', '', '2010-07-01 00:00:00', '', '');
