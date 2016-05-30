<?php

class Message {
     
    private $id;
    private $contenu;
    private $lu;
    private $id_expediteur;
    private $id_destinataire;
    
    function __construct($contenu, $id_expediteur, $id_destinataire, $lu, $id = null) {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->lu = $lu;
        $this->id_expediteur = $id_expediteur;
        $this->id_destinataire = $id_destinataire;
    }
    
    function getId() {
        return $this->id;
    }

    function getContenu() {
        return $this->contenu;
    }
    function getLu() {
        return $this->lu;
    }

    function setLu($lu) {
        $this->lu = $lu;
    }

        function getId_destinataire() {
        return $this->id_destinataire;
    }
    function getId_expediteur() {
        return $this->id_expediteur;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    function setId_expediteur($id_expediteur) {
        $this->id_expediteur = $id_expediteur;
    }
    
    function setId_destinataire($id_destinataire) {
        $this->id_destinataire = $id_destinataire;
    }





}
