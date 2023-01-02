<?php

class restauracionpuntos
{
	private $_idrestauracion;
    private $_idperiodo;
    private $_tecnica;
    private $_longitud;
    private $_latitud;
    private $_area;
    private $_arboles;
    private $_municipio;
    private $_canton;
    private $_ubicacion;
    private $_beneficiarios;
    private $_instituciones;
    private $_estado;
    private $_especie;
    private $_cantidadpersonas;
    private $_comentarios;
    private $_idtecnicas;
    private $_coordenadas;

    

    /**
     * @return mixed
     */
    public function getIdrestauracion()
    {
        return $this->_idrestauracion;
    }

    /**
     * @param mixed $_idrestauracion
     *
     * @return self
     */
    public function setIdrestauracion($_idrestauracion)
    {
        $this->_idrestauracion = $_idrestauracion;

        return $this;
    }

    
     /**
     * @return mixed
     */
    public function getIdperiodo()
    {
        return $this->_idperiodo;
    }

    /**
     * @param mixed $_idperiodo
     *
     * @return self
     */
    public function setIdperiodo($_idperiodo)
    {
        $this->_idperiodo = $_idperiodo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTecnica()
    {
        return $this->_tecnica;
    }

    /**
     * @param mixed $_tecnica
     *
     * @return self
     */
    public function setTecnica($_tecnica)
    {
        $this->_tecnica = $_tecnica;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLongitud()
    {
        return $this->_longitud;
    }

    /**
     * @param mixed $_longitud
     *
     * @return self
     */
    public function setLongitud($_longitud)
    {
        $this->_longitud = $_longitud;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLatitud()
    {
        return $this->_latitud;
    }

    /**
     * @param mixed $_latitud
     *
     * @return self
     */
    public function setLatitud($_latitud)
    {
        $this->_latitud = $_latitud;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->_area;
    }

    /**
     * @param mixed $_area
     *
     * @return self
     */
    public function setArea($_area)
    {
        $this->_area = $_area;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArboles()
    {
        return $this->_arboles;
    }

    /**
     * @param mixed $_arboles
     *
     * @return self
     */
    public function setArboles($_arboles)
    {
        $this->_arboles = $_arboles;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMunicipio()
    {
        return $this->_municipio;
    }

    /**
     * @param mixed $_municipio
     *
     * @return self
     */
    public function setMunicipio($_municipio)
    {
        $this->_municipio = $_municipio;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCanton()
    {
        return $this->_canton;
    }

    /**
     * @param mixed $_canton
     *
     * @return self
     */
    public function setCanton($_canton)
    {
        $this->_canton = $_canton;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUbicacion()
    {
        return $this->_ubicacion;
    }

    /**
     * @param mixed $_ubicacion
     *
     * @return self
     */
    public function setUbicacion($_ubicacion)
    {
        $this->_ubicacion = $_ubicacion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBeneficiarios()
    {
        return $this->_beneficiarios;
    }

    /**
     * @param mixed $_beneficiarios
     *
     * @return self
     */
    public function setBeneficiarios($_beneficiarios)
    {
        $this->_beneficiarios = $_beneficiarios;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInstituciones()
    {
        return $this->_instituciones;
    }

    /**
     * @param mixed $_instituciones
     *
     * @return self
     */
    public function setInstituciones($_instituciones)
    {
        $this->_instituciones = $_instituciones;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->_estado;
    }

    /**
     * @param mixed $_estado
     *
     * @return self
     */
    public function setEstado($_estado)
    {
        $this->_estado = $_estado;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getEspecie()
    {
        return $this->_especie;
    }

    /**
     * @param mixed $_especie
     *
     * @return self
     */
    public function setEspecie($_especie)
    {
        $this->_especie = $_especie;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCantidadpersonas()
    {
        return $this->_cantidadpersonas;
    }

    /**
     * @param mixed $_cantidadpersonas
     *
     * @return self
     */
    public function setCantidadpersonas($_cantidadpersonas)
    {
        $this->_cantidadpersonas = $_cantidadpersonas;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getComentarios()
    {
        return $this->_comentarios;
    }

    /**
     * @param mixed $_comentarios
     *
     * @return self
     */
    public function setComentarios($_comentarios)
    {
        $this->_comentarios = $_comentarios;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdtecnicas()
    {
        return $this->_idtecnicas;
    }

    /**
     * @param mixed $_idtecnicas
     *
     * @return self
     */
    public function setIdtecnicas($_idtecnicas)
    {
        $this->_idtecnicas = $_idtecnicas;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCoordenadas()
    {
        return $this->_coordenadas;
    }

    /**
     * @param mixed $_coordenadas
     *
     * @return self
     */
    public function setCoordenadas($_coordenadas)
    {
        $this->_coordenadas = $_coordenadas;

        return $this;
    }
}

?>