# SQL Manager 2011 for MySQL 5.1.0.2
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : peticiones


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `peticiones`
    CHARACTER SET 'latin1'
    COLLATE 'latin1_swedish_ci';

USE `peticiones`;

#
# Structure for the `config` table : 
#

CREATE TABLE `config` (
  `id_config` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `name` TEXT COLLATE latin1_swedish_ci,
  `value` TEXT COLLATE latin1_swedish_ci,
  PRIMARY KEY (`id_config`)
)ENGINE=InnoDB
AUTO_INCREMENT=2 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `dependencia` table : 
#

CREATE TABLE `dependencia` (
  `id_dependencia` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL,
  `codigo` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id_dependencia`)
)ENGINE=InnoDB
AUTO_INCREMENT=6 AVG_ROW_LENGTH=3276 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `dependencia_encargado` table : 
#

CREATE TABLE `dependencia_encargado` (
  `id_dependencia_encargado` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_encargado` INTEGER(11) DEFAULT NULL,
  `id_dependencia` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`id_dependencia_encargado`),
  UNIQUE KEY `dependencia_encargado_idx1` (`id_usuario_encargado`, `id_dependencia`)
)ENGINE=InnoDB
AUTO_INCREMENT=2 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `dependencia_tipo` table : 
#

CREATE TABLE `dependencia_tipo` (
  `id_dependencia_tipo` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_dependencia` INTEGER(11) DEFAULT NULL,
  `descripcion` VARCHAR(20) COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_dependencia_tipo`)
)ENGINE=InnoDB
AUTO_INCREMENT=16 AVG_ROW_LENGTH=4096 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `usuario_tipo` table : 
#

CREATE TABLE `usuario_tipo` (
  `id_usuario_tipo` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(100) COLLATE latin1_swedish_ci DEFAULT NULL,
  `permisos` TEXT COLLATE latin1_swedish_ci COMMENT 'en formato json',
  PRIMARY KEY (`id_usuario_tipo`)
)ENGINE=InnoDB
AUTO_INCREMENT=5 AVG_ROW_LENGTH=5461 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `usuario` table : 
#

CREATE TABLE `usuario` (
  `id_usuario` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(20) COLLATE latin1_swedish_ci NOT NULL,
  `apellido` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL,
  `documento` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL,
  `telefono` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL,
  `celular` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL,
  `correo` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  `login` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  `pass` VARCHAR(100) COLLATE latin1_swedish_ci DEFAULT NULL,
  `id_usuario_tipo` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `documento` (`documento`),
  UNIQUE KEY `documento_2` (`documento`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `login_2` (`login`),
  KEY `id_usuario_tipo` (`id_usuario_tipo`),
  CONSTRAINT `persona_fk1` FOREIGN KEY (`id_usuario_tipo`) REFERENCES usuario_tipo (`id_usuario_tipo`)
)ENGINE=InnoDB
AUTO_INCREMENT=16 AVG_ROW_LENGTH=4096 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `peticion` table : 
#

CREATE TABLE `peticion` (
  `id_peticion` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_tipo` INTEGER(11) NOT NULL COMMENT 'id dependencia tipo',
  `fecha_hora` DATETIME NOT NULL COMMENT 'Fecha de solicitud',
  `id_estado` INTEGER(11) NOT NULL,
  `id_usuario` INTEGER(11) DEFAULT NULL COMMENT 'La persona que hace la peticion, anteriormente inscrita al sistema',
  `descripcion` TEXT COLLATE latin1_swedish_ci,
  `id_vereda` INTEGER(11) DEFAULT NULL,
  `fecha_hora_respuestad` DATE DEFAULT NULL,
  `respuesta` TEXT COLLATE latin1_swedish_ci COMMENT 'Es la respuesta que se le da a una peticion cuando es aprobada o rechazada',
  PRIMARY KEY (`id_peticion`),
  KEY `cod_persona` (`id_usuario`),
  CONSTRAINT `peticion_fk1` FOREIGN KEY (`id_usuario`) REFERENCES usuario (`id_usuario`)
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `peticion_estado` table : 
#

CREATE TABLE `peticion_estado` (
  `id_peticion_estado` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL,
  `color` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id_peticion_estado`)
)ENGINE=InnoDB
AUTO_INCREMENT=5 AVG_ROW_LENGTH=4096 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `peticion_control` table : 
#

