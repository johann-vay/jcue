<?php

class Entreprise {
     
    private $id;
    private $raisonSociale;
    private $numeroSiret;

    function __construct($id, $raisonSociale, $numeroSiret) {
        $this->id = $id;
        $this->raisonSociale = $raisonSociale;
        $this->numeroSiret = $numeroSiret;
    }
    
    function getId() {
        return $this->id;
    }

    function getRaisonSociale() {
        return $this->raisonSociale;
    }

    function getNumeroSiret() {
        return $this->numeroSiret;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setRaisonSociale($raisonSociale) {
        $this->raisonSociale = $raisonSociale;
    }

    function setNumeroSiret($numeroSiret) {
        $this->numeroSiret = $numeroSiret;
    }


    
}
