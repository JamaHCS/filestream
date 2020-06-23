<?php


class student
{
    public $nombre;
    public $ap;
    public $am;
    public $matricula;
    public $profilePhoto;

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }


    /**
     * student constructor.
     * @param $nombre
     * @param $ap
     * @param $am
     * @param $matricula
     * @param $profilePhoto
     */

    public function __construct($nombre, $ap, $am, $matricula, $profilePhoto)
    {
        $this->nombre = $nombre;
        $this->ap = $ap;
        $this->am = $am;
        $this->matricula = $matricula;
        $this->profilePhoto = $profilePhoto;
    }



    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getAp()
    {
        return $this->ap;
    }

    /**
     * @param mixed $ap
     */
    public function setAp($ap)
    {
        $this->ap = $ap;
    }

    /**
     * @return mixed
     */
    public function getAm()
    {
        return $this->am;
    }

    /**
     * @param mixed $am
     */
    public function setAm($am)
    {
        $this->am = $am;
    }

    /**
     * @return mixed
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * @param mixed $matricula
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }

    public function __toString()
    {
        return $this->nombre;
    }


}