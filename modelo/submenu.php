<?php

class submenu{
	private $_idsubmenu;
	private $_valor;
    private $_vista;
	private $_estado;
	private $_idmenu;

    /**
     * @return mixed
     */
    public function getIdsubmenu()
    {
        return $this->_idsubmenu;
    }

    /**
     * @param mixed $_idsubmenu
     *
     * @return self
     */
    public function setIdsubmenu($_idsubmenu)
    {
        $this->_idsubmenu = $_idsubmenu;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->_valor;
    }

    /**
     * @param mixed $_valor
     *
     * @return self
     */
    public function setValor($_valor)
    {
        $this->_valor = $_valor;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVista()
    {
        return $this->_vista;
    }

    /**
     * @param mixed $_vista
     *
     * @return self
     */
    public function setVista($_vista)
    {
        $this->_vista = $_vista;

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
    public function getIdmenu()
    {
        return $this->_idmenu;
    }

    /**
     * @param mixed $_idmenu
     *
     * @return self
     */
    public function setIdmenu($_idmenu)
    {
        $this->_idmenu = $_idmenu;

        return $this;
    }
}

?>