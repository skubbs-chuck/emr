-- MySQL dump 10.13  Distrib 5.6.16, for Win32 (x86)
--
-- Host: localhost    Database: psadmin_skubbs_emr
-- ------------------------------------------------------
-- Server version	5.6.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `assessments`
--

DROP TABLE IF EXISTS `assessments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assessments` (
  `id_assessment` int(11) NOT NULL AUTO_INCREMENT,
  `clinical_diagnosis` text NOT NULL,
  PRIMARY KEY (`id_assessment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assessments`
--

LOCK TABLES `assessments` WRITE;
/*!40000 ALTER TABLE `assessments` DISABLE KEYS */;
/*!40000 ALTER TABLE `assessments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billings`
--

DROP TABLE IF EXISTS `billings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `billings` (
  `id_billing` int(11) NOT NULL AUTO_INCREMENT,
  `amount` varchar(255) NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY (`id_billing`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billings`
--

LOCK TABLES `billings` WRITE;
/*!40000 ALTER TABLE `billings` DISABLE KEYS */;
/*!40000 ALTER TABLE `billings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinics`
--

DROP TABLE IF EXISTS `clinics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinics` (
  `id_clinic` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `hour_start` varchar(255) NOT NULL,
  `hour_end` varchar(255) NOT NULL,
  `street` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `country` varchar(150) NOT NULL,
  `zip_code` varchar(8) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `website` text NOT NULL,
  PRIMARY KEY (`id_clinic`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinics`
--

LOCK TABLES `clinics` WRITE;
/*!40000 ALTER TABLE `clinics` DISABLE KEYS */;
INSERT INTO `clinics` VALUES (9,'Skubbs Dental Clinic','08:00 AM','06:00 PM','','','','Philippines','','','');
/*!40000 ALTER TABLE `clinics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `ctype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = patient, 1 = emergency, 3 = informant',
  `name` varchar(255) NOT NULL,
  `relation` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip_code` varchar(15) NOT NULL,
  `province` varchar(150) NOT NULL,
  `country` varchar(150) NOT NULL,
  `contacts` longtext NOT NULL,
  PRIMARY KEY (`id_contact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_atn`
--

DROP TABLE IF EXISTS `form_atn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_atn` (
  `id_form_atn` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_atn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_atn`
--

LOCK TABLES `form_atn` WRITE;
/*!40000 ALTER TABLE `form_atn` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_atn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_categories`
--

DROP TABLE IF EXISTS `form_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_categories` (
  `id_form_category` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id_form_category`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_categories`
--

LOCK TABLES `form_categories` WRITE;
/*!40000 ALTER TABLE `form_categories` DISABLE KEYS */;
INSERT INTO `form_categories` VALUES (1,'General medicine',''),(2,'Pediatrics',''),(3,'Dermatology',''),(4,'Surgery',''),(5,'Obstetrics and Gynecology',''),(6,'Ophthalmology',''),(7,'Otorhinolaryngology',''),(8,'Pulmonology',''),(9,'Scanned Consultation','');
/*!40000 ALTER TABLE `form_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_cbc`
--

DROP TABLE IF EXISTS `form_cbc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_cbc` (
  `id_form_cbc` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `time_start` time NOT NULL,
  `hemoglobin` varchar(255) NOT NULL,
  `hematocrit` varchar(255) NOT NULL,
  `rbc` varchar(255) NOT NULL,
  `wbc` varchar(255) NOT NULL,
  `platelet` varchar(255) NOT NULL,
  `mcv` varchar(255) NOT NULL,
  `mch` varchar(255) NOT NULL,
  `mchc` varchar(255) NOT NULL,
  `rdw` varchar(255) NOT NULL,
  `eosinophils` varchar(255) NOT NULL,
  `basophils` varchar(255) NOT NULL,
  `neutrophils` varchar(255) NOT NULL,
  `lymphocytes` varchar(255) NOT NULL,
  `monocytes` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_cbc`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_cbc`
--

LOCK TABLES `form_cbc` WRITE;
/*!40000 ALTER TABLE `form_cbc` DISABLE KEYS */;
INSERT INTO `form_cbc` VALUES (1,2,1,1,'2015-07-27','00:00:00','1','1','1','1','1','1','1','1','1','1','1','1','1','1','2015-07-27 00:00:00');
/*!40000 ALTER TABLE `form_cbc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_cbcf`
--

DROP TABLE IF EXISTS `form_cbcf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_cbcf` (
  `id_form_cbcf` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hemoglobin` int(255) NOT NULL,
  `hematocrit` int(255) NOT NULL,
  `rbc` varchar(255) NOT NULL,
  `wbc` varchar(255) NOT NULL,
  `neutrophils` varchar(255) NOT NULL,
  `lymphocytes` varchar(255) NOT NULL,
  `eosinophils` varchar(255) NOT NULL,
  `monocytes` varchar(255) NOT NULL,
  `platelet` varchar(255) NOT NULL,
  `mcv` varchar(255) NOT NULL,
  `mch` varchar(255) NOT NULL,
  `mchc` varchar(255) NOT NULL,
  `medical_technologist` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_cbcf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_cbcf`
--

LOCK TABLES `form_cbcf` WRITE;
/*!40000 ALTER TABLE `form_cbcf` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_cbcf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_cmof`
--

DROP TABLE IF EXISTS `form_cmof`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_cmof` (
  `id_form_cmof` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `to` varchar(255) NOT NULL,
  `date_examined` date NOT NULL,
  `diagnosis` text NOT NULL,
  `rest_day_no` int(11) NOT NULL,
  `good_health` int(11) NOT NULL,
  `cleared_date` date NOT NULL,
  `cleared_limitation_date` date NOT NULL,
  `no_lifting` tinyint(4) NOT NULL,
  `no_bending` tinyint(4) NOT NULL,
  `no_prolonged` tinyint(4) NOT NULL,
  `limit_equipment` tinyint(4) NOT NULL,
  `other` text NOT NULL,
  `unable_to_work` text NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_cmof`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_cmof`
--

LOCK TABLES `form_cmof` WRITE;
/*!40000 ALTER TABLE `form_cmof` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_cmof` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_cx`
--

DROP TABLE IF EXISTS `form_cx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_cx` (
  `id_form_cx` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `specimen_no` int(11) NOT NULL,
  `examination` text NOT NULL,
  `history` text NOT NULL,
  `comparison` text NOT NULL,
  `technique` text NOT NULL,
  `findings` text NOT NULL,
  `impression` text NOT NULL,
  `radiologist` text NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_cx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_cx`
--

LOCK TABLES `form_cx` WRITE;
/*!40000 ALTER TABLE `form_cx` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_cx` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_dc`
--

DROP TABLE IF EXISTS `form_dc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_dc` (
  `id_form_dc` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_vital_signs` text NOT NULL,
  `id_assessments` text NOT NULL,
  `id_management_plans` text NOT NULL,
  `id_prescriptions` text NOT NULL,
  `id_billings` text NOT NULL,
  `visit_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `visit_complaint` text NOT NULL,
  `history_present_illness` text NOT NULL,
  `height` varchar(30) NOT NULL,
  `weight` varchar(30) NOT NULL,
  `physical_examination` text NOT NULL,
  `skin` text NOT NULL,
  `laboratory_results` text NOT NULL,
  `patient_instructions` text NOT NULL,
  `follow_up` date NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_dc`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_dc`
--

LOCK TABLES `form_dc` WRITE;
/*!40000 ALTER TABLE `form_dc` DISABLE KEYS */;
INSERT INTO `form_dc` VALUES (1,2,1,1,'1','1','1','1','1','2015-07-27','00:00:00','00:00:00','1','1','1','1','1','1','1','1','2015-07-29','2015-07-27 00:00:00'),(2,2,1,1,'1','1','4','3','5','2015-07-13','00:00:00','00:00:00','','5','','','','','','','0000-00-00','2015-07-01 00:00:00');
/*!40000 ALTER TABLE `form_dc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_df`
--

DROP TABLE IF EXISTS `form_df`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_df` (
  `id_form_df` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_vital_signs` text NOT NULL,
  `id_management_plans` text NOT NULL,
  `id_prescriptions` text NOT NULL,
  `id_billings` text NOT NULL,
  `visit_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `follow_up_for` text NOT NULL,
  `remarks` text NOT NULL,
  `diagnosis` text NOT NULL,
  `procedures` text NOT NULL,
  `follow_up_on` date NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_df`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_df`
--

LOCK TABLES `form_df` WRITE;
/*!40000 ALTER TABLE `form_df` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_df` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_ec1`
--

DROP TABLE IF EXISTS `form_ec1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_ec1` (
  `id_form_ec1` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_symptoms` text NOT NULL,
  `id_vital_signs` text NOT NULL,
  `id_otorhinolaryngologicals` text NOT NULL,
  `id_assessments` text NOT NULL,
  `id_managements` text NOT NULL,
  `id_prescriptions` text NOT NULL,
  `id_billing` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `complaint` text NOT NULL,
  `history_present_illness` text NOT NULL,
  `other_findings` text NOT NULL,
  `other_results` text NOT NULL,
  `patient_instructions` text NOT NULL,
  `follow_up` date NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_ec1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_ec1`
--

LOCK TABLES `form_ec1` WRITE;
/*!40000 ALTER TABLE `form_ec1` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_ec1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_ec2`
--

DROP TABLE IF EXISTS `form_ec2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_ec2` (
  `id_form_ec2` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_symptoms` text NOT NULL,
  `id_vital_signs` text NOT NULL,
  `id_otorhinolaryngologicals` text NOT NULL,
  `id_assessments` text NOT NULL,
  `id_managements` text NOT NULL,
  `id_prescriptions` text NOT NULL,
  `id_billing` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `complaint` text NOT NULL,
  `history_present_illness` text NOT NULL,
  `other_findings` text NOT NULL,
  `other_results` text NOT NULL,
  `patient_instructions` text NOT NULL,
  `follow_up` date NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_ec2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_ec2`
--

LOCK TABLES `form_ec2` WRITE;
/*!40000 ALTER TABLE `form_ec2` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_ec2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_ec2bak`
--

DROP TABLE IF EXISTS `form_ec2bak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_ec2bak` (
  `id_form_ec2` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_ec2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_ec2bak`
--

LOCK TABLES `form_ec2bak` WRITE;
/*!40000 ALTER TABLE `form_ec2bak` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_ec2bak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_gnv`
--

DROP TABLE IF EXISTS `form_gnv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_gnv` (
  `id_form_gnv` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_gnv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_gnv`
--

LOCK TABLES `form_gnv` WRITE;
/*!40000 ALTER TABLE `form_gnv` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_gnv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_gsf1`
--

DROP TABLE IF EXISTS `form_gsf1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_gsf1` (
  `id_form_gsf1` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `soap_img` text NOT NULL,
  `subjective` text NOT NULL,
  `plan` text NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_gsf1`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_gsf1`
--

LOCK TABLES `form_gsf1` WRITE;
/*!40000 ALTER TABLE `form_gsf1` DISABLE KEYS */;
INSERT INTO `form_gsf1` VALUES (1,2,1,1,'1','1','1','0000-00-00 00:00:00'),(2,2,1,1,'2','2','2','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `form_gsf1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_gsf2`
--

DROP TABLE IF EXISTS `form_gsf2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_gsf2` (
  `id_form_gsf2` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_gsf2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_gsf2`
--

LOCK TABLES `form_gsf2` WRITE;
/*!40000 ALTER TABLE `form_gsf2` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_gsf2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_gsn`
--

DROP TABLE IF EXISTS `form_gsn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_gsn` (
  `id_form_gsn` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_gsn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_gsn`
--

LOCK TABLES `form_gsn` WRITE;
/*!40000 ALTER TABLE `form_gsn` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_gsn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_gswnt`
--

DROP TABLE IF EXISTS `form_gswnt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_gswnt` (
  `id_form_gswnt` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_gswnt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_gswnt`
--

LOCK TABLES `form_gswnt` WRITE;
/*!40000 ALTER TABLE `form_gswnt` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_gswnt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_lu`
--

DROP TABLE IF EXISTS `form_lu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_lu` (
  `id_form_lu` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_lu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_lu`
--

LOCK TABLES `form_lu` WRITE;
/*!40000 ALTER TABLE `form_lu` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_lu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_mc1`
--

DROP TABLE IF EXISTS `form_mc1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_mc1` (
  `id_form_mc1` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_mc1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_mc1`
--

LOCK TABLES `form_mc1` WRITE;
/*!40000 ALTER TABLE `form_mc1` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_mc1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_mc2`
--

DROP TABLE IF EXISTS `form_mc2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_mc2` (
  `id_form_mc2` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_mc2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_mc2`
--

LOCK TABLES `form_mc2` WRITE;
/*!40000 ALTER TABLE `form_mc2` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_mc2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_mc3`
--

DROP TABLE IF EXISTS `form_mc3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_mc3` (
  `id_form_mc3` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_mc3`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_mc3`
--

LOCK TABLES `form_mc3` WRITE;
/*!40000 ALTER TABLE `form_mc3` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_mc3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_oc1`
--

DROP TABLE IF EXISTS `form_oc1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_oc1` (
  `id_form_oc1` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_oc1`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_oc1`
--

LOCK TABLES `form_oc1` WRITE;
/*!40000 ALTER TABLE `form_oc1` DISABLE KEYS */;
INSERT INTO `form_oc1` VALUES (1,2,1,1,'2015-07-01 00:00:00');
/*!40000 ALTER TABLE `form_oc1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_oc2`
--

DROP TABLE IF EXISTS `form_oc2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_oc2` (
  `id_form_oc2` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_oc2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_oc2`
--

LOCK TABLES `form_oc2` WRITE;
/*!40000 ALTER TABLE `form_oc2` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_oc2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_oc3`
--

DROP TABLE IF EXISTS `form_oc3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_oc3` (
  `id_form_oc3` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_oc3`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_oc3`
--

LOCK TABLES `form_oc3` WRITE;
/*!40000 ALTER TABLE `form_oc3` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_oc3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_oftu`
--

DROP TABLE IF EXISTS `form_oftu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_oftu` (
  `id_form_oftu` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_oftu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_oftu`
--

LOCK TABLES `form_oftu` WRITE;
/*!40000 ALTER TABLE `form_oftu` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_oftu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_oggc`
--

DROP TABLE IF EXISTS `form_oggc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_oggc` (
  `id_form_oggc` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_oggc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_oggc`
--

LOCK TABLES `form_oggc` WRITE;
/*!40000 ALTER TABLE `form_oggc` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_oggc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_ogpc`
--

DROP TABLE IF EXISTS `form_ogpc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_ogpc` (
  `id_form_ogpc` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_ogpc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_ogpc`
--

LOCK TABLES `form_ogpc` WRITE;
/*!40000 ALTER TABLE `form_ogpc` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_ogpc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_ogpf`
--

DROP TABLE IF EXISTS `form_ogpf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_ogpf` (
  `id_form_ogpf` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_ogpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_ogpf`
--

LOCK TABLES `form_ogpf` WRITE;
/*!40000 ALTER TABLE `form_ogpf` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_ogpf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_pediac`
--

DROP TABLE IF EXISTS `form_pediac`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_pediac` (
  `id_form_pediac` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_pediac`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_pediac`
--

LOCK TABLES `form_pediac` WRITE;
/*!40000 ALTER TABLE `form_pediac` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_pediac` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_pulmoc`
--

DROP TABLE IF EXISTS `form_pulmoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_pulmoc` (
  `id_form_pulmoc` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_pulmoc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_pulmoc`
--

LOCK TABLES `form_pulmoc` WRITE;
/*!40000 ALTER TABLE `form_pulmoc` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_pulmoc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_pwnn`
--

DROP TABLE IF EXISTS `form_pwnn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_pwnn` (
  `id_form_pwnn` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_pwnn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_pwnn`
--

LOCK TABLES `form_pwnn` WRITE;
/*!40000 ALTER TABLE `form_pwnn` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_pwnn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_sc`
--

DROP TABLE IF EXISTS `form_sc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_sc` (
  `id_form_sc` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_sc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_sc`
--

LOCK TABLES `form_sc` WRITE;
/*!40000 ALTER TABLE `form_sc` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_sc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_tyl`
--

DROP TABLE IF EXISTS `form_tyl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_tyl` (
  `id_form_tyl` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_tyl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_tyl`
--

LOCK TABLES `form_tyl` WRITE;
/*!40000 ALTER TABLE `form_tyl` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_tyl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_types`
--

DROP TABLE IF EXISTS `form_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_types` (
  `id_form_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id_form_type`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_types`
--

LOCK TABLES `form_types` WRITE;
/*!40000 ALTER TABLE `form_types` DISABLE KEYS */;
INSERT INTO `form_types` VALUES (1,'Consultation Notes',''),(2,'Letters',''),(3,'Results',''),(4,'Diagnostic Study',''),(5,'Procedure',''),(6,'Operation',''),(7,'Nurses Visit','');
/*!40000 ALTER TABLE `form_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_wa`
--

DROP TABLE IF EXISTS `form_wa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_wa` (
  `id_form_wa` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_clinic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_form_wa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_wa`
--

LOCK TABLES `form_wa` WRITE;
/*!40000 ALTER TABLE `form_wa` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_wa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms` (
  `id_form` int(11) NOT NULL AUTO_INCREMENT,
  `id_form_category` int(11) NOT NULL,
  `id_form_type` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_form`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms`
--

LOCK TABLES `forms` WRITE;
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` VALUES (1,0,4,'CBC','form_cbc'),(2,0,4,'CBC Form','form_cbcf'),(3,0,2,'Certificate of Medical Fitness','form_cmof'),(4,0,4,'Chest X-ray','form_cx'),(5,0,1,'Gen SOAP Follow Up','form_gsf1'),(6,0,2,'Medical Certificate 1','form_mc1'),(7,0,2,'Medical Certificate 2','form_mc2'),(8,0,2,'Medical Certificate 3','form_mc3'),(9,0,4,'Ob First Trimester Ultrasound','form_oftu'),(11,0,2,'Thank You Letter','form_tyl'),(12,0,1,'Wound Assessment','form_wa'),(13,3,1,'[Derma] Consult','form_dc'),(14,3,1,'[Derma] Follow-Up','form_df'),(15,0,1,'[ENT] Consult 1','form_ec1'),(16,0,1,'[ENT] Consult 2','form_ec2'),(17,0,1,'[Gen] SOAP Follow-up','form_gsf2'),(18,0,1,'[Gen] SOAP Note','form_gsn'),(19,0,1,'[Gen] SOAP w/ Notes Template','form_gswnt'),(20,0,4,'[LABMERGE] Urinalysis','form_lu'),(21,0,1,'[Ob/Gyn] Gynecology Consult','form_oggc'),(22,0,1,'[Ob/Gyn] Prenatal Consult','form_ogpc'),(23,0,1,'[Ob/Gyn] Prenatal Flowsheet','form_ogpf'),(24,6,1,'[Ophtha] Consult 1','form_oc1'),(25,6,1,'[Ophtha] Consult 2','form_oc2'),(26,6,1,'[Ophtha] Consult 3','form_oc3'),(27,0,1,'[Pedia] Consult','form_pediac'),(28,0,1,'[Pulmo] Consult','form_pulmoc'),(29,0,1,'[Surgery] Consult','form_sc'),(30,0,7,'[Aesthetics] Therapist\'s Notes','form_atn'),(31,0,7,'[Gen] Nurse Visit','form_gnv'),(32,0,7,'[Preventive Wellness] Nurse\'s Notes','form_pwnn');
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `data` longtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'admin','awdawda','{\"user\":[1,1,1,1],\"groups\":[1,1,1,1],\"clinics\":[1,1,1,1],\"test\":[1,1,1,1]}');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hook_module`
--

DROP TABLE IF EXISTS `hook_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hook_module` (
  `id_module` int(11) NOT NULL,
  `id_hook` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id_module`,`id_hook`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hook_module`
--

LOCK TABLES `hook_module` WRITE;
/*!40000 ALTER TABLE `hook_module` DISABLE KEYS */;
INSERT INTO `hook_module` VALUES (1,1,1),(2,1,2);
/*!40000 ALTER TABLE `hook_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hooks`
--

DROP TABLE IF EXISTS `hooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hooks` (
  `id_hook` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `position` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_hook`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hooks`
--

LOCK TABLES `hooks` WRITE;
/*!40000 ALTER TABLE `hooks` DISABLE KEYS */;
INSERT INTO `hooks` VALUES (1,'header','Pages html head section','This hook adds additional elements in the head section of your pages (head section of html)',1),(2,'footer','Pages in footer section','',1);
/*!40000 ALTER TABLE `hooks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `width` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `management_plans`
--

DROP TABLE IF EXISTS `management_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `management_plans` (
  `id_management_plan` int(11) NOT NULL AUTO_INCREMENT,
  `order_procedure_lab` varchar(255) NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY (`id_management_plan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `management_plans`
--

LOCK TABLES `management_plans` WRITE;
/*!40000 ALTER TABLE `management_plans` DISABLE KEYS */;
/*!40000 ALTER TABLE `management_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_history`
--

DROP TABLE IF EXISTS `medical_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medical_history` (
  `id_medical_history` int(11) NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `blood_type` varchar(5) NOT NULL,
  `immunization` text NOT NULL,
  `phas` longtext NOT NULL,
  `personal_social` text NOT NULL,
  `family` longtext NOT NULL,
  `other` text NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_medical_history`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_history`
--

LOCK TABLES `medical_history` WRITE;
/*!40000 ALTER TABLE `medical_history` DISABLE KEYS */;
INSERT INTO `medical_history` VALUES (1,2,1,'O+','Immunization here dude','[[\"date year here 1\",\"some details\"],[\"date year here 2\",\"details here 2\"],[\"1wq\",\"1\"],[\"\",\"1\"],[\"2\",\"\"]]','past personal and social history','[[\"relative name 1\",\"relative desease details 1\"]]','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','0000-00-00 00:00:00'),(2,3,1,'A+','awd','[[\"awd\",\"awd\"]]','','[[\"a\",\"\"],[\"\",\"asq\"]]','wdafag','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `medical_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modules` (
  `id_module` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `version` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_module`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES (1,'firstmodule',1,1),(2,'secondmodule',1,1);
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `otorhinolaryngologicals`
--

DROP TABLE IF EXISTS `otorhinolaryngologicals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `otorhinolaryngologicals` (
  `id_otorhinolaryngological` int(11) NOT NULL AUTO_INCREMENT,
  `head_neck_naf` tinyint(1) NOT NULL DEFAULT '0',
  `head_neck_efa` tinyint(1) NOT NULL DEFAULT '0',
  `head_neck_cl` tinyint(1) NOT NULL DEFAULT '0',
  `head_neck_anm` tinyint(1) NOT NULL DEFAULT '0',
  `head_neck_td` tinyint(1) NOT NULL DEFAULT '0',
  `head_neck_gnd` tinyint(1) NOT NULL DEFAULT '0',
  `head_neck_comments` text NOT NULL,
  `ear_ad_naf` tinyint(1) NOT NULL DEFAULT '0',
  `ear_ad_it` tinyint(1) NOT NULL DEFAULT '0',
  `ear_ad_rh` tinyint(1) NOT NULL DEFAULT '0',
  `ear_ad_col` tinyint(1) NOT NULL DEFAULT '0',
  `ear_ad_ad` tinyint(1) NOT NULL DEFAULT '0',
  `ear_ad_eoec` tinyint(1) NOT NULL DEFAULT '0',
  `ear_ad_ic` tinyint(1) NOT NULL DEFAULT '0',
  `ear_as_naf` tinyint(1) NOT NULL DEFAULT '0',
  `ear_as_it` tinyint(1) NOT NULL DEFAULT '0',
  `ear_as_rh` tinyint(1) NOT NULL DEFAULT '0',
  `ear_as_col` tinyint(1) NOT NULL DEFAULT '0',
  `ear_as_ad` tinyint(1) NOT NULL DEFAULT '0',
  `ear_as_eoec` tinyint(1) NOT NULL DEFAULT '0',
  `ear_as_ic` tinyint(1) NOT NULL DEFAULT '0',
  `ear_comments` text NOT NULL,
  `nose_naf` tinyint(1) NOT NULL DEFAULT '0',
  `nose_sd` tinyint(1) NOT NULL DEFAULT '0',
  `nose_congestion` tinyint(1) NOT NULL DEFAULT '0',
  `nose_erythema` tinyint(1) NOT NULL DEFAULT '0',
  `nose_discharge` tinyint(1) NOT NULL DEFAULT '0',
  `nose_pnd` tinyint(1) NOT NULL DEFAULT '0',
  `nose_it` tinyint(1) NOT NULL DEFAULT '0',
  `nose_mass` tinyint(1) NOT NULL DEFAULT '0',
  `nose_comments` text NOT NULL,
  `oral_naf` tinyint(1) NOT NULL DEFAULT '0',
  `oral_lomu` tinyint(1) NOT NULL DEFAULT '0',
  `oral_tpc` tinyint(1) NOT NULL DEFAULT '0',
  `oral_pnd` tinyint(1) NOT NULL DEFAULT '0',
  `oral_im` bigint(1) NOT NULL DEFAULT '0',
  `oral_mh` tinyint(1) NOT NULL DEFAULT '0',
  `larynx_naf` tinyint(1) NOT NULL DEFAULT '0',
  `larynx_gvca` tinyint(1) NOT NULL DEFAULT '0',
  `larynx_m` tinyint(1) NOT NULL DEFAULT '0',
  `larynx_e` tinyint(1) NOT NULL DEFAULT '0',
  `larynx_comments` text NOT NULL,
  PRIMARY KEY (`id_otorhinolaryngological`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otorhinolaryngologicals`
--

LOCK TABLES `otorhinolaryngologicals` WRITE;
/*!40000 ALTER TABLE `otorhinolaryngologicals` DISABLE KEYS */;
/*!40000 ALTER TABLE `otorhinolaryngologicals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `id_patient` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(60) NOT NULL,
  `middle_name` varchar(80) NOT NULL,
  `last_name` varchar(90) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `birth_place` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `nationality` varchar(70) NOT NULL,
  `occupation` varchar(150) NOT NULL,
  `religion` int(100) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip_code` varchar(15) NOT NULL,
  `province` varchar(150) NOT NULL,
  `country` varchar(150) NOT NULL,
  `address2` text NOT NULL,
  `city2` varchar(100) NOT NULL,
  `zip_code2` varchar(15) NOT NULL,
  `province2` varchar(150) NOT NULL,
  `country2` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `account_type` varchar(50) NOT NULL,
  `reffered_by` varchar(50) NOT NULL,
  `client_source` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `contacts` longtext NOT NULL,
  `identifications` longtext NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_patient`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (2,'Chuck','Osmeña','Lagumbay','Ewan','1990-07-07','Bohol','Male','Single','Filipino','Web Developer',0,'Address Here','Makati','1215','Cavite','PH','SAME AS ABOVE','','','','','c0mp1l3r911@gmail.com','HMO/Company','Unknown','','Larry Lagumbay','Buenafe Lagumbay','[]','[]','2015-07-16 00:00:00'),(3,'Aaaaa','Aaaaa','Aaaaa','','2015-07-22','','Male','Single','61','',0,'','','','','PH','','','','','PH','','Individual','','Walkins','','','[[\"Home Fax\",\"awdawdawd\"],[\"Home Phone\",\"awdawdawdawdawd\"]]','[[\"Driver License\",\"111111111111111111111111111111111111111\"]]','0000-00-00 00:00:00'),(4,'Test','Test','Test','','0000-00-00','','Male','Single','61','',0,'','','','','PH','','','','','PH','','Individual','','Walkins','','','[]','[]','0000-00-00 00:00:00'),(5,'Tstt','Testt','Testt','','0000-00-00','','Male','Single','61','',0,'','','','','PH','','','','','PH','','Individual','','Walkins','','','[[\"Mobile\",\"3rsefsvseg\"],[\"Mobile\",\"eg2w4egsdxv\"],[\"Mobile\",\"eg2w4egsdxv\"]]','[]','0000-00-00 00:00:00'),(6,'Xxx','Xxx','Xxx','','0000-00-00','','Male','Single','61','',0,'','','','','PH','','','','','PH','','Individual','','Walkins','','','[]','[]','2015-07-22 07:44:49'),(7,'Ggg','Ggg','Ggg','ggg','1990-06-12','','Male','Single','61','',0,'','','','','PH','','','','','PH','','Individual','','Walkins','','','[]','[]','2015-07-22 07:59:39'),(8,'Qweqwe','Qweqwe','Qweqwe','qweqwe','1990-07-18','','Male','Single','61','',0,'','','','','PH','','','','','PH','','Individual','','Walkins','','','[]','[]','2015-07-22 08:32:24');
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prescriptions`
--

DROP TABLE IF EXISTS `prescriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prescriptions` (
  `id_prescription` int(11) NOT NULL AUTO_INCREMENT,
  `generic_name` varchar(255) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `preparation` varchar(255) NOT NULL,
  `no` int(11) NOT NULL,
  `mode` varchar(255) NOT NULL,
  `qty_per_take` int(11) NOT NULL,
  `form` varchar(255) NOT NULL,
  `frequency` varchar(255) NOT NULL,
  `remarks` text NOT NULL,
  `duration_start` date NOT NULL,
  `duration_end` date NOT NULL,
  PRIMARY KEY (`id_prescription`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescriptions`
--

LOCK TABLES `prescriptions` WRITE;
/*!40000 ALTER TABLE `prescriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `prescriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id_session` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  UNIQUE KEY `token` (`id_session`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('6ac7c52b474da4f650004850f1196848657128ee',1),('851344a22523533640546e60c5575e07a702bd86',1),('92ca8ddc7778b13fd0eba121984ee7e9f3de5023',1),('b97640ba82d3cefac0dbd661d7747ff481cf1b70',1),('be70939a38954cf760d8cab5ea1ca4f5db7176b5',1),('df6c7b7d1861af6b2b8a387525516acfc0ceadf1',1);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `symptoms`
--

DROP TABLE IF EXISTS `symptoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `symptoms` (
  `id_symptom` int(11) NOT NULL AUTO_INCREMENT,
  `cough` tinyint(4) NOT NULL DEFAULT '0',
  `mass` tinyint(4) NOT NULL DEFAULT '0',
  `ulcer` tinyint(4) NOT NULL DEFAULT '0',
  `dizziness` tinyint(4) NOT NULL DEFAULT '0',
  `headache` tinyint(4) NOT NULL DEFAULT '0',
  `fever` tinyint(4) NOT NULL DEFAULT '0',
  `aural_fullness` tinyint(4) NOT NULL DEFAULT '0',
  `otalgia` tinyint(4) NOT NULL DEFAULT '0',
  `itching` tinyint(4) NOT NULL DEFAULT '0',
  `hearing_loss` tinyint(4) NOT NULL DEFAULT '0',
  `aural_discharge` tinyint(4) NOT NULL DEFAULT '0',
  `tinnitus` tinyint(4) NOT NULL DEFAULT '0',
  `throat_pain` tinyint(4) NOT NULL DEFAULT '0',
  `dysphagia` tinyint(4) NOT NULL DEFAULT '0',
  `odynophagia` tinyint(4) NOT NULL DEFAULT '0',
  `hoarseness` tinyint(4) NOT NULL DEFAULT '0',
  `dyspnea` tinyint(4) NOT NULL DEFAULT '0',
  `hematemesis` tinyint(4) NOT NULL DEFAULT '0',
  `nasal_obstruction` tinyint(4) NOT NULL DEFAULT '0',
  `nasal_discharge` tinyint(4) NOT NULL DEFAULT '0',
  `post_nasal_discharge` tinyint(4) NOT NULL DEFAULT '0',
  `sneezing` tinyint(4) NOT NULL DEFAULT '0',
  `epistaxis` tinyint(4) NOT NULL DEFAULT '0',
  `hyposmia_anosmia` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_symptom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `symptoms`
--

LOCK TABLES `symptoms` WRITE;
/*!40000 ALTER TABLE `symptoms` DISABLE KEYS */;
/*!40000 ALTER TABLE `symptoms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salt` varchar(50) NOT NULL,
  `super_user` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL,
  `first_name` varchar(35) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `specialty` varchar(255) NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `ptr_number` varchar(255) NOT NULL,
  `s2_license_number` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'chuck','26c69d6a6ab08a23ce21a86005014364','CVoj#rt#',1,'ustdoz@gmail.com','Chuck','Osmeña','Lagumbay','7517935','205 Blk. 7 Mabolo Street West Rembo Makati City','Philippines','Makati City',1215,'2015-07-07','Male','Web Developer','','','','1',1,'2015-06-23 18:15:28'),(2,'skubbs','26c69d6a6ab08a23ce21a86005014364','CVoj#rt#',0,'skubbs@gmail.com','Skubbs','','Company','7517935','205 Blk. 7 Mabolo Street West Rembo Makati City','Philippines','Makati City',1215,'2015-07-07','Male','Guest Admin','','','','1',1,'2015-06-23 18:15:28'),(3,'skubbs1','26c69d6a6ab08a23ce21a86005014364','CVoj#rt#',0,'skubbs1@gmail.com','Skubbs1','','Company','7517935','205 Blk. 7 Mabolo Street West Rembo Makati City','Philippines','Makati City',1215,'2015-07-07','Male','Guest Admin','','','','1',1,'2015-06-23 18:15:28'),(4,'skubbs2','26c69d6a6ab08a23ce21a86005014364','CVoj#rt#',0,'skubbs2@gmail.com','Skubbs2','','Company','7517935','205 Blk. 7 Mabolo Street West Rembo Makati City','Philippines','Makati City',1215,'2015-07-07','Male','Guest Admin','','','','1',1,'2015-06-23 18:15:28'),(6,'psadmin','921e244bf87d5f45903fceb8da85e13c','Mk$ZoK%U',0,'info@preskubbs.com','Skubbs','','Philippines','68421112','4th Flr Unit 4K, Westgate Tower 1709 Investment Drive, Madrigal Business Park Ayala Alabang, Muntinlupa City','','',0,'0000-00-00','','Web Developer','','','','',1,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vital_signs`
--

DROP TABLE IF EXISTS `vital_signs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vital_signs` (
  `id_vital_sign` int(11) NOT NULL AUTO_INCREMENT,
  `temperature` varchar(255) NOT NULL,
  `bps` varchar(255) NOT NULL,
  `bpe` varchar(255) NOT NULL,
  `rr` varchar(255) NOT NULL,
  `hr` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id_vital_sign`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vital_signs`
--

LOCK TABLES `vital_signs` WRITE;
/*!40000 ALTER TABLE `vital_signs` DISABLE KEYS */;
/*!40000 ALTER TABLE `vital_signs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-28 18:01:17