CREATE TABLE `peticion_control` (
  `id_peticion_control` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  `fecha_hora` DATETIME DEFAULT NULL COMMENT 'fecha y hora del cambio',
  `id_peticion` INTEGER(11) DEFAULT NULL,
  `id_peticion_estado_anterior` INTEGER(11) DEFAULT NULL,
  `id_peticion_estado_nuevo` INTEGER(11) DEFAULT NULL,
  `id_usuario` INTEGER(11) DEFAULT NULL COMMENT 'Usuario que realiza el cambio',
  PRIMARY KEY (`id_peticion_control`),
  KEY `id_peticion_estado_anterior` (`id_peticion_estado_anterior`),
  KEY `id_peticion_estado_nuevo` (`id_peticion_estado_nuevo`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `peticion_control_fk1` FOREIGN KEY (`id_peticion_estado_anterior`) REFERENCES peticion_estado (`id_peticion_estado`),
  CONSTRAINT `peticion_control_fk2` FOREIGN KEY (`id_peticion_estado_nuevo`) REFERENCES peticion_estado (`id_peticion_estado`)
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `peticion_files` table : 
#

CREATE TABLE `peticion_files` (
  `id_peticion_file` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `url` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  `tipo_archivo` ENUM('imagen','pdf') DEFAULT NULL,
  `id_peticion` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`id_peticion_file`)
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `tbl_sys_log` table : 
#

CREATE TABLE `tbl_sys_log` (
  `tbl_sys_log` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_user` INTEGER(11) DEFAULT NULL,
  `funcion` VARCHAR(100) COLLATE latin1_swedish_ci DEFAULT NULL,
  `data_after` TEXT COLLATE latin1_swedish_ci,
  `data_before` TEXT COLLATE latin1_swedish_ci,
  `table` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`tbl_sys_log`)
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `vereda` table : 
#

CREATE TABLE `vereda` (
  `id_vereda` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  `codigo` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id_vereda`)
)ENGINE=InnoDB
AUTO_INCREMENT=56 AVG_ROW_LENGTH=292 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Data for the `config` table  (LIMIT -498,500)
#

INSERT INTO `config` (`id_config`, `name`, `value`) VALUES 
  (1,'formato_encabezado','Mi nombre es Camilo Ruiz');
COMMIT;

#
# Data for the `dependencia` table  (LIMIT -494,500)
#

INSERT INTO `dependencia` (`id_dependencia`, `nombre`, `codigo`) VALUES 
  (1,'dependencia 1',NULL),
  (2,'dependencia 2',NULL),
  (3,'dependencia 3',NULL),
  (4,'dependencia 4',NULL),
  (5,'dependencia 5',NULL);
COMMIT;

#
# Data for the `dependencia_encargado` table  (LIMIT -498,500)
#

INSERT INTO `dependencia_encargado` (`id_dependencia_encargado`, `id_usuario_encargado`, `id_dependencia`) VALUES 
  (1,7,1);
COMMIT;

#
# Data for the `dependencia_tipo` table  (LIMIT -494,500)
#

INSERT INTO `dependencia_tipo` (`id_dependencia_tipo`, `id_dependencia`, `descripcion`) VALUES 
  (1,1,'Económicas'),
  (2,2,'Bienestar'),
  (3,3,'Ayuda de vivienda'),
  (4,1,'Agropecuarias'),
  (15,1,'Piscícolas');
COMMIT;

#
# Data for the `usuario_tipo` table  (LIMIT -495,500)
#

INSERT INTO `usuario_tipo` (`id_usuario_tipo`, `descripcion`, `permisos`) VALUES 
  (1,'Encargado',NULL),
  (2,'SuperUser',NULL),
  (3,'Solicitantes',NULL),
  (4,'Administrador',NULL);
COMMIT;

#
# Data for the `usuario` table  (LIMIT -495,500)
#

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `documento`, `telefono`, `celular`, `correo`, `login`, `pass`, `id_usuario_tipo`) VALUES 
  (1,'julian david','garcia paz','2','1','5','','2','c81e728d9d4c2f636f067f89cc14862c',2),
  (5,'anyela','leiton','4','5','7',NULL,'4','a87ff679a2f3e71d9181a67b7542122c',4),
  (7,'camilo','ruiz','1','7','','','1','c4ca4238a0b923820dcc509a6f75849b',1),
  (14,'12112','12112','3','12112','12112','','3','eccbc87e4b5ce2fe28308fd9f2a7baf3',3);
