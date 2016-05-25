<?php

class TypeContrat {
     
    private $id;
    private $libelle;
    
    function __construct($libelle, $id = null) {
        $this->id = $id;
        $this->libelle = $libelle;
    }
    
    function getId() {
        return $this->id;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }



}
