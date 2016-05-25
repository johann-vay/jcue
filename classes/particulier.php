<?php

class Particulier extends User{
    
    //private $id;
    private $nom;
    private $prenom;
    private $urlVideo;
    private $id_cv;
     
    function __construct($id, $nom, $prenom, $urlVideo, $id_cv, $adresse, $codePostal, $ville, $mail, $telephone, $login, $password, $type) {
        parent::__construct($id, $adresse, $codePostal, $ville, $mail, $telephone, $login, $password, $type);
        //$this->id =  $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->urlVideo = $urlVideo;
        $this->id_cv = $id_cv;
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

    function getUrlVideo() {
        return $this->urlVideo;
    }

    function getId_cv() {
        return $this->id_cv;
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

    function setUrlVideo($urlVideo) {
        $this->urlVideo = $urlVideo;
    }

    function setId_cv($id_cv) {
        $this->id_cv = $id_cv;
    }


    
}
