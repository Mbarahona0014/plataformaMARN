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