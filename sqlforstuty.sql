-- --------------------------------------------------------
-- 호스트:                          127.0.0.1
-- 서버 버전:                        10.4.32-MariaDB - mariadb.org binary distribution
-- 서버 OS:                        Win64
-- HeidiSQL 버전:                  12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- php 데이터베이스 구조 내보내기
CREATE DATABASE IF NOT EXISTS `php` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;
USE `php`;

-- 테이블 php.members 구조 내보내기
CREATE TABLE IF NOT EXISTS `members` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `user_pw` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `gender` enum('남','여','선택안함') NOT NULL DEFAULT '선택안함',
  `img_path` varchar(50) DEFAULT NULL,
  `img_name` varchar(50) DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='회원관리';

-- 테이블 데이터 php.members:~9 rows (대략적) 내보내기
INSERT INTO `members` (`idx`, `user_id`, `user_pw`, `name`, `age`, `gender`, `img_path`, `img_name`, `regdate`) VALUES
	(6, '', '', '선우용여', 50, '여', './uploads', 'yongyeo.jpg', '2024-04-06 16:16:19'),
	(7, 'excuseme', '1c592e3481c4df3b64a4dd38fae38280', '애경언니', 50, '여', './uploads', 'aegyeong.jpg', '2024-04-06 16:16:30'),
	(8, '', '', '고상순', 45, '여', './uploads', 'gosangsoon.jpg', '2024-04-06 16:16:58'),
	(9, '', '', '박미달', 9, '여', './uploads', 'midal.jpg', '2024-04-06 16:17:10'),
	(10, '', '74be16979710d4c4e7c6647856088456', '쌍절곤김정희', 38, '여', './uploads', 'kimnurse.jpg', '2024-04-06 16:17:28'),
	(11, 'admin', '1234', '김고양이', 34, '남', './uploads', 'yongyeo2.jpg', '2024-04-06 16:41:42'),
	(12, 'admin1', '13579', '김강아지', 35, '남', './uploads', 'midal.jpg', '2024-04-06 16:46:37'),
	(16, 'admin2', 'b6af3f19458ec8e6faff8ee1e0440ecb', '박병아리', 30, '남', '', '', '2024-04-06 19:45:52'),
	(17, 'missdokgo', '81dc9bdb52d04dc20036dbd8313ed055', '독고분녀', 50, '여', './uploads', 'dokgoboonnyeo.jpg', '2024-04-06 20:07:25'),
	(18, 'jeongbae', '81dc9bdb52d04dc20036dbd8313ed055', '김정배', 6, '남', './uploads', 'jeongbae.jpg', '2024-04-06 20:10:52');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
