<?php

class ExperiencePro {
    
    private $id;
    private $lieu;
    private $dateDebut;
    private $dateFin;
    private $duree;
    private $posteOccupe;
    private $descriptionMission;
    private $id_cv;
    
    function __construct($id, $lieu, $dateDebut, $dateFin, $duree, $posteOccupe, $descriptionMission, $id_cv) {
        $this->id = $id;
        $this->lieu = $lieu;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->duree = $duree;
        $this->posteOccupe = $posteOccupe;
        $this->descriptionMission = $descriptionMission;
        $this->id_cv = $id_cv;
    }
    
    function getId() {
        return $this->id;
    }

    function getLieu() {
        return $this->lieu;
    }

    function getDateDebut() {
        return $this->dateDebut;
    }

    function getDateFin() {
        return $this->dateFin;
    }

    function getDuree() {
        return $this->duree;
    }

    function getPosteOccupe() {
        return $this->posteOccupe;
    }

    function getDescriptionMission() {
        return $this->descriptionMission;
    }

    function getId_cv() {
        return $this->id_cv;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLieu($lieu) {
        $this->lieu = $lieu;
    }

    function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;
    }

    function setDateFin($dateFin) {
        $this->dateFin = $dateFin;
    }

    function setDuree($duree) {
        $this->duree = $duree;
    }

    function setPosteOccupe($posteOccupe) {
        $this->posteOccupe = $posteOccupe;
    }

    function setDescriptionMission($descriptionMission) {
        $this->descriptionMission = $descriptionMission;
    }

    function setId_cv($id_cv) {
        $this->id_cv = $id_cv;
    }



}