<?php

class instituciones
{
	private $_id;
	private $_nombreinstitucion;
	private $correocontacto;
	private $_contacto;
	private $_telefono;
	private $_estado;

	function __construct(){

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
    public function getNombreinstitucion()
    {
        return $this->_nombreinstitucion;
    }

    /**
     * @param mixed $_nombreinstitucion
     *
     * @return self
     */
    public function setNombreinstitucion($_nombreinstitucion)
    {
        $this->_nombreinstitucion = $_nombreinstitucion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCorreocontacto()
    {
        return $this->correocontacto;
    }

    /**
     * @param mixed $correocontacto
     *
     * @return self
     */
    public function setCorreocontacto($correocontacto)
    {
        $this->correocontacto = $correocontacto;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContacto()
    {
        return $this->_contacto;
    }

    /**
     * @param mixed $_contacto
     *
     * @return self
     */
    public function setContacto($_contacto)
    {
        $this->_contacto = $_contacto;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->_telefono;
    }

    /**
     * @param mixed $_telefono
     *
     * @return self
     */
    public function setTelefono($_telefono)
    {
        $this->_telefono = $_telefono;

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

    
}


?>