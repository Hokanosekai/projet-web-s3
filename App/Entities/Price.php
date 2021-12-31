<?php

namespace App\Entities;

class Price {

    private $id;
    private $titre;
    private $prix;
    private $evt_id;

    /**
     * EvenementModel constructor.
     */
    public function __construct() {}

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getEvtId()
    {
        return $this->evt_id;
    }

    /**
     * @param mixed $evt_id
     */
    public function setEvtId($evt_id)
    {
        $this->evt_id = $evt_id;
    }
}
