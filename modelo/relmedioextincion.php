<?php
class relmedioextincion
{

	private $_idrelmedioextincendioforestal;
	private $_idmedioextincion;
	private $_idincendio;
    private $_cantidad;
   


    /**
     * @return mixed
     */
    public function getIdrelmedioextincendioforestal()
    {
        return $this->_idrelmedioextincendioforestal;
    }

    /**
     * @param mixed $_idrelmedioextincendioforestal
     *
     * @return self
     */
    public function setIdrelmedioextincendioforestal($_idrelmedioextincendioforestal)
    {
        $this->_idrelmedioextincendioforestal = $_idrelmedioextincendioforestal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdmedioextincion()
    {
        return $this->_idmedioextincion;
    }

    /**
     * @param mixed $_idmedioextincion
     *
     * @return self
     */
    public function setIdmedioextincion($_idmedioextincion)
    {
        $this->_idmedioextincion = $_idmedioextincion;

        return $this;
    }

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
    public function getCantidad()
    {
        return $this->_cantidad;
    }

    /**
     * @param mixed $_cantidad
     *
     * @return self
     */
    public function setCantidad($_cantidad)
    {
        $this->_cantidad = $_cantidad;

        return $this;
    }
}
?>