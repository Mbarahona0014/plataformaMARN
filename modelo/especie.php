<?php

class especie
{
	private $_id;
    private $_codigo;
    private $_genero;
	private $_especie;
	private $_subespecie;
    private $_nombrecomun;
    private $_categoria;
    private $_estado;

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
    public function getGenero()
    {
        return $this->_genero;
    }

    /**
     * @param mixed $_genero
     *
     * @return self
     */
    public function setGenero($_genero)
    {
        $this->_genero = $_genero;

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
    public function getSubespecie()
    {
        return $this->_subespecie;
    }

    /**
     * @param mixed $_subespecie
     *
     * @return self
     */
    public function setSubespecie($_subespecie)
    {
        $this->_subespecie = $_subespecie;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNombrecomun()
    {
        return $this->_nombrecomun;
    }

    /**
     * @param mixed $_nombrecomun
     *
     * @return self
     */
    public function setNombrecomun($_nombrecomun)
    {
        $this->_nombrecomun = $_nombrecomun;

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
    public function getCategoria()
    {
        return $this->_categoria;
    }

    /**
     * @param mixed $_categoria
     *
     * @return self
     */
    public function setCategoria($_categoria)
    {
        $this->_categoria = $_categoria;

        return $this;
    }
}

?>