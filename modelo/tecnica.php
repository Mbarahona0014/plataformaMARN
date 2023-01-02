<?php

class tecnica
{
	private $_idtecnica;
	private $_usosuelo;
	private $_tecnica;
    private $_estado;

	function __construct()
	{
		
	}





    /**
     * @return mixed
     */
    public function getIdtecnica()
    {
        return $this->_idtecnica;
    }

    /**
     * @param mixed $_idtecnica
     *
     * @return self
     */
    public function setIdtecnica($_idtecnica)
    {
        $this->_idtecnica = $_idtecnica;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsosuelo()
    {
        return $this->_usosuelo;
    }

    /**
     * @param mixed $_usosuelo
     *
     * @return self
     */
    public function setUsosuelo($_usosuelo)
    {
        $this->_usosuelo = $_usosuelo;

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