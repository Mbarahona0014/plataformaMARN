-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para mapas
DROP DATABASE IF EXISTS `mapas`;
CREATE DATABASE IF NOT EXISTS `mapas` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mapas`;

-- Volcando estructura para procedimiento mapas.actualizarAmbito
DROP PROCEDURE IF EXISTS `actualizarAmbito`;
DELIMITER //
CREATE PROCEDURE `actualizarAmbito`(IN `nom` VARCHAR(100), IN `pes` DOUBLE, IN `descrip` TEXT, IN `id_ambito` INT)
BEGIN
  DECLARE count_ambito INT;
  SELECT COUNT(*) INTO count_ambito FROM ambito WHERE (nombre = nom) AND id <> id_ambito;
  IF(count_ambito >= 1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    UPDATE ambito SET nombre = nom, peso= pes, descripcion = descrip WHERE id = id_ambito;
    SELECT 1 AS 'resultado';
  END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento mapas.actualizarArea
DROP PROCEDURE IF EXISTS `actualizarArea`;
DELIMITER //
CREATE PROCEDURE `actualizarArea`(IN `nom` VARCHAR(100), IN `ubica` VARCHAR(100), IN `descrip` TEXT, IN `obser` TEXT, IN `exten` DECIMAL(10,2), IN `id_area` INT)
BEGIN
  DECLARE count_area INT;
  SELECT COUNT(*) INTO count_area FROM area_natural WHERE (nombre = nom) AND id <> id_area;
  IF(count_area >= 1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    UPDATE area_natural SET nombre = nom, ubicacion = ubica, descripcion = descrip, observaciones = obser, extension_terreno = exten WHERE id = id_area;
    SELECT 1 AS 'resultado';
  END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento mapas.actualizarDetalle
DROP PROCEDURE IF EXISTS `actualizarDetalle`;
DELIMITER //
CREATE PROCEDURE `actualizarDetalle`(IN `evi` TEXT, IN `obs` TEXT, IN `idte` INT, IN `idam` INT, IN `idpt` INT, IN `iden` INT, IN `iddet` INT)
BEGIN
  DECLARE count_detalle INT;
  SELECT COUNT(*) INTO count_detalle FROM detalle_reporte WHERE evidencia = evi AND observaciones = obs AND id <> iddet;
  IF(count_detalle >= 1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    UPDATE detalle_reporte SET evidencia = evi, observaciones = obs, id_tema = idte, id_ambito=idam, id_puntaje=idpt, id_encabezado=iden WHERE id = iddet;
    SELECT 1 AS 'resultado';
  END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento mapas.actualizarEncabezadoReporte
DROP PROCEDURE IF EXISTS `actualizarEncabezadoReporte`;
DELIMITER //
CREATE PROCEDURE `actualizarEncabezadoReporte`(IN `fec` DATE, IN `idAr` INT, IN `idAc` INT, IN `idER` INT)
BEGIN
    UPDATE encabezado_reporte SET fecha_evaluacion=fec, id_area_natural =idAr, id_area_conservacion = idAc WHERE id=idER;
    SELECT 1 AS 'resultado';
END//
DELIMITER ;

-- Volcando estructura para procedimiento mapas.actualizarEvaluador
DROP PROCEDURE IF EXISTS `actualizarEvaluador`;
DELIMITER //
CREATE PROCEDURE `actualizarEvaluador`(IN `nom` TEXT, IN `apl` TEXT, IN `cor` TEXT, IN `tel` TEXT, IN `ins` VARCHAR(100), IN `car` VARCHAR(100), IN `idEv` INT)
BEGIN
  UPDATE evaluador SET nombres=nom, apellidos=apl, correo=cor, telefono=tel, institucion=ins, cargo=car WHERE id=idEv;
  SELECT 1 AS 'resultado';
END//
DELIMITER ;

-- Volcando estructura para procedimiento mapas.actualizarEvaluadorEncabezado
DROP PROCEDURE IF EXISTS `actualizarEvaluadorEncabezado`;
DELIMITER //
CREATE PROCEDURE `actualizarEvaluadorEncabezado`(IN `idEn` INT, IN `idEv` INT, IN `id_EvEn` INT)
BEGIN
  DECLARE count_EvEn INT;
  SELECT COUNT(*) INTO count_EvEn FROM evaluador_encabezado WHERE id_encabezado_reporte = idEn AND id_evaluador = idEv AND id <> id_tema;
  IF(count_EvEn >= 1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    UPDATE evaluador_encabezado SET id_encabezado_reporte = idEn, id_evaluador = idEv WHERE id = id_EvEn;
    SELECT 1 AS 'resultado';
  END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento mapas.actualizarPuntaje
DROP PROCEDURE IF EXISTS `actualizarPuntaje`;
DELIMITER //
CREATE PROCEDURE `actualizarPuntaje`(IN `pts` INT, IN `descrip` TEXT, IN `idTema` INT, IN `id_puntaje` INT)
BEGIN
  DECLARE count_puntaje INT;
  SELECT COUNT(*) INTO count_puntaje FROM puntaje WHERE (descripcion = descrip) AND id <> id_puntaje;
  IF(count_puntaje >= 1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    UPDATE puntaje SET puntaje = pts, descripcion = descrip, id_tema = idTema WHERE id = id_puntaje;
    SELECT 1 AS 'resultado';
  END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento mapas.actualizarTema
DROP PROCEDURE IF EXISTS `actualizarTema`;
DELIMITER //
CREATE PROCEDURE `actualizarTema`(IN `nom` VARCHAR(100), IN `descrip` TEXT, IN `obser` TEXT, IN `id_am` INT, IN `id_tema` INT)
BEGIN
  DECLARE count_tema INT;
  SELECT COUNT(*) INTO count_tema FROM tema WHERE (nombre = nom) AND id <> id_tema;
  IF(count_tema >= 1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    UPDATE tema SET nombre = nom, descripcion = descrip, observaciones = obser, id_ambito = id_am WHERE id = id_tema;
    SELECT 1 AS 'resultado';
  END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento mapas.agregarAmbito
DROP PROCEDURE IF EXISTS `agregarAmbito`;
DELIMITER //
CREATE PROCEDURE `agregarAmbito`(IN `nom` VARCHAR(100), IN `pes` DOUBLE, IN `descrip` TEXT)
BEGIN
  DECLARE count_ambito INT;
  SELECT COUNT(*) INTO count_ambito FROM ambito WHERE nombre = nom;
  IF(count_ambito >= 1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    INSERT INTO ambito VALUES(NULL,nom,pes,descrip);
    SELECT 1 AS 'resultado';
  END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento mapas.agregarArea
DROP PROCEDURE IF EXISTS `agregarArea`;
DELIMITER //
CREATE PROCEDURE `agregarArea`(IN `nom` VARCHAR(100), IN `ubica` VARCHAR(100), IN `descrip` TEXT, IN `obser` TEXT, IN `exten` DECIMAL(10,2))
BEGIN
  DECLARE count_area INT;
  SELECT COUNT(*) INTO count_area FROM area_natural WHERE nombre = nom;
  IF(count_area >= 1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    INSERT INTO area_natural VALUES(NULL, nom, ubica, descrip, obser, exten);
    SELECT 1 AS 'resultado';
  END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento mapas.agregarDetalle
DROP PROCEDURE IF EXISTS `agregarDetalle`;
DELIMITER //
CREATE PROCEDURE `agregarDetalle`(IN `evi` TEXT, IN `obs` TEXT, IN `idte` INT, IN `idam` INT, IN `idpt` INT, IN `iden` INT)
BEGIN
  DECLARE count_detalle INT;
  SELECT COUNT(*) INTO count_detalle FROM detalle_reporte WHERE evidencia = evi AND observaciones = obs;
  IF(count_detalle >= 1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    INSERT INTO detalle_reporte VALUES(NULL,evi,obs,idte,idam,idpt,iden);
    SELECT 1 AS 'resultado';
  END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento mapas.agregarEncabezadoReporte
DROP PROCEDURE IF EXISTS `agregarEncabezadoReporte`;
DELIMITER //
CREATE PROCEDURE `agregarEncabezadoReporte`(IN `fec` DATE, IN `idAr` INT, IN `idAc` INT)
BEGIN
    INSERT INTO encabezado_reporte VALUES(NULL,idAr,idAc,fec,0);
    SELECT 1 AS 'resultado';
END//
DELIMITER ;

-- Volcando estructura para procedimiento mapas.agregarEvaluador
DROP PROCEDURE IF EXISTS `agregarEvaluador`;
DELIMITER //
CREATE PROCEDURE `agregarEvaluador`(IN `nom` TEXT, IN `apl` TEXT, IN `cor` TEXT, IN `tel` TEXT, IN `ins` VARCHAR(100), IN `car` VARCHAR(100))
BEGIN
  DECLARE count_evaluador INT;
  SELECT COUNT(*) INTO count_evaluador FROM evaluador WHERE nombres = nom AND apellidos = apl;
  IF (count_evaluador >=1) THEN 
    SELECT 2 AS 'resultado';
  ELSE
    INSERT INTO evaluador VALUES(NULL,nom,apl,cor,tel,ins,car);
    SELECT 1 AS 'resultado';
  END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento mapas.agregarEvaluadorEncabezado
DROP PROCEDURE IF EXISTS `agregarEvaluadorEncabezado`;
DELIMITER //
CREATE PROCEDURE `agregarEvaluadorEncabezado`(IN `idEn` INT, IN `idEv` INT)
BEGIN
  DECLARE count_EvEn INT;
  SELECT COUNT(*) INTO count_EvEn FROM evaluador_encabezado WHERE id_encabezado_reporte = idEn AND id_evaluador = idEv;
  IF(count_EvEn >= 1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    INSERT INTO evaluador_encabezado VALUES(NULL, idEn, idEv);
    SELECT 1 AS 'resultado';
  END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento mapas.agregarPuntaje
DROP PROCEDURE IF EXISTS `agregarPuntaje`;
DELIMITER //
CREATE PROCEDURE `agregarPuntaje`(IN `pts` INT, IN `descrip` TEXT, IN `idTema` INT)
BEGIN
  DECLARE count_puntaje INT;
  SELECT COUNT(*) INTO count_puntaje FROM puntaje WHERE descripcion = descrip;
  IF(count_puntaje >= 1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    INSERT INTO puntaje VALUES(NULL, pts, descrip,idTema);
    SELECT 1 AS 'resultado';
  END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento mapas.agregarTema
DROP PROCEDURE IF EXISTS `agregarTema`;
DELIMITER //
CREATE PROCEDURE `agregarTema`(IN `nom` VARCHAR(100), IN `descrip` TEXT, IN `obser` TEXT, IN `id_am` INT)
BEGIN
  DECLARE count_tema INT;
  SELECT COUNT(*) INTO count_tema FROM tema WHERE nombre = nom;
  IF(count_tema >= 1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    INSERT INTO tema VALUES(NULL, nom, descrip, obser,id_am);
    SELECT 1 AS 'resultado';
  END IF;
END//
DELIMITER ;

-- Volcando estructura para tabla mapas.ambito
DROP TABLE IF EXISTS `ambito`;
CREATE TABLE IF NOT EXISTS `ambito` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `peso` double DEFAULT NULL,
  `descripcion` text COLLATE utf8mb3_spanish2_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.archivoincendio
DROP TABLE IF EXISTS `archivoincendio`;
CREATE TABLE IF NOT EXISTS `archivoincendio` (
  `IdArchivo` int NOT NULL AUTO_INCREMENT,
  `Archivo` text,
  `IdIncendio` int DEFAULT NULL,
  PRIMARY KEY (`IdArchivo`),
  KEY `IdIncendio` (`IdIncendio`),
  CONSTRAINT `archivoincendio_ibfk_1` FOREIGN KEY (`IdIncendio`) REFERENCES `incendioforestal` (`IdIncendio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.archivoqueja
