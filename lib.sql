-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Dec 07, 2015 at 02:40 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `library`
-- 
CREATE DATABASE `library` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `library`;

-- --------------------------------------------------------

-- 
-- Table structure for table `author`
-- 

CREATE TABLE `author` (
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `author`
-- 

INSERT INTO `author` VALUES ('CS Louis');
INSERT INTO `author` VALUES ('Dante Alighieri');
INSERT INTO `author` VALUES ('Dr Seuss');
INSERT INTO `author` VALUES ('EL James');
INSERT INTO `author` VALUES ('JK Rowling');
INSERT INTO `author` VALUES ('JRR Tolken');
INSERT INTO `author` VALUES ('Nelson Wong');
INSERT INTO `author` VALUES ('Randy Le');
INSERT INTO `author` VALUES ('RL E');
INSERT INTO `author` VALUES ('RL Stein');
INSERT INTO `author` VALUES ('Stephanie Meyre');
INSERT INTO `author` VALUES ('Stephen Hawking');
INSERT INTO `author` VALUES ('Walt Disney');
INSERT INTO `author` VALUES ('William Shakespeare');

-- --------------------------------------------------------

-- 
-- Table structure for table `book`
-- 

CREATE TABLE `book` (
  `isbn` int(4) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL default '1',
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY  (`isbn`),
  KEY `publisher` (`publisher`),
  KEY `author` (`author`),
  KEY `location` (`location`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- 
-- Dumping data for table `book`
-- 

INSERT INTO `book` VALUES (1, 'Harry Potter and the 12 Pigs', 0, 'JK Rowling', 'Harper Colins', 'McKimmie');
INSERT INTO `book` VALUES (2, 'How to go Fast', 0, 'Randy Le', 'Scholastic', 'McKimmie');
INSERT INTO `book` VALUES (3, 'How to Train Your Dragon', 1, 'Walt Disney', 'Scholastic', 'TFDL');
INSERT INTO `book` VALUES (4, 'Romeo & Juliet', 1, 'William Shakespeare', 'Scholastic', 'TFDL');
INSERT INTO `book` VALUES (5, 'Orthello', 1, 'William Shakespeare', 'Scholastic', 'TFDL');
INSERT INTO `book` VALUES (6, '50 Shades of Nelson', 1, 'CS Louis', 'Harper Colins', 'McKimmie');
INSERT INTO `book` VALUES (7, 'A+ Please', 1, 'JRR Tolken', 'Harper Colins', 'TFDL');
INSERT INTO `book` VALUES (8, 'Not Cheating', 1, 'Dante Alighieri', 'Penguin Club', 'TFDL');
INSERT INTO `book` VALUES (9, 'I Hate Dante', 1, 'Dante Alighieri', 'Scholastic', 'TFDL');
INSERT INTO `book` VALUES (10, 'How to Spell', 1, 'Dr Seuss', 'UofC Publications', 'McKimmie');
INSERT INTO `book` VALUES (11, 'Sonic', 1, 'Nelson Wong', 'UofC Publications', 'McKimmie');
INSERT INTO `book` VALUES (12, 'DBMA', 1, 'Nelson Wong', 'UofC Publications', 'TFDL');
INSERT INTO `book` VALUES (13, 'Twilight', 1, 'Nelson Wong', 'Penguin Club', 'TFDL');
INSERT INTO `book` VALUES (14, '3 Eyeballs', 1, 'RL Stein', 'Scholastic', 'McKimmie');
INSERT INTO `book` VALUES (15, 'Frankenstein', 1, 'Randy Le', 'Scholastic', 'TFDL');
INSERT INTO `book` VALUES (16, 'The Book', 1, 'Stephen Hawking', 'Penguin Club', 'TFDL');
INSERT INTO `book` VALUES (17, 'Push For Victory', 1, 'JRR Tolken', 'UofC Publications', 'TFDL');
INSERT INTO `book` VALUES (18, 'Push For Victory', 1, 'Randy Le', 'Penguin Club', 'TFDL');
INSERT INTO `book` VALUES (19, 'Can''t Touch This', 1, 'RL E', 'UofC Publications', 'McKimmie');
INSERT INTO `book` VALUES (20, 'Call Me Maybe', 1, 'Nelson Wong', 'Penguin Club', 'TFDL');

-- --------------------------------------------------------

-- 
-- Table structure for table `employee`
-- 

CREATE TABLE `employee` (
  `EID` int(3) unsigned NOT NULL auto_increment,
  `address` varchar(255) NOT NULL,
  `salary` double unsigned NOT NULL default '0',
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `superEID` int(3) unsigned default NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `library` varchar(255) NOT NULL,
  PRIMARY KEY  (`EID`),
  UNIQUE KEY `username` (`username`),
  KEY `library` (`library`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `employee`
-- 

INSERT INTO `employee` VALUES (1, '123 Manager Street', 999999, 'Andrew', 'Heng', NULL, 'sup', 'sup', 'TFDL');
INSERT INTO `employee` VALUES (2, '123 Noodle World', 5, 'Noodle', 'Tran', 0, 'emp', 'emp', 'TFDL');
INSERT INTO `employee` VALUES (3, '123 Forrest Gump', 6, 'Randy', 'Tree', 0, 'emp1', 'emp1', 'TFDL');
INSERT INTO `employee` VALUES (4, '123 Body Check', 6.9, 'Franchecka', 'Pure', 0, 'emp2', 'emp2', 'McKimmie');

-- --------------------------------------------------------

-- 
-- Table structure for table `library`
-- 

CREATE TABLE `library` (
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY  (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `library`
-- 

INSERT INTO `library` VALUES ('McKimmie', 'U of C Y');
INSERT INTO `library` VALUES ('TFDL', 'U of C X');

-- --------------------------------------------------------

-- 
-- Table structure for table `member`
-- 

CREATE TABLE `member` (
  `username` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `memberID` int(8) unsigned NOT NULL auto_increment,
  `fines` double unsigned NOT NULL default '0',
  PRIMARY KEY  (`memberID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `member`
-- 

INSERT INTO `member` VALUES ('mem', 'mem', 'Dixon', 'Cider', 1, 0);
INSERT INTO `member` VALUES ('mem1', 'mem1', 'Ran', 'Away', 2, 0);
INSERT INTO `member` VALUES ('mem2', 'mem2', 'Joy', 'Jump', 3, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `memberaddress`
-- 

CREATE TABLE `memberaddress` (
  `memberID` int(8) unsigned NOT NULL auto_increment,
  `street` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `postalCode` varchar(6) NOT NULL,
  KEY `memberID` (`memberID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `memberaddress`
-- 

INSERT INTO `memberaddress` VALUES (1, 'North Pole', '8787', 'T2A6K1');
INSERT INTO `memberaddress` VALUES (2, 'Applehood SE', '123', 'N9F7L7');
INSERT INTO `memberaddress` VALUES (3, 'Heaven', '9001', 'P0G5D7');

-- --------------------------------------------------------

-- 
-- Table structure for table `memberbooksworkroom`
-- 

CREATE TABLE `memberbooksworkroom` (
  `memberID` int(8) unsigned NOT NULL,
  `roomNumber` int(1) unsigned NOT NULL,
  `date` varchar(10) NOT NULL,
  UNIQUE KEY `entry` (`memberID`,`roomNumber`,`date`),
  KEY `memberID` (`memberID`),
  KEY `roomNumber` (`roomNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `memberbooksworkroom`
-- 

INSERT INTO `memberbooksworkroom` VALUES (1, 1, '12/15/2015');
INSERT INTO `memberbooksworkroom` VALUES (1, 5, '12/28/2015');

-- --------------------------------------------------------

-- 
-- Table structure for table `memberborrowsbook`
-- 

CREATE TABLE `memberborrowsbook` (
  `memberID` int(8) unsigned NOT NULL,
  `isbn` int(4) unsigned NOT NULL,
  `dueDate` date NOT NULL,
  KEY `memberID` (`memberID`),
  KEY `isbn` (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `memberborrowsbook`
-- 

INSERT INTO `memberborrowsbook` VALUES (1, 1, '2015-12-17');
INSERT INTO `memberborrowsbook` VALUES (1, 2, '2015-12-17');

-- --------------------------------------------------------

-- 
-- Table structure for table `publisher`
-- 

CREATE TABLE `publisher` (
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `publisher`
-- 

INSERT INTO `publisher` VALUES ('Harper Colins');
INSERT INTO `publisher` VALUES ('Penguin Club');
INSERT INTO `publisher` VALUES ('Scholastic');
INSERT INTO `publisher` VALUES ('UofC Publications');

-- --------------------------------------------------------

-- 
-- Table structure for table `record`
-- 

CREATE TABLE `record` (
  `isbn` int(4) unsigned NOT NULL auto_increment,
  `memberID` int(8) unsigned NOT NULL,
  `date` date NOT NULL,
  `type` varchar(3) NOT NULL,
  KEY `isbn` (`isbn`),
  KEY `memberID` (`memberID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `record`
-- 

INSERT INTO `record` VALUES (1, 1, '2015-12-03', 'CHK');
INSERT INTO `record` VALUES (1, 1, '2015-12-03', 'RET');
INSERT INTO `record` VALUES (1, 1, '2015-12-03', 'CHK');
INSERT INTO `record` VALUES (2, 1, '2015-12-03', 'CHK');

-- --------------------------------------------------------

-- 
-- Table structure for table `workroom`
-- 

CREATE TABLE `workroom` (
  `number` int(1) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `workroom`
-- 

INSERT INTO `workroom` VALUES (1);
INSERT INTO `workroom` VALUES (2);
INSERT INTO `workroom` VALUES (3);
INSERT INTO `workroom` VALUES (4);
INSERT INTO `workroom` VALUES (5);

-- 
-- Constraints for dumped tables
-- 

-- 
-- Constraints for table `book`
-- 
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_18` FOREIGN KEY (`author`) REFERENCES `author` (`name`) ON UPDATE CASCADE,
  ADD CONSTRAINT `book_ibfk_19` FOREIGN KEY (`publisher`) REFERENCES `publisher` (`name`) ON UPDATE CASCADE,
  ADD CONSTRAINT `book_ibfk_20` FOREIGN KEY (`location`) REFERENCES `library` (`name`) ON UPDATE CASCADE;

-- 
-- Constraints for table `employee`
-- 
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`library`) REFERENCES `library` (`name`) ON UPDATE CASCADE;

-- 
-- Constraints for table `memberaddress`
-- 
ALTER TABLE `memberaddress`
  ADD CONSTRAINT `memberaddress_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`) ON UPDATE CASCADE;

-- 
-- Constraints for table `memberbooksworkroom`
-- 
ALTER TABLE `memberbooksworkroom`
  ADD CONSTRAINT `memberbooksworkroom_ibfk_3` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `memberbooksworkroom_ibfk_4` FOREIGN KEY (`roomNumber`) REFERENCES `workroom` (`number`);

-- 
-- Constraints for table `memberborrowsbook`
-- 
ALTER TABLE `memberborrowsbook`
  ADD CONSTRAINT `memberborrowsbook_ibfk_8` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `memberborrowsbook_ibfk_9` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`) ON UPDATE CASCADE;

-- 
-- Constraints for table `record`
-- 
ALTER TABLE `record`
  ADD CONSTRAINT `record_ibfk_3` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`) ON UPDATE CASCADE,
  ADD CONSTRAINT `record_ibfk_4` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`) ON UPDATE CASCADE;
