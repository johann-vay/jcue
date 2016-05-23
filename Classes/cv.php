<?php

class cv {
    
    private $id;
    private $titre;
    private $langueParlee;
    private $langueEcrite;
    private $centreInterets;
    private $competences;
    private $id_utilisateur;
    
    function __construct($id, $titre, $langueParlee, $langueEcrite, $centreInterets, $competences, $id_utilisateur) {
        $this->id = $id;
        $this->titre = $titre;
        $this->langueParlee = $langueParlee;
        $this->langueEcrite = $langueEcrite;
        $this->centreInterets = $centreInterets;
        $this->competences = $competences;
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

    function setId_utilisateur($id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
    }

}
