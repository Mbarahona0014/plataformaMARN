--AGREGAR NUEVOS CAMPOS A LA TABLA EVALUADOR

ALTER TABLE evaluador
ADD COLUMN institucion VARCHAR(100)

ALTER TABLE evaluador
ADD COLUMN cargo VARCHAR(100)

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