<?php

class Cv {
    
    private $id;
    private $titre;
    private $langueParlee;
    private $langueEcrite;
    private $centreInterets;
    private $competences;
    private $urlVideo;
    private $id_utilisateur;
    
    function __construct($titre, $langueParlee, $langueEcrite, $centreInterets, $competences, $id_utilisateur, $id = null, $urlVideo = null) {
        $this->id = $id;
        $this->titre = $titre;
        $this->langueParlee = $langueParlee;
        $this->langueEcrite = $langueEcrite;
        $this->centreInterets = $centreInterets;
        $this->competences = $competences;
        $this->urlVideo = $urlVideo;
        $this->id_utilisateur = $id_utilisateur;
    }
    
     
    function getId() {
        return $this->id;
    }

    function getTitre() {
        return $this->titre;
    }

    function getLangueParlee() {
        return $this->langueParlee;
    }

    function getLangueEcrite() {
        return $this->langueEcrite;
    }

    function getCentreInterets() {
        return $this->centreInterets;
    }

    function getCompetences() {
        return $this->competences;
    }
    
    function getUrlVideo(){
        return $this->urlVideo;
    }

    function getId_utilisateur() {
        return $this->id_utilisateur;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitre($titre) {
        $this->titre = $titre;
    }

    function setLangueParlee($langueParlee) {
        $this->langueParlee = $langueParlee;
    }

    function setLangueEcrite($langueEcrite) {
        $this->langueEcrite = $langueEcrite;
    }

    function setCentreInterets($centreInterets) {
        $this->centreInterets = $centreInterets;
    }

    function setCompetences($competences) {
        $this->competences = $competences;
    }
    
    function setUrlVideo($urlVideo){
        $this->urlVideo = $urlVideo;
    }

    function setId_utilisateur($id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
    }

}
