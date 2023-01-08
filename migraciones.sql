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

