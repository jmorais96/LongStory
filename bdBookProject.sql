-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 02, 2019 at 02:19 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `bdBookProject`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `idAuthor` int(11) NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`idAuthor`, `author`) VALUES
(1, 'Pedro Chagas Freitas');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `idBook` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `idAuthor` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `ISBN` bigint(20) NOT NULL,
  `image` longtext NOT NULL,
  `idRegister` int(11) NOT NULL,
  `idAprover` int(11) DEFAULT NULL,
  `idstatusBook` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`idBook`, `name`, `idAuthor`, `description`, `ISBN`, `image`, `idRegister`, `idAprover`, `idstatusBook`) VALUES
(3, 'Prometo Falhar', 1, 'Em textos que exploram o lado humano dos relacionamentos, Prometo Falhar despe o conceito do amor romântico. Prometo Falhar é um livro que fala de amor.', 9789897540769, '', 1, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `book_has_gender`
--

CREATE TABLE `book_has_gender` (
  `idBook` int(11) NOT NULL,
  `idGender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `idUser` int(11) NOT NULL,
  `idFriend` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `idGender` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `owned`
--

CREATE TABLE `owned` (
  `idUser` int(11) NOT NULL,
  `idBook` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `idProfile` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`idProfile`, `type`) VALUES
(1, 'Admin'),
(2, 'Client');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `idUser` int(11) NOT NULL,
  `idBook` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `read`
--

CREATE TABLE `read` (
  `idUser` int(11) NOT NULL,
  `idBook` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `statusBook`
--

CREATE TABLE `statusBook` (
  `idStatusBook` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `statusBook`
--

INSERT INTO `statusBook` (`idStatusBook`, `status`) VALUES
(1, 'Aprovado'),
(2, 'Recusado'),
(3, 'Pendente');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `birthDate` date DEFAULT NULL,
  `idProfile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `name`, `email`, `pass`, `birthDate`, `idProfile`) VALUES
(1, 'José Felizmino', ' jose@felizmino.com', '123456', '2018-12-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `whislist`
--

CREATE TABLE `whislist` (
  `idUser` int(11) NOT NULL,
  `idBook` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`idAuthor`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`idBook`),
  ADD KEY `fk_book_user1_idx` (`idRegister`),
  ADD KEY `fk_book_user2_idx` (`idAprover`),
  ADD KEY `fk_book_author1_idx` (`idAuthor`),
  ADD KEY `fk_book_statusBook1_idx` (`idstatusBook`);

--
-- Indexes for table `book_has_gender`
--
ALTER TABLE `book_has_gender`
  ADD PRIMARY KEY (`idBook`,`idGender`),
  ADD KEY `fk_book_has_gender_gender1_idx` (`idGender`),
  ADD KEY `fk_book_has_gender_book1_idx` (`idBook`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`idUser`,`idFriend`),
  ADD KEY `fk_user_has_user_user2_idx` (`idFriend`),
  ADD KEY `fk_user_has_user_user1_idx` (`idUser`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`idGender`);

--
-- Indexes for table `owned`
--
ALTER TABLE `owned`
  ADD PRIMARY KEY (`idUser`,`idBook`),
  ADD KEY `fk_user_has_book_book3_idx` (`idBook`),
  ADD KEY `fk_user_has_book_user2_idx` (`idUser`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`idProfile`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`idUser`,`idBook`),
  ADD KEY `fk_user_has_book_book4_idx` (`idBook`),
  ADD KEY `fk_user_has_book_user3_idx` (`idUser`);

--
-- Indexes for table `read`
--
ALTER TABLE `read`
  ADD PRIMARY KEY (`idUser`,`idBook`),
  ADD KEY `fk_user_has_book_book1_idx` (`idBook`),
  ADD KEY `fk_user_has_book_user_idx` (`idUser`);

--
-- Indexes for table `statusBook`
--
ALTER TABLE `statusBook`
  ADD PRIMARY KEY (`idStatusBook`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `fk_user_profile1_idx` (`idProfile`);

--
-- Indexes for table `whislist`
--
ALTER TABLE `whislist`
  ADD PRIMARY KEY (`idUser`,`idBook`),
  ADD KEY `fk_user_has_book_book2_idx` (`idBook`),
  ADD KEY `fk_user_has_book_user1_idx` (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `idAuthor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `idBook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `idGender` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `idProfile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `statusBook`
--
ALTER TABLE `statusBook`
  MODIFY `idStatusBook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_book_author1` FOREIGN KEY (`idAuthor`) REFERENCES `author` (`idAuthor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_book_statusBook1` FOREIGN KEY (`idstatusBook`) REFERENCES `statusBook` (`idStatusBook`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_book_user1` FOREIGN KEY (`idRegister`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_book_user2` FOREIGN KEY (`idAprover`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `book_has_gender`
--
ALTER TABLE `book_has_gender`
  ADD CONSTRAINT `fk_book_has_gender_book1` FOREIGN KEY (`idBook`) REFERENCES `book` (`idBook`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_book_has_gender_gender1` FOREIGN KEY (`idGender`) REFERENCES `gender` (`idGender`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `fk_user_has_user_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_user_user2` FOREIGN KEY (`idFriend`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `owned`
--
ALTER TABLE `owned`
  ADD CONSTRAINT `fk_user_has_book_book3` FOREIGN KEY (`idBook`) REFERENCES `book` (`idBook`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_book_user2` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_user_has_book_book4` FOREIGN KEY (`idBook`) REFERENCES `book` (`idBook`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_book_user3` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `read`
--
ALTER TABLE `read`
  ADD CONSTRAINT `fk_user_has_book_book1` FOREIGN KEY (`idBook`) REFERENCES `book` (`idBook`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_book_user` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_profile1` FOREIGN KEY (`idProfile`) REFERENCES `profile` (`idProfile`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `whislist`
--
ALTER TABLE `whislist`
  ADD CONSTRAINT `fk_user_has_book_book2` FOREIGN KEY (`idBook`) REFERENCES `book` (`idBook`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_has_book_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;
