<?php

class Postuler {
     
    private $id_utilisateur;
    private $id_offre;
    
    function __construct($id_offre, $id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
        $this->id_offre = $id_offre;
    }

    function getIdUtilisateur() {
        return $this->id_utilisateur;
    }

    function getId_offre() {
        return $this->id_offre;
    }

    function setIdUtilisateur($id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
    }

    function setId_offre($id_offre) {
        $this->id_offre = $id_offre;
    }

}