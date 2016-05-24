<?php

class Personnel extends user{
    private $nom;
    private $prenom;
    
    function __construct($nom, $prenom) {
        $this->nom = $nom;
        $this->prenom = $prenom;
    }
    
    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

}
