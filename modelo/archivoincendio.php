<?php
class archivoincendio
{

	private $_idarchivo;
    private $_archivo;
	private $_idincendio;
	

    /**
     * @return mixed
     */
    public function getIdarchivo()
    {
        return $this->_idarchivo;
    }

    /**
     * @param mixed $_idarchivo
     *
     * @return self
     */
    public function setIdarchivo($_idarchivo)
    {
        $this->_idarchivo = $_idarchivo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArchivo()
    {
        return $this->_archivo;
    }

    /**
     * @param mixed $_archivo
     *
     * @return self
     */
    public function setArchivo($_archivo)
    {
        $this->_archivo = $_archivo;

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
}
?>