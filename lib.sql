-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 01, 2015 at 10:10 PM
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
('A. A. Milne'),
('Agatha Christie'),
('Anne Rice'),
('Charles Dickens'),
('Chuck Palahniuk'),
('Clive Cussler'),
('Elbert Hubbard'),
('Enid Blyton'),
('Frank McCourt'),
('Frederick Douglass'),
('Gary Paulsen'),
('George Eliot'),
('Harpercollins'),
('Irving, John'),
('J. R. R. Tolkien'),
('J.K. Rowling'),
('Mary Kate'),
('ohn Milton'),
('William Shakespeare');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `isbn` int(4) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`isbn`, `title`, `available`, `author`, `publisher`) VALUES
(1, 'Magical Horse', 1, 'A. A. Milne', 'Penguin P'),
(2, 'Stinky Horse', 1, 'Clive Cussler', 'Penguin P'),
(3, 'Farm Animals ', 1, 'ohn Milton', 'UofC'),
(4, 'Pizza making', 1, 'Clive Cussler', 'UofC'),
(5, 'Fast Cars', 0, 'Agatha Christie', 'UofC'),
(6, 'Tasty Dogs', 1, 'Irving, John', 'Penguin P'),
(7, 'Yes please', 0, 'A. A. Milne', 'Penguin P'),
(8, 'Wild Gooose', 0, 'A. A. Milne', 'UofC'),
(9, 'Fame Ya', 1, 'Charles Dickens', 'UofC'),
(10, 'Harry Potter and the 12 pigs', 1, 'J.K. Rowling', 'Penguin P'),
(11, 'helloworld', 0, 'Gary Paulsen', 'UofC'),
(12, 'king', 1, 'A. A. Milne', 'Penguin P'),
(13, 'King Candy', 0, 'A. A. Milne', 'Penguin P'),
(14, 'King Candy', 1, 'A. A. Milne', 'Penguin P'),
(17, 'fsdf', 0, 'A. A. Milne', 'Penguin P'),
(18, 'Computer 101', 1, 'Frederick Douglass', 'UofC'),
(19, 'Computer 101', 1, 'Frederick Douglass', 'UofC'),
(20, 'Computer 101', 1, 'Frederick Douglass', 'UofC'),
(30, 'Good Story', 1, 'A. A. Milne', 'Harpercollins '),
(31, 'Winnie the Pooh', 0, 'A. A. Milne', 'Harpercollins '),
(32, 'New paradise', 1, 'Frank McCourt', 'UofC');

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
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `username` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `memberID` int(8) unsigned NOT NULL,
  `fines` double unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`username`, `password`, `fname`, `lname`, `memberID`, `fines`) VALUES
('asdf', 'asdf', 'sdf', 'dsf', 10, 0),
('hello', 'head', 'dsfjlk', 'ds', 13, 0),
('dsfjkl', 'fsdf', 'sdf', 'dsf', 14, 0),
('qq', 'q', 'q', 'q', 17, 0),
('fdsf', 'lkfjds', 'lkfjdslk', 'klfdslkjflk', 19, 0),
('dsf', 'dsf', 'dsf', 'df', 20, 0),
('sfd', 'sdf', 'sdf', 'sdf', 21, 0),
('808', 'asdf', 'sadf', 'sdf', 23, 0),
('dsaf', 'asdf', 'sdaf', 'sdf', 24, 0),
('sup', 'sup', 'andrew', 'heng', 26, 0),
('root', 'root', 'adfjl', 'flkdsj', 27, 0),
('kf', 'kfdskl', 'jflksd', 'lkjfdslk', 28, 0),
('L', 'l', 'joe', 'smith', 29, 0),
('me', 'me', 'you', 'me', 30, 0),
('kitty', 'kitty', 'Smiles', 'Dogs', 32, 0),
('queen', 'queen', 'elizabeth', 'of england', 33, 0),
('Jarom', 'Jarom', 'Joe', 'lady boy', 35, 0);

-- --------------------------------------------------------

--
-- Table structure for table `memberaddress`
--

CREATE TABLE `memberaddress` (
  `memberID` int(8) unsigned NOT NULL,
  `street` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `postalCode` varchar(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

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
(26, 'jfsld', '33', 'fdsjkl'),
(29, 'sky', '332', 'qekk'),
(30, 'rock', '123', 'Someth'),
(30, 'rock', '123', 'Someth'),
(32, 'litter box', '999', 'Random'),
(33, 'the palace', '555', 'royalt'),
(33, 'the palace', '555', 'royalt'),
(35, 'penthouse', '88', 'sup');

-- --------------------------------------------------------

--
-- Table structure for table `memberborrowsbook`
--

CREATE TABLE `memberborrowsbook` (
  `memberID` int(8) unsigned NOT NULL,
  `isbn` int(4) unsigned NOT NULL,
  `dueDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `memberborrowsbook`
--

INSERT INTO `memberborrowsbook` (`memberID`, `isbn`, `dueDate`) VALUES
(26, 5, '2015-12-31'),
(26, 11, '2015-12-15'),
(26, 7, '2015-12-15'),
(26, 31, '2015-12-15'),
(13, 13, '2015-12-15'),
(32, 8, '2015-12-15'),
(32, 17, '2015-12-15');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`name`) VALUES
('Harpercollins '),
('Penguin P'),
('UofC');

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
  ADD KEY `publisher` (`publisher`),
  ADD KEY `author` (`author`);

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
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `isbn` int(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EID` int(3) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `memberID` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `memberaddress`
--
ALTER TABLE `memberaddress`
  MODIFY `memberID` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
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

