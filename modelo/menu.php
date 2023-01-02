<?php

class menu{
	private $_idmenu;
	private $_valor;
	private $_estado;
	private $_idtipousuario;




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
    public function getIdtipousuario()
    {
        return $this->_idtipousuario;
    }

    /**
     * @param mixed $_idtipousuario
     *
     * @return self
     */
    public function setIdtipousuario($_idtipousuario)
    {
        $this->_idtipousuario = $_idtipousuario;

        return $this;
    }

    
}

?>