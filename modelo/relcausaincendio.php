<?php
class relcausaincendio
{

	private $_idrelcausaincendio;
	private $_idincendio;
	private $_idcausaincendio;
  

   

    /**
     * @return mixed
     */
    public function getIdrelcausaincendio()
    {
        return $this->_idrelcausaincendio;
    }

    /**
     * @param mixed $_idrelcausaincendio
     *
     * @return self
     */
    public function setIdrelcausaincendio($_idrelcausaincendio)
    {
        $this->_idrelcausaincendio = $_idrelcausaincendio;

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
    public function getIdcausaincendio()
    {
        return $this->_idcausaincendio;
    }

    /**
     * @param mixed $_idcausaincendio
     *
     * @return self
     */
    public function setIdcausaincendio($_idcausaincendio)
    {
        $this->_idcausaincendio = $_idcausaincendio;

        return $this;
    }
}
?>