-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.10a-beta-nt


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema race
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ race;
USE race;

--
-- Table structure for table `race`.`colleges`
--

DROP TABLE IF EXISTS `colleges`;
CREATE TABLE `colleges` (
  `college` varchar(45) NOT NULL,
  `domain` varchar(45) NOT NULL,
  `level` varchar(45) NOT NULL,
  `sessions` varchar(45) NOT NULL,
  `trainer_alloc` varchar(45) NOT NULL default 'none',
  PRIMARY KEY  (`college`,`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `race`.`colleges`
--

/*!40000 ALTER TABLE `colleges` DISABLE KEYS */;
INSERT INTO `colleges` (`college`,`domain`,`level`,`sessions`,`trainer_alloc`) VALUES 
 ('CEG','LA','1','1','Raj'),
 ('CEG','VA','2','1','Raj'),
 ('VIT','VA','any level','2','none');
/*!40000 ALTER TABLE `colleges` ENABLE KEYS */;


--
-- Table structure for table `race`.`dates`
--

DROP TABLE IF EXISTS `dates`;
CREATE TABLE `dates` (
  `college` varchar(45) NOT NULL,
  `days` date NOT NULL,
  PRIMARY KEY  (`college`,`days`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `race`.`dates`
--

/*!40000 ALTER TABLE `dates` DISABLE KEYS */;
INSERT INTO `dates` (`college`,`days`) VALUES 
 ('CEG','2014-03-19'),
 ('CEG','2014-03-20'),
 ('CEG','2014-03-21'),
 ('CEG','2014-03-22'),
 ('CEG','2014-03-23'),
 ('CEG','2014-03-24'),
 ('CEG','2014-03-25'),
 ('VIT','2014-03-25'),
 ('VIT','2014-03-26');
/*!40000 ALTER TABLE `dates` ENABLE KEYS */;


--
-- Table structure for table `race`.`trainers`
--

DROP TABLE IF EXISTS `trainers`;
CREATE TABLE `trainers` (
  `trainer` varchar(45) NOT NULL,
  `domain` varchar(45) NOT NULL,
  `level` varchar(45) NOT NULL,
  `allocated` varchar(45) NOT NULL default 'no',
  PRIMARY KEY  (`trainer`,`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `race`.`trainers`
--

/*!40000 ALTER TABLE `trainers` DISABLE KEYS */;
INSERT INTO `trainers` (`trainer`,`domain`,`level`,`allocated`) VALUES 
 ('Raj','LA','1','CEG'),
 ('Raj','VA','2','CEG');
/*!40000 ALTER TABLE `trainers` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
