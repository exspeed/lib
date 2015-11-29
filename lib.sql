-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Nov 29, 2015 at 04:45 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`name`) VALUES
('J.K. Rowling'),
('William Shakespeare');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `isbn` varchar(255) NOT NULL,
  `title` int(255) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EID` int(3) unsigned NOT NULL,
  `address` varchar(255) NOT NULL,
  `salary` double unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `superEID` int(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `businessID` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `totalBooks` int(4) unsigned NOT NULL DEFAULT '0',
  `mgrEID` int(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `librarystoresbook`
--

CREATE TABLE `librarystoresbook` (
  `businessID` int(10) unsigned NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `qty` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `username` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `memberID` int(8) unsigned NOT NULL,
  `fines` double unsigned NOT NULL DEFAULT '0',
  `totalBorrowed` int(2) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`username`, `password`, `fname`, `lname`, `memberID`, `fines`, `totalBorrowed`) VALUES
('asdf', 'asdf', 'sdf', 'dsf', 10, 0, 0),
('hello', 'head', 'dsfjlk', 'ds', 13, 0, 0),
('dsfjkl', 'fsdf', 'sdf', 'dsf', 14, 0, 0),
('qq', 'q', 'q', 'q', 17, 0, 0),
('fdsf', 'lkfjds', 'lkfjdslk', 'klfdslkjflk', 19, 0, 0),
('dsf', 'dsf', 'dsf', 'df', 20, 0, 0),
('sfd', 'sdf', 'sdf', 'sdf', 21, 0, 0),
('808', 'asdf', 'sadf', 'sdf', 23, 0, 0),
('dsaf', 'asdf', 'sdaf', 'sdf', 24, 0, 0),
('sup', 'sup', 'andrew', 'heng', 26, 0, 0),
('root', 'root', 'adfjl', 'flkdsj', 27, 0, 0),
('kf', 'kfdskl', 'jflksd', 'lkjfdslk', 28, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `memberaddress`
--

CREATE TABLE `memberaddress` (
  `memberID` int(8) unsigned NOT NULL,
  `street` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `postalCode` varchar(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `memberaddress`
--

INSERT INTO `memberaddress` (`memberID`, `street`, `number`, `postalCode`) VALUES
(13, 'fdslkj', '', 'fsd'),
(19, 'lfkdjs', '', 'fdslk'),
(20, 'sdf', '', 'df'),
(21, 'dsf', '', 'sdf'),
(20, 'dfs', '', 'sdf'),
(23, 'sdf', '', 'sdaf'),
(24, 'sdf', '333', 'dsf'),
(10, 'asdf', '99', 'dsf'),
(26, 'in', '443', 'T320'),
(27, 'sldfkj', '1234', 'sldfkj'),
(28, 'flksdjl', '423', 'dsfs'),
(26, 'jfsld', '33', 'fdsjkl');

-- --------------------------------------------------------

--
-- Table structure for table `memberborrowsbook`
--

CREATE TABLE `memberborrowsbook` (
  `memberID` int(8) unsigned NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `dueDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `isbn` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `type` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `workroom`
--

CREATE TABLE `workroom` (
  `number` int(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`isbn`),
  ADD UNIQUE KEY `title` (`title`),
  ADD UNIQUE KEY `isbn_2` (`isbn`),
  ADD KEY `publisher` (`publisher`),
  ADD KEY `author` (`author`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EID`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`businessID`);

--
-- Indexes for table `librarystoresbook`
--
ALTER TABLE `librarystoresbook`
  ADD KEY `businessID` (`businessID`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `memberID` (`memberID`);

--
-- Indexes for table `memberaddress`
--
ALTER TABLE `memberaddress`
  ADD KEY `memberID` (`memberID`);

--
-- Indexes for table `memberborrowsbook`
--
ALTER TABLE `memberborrowsbook`
  ADD KEY `memberID` (`memberID`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `workroom`
--
ALTER TABLE `workroom`
  ADD PRIMARY KEY (`number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EID` int(3) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `memberID` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `memberaddress`
--
ALTER TABLE `memberaddress`
  MODIFY `memberID` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `memberborrowsbook`
--
ALTER TABLE `memberborrowsbook`
  MODIFY `memberID` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`author`) REFERENCES `author` (`name`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`publisher`) REFERENCES `publisher` (`name`);

--
-- Constraints for table `librarystoresbook`
--
ALTER TABLE `librarystoresbook`
  ADD CONSTRAINT `librarystoresbook_ibfk_1` FOREIGN KEY (`businessID`) REFERENCES `library` (`businessID`),
  ADD CONSTRAINT `librarystoresbook_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`);

--
-- Constraints for table `memberaddress`
--
ALTER TABLE `memberaddress`
  ADD CONSTRAINT `memberaddress_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`);

--
-- Constraints for table `memberborrowsbook`
--
ALTER TABLE `memberborrowsbook`
  ADD CONSTRAINT `memberborrowsbook_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`),
  ADD CONSTRAINT `memberborrowsbook_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`);

--
-- Constraints for table `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `record_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`);
