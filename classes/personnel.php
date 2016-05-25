<?php

class Personnel extends User{
    private $nom;
    private $prenom;
    
    function __construct($nom, $prenom, $adresse, $codePostal, $ville, $mail, $telephone, $login, $password, $type, $id = null) {
        parent::__construct($id, $adresse, $codePostal, $ville, $mail, $telephone, $login, $password, $type);
        $this->nom = $nom;
        $this->prenom = $prenom;
    }
    
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }



}
 