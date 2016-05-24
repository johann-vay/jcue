<?php

class Offre {
    

    private $id;
    private $libelle;
    private $duree;
    private $descriptionMission;
    private $dateDebut;
    private $id_utilisateur;
    private $id_typeContrat;
    
    function __construct($id, $libelle, $duree, $descriptionMission, $dateDebut, $id_utilisateur, $id_typeContrat) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->duree = $duree;
        $this->descriptionMission = $descriptionMission;
        $this->dateDebut = $dateDebut;
        $this->id_utilisateur = $id_utilisateur;
        $this->id_typeContrat = $id_typeContrat;
    }
    
    function getId() {
        return $this->id;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function getDuree() {
        return $this->duree;
    }

    function getDescriptionMission() {
        return $this->descriptionMission;
    }

    function getDateDebut() {
        return $this->dateDebut;
    }

    function getId_utilisateur() {
        return $this->id_utilisateur;
    }

    function getId_typeContrat() {
        return $this->id_typeContrat;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setDuree($duree) {
        $this->duree = $duree;
    }

    function setDescriptionMission($descriptionMission) {
        $this->descriptionMission = $descriptionMission;
    }

    function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;
    }

    function setId_utilisateur($id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
    }

    function setId_typeContrat($id_typeContrat) {
        $this->id_typeContrat = $id_typeContrat;
    }


    
}