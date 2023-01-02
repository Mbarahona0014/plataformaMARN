<?php
class archivorestauracion
{

	private $_idarchivo;
    private $_archivo;
	private $_idrestauracion;
	


    

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
    public function getIdrestauracion()
    {
        return $this->_idrestauracion;
    }

    /**
     * @param mixed $_idrestauracion
     *
     * @return self
     */
    public function setIdrestauracion($_idrestauracion)
    {
        $this->_idrestauracion = $_idrestauracion;

        return $this;
    }
}
?>