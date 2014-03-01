/*
SQLyog Community v11.31 (32 bit)
MySQL - 5.1.63-0ubuntu0.10.04.1 : Database - myserverdbname
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `ddt9-AUTH-CRED` */

DROP TABLE IF EXISTS `ddt9-AUTH-CRED`;

CREATE TABLE `ddt9-AUTH-CRED` (
  `auth-cred-UUID` varchar(100) NOT NULL DEFAULT '#not',
  `auth-cred-UNAME` varchar(200) NOT NULL DEFAULT '#not',
  `auth-cred-PASSHASH` varchar(32) NOT NULL DEFAULT '#not',
  `auth-cred-SALT` varchar(100) NOT NULL DEFAULT '#not',
  `auth-cred-GLOBALPERMS` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ddt9-AUTH-CRED` */

insert  into `ddt9-AUTH-CRED`(`auth-cred-UUID`,`auth-cred-UNAME`,`auth-cred-PASSHASH`,`auth-cred-SALT`,`auth-cred-GLOBALPERMS`) values ('872bb940-fb14-4320-995c-42ef285b0d7a','White Rabbit','2ba647d69ace3040c31a96cd8b8e1e3b','066f0231-c964-4ff8-8961-a7b3e483bdde',';GOD:ALL;');

/*Table structure for table `ddt9-AUTH-SESSION` */

DROP TABLE IF EXISTS `ddt9-AUTH-SESSION`;

CREATE TABLE `ddt9-AUTH-SESSION` (
  `auth-session-ID` varchar(100) NOT NULL DEFAULT '#not',
  `auth-session-USER-UUID` varchar(100) NOT NULL DEFAULT '#not'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ddt9-AUTH-SESSION` */

/*Table structure for table `ddt9-ENS-records` */

DROP TABLE IF EXISTS `ddt9-ENS-records`;

CREATE TABLE `ddt9-ENS-records` (
  `ens-UUID` varchar(100) NOT NULL DEFAULT '#not',
  `ens-IP` varchar(60) NOT NULL DEFAULT '#not',
  `ens-ENAME` varchar(200) NOT NULL DEFAULT '#not',
  `ens-SNAME` varchar(200) NOT NULL DEFAULT '#not',
  `ens-CONTACTUUID` varchar(100) NOT NULL DEFAULT '#not',
  `ens-UTIMEUPDATE` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ens-PORT` varchar(10) NOT NULL DEFAULT '#not'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ddt9-ENS-records` */

insert  into `ddt9-ENS-records`(`ens-UUID`,`ens-IP`,`ens-ENAME`,`ens-SNAME`,`ens-CONTACTUUID`,`ens-UTIMEUPDATE`,`ens-PORT`) values ('1f09b4f7-b967-43f9-8b14-85657b29c900','208.109.101.135','govmmo','home','872bb940-fb14-4320-995c-42ef285b0d7a',1391780571,'9000');

/*Table structure for table `ddt9-auth-user` */

DROP TABLE IF EXISTS `ddt9-auth-user`;

CREATE TABLE `ddt9-auth-user` (
  `user-uuid` varchar(100) NOT NULL DEFAULT '#not',
  `clientid` varchar(255) NOT NULL DEFAULT '#not',
  `clientidassigntime` bigint(20) unsigned NOT NULL DEFAULT '0',
  `username` varchar(60) NOT NULL DEFAULT '#not',
  `passhash` varchar(32) NOT NULL DEFAULT '#not',
  `passsalt` varchar(100) NOT NULL DEFAULT '#not',
  `userperms` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ddt9-auth-user` */

insert  into `ddt9-auth-user`(`user-uuid`,`clientid`,`clientidassigntime`,`username`,`passhash`,`passsalt`,`userperms`) values ('ebaee8b1-06d2-4c72-9ed8-256bfe322008','1',1392832380,'White Rabbit','7f5ca3359d009bcc0f14257fe753beba','70e646d1-44d9-4fbc-84f1-1d2307907e61',';user-normal;');

/*Table structure for table `ddt9-help` */

DROP TABLE IF EXISTS `ddt9-help`;

CREATE TABLE `ddt9-help` (
  `typekey` varchar(255) NOT NULL DEFAULT '#not',
  `helpdata` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ddt9-help` */

insert  into `ddt9-help`(`typekey`,`helpdata`) values ('ALL:MAIN','/##identify::name::password (this logs you in or registers you with the game where \"name\" is your avatar name and password is your password.)<br>\r\n/##help (this gives you a listing of useful commands)<br>');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
