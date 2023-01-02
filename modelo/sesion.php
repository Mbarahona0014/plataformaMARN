<?php

class sesion
{

    private $_correo;
    private $_contra;

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
    public function getContra()
    {
        return $this->_contra;
    }

    /**
     * @param mixed $_contra
     *
     * @return self
     */
    public function setContra($_contra)
    {
        $this->_contra = $_contra;

        return $this;
    }
}

?>