DROP TABLE IF EXISTS `archivoqueja`;
CREATE TABLE IF NOT EXISTS `archivoqueja` (
  `idarchivo` int NOT NULL AUTO_INCREMENT,
  `archivo` text,
  `idqueja` int DEFAULT NULL,
  PRIMARY KEY (`idarchivo`),
  KEY `idqueja` (`idqueja`),
  CONSTRAINT `archivoqueja_ibfk_1` FOREIGN KEY (`idqueja`) REFERENCES `queja` (`idqueja`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.archivorestauracion
DROP TABLE IF EXISTS `archivorestauracion`;
CREATE TABLE IF NOT EXISTS `archivorestauracion` (
  `IdArchivo` int NOT NULL AUTO_INCREMENT,
  `Archivo` text,
  `id_restauracion` int DEFAULT NULL,
  PRIMARY KEY (`IdArchivo`),
  KEY `id_restauracion` (`id_restauracion`),
  CONSTRAINT `archivorestauracion_ibfk_1` FOREIGN KEY (`id_restauracion`) REFERENCES `restauracion_points` (`id_restauracion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.archivos_evaluacion
DROP TABLE IF EXISTS `archivos_evaluacion`;
CREATE TABLE IF NOT EXISTS `archivos_evaluacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `archivo` text COLLATE utf8mb4_general_ci,
  `id_detalle` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_archi_evalu_evaluaciones` (`id_detalle`) USING BTREE,
  CONSTRAINT `FK_archivos_evaluacion_detalle_reporte` FOREIGN KEY (`id_detalle`) REFERENCES `detalle_reporte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.areanaturalprotegida
DROP TABLE IF EXISTS `areanaturalprotegida`;
CREATE TABLE IF NOT EXISTS `areanaturalprotegida` (
  `IdAreaNaturalProtegida` int NOT NULL AUTO_INCREMENT,
  `AreaNaturalProtegida` varchar(900) DEFAULT NULL,
  `Activo` int DEFAULT NULL,
  `Extension` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdAreaNaturalProtegida`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.area_natural
DROP TABLE IF EXISTS `area_natural`;
CREATE TABLE IF NOT EXISTS `area_natural` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `ubicacion` varchar(100) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb3_spanish2_ci,
  `observaciones` text COLLATE utf8mb3_spanish2_ci,
  `extension_terreno` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.asignacion_queja
DROP TABLE IF EXISTS `asignacion_queja`;
CREATE TABLE IF NOT EXISTS `asignacion_queja` (
  `id_asignacion` int NOT NULL AUTO_INCREMENT,
  `idqueja` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `id_cordinador` int DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`id_asignacion`),
  KEY `idqueja` (`idqueja`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_cordinador` (`id_cordinador`),
  CONSTRAINT `asignacion_queja_ibfk_1` FOREIGN KEY (`idqueja`) REFERENCES `queja` (`idqueja`),
  CONSTRAINT `asignacion_queja_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  CONSTRAINT `asignacion_queja_ibfk_3` FOREIGN KEY (`id_cordinador`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.causaafectacionqueja
DROP TABLE IF EXISTS `causaafectacionqueja`;
CREATE TABLE IF NOT EXISTS `causaafectacionqueja` (
  `idcausaafectacionqueja` int NOT NULL,
  `causaafectacion` varchar(100) DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`idcausaafectacionqueja`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.causaincendio
DROP TABLE IF EXISTS `causaincendio`;
CREATE TABLE IF NOT EXISTS `causaincendio` (
  `IdCausaIncendio` int NOT NULL AUTO_INCREMENT,
  `CausaIncendio` varchar(50) DEFAULT NULL,
  `Activo` int DEFAULT NULL,
  PRIMARY KEY (`IdCausaIncendio`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.copia_cumplimiento
DROP TABLE IF EXISTS `copia_cumplimiento`;
CREATE TABLE IF NOT EXISTS `copia_cumplimiento` (
  `id_cumplimiento` int NOT NULL,
  `dga` int DEFAULT NULL,
  `numero_auditorias` int DEFAULT NULL,
  `proyecto` text,
  `sector` varchar(150) DEFAULT NULL,
  `ubicacion` varchar(250) DEFAULT NULL,
  `latitud` double(12,8) DEFAULT NULL,
  `longitud` double(12,8) DEFAULT NULL,
  `area` double(12,2) DEFAULT NULL,
  `medida_cumplida_afianzada` varchar(45) DEFAULT NULL,
  `medida_cumplida_obligatoria` varchar(45) DEFAULT NULL,
  `medida_incumplida_afianzada` varchar(45) DEFAULT NULL,
  `medida_incumplida_obligatoria` varchar(45) DEFAULT NULL,
  `cumplida_ambiental_afianzada` varchar(45) DEFAULT NULL,
  `cumplida_ambiental_obligatoria` varchar(45) DEFAULT NULL,
  `cumplida_social_afianzada` varchar(45) DEFAULT NULL,
  `cumplida_social_obligatoria` varchar(45) DEFAULT NULL,
  `cumplida_fisica_afianzada` varchar(45) DEFAULT NULL,
  `cumplida_fisica_obligatoria` varchar(45) DEFAULT NULL,
  `cumplida_seguridad_afianzada` varchar(45) DEFAULT NULL,
  `cumplida_seguridad_obligatoria` varchar(45) DEFAULT NULL,
  `cumplida_otros_afianzada` varchar(45) DEFAULT NULL,
  `cumplida_otros_obligatoria` varchar(45) DEFAULT NULL,
  `incumplida_ambiental_afianzada` varchar(45) DEFAULT NULL,
  `incumplida_ambiental_obligatoria` varchar(45) DEFAULT NULL,
  `incumplida_social_afianzada` varchar(45) DEFAULT NULL,
  `incumplida_social_obligatoria` varchar(45) DEFAULT NULL,
  `incumplida_fisica_afianzada` varchar(45) DEFAULT NULL,
  `incumplida_fisica_obligatoria` varchar(45) DEFAULT NULL,
  `incumplida_seguridad_afianzada` varchar(45) DEFAULT NULL,
  `incumplida_seguridad_obligatoria` varchar(45) DEFAULT NULL,
  `incumplida_otros_afianzada` varchar(45) DEFAULT NULL,
  `incumplida_otros_obligatoria` varchar(45) DEFAULT NULL,
  `departamento` varchar(75) DEFAULT NULL,
  `municipio` varchar(75) DEFAULT NULL,
  `canton` varchar(75) DEFAULT NULL,
  `coordenadas` varchar(45) DEFAULT NULL,
  `fecha_permiso` date DEFAULT NULL,
  `fecha_ultima_auditoria` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.correlativo
DROP TABLE IF EXISTS `correlativo`;
CREATE TABLE IF NOT EXISTS `correlativo` (
  `idcorrelativo` int NOT NULL AUTO_INCREMENT,
  `correlativo` int DEFAULT NULL,
  `anio` int DEFAULT NULL,
  PRIMARY KEY (`idcorrelativo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.correoqueja
DROP TABLE IF EXISTS `correoqueja`;
CREATE TABLE IF NOT EXISTS `correoqueja` (
  `id` int NOT NULL AUTO_INCREMENT,
  `correo` varchar(900) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.cumplimiento
DROP TABLE IF EXISTS `cumplimiento`;
CREATE TABLE IF NOT EXISTS `cumplimiento` (
  `id_cumplimiento` int NOT NULL,
  `dga` int DEFAULT NULL,
  `numero_auditorias` int DEFAULT NULL,
  `proyecto` text,
  `sector` varchar(150) DEFAULT NULL,
  `ubicacion` varchar(250) DEFAULT NULL,
  `latitud` double(12,8) DEFAULT NULL,
  `longitud` double(12,8) DEFAULT NULL,
  `area` double(12,2) DEFAULT NULL,
  `fianza` double(12,2) NOT NULL,
  `medida_cumplida_afianzada` varchar(45) DEFAULT NULL,
  `medida_cumplida_obligatoria` varchar(45) DEFAULT NULL,
  `medida_incumplida_afianzada` varchar(45) DEFAULT NULL,
  `medida_incumplida_obligatoria` varchar(45) DEFAULT NULL,
  `cumplida_ambiental_afianzada` varchar(45) DEFAULT NULL,
  `cumplida_ambiental_obligatoria` varchar(45) DEFAULT NULL,
  `cumplida_social_afianzada` varchar(45) DEFAULT NULL,
  `cumplida_social_obligatoria` varchar(45) DEFAULT NULL,
  `cumplida_fisica_afianzada` varchar(45) DEFAULT NULL,
  `cumplida_fisica_obligatoria` varchar(45) DEFAULT NULL,
  `cumplida_seguridad_afianzada` varchar(45) DEFAULT NULL,
  `cumplida_seguridad_obligatoria` varchar(45) DEFAULT NULL,
  `cumplida_otros_afianzada` varchar(45) DEFAULT NULL,
  `cumplida_otros_obligatoria` varchar(45) DEFAULT NULL,
  `incumplida_ambiental_afianzada` varchar(45) DEFAULT NULL,
  `incumplida_ambiental_obligatoria` varchar(45) DEFAULT NULL,
  `incumplida_social_afianzada` varchar(45) DEFAULT NULL,
  `incumplida_social_obligatoria` varchar(45) DEFAULT NULL,
  `incumplida_fisica_afianzada` varchar(45) DEFAULT NULL,
  `incumplida_fisica_obligatoria` varchar(45) DEFAULT NULL,
  `incumplida_seguridad_afianzada` varchar(45) DEFAULT NULL,
  `incumplida_seguridad_obligatoria` varchar(45) DEFAULT NULL,
  `incumplida_otros_afianzada` varchar(45) DEFAULT NULL,
  `incumplida_otros_obligatoria` varchar(45) DEFAULT NULL,
  `departamento` varchar(75) DEFAULT NULL,
  `municipio` varchar(75) DEFAULT NULL,
  `canton` varchar(75) DEFAULT NULL,
  `coordenadas` varchar(45) DEFAULT NULL,
  `fecha_permiso` date DEFAULT NULL,
  `fecha_ultima_auditoria` date DEFAULT NULL,
  PRIMARY KEY (`id_cumplimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.depto
DROP TABLE IF EXISTS `depto`;
CREATE TABLE IF NOT EXISTS `depto` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Depto` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.detalle_reporte
DROP TABLE IF EXISTS `detalle_reporte`;
CREATE TABLE IF NOT EXISTS `detalle_reporte` (
  `id` int NOT NULL AUTO_INCREMENT,
  `evidencia` text COLLATE utf8mb3_spanish2_ci,
  `observaciones` text COLLATE utf8mb3_spanish2_ci,
  `id_tema` int DEFAULT NULL,
  `id_ambito` int DEFAULT NULL,
  `id_puntaje` int DEFAULT NULL,
  `id_encabezado` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tema` (`id_tema`),
  KEY `id_ambito` (`id_ambito`),
  KEY `id_puntaje` (`id_puntaje`),
  KEY `detalle_reporte_ibfk_4` (`id_encabezado`),
  CONSTRAINT `detalle_reporte_ibfk_1` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id`),
  CONSTRAINT `detalle_reporte_ibfk_2` FOREIGN KEY (`id_ambito`) REFERENCES `ambito` (`id`),
  CONSTRAINT `detalle_reporte_ibfk_3` FOREIGN KEY (`id_puntaje`) REFERENCES `puntaje` (`id`),
  CONSTRAINT `detalle_reporte_ibfk_4` FOREIGN KEY (`id_encabezado`) REFERENCES `encabezado_reporte` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.documentos
DROP TABLE IF EXISTS `documentos`;
CREATE TABLE IF NOT EXISTS `documentos` (
  `id_documento` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(500) NOT NULL,
  `archivo` varchar(50) DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`id_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.dpto
DROP TABLE IF EXISTS `dpto`;
CREATE TABLE IF NOT EXISTS `dpto` (
  `id_dpto` int NOT NULL AUTO_INCREMENT,
  `depto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_dpto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.encabezado_reporte
DROP TABLE IF EXISTS `encabezado_reporte`;
CREATE TABLE IF NOT EXISTS `encabezado_reporte` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_area_natural` int DEFAULT NULL,
  `id_area_conservacion` int DEFAULT NULL,
  `fecha_evaluacion` date DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_area_natural` (`id_area_natural`),
  KEY `encabezado_reporte_ibfk_2` (`id_area_conservacion`),
  CONSTRAINT `encabezado_reporte_ibfk_1` FOREIGN KEY (`id_area_natural`) REFERENCES `area_natural` (`id`),
  CONSTRAINT `encabezado_reporte_ibfk_2` FOREIGN KEY (`id_area_conservacion`) REFERENCES `paisaje` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.equipotecnico
DROP TABLE IF EXISTS `equipotecnico`;
CREATE TABLE IF NOT EXISTS `equipotecnico` (
  `IdEquipoTec` int NOT NULL AUTO_INCREMENT,
  `EquipoTecnico` varchar(50) DEFAULT NULL,
  `Activo` int DEFAULT NULL,
  PRIMARY KEY (`IdEquipoTec`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.especie
DROP TABLE IF EXISTS `especie`;
CREATE TABLE IF NOT EXISTS `especie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) DEFAULT NULL,
  `genero` varchar(9000) DEFAULT NULL,
  `especie` varchar(9000) DEFAULT NULL,
  `subespecie` varchar(9000) DEFAULT NULL,
  `nombrecomun` text,
  `categoria` varchar(9000) DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1203 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.estuvoenetapa3
DROP TABLE IF EXISTS `estuvoenetapa3`;
CREATE TABLE IF NOT EXISTS `estuvoenetapa3` (
  `id_es` int NOT NULL AUTO_INCREMENT,
  `idqueja` int DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`id_es`),
  KEY `idqueja` (`idqueja`),
  CONSTRAINT `estuvoenetapa3_ibfk_1` FOREIGN KEY (`idqueja`) REFERENCES `queja` (`idqueja`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.evaluador
DROP TABLE IF EXISTS `evaluador`;
CREATE TABLE IF NOT EXISTS `evaluador` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `apellidos` varchar(100) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `telefono` varchar(50) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `institucion` varchar(100) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `cargo` varchar(100) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.evaluador_encabezado
DROP TABLE IF EXISTS `evaluador_encabezado`;
CREATE TABLE IF NOT EXISTS `evaluador_encabezado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_encabezado_reporte` int DEFAULT NULL,
  `id_evaluador` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_encabezado_reporte` (`id_encabezado_reporte`),
  KEY `id_evaluador` (`id_evaluador`),
  CONSTRAINT `evaluador_encabezado_ibfk_1` FOREIGN KEY (`id_encabezado_reporte`) REFERENCES `encabezado_reporte` (`id`),
  CONSTRAINT `evaluador_encabezado_ibfk_2` FOREIGN KEY (`id_evaluador`) REFERENCES `evaluador` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.formarecepcion
DROP TABLE IF EXISTS `formarecepcion`;
CREATE TABLE IF NOT EXISTS `formarecepcion` (
  `IdFormaRecepcion` int NOT NULL AUTO_INCREMENT,
  `FormaRecepcion` varchar(50) DEFAULT NULL,
  `Activo` int DEFAULT NULL,
  PRIMARY KEY (`IdFormaRecepcion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.granjas
DROP TABLE IF EXISTS `granjas`;
CREATE TABLE IF NOT EXISTS `granjas` (
  `id_granja` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(45) DEFAULT NULL,
  `propietario` varchar(200) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `departamento` varchar(200) DEFAULT NULL,
  `municipio` varchar(200) DEFAULT NULL,
  `canton` varchar(200) DEFAULT NULL,
  `caserio` varchar(200) DEFAULT NULL,
  `latitud` double(12,6) DEFAULT NULL,
  `longitud` double(12,6) DEFAULT NULL,
  `fin` varchar(45) DEFAULT NULL,
  `galp` int DEFAULT NULL,
  `capacidad` int DEFAULT NULL,
  `linea` varchar(500) DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  PRIMARY KEY (`id_granja`)
) ENGINE=InnoDB AUTO_INCREMENT=460 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.incendioforestal
DROP TABLE IF EXISTS `incendioforestal`;
CREATE TABLE IF NOT EXISTS `incendioforestal` (
  `IdIncendio` int NOT NULL AUTO_INCREMENT,
  `IdAreaNaturalProtegida` int DEFAULT NULL,
  `FechaReporte` datetime DEFAULT NULL,
  `FechaIncendio` datetime DEFAULT NULL,
  `FechaAvisoIncendio` datetime DEFAULT NULL,
  `IdFormaRecepcion` int DEFAULT NULL,
  `IdTopografia` int DEFAULT NULL,
  `IdTenenciaPropiedad` int DEFAULT NULL,
  `IdInicioFuego` int DEFAULT NULL,
  `EstatusIncendio` int DEFAULT NULL,
  `ArbolesAfectados` int DEFAULT NULL,
  `ArbolesEspecies` int DEFAULT NULL,
  `FaunaAfectada` int DEFAULT NULL,
  `FaunaEspecies` int DEFAULT NULL,
  `VelocidadPropagacion` varchar(50) DEFAULT NULL,
  `RutaAcceso` text,
  `Comentarios` text,
  `Latitud` varchar(200) DEFAULT NULL,
  `Longitud` varchar(200) DEFAULT NULL,
  `Geoposicion` varchar(500) DEFAULT NULL,
  `FechaFinalizacion` datetime DEFAULT NULL,
  `UsuarioCreacion` int DEFAULT NULL,
  `IdEquipoTec` int DEFAULT NULL,
  `Canton` varchar(500) DEFAULT NULL,
  `Eliminado` int DEFAULT NULL,
  `coordenadas` text,
  PRIMARY KEY (`IdIncendio`),
  KEY `IdAreaNaturalProtegida` (`IdAreaNaturalProtegida`),
  KEY `IdFormaRecepcion` (`IdFormaRecepcion`),
  KEY `IdTopografia` (`IdTopografia`),
  KEY `IdTenenciaPropiedad` (`IdTenenciaPropiedad`),
  KEY `IdInicioFuego` (`IdInicioFuego`),
  KEY `UsuarioCreacion` (`UsuarioCreacion`),
  KEY `IdEquipoTec` (`IdEquipoTec`),
  CONSTRAINT `incendioforestal_ibfk_1` FOREIGN KEY (`IdAreaNaturalProtegida`) REFERENCES `areanaturalprotegida` (`IdAreaNaturalProtegida`),
  CONSTRAINT `incendioforestal_ibfk_2` FOREIGN KEY (`IdFormaRecepcion`) REFERENCES `formarecepcion` (`IdFormaRecepcion`),
  CONSTRAINT `incendioforestal_ibfk_3` FOREIGN KEY (`IdTopografia`) REFERENCES `topografia` (`IdTopografia`),
  CONSTRAINT `incendioforestal_ibfk_4` FOREIGN KEY (`IdTenenciaPropiedad`) REFERENCES `tenencia` (`IdTenenciaPropiedad`),
  CONSTRAINT `incendioforestal_ibfk_5` FOREIGN KEY (`IdInicioFuego`) REFERENCES `iniciofuego` (`IdInicioFuego`),
  CONSTRAINT `incendioforestal_ibfk_6` FOREIGN KEY (`UsuarioCreacion`) REFERENCES `usuario` (`id`),
  CONSTRAINT `incendioforestal_ibfk_7` FOREIGN KEY (`IdEquipoTec`) REFERENCES `equipotecnico` (`IdEquipoTec`)
) ENGINE=InnoDB AUTO_INCREMENT=449 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.indiceisp
DROP TABLE IF EXISTS `indiceisp`;
CREATE TABLE IF NOT EXISTS `indiceisp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ica` float DEFAULT NULL,
  `iq` float DEFAULT NULL,
  `ibp` float DEFAULT NULL,
  `icoe` float DEFAULT NULL,
  `ics` float DEFAULT NULL,
  `ita` float DEFAULT NULL,
  `irv` float DEFAULT NULL,
  `igp` float DEFAULT NULL,
  `fechainicio` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  `detallepaisaje` varchar(9000) DEFAULT NULL,
  `idpaisaje` int DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.iniciofuego
DROP TABLE IF EXISTS `iniciofuego`;
CREATE TABLE IF NOT EXISTS `iniciofuego` (
  `IdInicioFuego` int NOT NULL AUTO_INCREMENT,
  `InicioFuego` varchar(50) NOT NULL,
  `Activo` int DEFAULT NULL,
  PRIMARY KEY (`IdInicioFuego`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.inscripcion
DROP TABLE IF EXISTS `inscripcion`;
CREATE TABLE IF NOT EXISTS `inscripcion` (
  `id_inscripcion` int NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `id_sector` int NOT NULL AUTO_INCREMENT,
  `institucion` varchar(500) DEFAULT NULL,
  `cargo` varchar(500) DEFAULT NULL,
  `correo` varchar(500) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `movil` varchar(45) DEFAULT NULL,
  `id_pais` int DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_inscripcion`,`id_sector`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.instituciones
DROP TABLE IF EXISTS `instituciones`;
CREATE TABLE IF NOT EXISTS `instituciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombreinstitucion` varchar(900) DEFAULT NULL,
  `correocontacto` varchar(500) DEFAULT NULL,
  `contacto` varchar(500) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.medioextincion
DROP TABLE IF EXISTS `medioextincion`;
CREATE TABLE IF NOT EXISTS `medioextincion` (
  `IdMedioExtincion` int NOT NULL AUTO_INCREMENT,
  `MedioExtincion` varchar(50) DEFAULT NULL,
  `Activo` int DEFAULT NULL,
  PRIMARY KEY (`IdMedioExtincion`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.mensajes_de_asignacion
DROP TABLE IF EXISTS `mensajes_de_asignacion`;
CREATE TABLE IF NOT EXISTS `mensajes_de_asignacion` (
  `id_mensaje` int NOT NULL AUTO_INCREMENT,
  `de` int DEFAULT NULL,
  `para` int DEFAULT NULL,
  `idqueja` int DEFAULT NULL,
  `mensaje` varchar(700) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `archivo` varchar(900) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`id_mensaje`),
  KEY `de` (`de`),
  KEY `para` (`para`),
  KEY `idqueja` (`idqueja`),
  CONSTRAINT `mensajes_de_asignacion_ibfk_1` FOREIGN KEY (`de`) REFERENCES `usuario` (`id`),
  CONSTRAINT `mensajes_de_asignacion_ibfk_2` FOREIGN KEY (`para`) REFERENCES `usuario` (`id`),
  CONSTRAINT `mensajes_de_asignacion_ibfk_3` FOREIGN KEY (`idqueja`) REFERENCES `queja` (`idqueja`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `idmenu` int NOT NULL AUTO_INCREMENT,
  `valor` varchar(900) DEFAULT NULL,
  `estado` int DEFAULT NULL,
  `idtipousuario` int DEFAULT NULL,
  PRIMARY KEY (`idmenu`),
  KEY `idtipousuario` (`idtipousuario`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`idtipousuario`) REFERENCES `tipousuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.meses
DROP TABLE IF EXISTS `meses`;
CREATE TABLE IF NOT EXISTS `meses` (
  `id_mes` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_mes`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.municipio
DROP TABLE IF EXISTS `municipio`;
CREATE TABLE IF NOT EXISTS `municipio` (
  `id_municipio` int NOT NULL,
  `id_departamento` int DEFAULT NULL,
  `departamento` char(45) DEFAULT NULL,
  `municipio` char(45) DEFAULT NULL,
  PRIMARY KEY (`id_municipio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.municipioss
DROP TABLE IF EXISTS `municipioss`;
CREATE TABLE IF NOT EXISTS `municipioss` (
  `Id` int NOT NULL,
  `Iddepto` int DEFAULT NULL,
  `Muni` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Codigo` char(3) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.pais
DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `id_pais` int NOT NULL,
  `pais` varchar(500) NOT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.paisaje
DROP TABLE IF EXISTS `paisaje`;
CREATE TABLE IF NOT EXISTS `paisaje` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(900) DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.periodo
DROP TABLE IF EXISTS `periodo`;
CREATE TABLE IF NOT EXISTS `periodo` (
  `ano` int NOT NULL,
  `mes` int NOT NULL,
  `semestre` char(7) DEFAULT NULL,
  PRIMARY KEY (`ano`,`mes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.periodo_point
DROP TABLE IF EXISTS `periodo_point`;
CREATE TABLE IF NOT EXISTS `periodo_point` (
  `id_periodo` int NOT NULL AUTO_INCREMENT,
  `ano` int DEFAULT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`id_periodo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.plantaton_points
DROP TABLE IF EXISTS `plantaton_points`;
CREATE TABLE IF NOT EXISTS `plantaton_points` (
  `id_plantaton` int NOT NULL AUTO_INCREMENT,
  `id_tecnica` int NOT NULL,
  `arboles` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `especie` varchar(500) NOT NULL,
  `instituciones` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `id_municipio` int NOT NULL,
  `ubicacion` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `latitud` double(12,6) NOT NULL,
  `longitud` double(12,6) NOT NULL,
  `voluntarios` int DEFAULT NULL,
  `imagen` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_plantaton`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.plantaton_points_2017
DROP TABLE IF EXISTS `plantaton_points_2017`;
CREATE TABLE IF NOT EXISTS `plantaton_points_2017` (
  `id_plantaton` int NOT NULL DEFAULT '0',
  `id_tecnica` int NOT NULL,
  `arboles` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `especie` varchar(500) NOT NULL,
  `instituciones` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `id_municipio` int NOT NULL,
  `ubicacion` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `latitud` double(12,6) NOT NULL,
  `longitud` double(12,6) NOT NULL,
  `voluntarios` int DEFAULT NULL,
  `imagen` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.puntaje
DROP TABLE IF EXISTS `puntaje`;
CREATE TABLE IF NOT EXISTS `puntaje` (
  `id` int NOT NULL AUTO_INCREMENT,
  `puntaje` int DEFAULT NULL,
  `descripcion` text COLLATE utf8mb3_spanish2_ci,
  `id_tema` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tema_ibfk_1` (`id_tema`),
  CONSTRAINT `tema_ibfk_1` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.puntaje_ambito
DROP TABLE IF EXISTS `puntaje_ambito`;
CREATE TABLE IF NOT EXISTS `puntaje_ambito` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_ambito` int DEFAULT NULL,
  `id_puntaje` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ambito` (`id_ambito`),
  KEY `id_puntaje` (`id_puntaje`),
  CONSTRAINT `puntaje_ambito_ibfk_1` FOREIGN KEY (`id_ambito`) REFERENCES `ambito` (`id`),
  CONSTRAINT `puntaje_ambito_ibfk_2` FOREIGN KEY (`id_puntaje`) REFERENCES `puntaje` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.queja
DROP TABLE IF EXISTS `queja`;
CREATE TABLE IF NOT EXISTS `queja` (
  `idqueja` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(1000) DEFAULT NULL,
  `anonimo` int NOT NULL,
  `nombre` varchar(9000) DEFAULT NULL,
  `apellido` varchar(9000) DEFAULT NULL,
  `lugarresidencia` text,
  `correo` varchar(9000) NOT NULL,
  `fechaincidente` date DEFAULT NULL,
  `fecharegistro` datetime DEFAULT NULL,
  `direccion` text,
  `latitud` text,
  `longitud` text,
  `denunciado` varchar(9000) DEFAULT NULL,
  `descripcionqueja` text,
  `idusuario` int DEFAULT NULL,
  `estado` int NOT NULL,
  `edad` varchar(3) DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idqueja`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.ramsar
DROP TABLE IF EXISTS `ramsar`;
CREATE TABLE IF NOT EXISTS `ramsar` (
  `id_ramsar` int NOT NULL AUTO_INCREMENT,
  `codigo` char(10) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `latitud` double(12,6) NOT NULL,
  `longitud` double(12,6) NOT NULL,
  `area` double(18,6) NOT NULL,
  `descripcion` text NOT NULL,
  `ficha_tecnica` varchar(300) NOT NULL,
  PRIMARY KEY (`id_ramsar`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.region
DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `IdRegion` int NOT NULL AUTO_INCREMENT,
  `Region` varchar(400) NOT NULL,
  PRIMARY KEY (`IdRegion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.relcausaincendioforestal
DROP TABLE IF EXISTS `relcausaincendioforestal`;
CREATE TABLE IF NOT EXISTS `relcausaincendioforestal` (
  `IdRelCausaIncendioForestal` int NOT NULL AUTO_INCREMENT,
  `IdIncendio` int NOT NULL,
  `IdCausaIncendio` int NOT NULL,
  PRIMARY KEY (`IdRelCausaIncendioForestal`),
  KEY `IdIncendio` (`IdIncendio`),
  KEY `IdCausaIncendio` (`IdCausaIncendio`),
  CONSTRAINT `relcausaincendioforestal_ibfk_1` FOREIGN KEY (`IdIncendio`) REFERENCES `incendioforestal` (`IdIncendio`),
  CONSTRAINT `relcausaincendioforestal_ibfk_2` FOREIGN KEY (`IdCausaIncendio`) REFERENCES `causaincendio` (`IdCausaIncendio`)
) ENGINE=InnoDB AUTO_INCREMENT=292 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.relleno
DROP TABLE IF EXISTS `relleno`;
CREATE TABLE IF NOT EXISTS `relleno` (
  `id_relleno` int NOT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `nombre` varchar(500) DEFAULT NULL,
  `latitud` double(12,6) DEFAULT NULL,
  `longitud` double(12,6) DEFAULT NULL,
  PRIMARY KEY (`id_relleno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.relmedioextincendioforestal
DROP TABLE IF EXISTS `relmedioextincendioforestal`;
CREATE TABLE IF NOT EXISTS `relmedioextincendioforestal` (
  `IdRelMedioExtIncendioForestal` int NOT NULL AUTO_INCREMENT,
  `IdMedioExtincion` int NOT NULL,
  `IdIncendio` int NOT NULL,
  `Cantidad` float DEFAULT NULL,
  PRIMARY KEY (`IdRelMedioExtIncendioForestal`),
  KEY `IdMedioExtincion` (`IdMedioExtincion`),
  KEY `IdIncendio` (`IdIncendio`),
  CONSTRAINT `relmedioextincendioforestal_ibfk_1` FOREIGN KEY (`IdMedioExtincion`) REFERENCES `medioextincion` (`IdMedioExtincion`),
  CONSTRAINT `relmedioextincendioforestal_ibfk_2` FOREIGN KEY (`IdIncendio`) REFERENCES `incendioforestal` (`IdIncendio`)
) ENGINE=InnoDB AUTO_INCREMENT=2705 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.reltipoafectacionqueja
DROP TABLE IF EXISTS `reltipoafectacionqueja`;
CREATE TABLE IF NOT EXISTS `reltipoafectacionqueja` (
  `idreltipoafectacionqueja` int NOT NULL AUTO_INCREMENT,
  `idqueja` int NOT NULL,
  `idcausaafectacionqueja` int NOT NULL,
  PRIMARY KEY (`idreltipoafectacionqueja`),
  KEY `idqueja` (`idqueja`),
  KEY `idcausaafectacionqueja` (`idcausaafectacionqueja`),
  CONSTRAINT `reltipoafectacionqueja_ibfk_1` FOREIGN KEY (`idqueja`) REFERENCES `queja` (`idqueja`),
  CONSTRAINT `reltipoafectacionqueja_ibfk_2` FOREIGN KEY (`idcausaafectacionqueja`) REFERENCES `causaafectacionqueja` (`idcausaafectacionqueja`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.reltipovegeincendioforestal
DROP TABLE IF EXISTS `reltipovegeincendioforestal`;
CREATE TABLE IF NOT EXISTS `reltipovegeincendioforestal` (
  `IdRelTipoVegeIncendioForestal` int NOT NULL AUTO_INCREMENT,
  `IdTipoVegetacion` int NOT NULL,
  `IdIncendio` int NOT NULL,
  `AreaProtegida` float DEFAULT NULL,
  `ZonaAmortiguamiento` float DEFAULT NULL,
  PRIMARY KEY (`IdRelTipoVegeIncendioForestal`),
  KEY `IdTipoVegetacion` (`IdTipoVegetacion`),
  KEY `IdIncendio` (`IdIncendio`),
  CONSTRAINT `reltipovegeincendioforestal_ibfk_1` FOREIGN KEY (`IdTipoVegetacion`) REFERENCES `tipovegetacion` (`IdTipoVegetacion`),
  CONSTRAINT `reltipovegeincendioforestal_ibfk_2` FOREIGN KEY (`IdIncendio`) REFERENCES `incendioforestal` (`IdIncendio`)
) ENGINE=InnoDB AUTO_INCREMENT=3719 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.respuestasenviadas
DROP TABLE IF EXISTS `respuestasenviadas`;
CREATE TABLE IF NOT EXISTS `respuestasenviadas` (
  `id_respuesta` int NOT NULL AUTO_INCREMENT,
  `idqueja` int DEFAULT NULL,
  `mensaje` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`id_respuesta`),
  KEY `idqueja` (`idqueja`),
  CONSTRAINT `respuestasenviadas_ibfk_1` FOREIGN KEY (`idqueja`) REFERENCES `queja` (`idqueja`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.respuestasenviadasusuario
DROP TABLE IF EXISTS `respuestasenviadasusuario`;
CREATE TABLE IF NOT EXISTS `respuestasenviadasusuario` (
  `id_r` int NOT NULL AUTO_INCREMENT,
  `idqueja` int DEFAULT NULL,
  `satisfecho` int DEFAULT NULL,
  `comentariono` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estadoadjunto` int DEFAULT NULL,
  `estado` int DEFAULT NULL,
  `fechafinalizo` datetime DEFAULT NULL,
  PRIMARY KEY (`id_r`),
  KEY `respuestasenviadasusuario_ibfk_1` (`idqueja`),
  CONSTRAINT `respuestasenviadasusuario_ibfk_1` FOREIGN KEY (`idqueja`) REFERENCES `queja` (`idqueja`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.restauracion
DROP TABLE IF EXISTS `restauracion`;
CREATE TABLE IF NOT EXISTS `restauracion` (
  `id_restauracion` int NOT NULL DEFAULT '0',
  `codigo` char(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nombre` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `latitud` double(12,6) NOT NULL,
  `longitud` double(12,6) NOT NULL,
  `area` double(18,6) NOT NULL,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ficha_tecnica` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id_restauracion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.restauracion_a
DROP TABLE IF EXISTS `restauracion_a`;
CREATE TABLE IF NOT EXISTS `restauracion_a` (
  `id_restauracion` int NOT NULL DEFAULT '0',
  `codigo` char(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nombre` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `latitud` double(12,6) NOT NULL,
  `longitud` double(12,6) NOT NULL,
  `area` double(18,6) NOT NULL,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ficha_tecnica` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.restauracion_points
DROP TABLE IF EXISTS `restauracion_points`;
CREATE TABLE IF NOT EXISTS `restauracion_points` (
  `id_restauracion` int NOT NULL AUTO_INCREMENT,
  `periodo` char(10) NOT NULL,
  `tecnica` varchar(500) NOT NULL,
  `latitud` double(12,6) NOT NULL,
  `longitud` double(12,6) NOT NULL,
  `area` double(18,1) NOT NULL,
  `arboles` varchar(500) NOT NULL,
  `Municipio` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Canton` varchar(300) DEFAULT NULL,
  `Ubicacion` varchar(300) DEFAULT NULL,
  `Beneficiarios` varchar(400) DEFAULT NULL,
  `Instituciones` varchar(500) DEFAULT NULL,
  `imagen` varchar(250) NOT NULL,
  `id_usuario` int NOT NULL DEFAULT '1',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` int NOT NULL,
  `id_periodo` int NOT NULL,
  `especies` mediumtext,
  `cantidadpersonas` int DEFAULT NULL,
  `comentarios` mediumtext,
  `idtecnicas` int DEFAULT NULL,
  `coordenadas` mediumtext,
  `banderausuario` int NOT NULL,
  PRIMARY KEY (`id_restauracion`),
  KEY `idtecnicas` (`idtecnicas`),
  CONSTRAINT `restauracion_points_ibfk_1` FOREIGN KEY (`idtecnicas`) REFERENCES `tecnica` (`IdTecnica`)
) ENGINE=InnoDB AUTO_INCREMENT=838 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.rol
DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `IdRol` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdRol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.sector
DROP TABLE IF EXISTS `sector`;
CREATE TABLE IF NOT EXISTS `sector` (
  `id_sector` int NOT NULL,
  `sector` varchar(200) NOT NULL,
  PRIMARY KEY (`id_sector`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.seguimiento
DROP TABLE IF EXISTS `seguimiento`;
CREATE TABLE IF NOT EXISTS `seguimiento` (
  `id_seguimiento` int NOT NULL AUTO_INCREMENT,
  `idqueja` int DEFAULT NULL,
  `etapa` int DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`id_seguimiento`),
  KEY `idqueja` (`idqueja`),
  CONSTRAINT `seguimiento_ibfk_1` FOREIGN KEY (`idqueja`) REFERENCES `queja` (`idqueja`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.submenu
DROP TABLE IF EXISTS `submenu`;
CREATE TABLE IF NOT EXISTS `submenu` (
  `idsubmenu` int NOT NULL AUTO_INCREMENT,
  `valor` varchar(900) DEFAULT NULL,
  `vista` varchar(500) DEFAULT NULL,
  `estado` int DEFAULT NULL,
  `idmenu` int DEFAULT NULL,
  PRIMARY KEY (`idsubmenu`),
  KEY `idmenu` (`idmenu`),
  CONSTRAINT `submenu_ibfk_1` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.tala
DROP TABLE IF EXISTS `tala`;
CREATE TABLE IF NOT EXISTS `tala` (
  `id_tala` int NOT NULL AUTO_INCREMENT,
  `id_municipio` int DEFAULT NULL,
  `direccion` varchar(500) DEFAULT NULL,
  `latitud` double(12,6) DEFAULT NULL,
  `longitud` double(12,6) DEFAULT NULL,
  `solicitante` varchar(500) DEFAULT NULL,
  `id_tipo_actividad` int DEFAULT NULL,
  `id_tipo_especie` int DEFAULT NULL,
  `especies` varchar(500) DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `cantidadm3` double(12,2) DEFAULT NULL,
  `estado` int DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tala`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.tecnica
DROP TABLE IF EXISTS `tecnica`;
CREATE TABLE IF NOT EXISTS `tecnica` (
  `IdTecnica` int NOT NULL AUTO_INCREMENT,
  `UsoSuelo` varchar(400) DEFAULT NULL,
  `Tecnica` varchar(500) DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`IdTecnica`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.tema
DROP TABLE IF EXISTS `tema`;
CREATE TABLE IF NOT EXISTS `tema` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb3_spanish2_ci,
  `observaciones` text COLLATE utf8mb3_spanish2_ci,
  `id_ambito` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ambito_ibfk_1` (`id_ambito`),
  CONSTRAINT `ambito_ibfk_1` FOREIGN KEY (`id_ambito`) REFERENCES `ambito` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.tenencia
DROP TABLE IF EXISTS `tenencia`;
CREATE TABLE IF NOT EXISTS `tenencia` (
  `IdTenenciaPropiedad` int NOT NULL AUTO_INCREMENT,
  `Tenencia` varchar(50) NOT NULL,
  `Activo` int DEFAULT NULL,
  PRIMARY KEY (`IdTenenciaPropiedad`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.tipousuario
DROP TABLE IF EXISTS `tipousuario`;
CREATE TABLE IF NOT EXISTS `tipousuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) NOT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.tipovegetacion
DROP TABLE IF EXISTS `tipovegetacion`;
CREATE TABLE IF NOT EXISTS `tipovegetacion` (
  `IdTipoVegetacion` int NOT NULL AUTO_INCREMENT,
  `TipoVegetacion` varchar(50) NOT NULL,
  `Activo` int DEFAULT NULL,
  PRIMARY KEY (`IdTipoVegetacion`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.tipo_actividad
DROP TABLE IF EXISTS `tipo_actividad`;
CREATE TABLE IF NOT EXISTS `tipo_actividad` (
  `id_tipo_actividad` int NOT NULL AUTO_INCREMENT,
  `tipo_actividad` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_actividad`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.tipo_especie
DROP TABLE IF EXISTS `tipo_especie`;
CREATE TABLE IF NOT EXISTS `tipo_especie` (
  `id_tipo_especie` int NOT NULL AUTO_INCREMENT,
  `tipo_especie` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_especie`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.tmprest
DROP TABLE IF EXISTS `tmprest`;
CREATE TABLE IF NOT EXISTS `tmprest` (
  `id_restauracion` int NOT NULL AUTO_INCREMENT,
  `Tecnica` varchar(500) DEFAULT NULL,
  `Municipio` varchar(500) DEFAULT NULL,
  `area` double(12,2) DEFAULT NULL,
  `latitud` double(12,6) DEFAULT NULL,
  `longitud` double(12,6) DEFAULT NULL,
  PRIMARY KEY (`id_restauracion`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.topografia
DROP TABLE IF EXISTS `topografia`;
CREATE TABLE IF NOT EXISTS `topografia` (
  `IdTopografia` int NOT NULL AUTO_INCREMENT,
  `Topografia` varchar(50) NOT NULL,
  `Activo` int DEFAULT NULL,
  PRIMARY KEY (`IdTopografia`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(15) NOT NULL,
  `nombre` varchar(900) NOT NULL,
  `apellido` varchar(900) NOT NULL,
  `usuarioad` varchar(30) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `estado` int NOT NULL,
  `idtipo` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idtipo` (`idtipo`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idtipo`) REFERENCES `tipousuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.usuarioexterno
DROP TABLE IF EXISTS `usuarioexterno`;
CREATE TABLE IF NOT EXISTS `usuarioexterno` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(900) NOT NULL,
  `apellido` varchar(900) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contra` varchar(900) NOT NULL,
  `estadocontra` int NOT NULL,
  `estadocambiocontra` int NOT NULL,
  `estado` int NOT NULL,
  `idtipo` int NOT NULL,
  `idinstitucion` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idtipo` (`idtipo`),
  KEY `idinstitucion` (`idinstitucion`),
  CONSTRAINT `usuarioexterno_ibfk_1` FOREIGN KEY (`idtipo`) REFERENCES `tipousuario` (`id`),
  CONSTRAINT `usuarioexterno_ibfk_2` FOREIGN KEY (`idinstitucion`) REFERENCES `instituciones` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla mapas.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `IdUsuario` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `Usuario` varchar(45) DEFAULT NULL,
  `Clave` varchar(45) DEFAULT NULL,
  `IdRol` int NOT NULL,
  `Unidad` varchar(45) DEFAULT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`IdUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para disparador mapas.ingresarseguimiento
DROP TRIGGER IF EXISTS `ingresarseguimiento`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `ingresarseguimiento` AFTER INSERT ON `queja` FOR EACH ROW INSERT INTO seguimiento values('0',NEW.idqueja,1,now(),1)//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador mapas.ingresarseguimientoetapa2
DROP TRIGGER IF EXISTS `ingresarseguimientoetapa2`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `ingresarseguimientoetapa2` AFTER INSERT ON `asignacion_queja` FOR EACH ROW update seguimiento set etapa=2 where idqueja=NEW.idqueja//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador mapas.ingresarseguimientoetapa3
DROP TRIGGER IF EXISTS `ingresarseguimientoetapa3`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `ingresarseguimientoetapa3` AFTER UPDATE ON `mensajes_de_asignacion` FOR EACH ROW begin
    DECLARE conteo int;
    set conteo = (select count(*) as conteo from mensajes_de_asignacion ma where ma.estado=2 and ma.idqueja=NEW.idqueja);
    IF conteo>0 THEN
    update seguimiento set etapa=3 where idqueja=NEW.idqueja;
    insert into estuvoenetapa3 values (0,NEW.idqueja,1);
    END IF;
    end//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador mapas.ingresarseguimientoetapa4
DROP TRIGGER IF EXISTS `ingresarseguimientoetapa4`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `ingresarseguimientoetapa4` AFTER INSERT ON `respuestasenviadasusuario` FOR EACH ROW update seguimiento set etapa=4 where idqueja=NEW.idqueja//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador mapas.ingresarseguimientofinalizado
DROP TRIGGER IF EXISTS `ingresarseguimientofinalizado`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `ingresarseguimientofinalizado` AFTER UPDATE ON `respuestasenviadasusuario` FOR EACH ROW begin
    DECLARE conteo int;
    set conteo = (select satisfecho from respuestasenviadasusuario re where re.idqueja=NEW.idqueja and estado=1);
    IF conteo=1 THEN
    update queja set estado=3 where idqueja=NEW.idqueja;
    END IF;
    end//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
