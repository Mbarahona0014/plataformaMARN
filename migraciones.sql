--AGREGAR NUEVOS CAMPOS A LA TABLA EVALUADOR

ALTER TABLE evaluador
ADD COLUMN institucion VARCHAR(100)

ALTER TABLE evaluador
ADD COLUMN cargo VARCHAR(100)

CREATE TABLE `archivos_evaluacion` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `archivo` TEXT DEFAULT NULL,
  `id_evaluacion` int(11) DEFAULT NULL,
  CONSTRAINT `fk_archi_evalu_evaluaciones` FOREIGN KEY (`id_evaluacion`) REFERENCES `encabezado_reporte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--MODIFICAR LOS PROCEDIMIENTOS ALMACENADOS DE LA TABLA EVALUADOR

DELIMITER $$
DROP PROCEDURE IF EXISTS agregarEvaluador$$
CREATE PROCEDURE agregarEvaluador(IN nom TEXT, IN apl TEXT, IN cor TEXT, IN tel TEXT, IN ins VARCHAR(100), IN car VARCHAR(100))
BEGIN
  DECLARE count_evaluador INT;
  SELECT COUNT(*) INTO count_evaluador FROM evaluador WHERE nombres = nom AND apellidos = apl;
  IF (count_evaluador >=1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    INSERT INTO evaluador VALUES(NULL,nom,apl,cor,tel,ins,car);
    SELECT 1 AS 'resultado';
  END IF;
END;
$$

DELIMITER $$
DROP PROCEDURE IF EXISTS actualizarEvaluador$$
CREATE PROCEDURE actualizarEvaluador(IN nom TEXT, IN apl TEXT, IN cor TEXT, IN tel TEXT, IN ins VARCHAR(100), IN car VARCHAR(100), IN idEv INT)
BEGIN
  UPDATE evaluador SET nombres=nom, apellidos=apl, correo=cor, telefono=tel, institucion=ins, cargo=car WHERE id=idEv;
  SELECT 1 AS 'resultado';
END
$$

--Añadir nuevo campo a tabla encabezado

ALTER TABLE encabezado_reporte
ADD COLUMN estado INT

--Reestructurar los procedimientos almacenados

--ENCABEZADO REPORTE
DELIMITER $$
DROP PROCEDURE IF EXISTS agregarEncabezadoReporte$$
CREATE PROCEDURE agregarEncabezadoReporte(IN fec DATE, IN idAr INT, IN est INT)
BEGIN
    INSERT INTO encabezado_reporte VALUES(NULL,idAr,fec,0);
    SELECT 1 AS 'resultado';
END;
$$

--AGREGAR ID DE AREA PROTEGIDA A TABLA EVALUACION

ALTER TABLE encabezado_reporte ADD COLUMN id_area_conservacion INT AFTER `id_area_natural`

--AGREGAR LLAVE FORANEA

ALTER TABLE `encabezado_reporte`
  ADD CONSTRAINT `encabezado_reporte_ibfk_2` FOREIGN KEY (`id_area_conservacion`) REFERENCES `paisaje` (`id`);

--MODIFICAR LOS PROCEDIMIENTOS ALMACENADOS

DELIMITER $$
DROP PROCEDURE IF EXISTS agregarEncabezadoReporte$$
CREATE PROCEDURE agregarEncabezadoReporte(IN fec DATE, IN idAr INT,IN idAc INT)
BEGIN
    INSERT INTO encabezado_reporte VALUES(NULL,idAr,idAc,fec,0);
    SELECT 1 AS 'resultado';
END;
$$

DELIMITER $$
DROP PROCEDURE IF EXISTS actualizarEncabezadoReporte$$
CREATE PROCEDURE actualizarEncabezadoReporte(IN fec DATE, IN idAr INT,IN idAc INT, IN idER INT)
BEGIN
    UPDATE encabezado_reporte SET fecha_evaluacion=fec, id_area_natural =idAr, id_area_conservacion = idAc WHERE id=idER;
    SELECT 1 AS 'resultado';
END;
$$

--CAMBIAR LA TABLA AMBITOS

ALTER TABLE ambito ADD COLUMN peso DOUBLE AFTER `nombre`

--MODIFICAR LOS PROCEDIMIENTOS ALMACENADOS

DELIMITER $$
DROP PROCEDURE IF EXISTS agregarAmbito$$
CREATE PROCEDURE agregarAmbito(IN nom VARCHAR(100), IN pes DOUBLE, IN descrip TEXT)
BEGIN
  DECLARE count_ambito INT;
  SELECT COUNT(*) INTO count_ambito FROM ambito WHERE nombre = nom;
  IF(count_ambito >= 1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    INSERT INTO ambito VALUES(NULL,nom,pes,descrip);
    SELECT 1 AS 'resultado';
  END IF;
END
$$

DELIMITER $$
DROP PROCEDURE IF EXISTS actualizarAmbito$$
CREATE PROCEDURE actualizarAmbito(IN nom VARCHAR(100), IN pes DOUBLE, IN descrip TEXT, IN id_ambito INT)
BEGIN
  DECLARE count_ambito INT;
  SELECT COUNT(*) INTO count_ambito FROM ambito WHERE (nombre = nom) AND id <> id_ambito;
  IF(count_ambito >= 1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    UPDATE ambito SET nombre = nom, peso= pes, descripcion = descrip WHERE id = id_ambito;
    SELECT 1 AS 'resultado';
  END IF;
END
$$

--PROCESO ALMACENADO PARA ACTUALIZAR ENCABEZADO
DELIMITER $$
DROP PROCEDURE IF EXISTS actualizarEncabezadoEstado$$
CREATE PROCEDURE actualizarEncabezadoEstado(IN est INT, IN idEv INT)
BEGIN
  UPDATE encabezado_reporte SET estado=est WHERE id=idEv;
  SELECT 1 AS 'resultado';
END
$$

--CAMBIOS EN LA TABLA ARCHIVOS

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

--CREAR TABLA FACTOR

CREATE TABLE `factor` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(100) DEFAULT NULL,
  `peso` double(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--CREAR PROCESOS ALMACENADOS PARA FACTOR

DELIMITER $$
DROP PROCEDURE IF EXISTS agregarFactor$$
CREATE PROCEDURE agregarFactor(IN nom VARCHAR(100), IN pes DOUBLE)
BEGIN
  DECLARE count_factor INT;
  SELECT COUNT(*) INTO count_factor FROM factor WHERE nombre = nom;
  IF(count_factor >= 1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    INSERT INTO factor VALUES(NULL,nom,pes);
    SELECT 1 AS 'resultado';
  END IF;
END
$$

DELIMITER $$
DROP PROCEDURE IF EXISTS actualizarFactor$$
CREATE PROCEDURE actualizarFactor(IN nom VARCHAR(100), IN pes DOUBLE, IN id_factor INT)
BEGIN
  DECLARE count_factor INT;
  SELECT COUNT(*) INTO count_factor FROM factor WHERE (nombre = nom) AND id <> id_factor;
  IF(count_factor >= 1) THEN
    SELECT 2 AS 'resultado';
  ELSE
    UPDATE factor SET nombre = nom, peso= pes WHERE id = id_factor;
    SELECT 1 AS 'resultado';
  END IF;
END
$$