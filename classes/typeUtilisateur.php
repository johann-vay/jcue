<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of typeUtilisateur
 *
 * @author Johann
 */
class TypeUtilisateur {
    
    private $id;
    private $libelle;
    
    function __construct($id, $libelle) {
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