COMMIT;

#
# Data for the `peticion_estado` table  (LIMIT -495,500)
#

INSERT INTO `peticion_estado` (`id_peticion_estado`, `descripcion`, `color`) VALUES 
  (1,'En espera',NULL),
  (2,'Aceptada',NULL),
  (3,'Rechazada',NULL),
  (4,'Cancelada',NULL);
COMMIT;

#
# Data for the `vereda` table  (LIMIT -444,500)
#

INSERT INTO `vereda` (`id_vereda`, `nombre`, `codigo`) VALUES 
  (1,'ALTO PIENDAMO','01'),
  (2,'EL CARMEN','02'),
  (3,'EL AGRADO','03'),
  (4,'LA ESPERANZA','04'),
  (5,'ONCE DE NOVIEMBRE','05'),
  (6,'SAN ISIDRO','06'),
  (7,'VILLA NUEVA','07'),
  (8,'CORRALES','08'),
  (9,'LA FLORIDA','09'),
  (10,'VILLA MERCEDES','10'),
  (11,'LA LORENA','11'),
  (12,'MATARREDONDA','12'),
  (13,'GUAICOSECO','13'),
  (14,'VALPARAISO','14'),
  (15,'SAN MIGUEL','15'),
  (16,'LOMA CORTA','16'),
  (17,'SANTA HELENA','17'),
  (18,'NUEVO PORVENIR','18'),
  (19,'VEGA NUÑEZ','19'),
  (20,'LA UNION','20'),
  (21,'SALINAS','21'),
  (22,'CAÑA DULCE','22'),
  (23,'MATECAÑA','23'),
  (24,'LOS PINOS','24'),
  (25,'CALIFORNIA','25'),
  (26,'CAMPO ALEGRE','26'),
  (27,'UVALES','27'),
  (28,'SAN JOSE','28'),
  (29,'OCTAVIO','29'),
  (30,'EL DIVISO','30'),
  (31,'EL HOGAR','31'),
  (32,'MEDIA LOMA','32'),
  (33,'LOS NARANJOS','33'),
  (34,'LOS ARADOS','34'),
  (35,'EL PINAR','35'),
  (36,'LA PALOMERA','36'),
  (37,'VIVAS BALCAZAR','37'),
  (38,'BELLAVISTA','38'),
  (39,'FARALLONES','39'),
  (40,'ALTAMIRA','40'),
  (41,'QUEBRADA GRANDE','41'),
  (42,'LA ESMERALDA','42'),
  (43,'CAMILO TORRES','43'),
  (44,'PU ENTECITA','44'),
  (45,'MELCHO','45'),
  (46,'EL MANGO','46'),
  (47,'LA INDEPENDENCIA','47'),
  (48,'SAN PEDRO','48'),
  (49,'BETANIA','49'),
  (50,'EL ARRAYAN','50'),
  (51,'LA MARIA','51'),
  (52,'RESGUARDO LA MARIA','52'),
  (53,'LOS ALPES','53'),
  (54,'NUEVA PRIMAVERA','54'),
  (55,'PRIMAVERA','55');
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;