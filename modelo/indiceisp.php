<?php

class indiceisp
{
	private $_id;
	private $_ica;
	private $_iq;
	private $_ibp;
	private $_icoe;
	private $_ics;
	private $_ita;
	private $_irv;
	private $_igp;
    private $_fechainicio;
    private $_fechafin;
    private $_detallepaisaje;
    private $_idpaisaje;
	private $_estado;


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
    public function getIca()
    {
        return $this->_ica;
    }

    /**
     * @param mixed $_ica
     *
     * @return self
     */
    public function setIca($_ica)
    {
        $this->_ica = $_ica;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIq()
    {
        return $this->_iq;
    }

    /**
     * @param mixed $_iq
     *
     * @return self
     */
    public function setIq($_iq)
    {
        $this->_iq = $_iq;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIbp()
    {
        return $this->_ibp;
    }

    /**
     * @param mixed $_ibp
     *
     * @return self
     */
    public function setIbp($_ibp)
    {
        $this->_ibp = $_ibp;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIcoe()
    {
        return $this->_icoe;
    }

    /**
     * @param mixed $_icoe
     *
     * @return self
     */
    public function setIcoe($_icoe)
    {
        $this->_icoe = $_icoe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIcs()
    {
        return $this->_ics;
    }

    /**
     * @param mixed $_ics
     *
     * @return self
     */
    public function setIcs($_ics)
    {
        $this->_ics = $_ics;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIta()
    {
        return $this->_ita;
    }

    /**
     * @param mixed $_ita
     *
     * @return self
     */
    public function setIta($_ita)
    {
        $this->_ita = $_ita;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIrv()
    {
        return $this->_irv;
    }

    /**
     * @param mixed $_irv
     *
     * @return self
     */
    public function setIrv($_irv)
    {
        $this->_irv = $_irv;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIgp()
    {
        return $this->_igp;
    }

    /**
     * @param mixed $_igp
     *
     * @return self
     */
    public function setIgp($_igp)
    {
        $this->_igp = $_igp;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechainicio()
    {
        return $this->_fechainicio;
    }

    /**
     * @param mixed $_fechainicio
     *
     * @return self
     */
    public function setFechainicio($_fechainicio)
    {
        $this->_fechainicio = $_fechainicio;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechafin()
    {
        return $this->_fechafin;
    }

    /**
     * @param mixed $_fechafin
     *
     * @return self
     */
    public function setFechafin($_fechafin)
    {
        $this->_fechafin = $_fechafin;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdpaisaje()
    {
        return $this->_idpaisaje;
    }

    /**
     * @param mixed $_idpaisaje
     *
     * @return self
     */
    public function setIdpaisaje($_idpaisaje)
    {
        $this->_idpaisaje = $_idpaisaje;

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
    public function getDetallepaisaje()
    {
        return $this->_detallepaisaje;
    }

    /**
     * @param mixed $_detallepaisaje
     *
     * @return self
     */
    public function setDetallepaisaje($_detallepaisaje)
    {
        $this->_detallepaisaje = $_detallepaisaje;

        return $this;
    }
}
?>