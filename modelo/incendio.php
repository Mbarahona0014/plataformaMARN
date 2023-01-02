<?php

class incendio
{
	private $_idincendio;
    private $_idareanaturalprotegida;
    private $_fechareporte;
    private $_fechaincendio;
    private $_fechaavisoincendio;
    private $_idformarecepcion;
    private $_idtopografia;
    private $_idtenenciapropiedad;
    private $_idiniciofuego;
    private $_estatusincendio;
    private $_arbolesafectados;
    private $_arbolesespecies;
    private $_faunaafectada;
    private $_faunaespecies;
    private $_velocidadpropagacion;
    private $_rutaacceso;
    private $_comentarios;
    private $_latitud;
    private $_longitud;
    private $_geoposicion;
    private $_fechafinalizacion;
    private $_usuariocreacion;
    private $_idequipotec;
    private $_canton;
    private $_eliminado;
    private $_coordenadas;




    /**
     * @return mixed
     */
    public function getIdincendio()
    {
        return $this->_idincendio;
    }

    /**
     * @param mixed $_idincendio
     *
     * @return self
     */
    public function setIdincendio($_idincendio)
    {
        $this->_idincendio = $_idincendio;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdareanaturalprotegida()
    {
        return $this->_idareanaturalprotegida;
    }

    /**
     * @param mixed $_idareanaturalprotegida
     *
     * @return self
     */
    public function setIdareanaturalprotegida($_idareanaturalprotegida)
    {
        $this->_idareanaturalprotegida = $_idareanaturalprotegida;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechareporte()
    {
        return $this->_fechareporte;
    }

    /**
     * @param mixed $_fechareporte
     *
     * @return self
     */
    public function setFechareporte($_fechareporte)
    {
        $this->_fechareporte = $_fechareporte;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechaincendio()
    {
        return $this->_fechaincendio;
    }

    /**
     * @param mixed $_fechaincendio
     *
     * @return self
     */
    public function setFechaincendio($_fechaincendio)
    {
        $this->_fechaincendio = $_fechaincendio;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechaavisoincendio()
    {
        return $this->_fechaavisoincendio;
    }

    /**
     * @param mixed $_fechaavisoincendio
     *
     * @return self
     */
    public function setFechaavisoincendio($_fechaavisoincendio)
    {
        $this->_fechaavisoincendio = $_fechaavisoincendio;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdformarecepcion()
    {
        return $this->_idformarecepcion;
    }

    /**
     * @param mixed $_idformarecepcion
     *
     * @return self
     */
    public function setIdformarecepcion($_idformarecepcion)
    {
        $this->_idformarecepcion = $_idformarecepcion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdtopografia()
    {
        return $this->_idtopografia;
    }

    /**
     * @param mixed $_idtopografia
     *
     * @return self
     */
    public function setIdtopografia($_idtopografia)
    {
        $this->_idtopografia = $_idtopografia;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdtenenciapropiedad()
    {
        return $this->_idtenenciapropiedad;
    }

    /**
     * @param mixed $_idtenenciapropiedad
     *
     * @return self
     */
    public function setIdtenenciapropiedad($_idtenenciapropiedad)
    {
        $this->_idtenenciapropiedad = $_idtenenciapropiedad;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdiniciofuego()
    {
        return $this->_idiniciofuego;
    }

    /**
     * @param mixed $_idiniciofuego
     *
     * @return self
     */
    public function setIdiniciofuego($_idiniciofuego)
    {
        $this->_idiniciofuego = $_idiniciofuego;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstatusincendio()
    {
        return $this->_estatusincendio;
    }

    /**
     * @param mixed $_estatusincendio
     *
     * @return self
     */
    public function setEstatusincendio($_estatusincendio)
    {
        $this->_estatusincendio = $_estatusincendio;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArbolesafectados()
    {
        return $this->_arbolesafectados;
    }

    /**
     * @param mixed $_arbolesafectados
     *
     * @return self
     */
    public function setArbolesafectados($_arbolesafectados)
    {
        $this->_arbolesafectados = $_arbolesafectados;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArbolesespecies()
    {
        return $this->_arbolesespecies;
    }

    /**
     * @param mixed $_arbolesespecies
     *
     * @return self
     */
    public function setArbolesespecies($_arbolesespecies)
    {
        $this->_arbolesespecies = $_arbolesespecies;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFaunaafectada()
    {
        return $this->_faunaafectada;
    }

    /**
     * @param mixed $_faunaafectada
     *
     * @return self
     */
    public function setFaunaafectada($_faunaafectada)
    {
        $this->_faunaafectada = $_faunaafectada;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFaunaespecies()
    {
        return $this->_faunaespecies;
    }

    /**
     * @param mixed $_faunaespecies
     *
     * @return self
     */
    public function setFaunaespecies($_faunaespecies)
    {
        $this->_faunaespecies = $_faunaespecies;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVelocidadpropagacion()
    {
        return $this->_velocidadpropagacion;
    }

    /**
     * @param mixed $_velocidadpropagacion
     *
     * @return self
     */
    public function setVelocidadpropagacion($_velocidadpropagacion)
    {
        $this->_velocidadpropagacion = $_velocidadpropagacion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRutaacceso()
    {
        return $this->_rutaacceso;
    }

    /**
     * @param mixed $_rutaacceso
     *
     * @return self
     */
    public function setRutaacceso($_rutaacceso)
    {
        $this->_rutaacceso = $_rutaacceso;

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
    public function getGeoposicion()
    {
        return $this->_geoposicion;
    }

    /**
     * @param mixed $_geoposicion
     *
     * @return self
     */
    public function setGeoposicion($_geoposicion)
    {
        $this->_geoposicion = $_geoposicion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechafinalizacion()
    {
        return $this->_fechafinalizacion;
    }

    /**
     * @param mixed $_fechafinalizacion
     *
     * @return self
     */
    public function setFechafinalizacion($_fechafinalizacion)
    {
        $this->_fechafinalizacion = $_fechafinalizacion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsuariocreacion()
    {
        return $this->_usuariocreacion;
    }

    /**
     * @param mixed $_usuariocreacion
     *
     * @return self
     */
    public function setUsuariocreacion($_usuariocreacion)
    {
        $this->_usuariocreacion = $_usuariocreacion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdequipotec()
    {
        return $this->_idequipotec;
    }

    /**
     * @param mixed $_idequipotec
     *
     * @return self
     */
    public function setIdequipotec($_idequipotec)
    {
        $this->_idequipotec = $_idequipotec;

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
    public function getEliminado()
    {
        return $this->_eliminado;
    }

    /**
     * @param mixed $_eliminado
     *
     * @return self
     */
    public function setEliminado($_eliminado)
    {
        $this->_eliminado = $_eliminado;

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