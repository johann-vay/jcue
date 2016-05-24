<?php

class Message {
     
    private $id;
    private $contenu;
    private $id_utilisateur;
    
    function __construct($id, $contenu, $id_utilisateur) {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->id_utilisateur = $id_utilisateur;
    }
    
    function getId() {
        return $this->id;
    }

    function getContenu() {
        return $this->contenu;
    }

    function getId_utilisateur() {
        return $this->id_utilisateur;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    function setId_utilisateur($id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
    }



}
