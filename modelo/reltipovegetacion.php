<?php
class reltipovegetacion
{

	private $_idreltipovegeincendioforestal;
	private $_idtipovegetacion;
	private $_idincendio;
    private $_areraprotegida;
    private $_zonaamortiguamiento;
   

    

    /**
     * @return mixed
     */
    public function getIdreltipovegeincendioforestal()
    {
        return $this->_idreltipovegeincendioforestal;
    }

    /**
     * @param mixed $_idreltipovegeincendioforestal
     *
     * @return self
     */
    public function setIdreltipovegeincendioforestal($_idreltipovegeincendioforestal)
    {
        $this->_idreltipovegeincendioforestal = $_idreltipovegeincendioforestal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdtipovegetacion()
    {
        return $this->_idtipovegetacion;
    }

    /**
     * @param mixed $_idtipovegetacion
     *
     * @return self
     */
    public function setIdtipovegetacion($_idtipovegetacion)
    {
        $this->_idtipovegetacion = $_idtipovegetacion;

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
    public function getAreraprotegida()
    {
        return $this->_areraprotegida;
    }

    /**
     * @param mixed $_areraprotegida
     *
     * @return self
     */
    public function setAreraprotegida($_areraprotegida)
    {
        $this->_areraprotegida = $_areraprotegida;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getZonaamortiguamiento()
    {
        return $this->_zonaamortiguamiento;
    }

    /**
     * @param mixed $_zonaamortiguamiento
     *
     * @return self
     */
    public function setZonaamortiguamiento($_zonaamortiguamiento)
    {
        $this->_zonaamortiguamiento = $_zonaamortiguamiento;

        return $this;
    }
}
?>