<?php

class usuario
{
	private $_id;
	private $_codigo;
	private $_nombre;
    private $_apellido;
    private $_usuarioad;
    private $_correo;
    private $_estado;
    private $_idtipo;

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
    public function getCodigo()
    {
        return $this->_codigo;
    }

    /**
     * @param mixed $_codigo
     *
     * @return self
     */
    public function setCodigo($_codigo)
    {
        $this->_codigo = $_codigo;

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
    public function getUsuarioad()
    {
        return $this->_usuarioad;
    }

    /**
     * @param mixed $_usuarioad
     *
     * @return self
     */
    public function setUsuarioad($_usuarioad)
    {
        $this->_usuarioad = $_usuarioad;

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
     * @param mixed $_idTipo
     *
     * @return self
     */
    public function setIdtipo($_idtipo)
    {
        $this->_idtipo = $_idtipo;

        return $this;
    }

    

    
}

?>