<?php

class Formation {
     
    private $id;
    private $intitule;
    private $anneeDebut;
    private $anneeFin;
    private $nomEtablissement;
    private $villeEtablissement;
    private $diplomeVise;
    private $diplomeObtenu;
    private $id_cv;
    
    function __construct( $intitule, $anneeDebut, $anneeFin, $nomEtablissement, $villeEtablissement, $diplomeVise, $diplomeObtenu, $id_cv, $id = null) {
        $this->id = $id;
        $this->intitule = $intitule;
        $this->anneeDebut = $anneeDebut;
        $this->anneeFin = $anneeFin;
        $this->nomEtablissement = $nomEtablissement;
        $this->villeEtablissement = $villeEtablissement;
        $this->diplomeVise = $diplomeVise;
        $this->diplomeObtenu = $diplomeObtenu;
        $this->id_cv = $id_cv;
    }

    function getId() {
        return $this->id;
    }

    function getIntitule() {
        return $this->intitule;
    }

    function getAnneeDebut() {
        return $this->anneeDebut;
    }

    function getAnneeFin() {
        return $this->anneeFin;
    }

    function getNomEtablissement() {
        return $this->nomEtablissement;
    }

    function getVilleEtablissement() {
        return $this->villeEtablissement;
    }

    function getDiplomeVise() {
        return $this->diplomeVise;
    }

    function getDiplomeObtenu() {
        return $this->diplomeObtenu;
    }

    function getId_cv() {
        return $this->id_cv;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIntitule($intitule) {
        $this->intitule = $intitule;
    }

    function setAnneeDebut($anneeDebut) {
        $this->anneeDebut = $anneeDebut;
    }

    function setAnneeFin($anneeFin) {
        $this->anneeFin = $anneeFin;
    }

    function setNomEtablissement($nomEtablissement) {
        $this->nomEtablissement = $nomEtablissement;
    }

    function setVilleEtablissement($villeEtablissement) {
        $this->villeEtablissement = $villeEtablissement;
    }

    function setDiplomeVise($diplomeVise) {
        $this->diplomeVise = $diplomeVise;
    }

    function setDiplomeObtenu($diplomeObtenu) {
        $this->diplomeObtenu = $diplomeObtenu;
    }

    function setId_cv($id_cv) {
        $this->id_cv = $id_cv;
    }


}