<?php

class periodopoints
{
	private $_id;
	private $_ano;
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
    public function getAno()
    {
        return $this->_ano;
    }

    /**
     * @param mixed $_ano
     *
     * @return self
     */
    public function setAno($_ano)
    {
        $this->_ano = $_ano;

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