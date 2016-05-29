<?php
require_once '../required.php';

class Particulier extends User{
    private $nom;
    private $prenom;
    private $urlVideo;
     
    function __construct( $nom, $prenom, $urlVideo, $adresse, $codePostal, $ville, $mail, $telephone, $login, $password, $type, $id = null) {
        parent::__construct($id, $adresse, $codePostal, $ville, $mail, $telephone, $login, $password, $type);
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->urlVideo = $urlVideo;
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

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setUrlVideo($urlVideo) {
        $this->urlVideo = $urlVideo;
    }

    
}
