<?php

class usuarioexterno
{
	private $_id;
	private $_nombre;
    private $_apellido;
    private $_correo;
    private $_contra;
    private $_estadocontra;
    private $_estadocambiocontra;
    private $_estado;
    private $_idtipo;
    private $_idinstitucion;

	function __construct()
	{
		
	}

    

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $_id
     *
     * @return self
     */
    public function setId($_id)
    {
        $this->_id = $_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->_nombre;
    }

    /**
     * @param mixed $_nombre
     *
     * @return self
     */
    public function setNombre($_nombre)
    {
        $this->_nombre = $_nombre;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->_apellido;
    }

    /**
     * @param mixed $_apellido
     *
     * @return self
     */
    public function setApellido($_apellido)
    {
        $this->_apellido = $_apellido;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->_correo;
    }

    /**
     * @param mixed $_correo
     *
     * @return self
     */
    public function setCorreo($_correo)
    {
        $this->_correo = $_correo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContra()
    {
        return $this->_contra;
    }

    /**
     * @param mixed $_contra
     *
     * @return self
     */
    public function setContra($_contra)
    {
        $this->_contra = $_contra;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstadocontra()
    {
        return $this->_estadocontra;
    }

    /**
     * @param mixed $_estadocontra
     *
     * @return self
     */
    public function setEstadocontra($_estadocontra)
    {
        $this->_estadocontra = $_estadocontra;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstadocambiocontra()
    {
        return $this->_estadocambiocontra;
    }

    /**
     * @param mixed $_estadocambiocontra
     *
     * @return self
     */
    public function setEstadocambiocontra($_estadocambiocontra)
    {
        $this->_estadocambiocontra = $_estadocambiocontra;

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
    public function getIdtipo()
    {
        return $this->_idtipo;
    }

    /**
     * @param mixed $_idtipo
     *
     * @return self
     */
    public function setIdtipo($_idtipo)
    {
        $this->_idtipo = $_idtipo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdinstitucion()
    {
        return $this->_idinstitucion;
    }

    /**
     * @param mixed $_idinstitucion
     *
     * @return self
     */
    public function setIdinstitucion($_idinstitucion)
    {
        $this->_idinstitucion = $_idinstitucion;

        return $this;
    }
}

?>